<?php

namespace Modules\Tenants\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use Modules\Backend\Entities\TenantPayment;
use Entrust;
use Modules\Backend\Entities\Tenant;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Modules\Backend\Entities\Invoice;
use Modules\Backend\Entities\Repair;
use Modules\Tenants\Entities\RepairRequest;
use Modules\Backend\Entities\Space;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;
use DB;

class TenantsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */


     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('tenants::index');
    }

    public function getSubmittedPayments()
    {
       if(Entrust::hasRole("Renter"))
        {
          $data['page_title']="Submitted Payments";
            return view('tenants::tenants.submitted_payments',$data);



        }else{
          return view("forbidden");
        }



    }



    public function getMonthList($number){
     $first  = strtotime('first day next month');

$months = array();

for ($i = $number; $i >= 1; $i--) {
   $year=date('Y', strtotime("-$i month", $first));
   $month=date('M', strtotime("-$i month", $first));
   $months[]=array($year=>$month);
  
}
 return $months;

}


    public function getPaymentHistory($year){

       

           $enterprise_count=TenantPayment::count();

             if($enterprise_count>0){

                $months=$this->getMonthList(6);
                $data=array();
                 foreach($months as $month){
                     foreach($month as $key=>$value):
                         $y=$value.' '.$key;
                        $value=date_parse($value);
                         $value=$value['month'];
                $tenant_id=Auth::user()->tenant->id;
                $user_id=Auth::user()->id;

                $sum=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')->where('user_id',$user_id)->whereYear('transaction_date',$key)->whereMonth('transaction_date',$value)->sum('debit');

                $data[]=array('y'=>$y,'a'=>$sum);

              endforeach;
            }

           echo json_encode($data);

             }else{
               echo "No Data To Show";
             }

}

   public function getSpace(){
      if(Entrust::hasRole("Renter")){
        $data['page_title']="Tenancy History";
        $data['status']=(isset($_GET['status']))? $_GET['status']:'All';
         return view('tenants::tenants.space_index',$data);



      }else{
        return view('forbidden');
      }

   }


   public function fetchSpaceHistory($status){

    $bookings=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','monthly_fee'])
          ->where(['users.id'=>\Auth::user()->id,'current_status'=>$status])
          ->get();

          return Datatables::of($bookings)->addColumn('action', function ($model) {
                     $url=url('/backend/v-notice/extend/'.$model->id);
                     $url_to=url('/backend/notices/create/'.$model->tenant_id);
                      return '<button class="btn btn-sm btn-primary">View More Details</button>
                                ';

                    
                    })->make(true);;

   }


   public function ftechMyRequests(){
      $models=RepairRequest::join('spaces','spaces.id','=','repair_requests.space_id')
             ->join('users','users.id','=','repair_requests.user_id')
              ->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'repair_ticket','repair_requests.type','priorty','level','expected_investination_date','expected_repair_date','repair_requests.status as status','number','title','repair_requests.id'])
              ->where(['users.id'=>Auth::user()->id]);
        return Datatables::of($models)
        ->editColumn('status',function($model){
                if($model->status=="Pending"){
                   return '<label class="label label-warning">'.$model->status.'</label>';

                }elseif($model->status=="Closed"){
                  return '<label class="label label-success">'.$model->status.'</label>';
                }else if($model->status=="Processed"){
                   return '<label class="label label-info">'.$model->status.'</label>';
                }

                else if($model->status=="Open"){
                   return '<label class="label label-primary">'.$model->status.'</label>';
                }else{
                  return '<label class="label label-danger">'.$model->status.'</label>';
                }




               })->make(true);

   }


   public function getInvoices(){
     if(Entrust::hasRole("Renter")){
        $data['page_title']="Tenant Invoices";
        $data['status']=(isset($_GET['status']))? $_GET['status']:'All';
        return view('tenants::tenants.invoices',$data);





     }else{
        return view('forbidden');
     }
}


