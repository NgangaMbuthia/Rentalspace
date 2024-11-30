<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller ;
use Modules\Backend\Entities\Property;
use Auth;
use Entrust;
use Modules\Backend\Entities\Space;
use DB;
use Modules\Backend\Entities\Repair;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\RepairItem;
use Session;
use Modules\Backend\Entities\Invoice;
use Modules\Backend\Entities\Tenant;
use Modules\Supplier\Entities\Supplier;
use Modules\Supplier\Entities\ProviderSupplier;
use Modules\Tenants\Entities\RepairRequest;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;
use App\Http\Middleware\AccountSetUp;



class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AccountSetUp::class);

    }

    public function index()
    {
         if(Entrust::hasRole("Provider") && Helper::testModule("Maintanance Module",Auth::User()->getProvider->id))
          {
      
        $data['page_title']="Manage Your Repairs";
        $data['type']=(isset($_GET['type'])) ? $_GET['type']:"All";
        return view('backend::repairs.index',$data);

        }else{
          Session::flash("danger_msg","You have not subscribed to this module");
            return view("forbidden"); 
        }

    }

    public function getRepairItems(){

       if(Entrust::hasRole("Provider") && Helper::testModule("Maintanance Module",Auth::User()->getProvider->id))
          {
      
        $data['page_title']="Manage Your Repairs";
        $data['models']=Repair::join('repair_items','repair_items.repair_id','=','repairs.id')
                        ->where(['repairs.provider_id'=>Auth::User()->getProvider->id])
                        ->get();
                         

        
        return view('backend::repairs.repairitems',$data);

        }else{
          Session::flash("danger_msg","You have not subscribed to this module");
          

    }
  }



  public function getMyRepairItems($id){
    $models=RepairItem::where(['repair_id'=>$id])->get();
    

     $data=array();
        foreach($models as $model){
           
            $data[]=array('id'=>$model->id,
                'suppliy_date'=>$model->date_supplied,
                'item'=>$model->item_name,
               );
        }

        return json_encode($data);


  }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
         if(Entrust::hasRole("Provider"))
       {
        $data['page_title']="Mantenance Module";
         $models=Property::where(['provider_id'=>Auth::User()->getProvider->id])->get();
         

         $data['properties']=$models;
         $data['repair_code']=strtoupper(str_random(8));
         
        return view('backend::repairs.create',$data);

    }else{
        return view("forbidden");
    }

    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
         if(Entrust::hasRole("Provider"))
       {
         $this->validate($request,[
            'space_id'=>'required|integer',
            'repair_code'=>'unique:repairs',
            'repair_date'=>'required|date',
            'type'=>'required',
            'responsible_person'=>'required',
            'description'=>'required',
            'total_cost'=>'integer|required',
            'technician_fee'=>'required|integer'
            

            ]);
        $data=$request->all();
          
         if(isset($data['ticket_number']) && !empty($data['ticket_number'])){

          $repair_request=RepairRequest::where(['repair_ticket'=>$data['ticket_number']])->first();
           $repair_request->status="Closed";
           $repair_request->save();
          $a=array(
                 'request_id'=>$repair_request->id,
                  'user_id'=>$repair_request->user_id
                  );

            }
            else
            {
              
                 if(isset($data['responsible_person']) && $data['responsible_person']=="Tenant")
                 {
                  $tenant=Tenant::where(['space_id'=>$data['space_id']])->where('current_status','Active')->first();
                    $user_id=$tenant->user_id;
                 }else{
                  $user_id=\Auth::user()->id;
                 }
                 $a=array('user_id'=>$user_id);

            }

           
        

         

        $provider=Space::find($data['space_id']);
        $invoice_number="#".substr(number_format(time() * rand(),0,'',''),0,6);
        $repair_data=array('space_id'=>$data['space_id'],
                            'repair_date'=>date('Y-m-d',strtotime($data['repair_date'])),
                            'type'=>$data['type'],
                            'total_cost'=>$data['total_cost'],

                            'job_done_by'=>$data['technician'],
                            'description'=>$data['description'],
                            'person_responsible'=>$data['responsible_person'],
                            'technician_fee'=>$data['technician_fee'],
                            'repair_code'=>strtoupper(str_random(8)),
                            'provider_id'=>$provider->property->provider_id,
                            'invoice_number'=>$invoice_number,
                           );
        DB::beginTransaction();
        $repair_data=array_merge($repair_data,$a);
        $model=Repair::create($repair_data);
          $total=0;
          if($data['items_bought']=="Yes")
          {
            $total=$this->processRepairItems($data,$model);
          }
         
          
          if($model->person_responsible=="Tenant")
          {
            $charge_tenant=$this->ProcessPenalt($data,$total,$model,$provider);
          }
          Session::flash('success_msg','Repairs added successfully')   ;
          DB::commit();
          return redirect()->back();

    }else{
        return view("forbidden");
    }

    }

    public function processRepairItems($data,$model)
    {
        $item_name=$data['item_name'];
        $unit_price=$data['unit_price'];
        $quantity=$data['quantity'];
        $receipt=$data['receipt'];
        $suppliers=(isset($data['supplier_id']))? $data['supplier_id']:null;
        $supply_date=$data['supply_date'];
        $total=0;
          foreach($item_name as $key=>$value)
          {
            $item=new RepairItem();
            $item->repair_id=$model->id;
            $item->item_name=$item_name[$key];
            $item->unit_price=$unit_price[$key];
            $item->quantity= $quantity[$key];
            $item->receit_number=$receipt[$key];
            $item->supplier_id=$suppliers[$key];
            $item->date_supplied=date('Y-m-d',strtotime($supply_date[$key]));
            $net_cost=$item->unit_price* $item->quantity;
            $total=$total+$net_cost;
            $item->save();
        }
        return $total;

    }

    public function ProcessPenalt($data,$sub_total,$model,$provider){
        $grand_total=$sub_total+$data['technician_fee'];
        $tenant=Tenant::where(['space_id'=>$data['space_id']])->first();
          
         if($tenant)
         {
             
                  $invoice=new Invoice();
                  $invoice->provider_id=Auth::User()->getProvider->id;
                  $invoice->issued_to=$tenant->user_id;
                  $invoice->space_id=$tenant->space_id;
                  $invoice->issue_date=date('Y-m-d');
                  $invoice->amount=$grand_total;
                  $invoice->status="Pending";
                  $invoice->due_date=date('Y-m-d', strtotime($invoice->issue_date . "+14 days"));
                  $invoice->invoice_number=$model->invoice_number;
                  $invoice->description=$data['description'];
                  $invoice->save();
            $payment_data=array('tenant_id'=>$tenant->id,
                                 'reference_number'=>$model->repair_code,
                                 'debit'=>0,
                                  'space_id'=>$data['space_id'],
                                  'type'=>'Repairs',
                                  'provider_id'=>$provider->property->provider_id,
                                  'credit'=>$grand_total,
                                  'fee_charges'=>0,
                                  'transaction_date'=>date('Y-m-d',strtotime($data['repair_date'])),
                                  'year'=>date('Y'),
                                  'month'=>date('m'),
                                  'payment_mode'=>'Others',
                                  'system_transaction_number'=>str_random(8),
                                  'description'=>'Being payment for repairs caused by Tenant(s)',

                                  );
            $payment=TenantPayment::create($payment_data);

             if($payment)
             {
                return true;
             }
             else{
                return false;
             }


         }

         return true;


    }


    private function getTenant($id)
    {
        $tenant=TenantPayment::where(['space_id'=>$id])->first();
         if($tenant)
         {
            return $tenant->tenant_id;
         }
         else{
            return false;
         }

    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('backend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function getRepairRequests() {
       if(Entrust::hasRole("Provider")){
        $data['page_title']="Manage Repair Requests";
        $data['status']=(isset($_GET['status']))? $_GET['status']:'All';
        return view('backend::repairs._viewrequests',$data);



       }else{
        return "Access Denied.You do not have permission to access this module";
       }
    }


    public function fetchRepairRequest($status){
       DB::statement(DB::raw('set @rownum=0'));
       $id=Auth::User()->getProvider->id;


      if($status=="All"){
    $models=RepairRequest::join('spaces','spaces.id','=','repair_requests.space_id')
             ->join('users','users.id','=','repair_requests.user_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->select(['repair_requests.repair_ticket','repair_requests.id','users.name','spaces.number','repair_requests.priorty','repair_requests.type as repair_type','expected_repair_date','expected_investination_date','repair_requests.status as repaiR-status'])
             ->where('properties.provider_id',$id);
             
          }
    else if($status=="Year"){
        $models=RepairRequest::join('spaces','spaces.id','=','repair_requests.space_id')
             ->join('users','users.id','=','repair_requests.user_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->select(['repair_requests.repair_ticket','repair_requests.id','users.name','spaces.number','repair_requests.priorty','repair_requests.type as repair_type','expected_repair_date','expected_investination_date','repair_requests.status as repaiR-status'])
             ->whereYear('repair_requests.created_at',date('Y'))
             ->where('properties.provider_id',$id);



    }
    else if($status=="Month"){
        $models=RepairRequest::join('spaces','spaces.id','=','repair_requests.space_id')
             ->join('users','users.id','=','repair_requests.user_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->select(['repair_requests.repair_ticket','repair_requests.id','users.name','spaces.number','repair_requests.priorty','repair_requests.type as repair_type','expected_repair_date','expected_investination_date','repair_requests.status as repaiR-status'])
             ->whereMonth('repair_requests.created_at',date('m'))
             ->where('properties.provider_id',$id);



    }


     else{
      $models=RepairRequest::join('spaces','spaces.id','=','repair_requests.space_id')
             ->join('users','users.id','=','repair_requests.user_id')
              ->join('properties','properties.id','=','spaces.property_id')
             ->select(['repair_requests.repair_ticket','repair_requests.id','users.name','spaces.number','repair_requests.priorty','repair_requests.type as repair_type','expected_repair_date','expected_investination_date','repair_requests.status as repaiR-status'])
              ->where('properties.provider_id',$id)
              ->where('repair_requests.status',$status);
              
     }
         


    
           return Datatables::of($models)
           ->editColumn('name',function($model){
                 $fullname=explode(' ', $model->name);
                  return $fullname[0]."  " .$fullname[1];
               })
           ->editColumn('repair_ticket',function($model){
            $job_request_url=url('/serviceproviders/job_requests/create/'.$model->id);
            return '<a  data-url="'.$job_request_url.'"   data-title="Create Job Request" class="reject-modal">'.$model->repair_ticket.'</a>';

           })
           ->make(true);
               

    }


    public function fetchRepairs($type){

      DB::statement(DB::raw('set @rownum=0'));
      $id=Auth::User()->getProvider->id;
        if($type=="Year"){
          $models=Repair::join('spaces','spaces.id','=','repairs.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('repair_requests','repair_requests.id','=','repairs.request_id')
              ->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'repair_ticket','repair_requests.type','priorty','level','expected_investination_date','expected_repair_date','repair_requests.status as status','number','spaces.title','repairs.id','repair_code','repair_date','total_cost','person_responsible','repairs.type as repair_type'])
              ->where('repairs.provider_id',$id)
              ->whereYear('repairs.created_at',date("Y"));

              ;

        }
        else if($type=="Month"){
          $models=Repair::join('spaces','spaces.id','=','repairs.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('repair_requests','repair_requests.id','=','repairs.request_id')
              ->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'repair_ticket','repair_requests.type','priorty','level','expected_investination_date','expected_repair_date','repair_requests.status as status','number','spaces.title','repairs.id','repair_code','repair_date','total_cost','person_responsible','repairs.type as repair_type'])
              ->where('repairs.provider_id',$id)
              ->whereMonth('repairs.created_at',date("m"));

              ;

        }


        else{
          $models=Repair::join('spaces','spaces.id','=','repairs.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('repair_requests','repair_requests.id','=','repairs.request_id')
              ->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'repair_ticket','repair_requests.type','priorty','level','expected_investination_date','expected_repair_date','repair_requests.status as status','number','spaces.title','repairs.id','repair_code','repair_date','total_cost','person_responsible','repairs.type as repair_type'])
              ->where('repairs.provider_id',$id);
        }
      
               return Datatables::of($models)
                ->editColumn('total_cost',function($model){
                $total_cost_url=url('/backend/space/repair/'.$model->id);
                 return '<a tyle="cursor:pointer;color:blue;"  title="View Repair Costings" class="reject-modal" data-title="Repair Costings" data-url="'.$total_cost_url.'">'.$model->total_cost.'</a>';
               })
                 ->editColumn('repair_code',function($model){
                $total_cost_url=url('/backend/view/repair/'.$model->id);
                 return '<a tyle="cursor:pointer;color:red;"  title="View Repair Details" class="reject-modal" data-title="Repair Details" data-url="'.$total_cost_url.'">'.$model->repair_code.'</a>';
               })


                ->make(true);
               

    }


    public function viewRepairsDetails($id){
      if(Entrust::hasRole("Provider") && Helper::testModule("Maintanance Module",Auth::User()->getProvider->id))
          {
        $model=Repair::where(['id'=>$id,'provider_id'=>Auth::User()->getProvider->id])->first();
         if(!$model){
          return "Resource You are looking for was not found on this Server";
         }else{
          $data['model']=$model;
          return view('backend::repairs._repair',$data);
           
         }
        
         
        

        }else{
           return "You have not subscribed to this module";
        }
         

    }

    public function getTicket(){
      $q=Input::get('term');

        if(strlen($q)>3){
          

          if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $q))
            {
               $q="#".$q;
            }

           


        $models=RepairRequest::where('repair_ticket','like','%'.$q.'%')->where('status','!=','Closed')->get();
         

        if(sizeof($models)>0){
           $data=array();
       foreach($models as $model){
           $invoice_id=$model->id;
           $date_create=date('dS M Y',strtotime($model->created_at));
           $data[]=array($invoice_id,$model->repair_ticket,$date_create);
    
       }
      
   
   $data=json_encode($data);
   return $data;


        }else{

          $data=json_decode("Invoice Not Found In Our Records");
           return $data;

        }
      

    }
    }
}