public function fetchInvoices($status){

      $id=Auth::user()->id;

    if($status=="All"){
            $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
             ->join('invoices','spaces.id','=','invoices.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['invoices.id','users.name','invoice_number','properties.title','spaces.number','invoices.status','amount','properties.id as P_id','tenants.id as tenant_id','invoices.created_at','issue_date','due_date'])
             ->where('issued_to','=',$id);

           }else{
            $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
             ->join('invoices','spaces.id','=','invoices.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['invoices.id','users.name','invoice_number','properties.title','spaces.number','invoices.status','amount','properties.id as P_id','tenants.id as tenant_id','invoices.created_at','issue_date','due_date'])
             ->where(['invoices.status'=>$status])
             ->where('issued_to','=',$id);
           }
        
              return Datatables::of($models)

         ->editColumn('name',function($model){
            $pro_url=url('/backend/tenant/view/'.$model->tenant_id);
             return '<a href="'.$pro_url.'">'.$model->name.'</a>';

         })
         ->editColumn('created_at',function($model){
            $pro_url=url('/backend/tenant/view/'.$model->tenant_id);
             return date('F, Y',strtotime($model->created_at));

         })
          ->editColumn('status',function($model){
              $status=$model->status;
               if($status=="Pending"){
                return "<label class='label label-primary'>".$model->status."</label>";
               }elseif($status=="Paid"){
                return "<label class='label label-success'>".$model->status."</label>";
               }
               elseif($status=="Cancelled"){
                return "<label class='label label-info'>".$model->status."</label>";
               }
                elseif($status=="Overdue"){
                return "<label class='label label-danger'>".$model->status."</label>";
               }
               elseif($status=="On Hold"){
                return "<label class='label label-default'>".$model->status."</label>";
               }
                else{
                return "<label class='label label-warning'>".$model->status."</label>";
               }


         })

         ->editColumn('title',function($model){
            $pro_url=url('/backend/property/view/'.$model->P_id);
             return '<a href="'.$pro_url.'">'.$model->title.'</a>';

         })->addColumn('action', function ($model) {
                  $invoice_url=url('/backend/invoice/view/'.$model->id);
                  $cancel_url=url('/backend/invoice/cancel/'.$model->id);
                  $download_url=url('/backend/invoice/download/'.$model->id);
                     
                      if($model->status=="Pending")
                      {
                        return '<ul class="icons-list">
                      <li><a href="'.$invoice_url.'" ><i class="icon-file-eye"></i></a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="'.$download_url.'"><i class="icon-file-download"></i> Download</a></li>
                         
                           
                          
                       
                        </ul>
                      </li>
                    </ul>';


                      }else{
                        return '<ul class="icons-list">
                      <li><a href="'.$invoice_url.'" ><i class="icon-file-eye"></i></a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                           <li><a href="'.$download_url.'"><i class="icon-file-download"></i> Download</a></li>
                         
                           
                          
                       
                        </ul>
                      </li>
                    </ul>';

                      }
            })->make(true);
}




public function gettransactions(){

    if(Entrust::hasRole("Renter")){
        $data['page_title']="Tenant Transactions";
        $data['status']=(isset($_GET['status']))? $_GET['status']:'All';
        return view('tenants::tenants.transactions',$data);
     }
     else
     {
        return view('forbidden');
     }

}


public function fetchAllTransactions(){

  $p_id=Auth::User()->tenant->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id','payment_mode'])
          ->where(['tenant_id'=>$p_id]);
          
        
         
           return Datatables::of($models)
           ->editColumn('name',function($model){
            list($a,$b)=explode(' ', $model->name);
             return ucwords($a)." " .ucfirst($b);

           })
           ->editColumn('invoice_id',function($model){
            $invoices_url=url('/backend/invoice/view/'.$model->invoice_id);

            $model=Invoice::find($model->invoice_id);
              if($model){
                return '<a href="'.$invoices_url.'" >'.$model->invoice_number.'</a>';


                //$model->invoice_number;
              }else{
                return "Not Set";
              }



           })->make(true);


}


public function getDeductions(){
   if(Entrust::hasRole("Renter")){
        $data['page_title']="Tenant Deductions";
        $data['status']=(isset($_GET['status']))? $_GET['status']:'All';
        return view('tenants::tenants.deductions',$data);
     }
     else
     {
        return view('forbidden');
     }
}

public function fetchDeductions(){

        $p_id=Auth::User()->tenant->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')
          
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id','tenant_payments.created_at','sub_categories.name as sub_cat','tenant_payments.id as payment_id'])
          ->where('credit','>',0)
          ->where(['tenant_id'=>$p_id])
          ;
          
        
         
           return Datatables::of($models)
           ->editColumn('reference_number',function($model){
            $url_to=url('/backend/tenant/payment/view/'.$model->payment_id);
            return '<span  data-url="'.$url_to.'" style="cursor:pointer;color:green"  title="View More Details"  class="reject-modal"
                                data-title="View Details" >'.$model->reference_number.'</span>';

           })->editColumn('invoice_id',function($model){
            $invoices_url=url('/backend/invoice/view/'.$model->invoice_id);

            $model=Invoice::find($model->invoice_id);
              if($model){
                return '<a href="'.$invoices_url.'" >'.$model->invoice_number.'</a>';


                //$model->invoice_number;
              }else{
                return "Not Set";
              }



           })->make(true);

}


public function getAdditions(){

  if(Entrust::hasRole("Renter")){
        $data['page_title']="Tenant Top Ups/Account Additions";
        $data['status']=(isset($_GET['status']))? $_GET['status']:'All';
        return view('tenants::tenants.additions_index',$data);
     }
     else
     {
        return view('forbidden');
     }

}

public function fetchDebits(){
         $p_id=Auth::User()->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')

          ->join('properties','properties.id','=','spaces.property_id')
           ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id','tenant_payments.created_at','sub_categories.name as sub_cat','tenant_payments.id as payment_id'])
          ->where('debit','>',0)
          ->where(['users.id'=>$p_id])
          ;
          
        
         
           return Datatables::of($models)
            ->editColumn('reference_number',function($model){
            $url_to=url('/backend/tenant/payment/view/'.$model->payment_id);
            return '<span  data-url="'.$url_to.'" style="cursor:pointer;color:green"  title="View More Details"  class="reject-modal"
                                data-title="View Details" >'.$model->reference_number.'</span>';

           })
           ->editColumn('invoice_id',function($model){
            $invoices_url=url('/backend/invoice/view/'.$model->invoice_id);

            $model=Invoice::find($model->invoice_id);
              if($model){
                return '<a href="'.$invoices_url.'" >'.$model->invoice_number.'</a>';


                //$model->invoice_number;
              }else{
                return "Not Set";
              }



           })->make(true);

}


public function getRegisteredItems(){

   if(Entrust::hasRole("Renter")){
        $data['page_title']="Registered Items";
        $data['status']=(isset($_GET['type']))? $_GET['type']:'All';
        return view('tenants::tenants.registered_items',$data);
     }
     else
     {
        return view('forbidden');
     }


}



public function fetchAssets($status){
   $id=Auth::User()->id;

   if($status=="All"){
     $models=Tenant::join('possessions','tenants.id','=','possessions.tenant_id')
             ->join('spaces','spaces.id','=','tenants.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['possessions.id','users.name','possessions.name as cname','properties.title','spaces.number','possessions.type','possessions.number','properties.id as P_id','tenants.id as tenant_id','possessions.status','possessions.fee_charged'])
             ->where('users.id','=',$id);
   }
   else
   {
     $models=Tenant::join('possessions','tenants.id','=','possessions.tenant_id')
             ->join('spaces','spaces.id','=','tenants.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['possessions.id','users.name','possessions.name as cname','properties.title','spaces.number','possessions.type','possessions.number','properties.id as P_id','tenants.id as tenant_id','possessions.status','possessions.fee_charged'])
             ->where('possessions.type',$status)
             ->where('users.id','=',$id);
  }

  
       
              return Datatables::of($models)

         ->editColumn('name',function($model){
            $pro_url=url('/backend/tenant/view/'.$model->tenant_id);
             return '<a href="'.$pro_url.'">'.$model->name.'</a>';

         })

         ->editColumn('title',function($model){
            $pro_url=url('/backend/property/view/'.$model->P_id);
             return '<a href="'.$pro_url.'">'.$model->title.'</a>';

         })->addColumn('action', function ($model) {
                     $delete_url=url('/backend/item/delete/'.$model->id);
                     $to_url=url('/backend/tenants/registered_items');
                     $asset_url=url('/backend/tenants/edit_item/'.$model->id);
                      
             if($model->status=="Pending"):
                    return '<a style="cursor:pointer;"  title="Update This Asset" class="reject-modal glyphicon glyphicon-pencil "
                                data-title="Edit Asset"  data-url="'.$asset_url.'" ></a>

                                <a data-href="'.$delete_url.'"   class="delete-record" style="margin-left:10%;" data-redirect-to="'.$to_url.'" data-name="Asset" ><span class="icon-trash"></span></a>



                                ';

                    else:


                      return '<a style="cursor:pointer;"  title="Update This Asset" class="reject-modal glyphicon glyphicon-pencil "
                                data-title="Edit Asset"  data-url="'.$asset_url.'" ></a>

                                



                                ';





                   endif ;

                    
                    })->make(true);

}


public function getRepairs(){

   if(Entrust::hasRole("Renter")){
        $data['page_title']="Registered Items";
        $data['status']=(isset($_GET['type']))? $_GET['type']:'All';
        return view('tenants::tenants.repairs_inccured',$data);
     }
     else
     {
        return view('forbidden');
     }

}


public function fetchRepairs(){
   $models=Repair::join('spaces','spaces.id','=','repairs.space_id')
             ->join('users','users.id','=','repairs.user_id')
              ->select(['repairs.id','repair_code','repair_date','repair_date','total_cost','person_responsible','invoice_number','number','technician_fee'])
              ->where(['users.id'=>Auth::user()->id]);
           return Datatables::of($models)
               ->editColumn('total_cost',function($model){
                $total_cost_url=url('/backend/space/repair/'.$model->id);
                 return '<a tyle="cursor:pointer;color:blue;"  title="View Repair Costings" class="reject-modal" data-title="Repair Costings" data-url="'.$total_cost_url.'">'.$model->total_cost.'</a>';
               })
               ->editColumn('technician_fee',function($model){
                $total_cost_url=url('/backend/space/repair_technician/'.$model->id);
                 return '<a tyle="cursor:pointer;color:blue;"  title="View Technicians Fee" class="reject-modal"  data-title="Work Technician" data-url="'.$total_cost_url.'">'.$model->technician_fee.'</a>';
               })
              ->make(true);

}


   public function createRequest(Request $request){
      if(Entrust::hasRole("Renter")){
        $data['model']=new RepairRequest();
        $data['page_title']="Create Request";
        $spaces=Tenant::where(['user_id'=>\Auth::user()->id])->where('current_status','Active')->get();
          
         if($request->isMethod('post')){
            $data=$request->all();
             $level=$data['level'];
             $expected_visit_date=$this->getVisitDate($level);
              $a=array('user_id'=>Auth::user()->id,
                       'expected_investination_date'=> $expected_visit_date,
                       'repair_ticket'=>"#".substr(number_format(time() * rand(),0,'',''),0,6),
                       );
               $data=array_merge($a,$data);

                 try{
                   $model=RepairRequest::create($data);
                     Session::flash('success_msg',"Repair Requested Created Successfuully");
                      return redirect()->back();
                 }catch(\Exception $e){
                  Helper::sendEmailToSupport($e);
                   return true;

                 }
                


         }


          $spaces_ids=array();
          foreach ($spaces as $key) {
            $spaces_ids[]=$key->space_id;
          }

          $real_spaces=Space::whereIn('id',$spaces_ids)->get();
            $models=array();
            foreach($real_spaces as $spaced){
               $models[]=$spaced;

                 

            }

           $data['spaces']=$models;
           $data['url']=url('/tenants/repair/create_request');
          
        return view('tenants::tenants.create_repair_request',$data);
     }
     else
     {
        return view('forbidden');
     }

   }


   public function viewRepairRequests(){

      if(Entrust::hasRole("Renter") || Entrust::hasRole("Admin") || Entrust::hasRole("Provider")){
        $data['page_title']="Your Repair Requests";
        $data['status']=(isset($_GET['status']))? $_GET['status']:'All';
        return view('tenants::tenants.repairs_requests',$data);
     }
     else
     {
        return view('forbidden');
     }

   }


   public function getRequestForRepairs($status){
    DB::statement(DB::raw('set @rownum=0'));

     if($status=="All"){
      $models=RepairRequest::join('spaces','spaces.id','=','repair_requests.space_id')
             ->join('users','users.id','=','repair_requests.user_id')
              ->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'repair_ticket','repair_requests.type','priorty','level','expected_investination_date','expected_repair_date','repair_requests.status as status','number','title','repair_requests.id'])
              ->where(['users.id'=>Auth::user()->id]);

     }else{
      $models=RepairRequest::join('spaces','spaces.id','=','repair_requests.space_id')
             ->join('users','users.id','=','repair_requests.user_id')
              ->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),'repair_ticket','repair_requests.type','priorty','level','expected_investination_date','expected_repair_date','repair_requests.status as status','number','title','repair_requests.id'])
              ->where('repair_requests.status',$status)
              ->where(['users.id'=>Auth::user()->id]);
     }

    
           return Datatables::of($models)
               ->editColumn('total_cost',function($model){
                $total_cost_url=url('/backend/space/repair/'.$model->id);
                 return '<a tyle="cursor:pointer;color:blue;"  title="View Repair Costings" class="reject-modal" data-title="Repair Costings" data-url="'.$total_cost_url.'">'.$model->total_cost.'</a>';
               })
               ->editColumn('technician_fee',function($model){
                $total_cost_url=url('/backend/space/repair_technician/'.$model->id);
                 return '<a tyle="cursor:pointer;color:blue;"  title="View Technicians Fee" class="reject-modal"  data-title="Work Technician" data-url="'.$total_cost_url.'">'.$model->technician_fee.'</a>';
               })
              ->make(true);



   }


   
    

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('tenants::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('tenants::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('tenants::edit');
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


    private function getVisitDate($level)
    {

          $now=date('Y-m-d H:i:s');
          $months=12;
          
       switch ($level) 
       {
           case 'Emergency Repair':
             $hours=4;
              $expiry_date=date('Y-m-d H:i:s', strtotime($now . "+".$hours." hours") );;
            
             break;

          case 'Urgent Repair':
             $days=3;
              $expiry_date=date('Y-m-d H:i:s', strtotime($now . "+".$days." days") );;
            
             break;
           
           default:
              $days=20;
              $expiry_date=date('Y-m-d H:i:s', strtotime($now . "+".$days." days") );;
             break;
         }

       return  $expiry_date;

    }

    public function GetInvoiceAmount($id)
    { 
      $model=Invoice::find($id);
        return ($model)?$model->amount:0;

    }


    public function getSpaceInvoices($id)
    {
      $models=Invoice::where(['space_id'=>$id,'status'=>'Pending','issued_to'=>auth::user()->id])->get();
       echo '<option value="">----Select Invoice---</option>';
        foreach($models as $model)
        {
          echo '<option value="'.$model->id.'">'.$model->invoice_number.'</option>';
        }


    }



}
