<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Entrust;
use App\User;
use Modules\Backend\Entities\Space;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\VaccationRequest;
use Session;
use DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Auth;
use Modules\Backend\Entities\Invoice;
use App\Http\Middleware\AccountSetUp;
use Modules\Backend\Entities\Property;
use Modules\Backend\Entities\PropertyAccount;
use Modules\Backend\Entities\PropertyExpense;
use Modules\Backend\Entities\PropertyTransaction;
use Modules\Backend\Entities\ProviderTransaction;

class VaccationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
  protected $orgID;

      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AccountSetUp::class);

        $this->middleware(function ($request, $next) {
            $this->orgID = Auth::User()->getProvider->id;

            return $next($request);
        });

    }
    public function index()
    {
        return view('backend::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request,$id=null)
    {
         $model=Tenant::find($id);
         $data['model']=$model;
         $data['report_date']=$now=date('Y-m-d');
         $data['vaccation_date']=date('Y-m-d', strtotime($now . "+1 months") );

          if($request->isMethod("post")){
            DB::beginTransaction();
             $notice=new VaccationRequest();
             $notice->tenant_id=$model->id;
             $data=$request->all();
             
             $notice->date_reported=date("Y-m-d",strtotime($data['report_date']));
             $notice->vaccation_date=date("Y-m-d",strtotime($data['vacation_date']));
             $notice->reason =ucwords($data['reason']);
             $notice->save();
             $space=Space::find($model->space_id);
             if($space){
                $space->status="OnNotice";
                $space->save();
             }
              Session::flash('success_msg','Notice Created successfully')   ;
             DB::commit();
          return redirect()->back();
             }

         $data['url']=url('/backend/notices/create/'.$model->id);
        return view('backend::notice.create',$data);
    }


    public function Bulk()
    {
      if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent")){
             $data['page_title']="Vaccation Notices";
              $data['models']=Property::where(['provider_id'=>$this->orgID])->get();
              
             return view('backend::notice.bulk',$data);




         }else{
            return view("forbidden");
         }

    }



    public function notice(){
         if(Entrust::hasRole("Provider")){
             $data['page_title']="Vaccation Notices";
             return view('backend::notice.index',$data);




         }else{
            return view("forbidden");
         }
    }



    public function fetchList()
    {
        $p_id=Auth::User()->getProvider->id;
        $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->select('properties.title','spaces.number','users.name','vacation_balance','vacation_date','tenants.id')
          ->where(['properties.provider_id'=>$this->orgID,'tenants.current_status'=>'Inactive'])
          ->orderBy('vacation_date','desc');

      return Datatables::of($models)
      ->addColumn('action',function($model){
        if($model->vacation_balance>0)
        {
          $clear_url=url('/backend/tenants/ClearBalance/'.$model->id);
         return '<button data-url="'.$clear_url.'" data-title="Clear Balance" class="btn btn-xs btn-primary reject-modal">Clear</button>';

        }else{
          return "NO ACTION";
        }

          
      })->make(true);
        
        

    }
    public function ClearBalance($id,Request $request)
    {
      $model=Tenant::find($id);
        if(!$model)
        {
          return "Resource Not Found";
        }
        $payment=\App\TenantMonthlyReport::where(['tenant_id'=>$model->id])->latest()
        ->first();

         if($request->isMethod("post"))
         {
           $data=$request->all();
            if($data['amount']>0)
            {
              DB::beginTransaction();
              $model->vacation_balance=$model->vacation_balance-$data['amount'];
              $model->status=($model->vacation_balance==0)?"Free":"Occupied";
              $model->save();
              $property=$model->space->property;
              $pecentage=$property->agent_commission_percentage;
               $landload_percentage=(100-$pecentage)/100;
               $landAmount=$landload_percentage*$data['amount'];
                
                $balance=PropertyTransaction::where(['property_id'=>$property->id])->latest()->first();
              
               $amount=$data['amount'];
                $landlord_amount=$balance->landloard_balance;
                 $transaction=new PropertyTransaction();
              $transaction->provider_id=$this->orgID;
              $transaction->property_id=$model->space->property_id;
              $transaction->credit=0;
               $transaction->tran_date=date('Y-m-d');
              $transaction->debit=$amount;
              $transaction->total_amount=$amount;
              $model->is_previous_tenant_payments=1;
              $transaction->year=date('Y',strtotime($transaction->tran_date));
              $transaction->month=date('M',strtotime( $transaction->tran_date));
              $transaction->type="Credit";
              $transaction->method="Cash";
              $transaction->landloard_balance=$landlord_amount+$landAmount;
              $transaction->Description="Previous Tenant Payment For Unit ".$payment->space->number;
              $transaction->ref_no=$payment->reference_number;
              $account=PropertyAccount::where(['provider_id'=>$this->orgID,'property_id'=>$property->id,'account_type'=>'Debit'])->first();
              $transaction->account_id=$account->id;
              $transaction->save();
               DB::commit();
            }

            Session::flash("success_msg","Payment Pubmitted successfully");
            return redirect()->back();
         }
        
        $data['model']=$model;
        $data['payment']=$payment;
        $data['url']=url()->current();

        return view('backend::notice._clearbalance',$data);

    }

    public function fetch_notices(){
        $p_id=Auth::User()->getProvider->id;
        $bookings=Tenant::join('vaccation_notifications','tenants.id','=','vaccation_notifications.tenant_id')
           ->join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->select(['vaccation_notifications.id as id','vaccation_notifications.vaccation_date','vaccation_notifications.date_reported','users.name','spaces.number','properties.title'])
          ->where(['properties.provider_id'=>$p_id,'vaccation_notifications.status'=>'Pending'])
          ->get();

      
      return Datatables::of($bookings)->addColumn('action', function ($model) {
                     $url=url('/backend/v-notice/Complete/'.$model->id);
                          return '<a href="'.$url.'" class="btn btn-xs btn-info">Complete</button>';

                    
                    })->make(true);
    }


    public function complete($id){
         if(Entrust::hasRole("Provider")){
              $model=VaccationRequest::find($id);
              DB::beginTransaction();
               if($model){
                $model->status="Approved";
                $model->save();
                $tenant=$model->tenant;
                $tenant->current_status="Inactive";
                $tenant->save();

                $space=$tenant->space;
                $space->status="Free";
                $space->save();
                DB::commit();
                Session::flash('success_msg','Specified Unit is now Free.It will be visible for visitors to book');
                return redirect()->back();

               }



         }else{
            return view("forbidden");
         }
    }


    public function getcontacts(){
        $id=Auth::User()->getProvider->id;
        $models=Tenant::join('emergency_contacts','tenants.id','=','emergency_contacts.tenant_id')
             ->join('spaces','spaces.id','=','tenants.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['emergency_contacts.id','users.name','emergency_contacts.name as cname','properties.title','spaces.number','emergency_contacts.email','emergency_contacts.phone','properties.id as P_id','tenants.id as tenant_id'])
             ->where('tenants.current_status','=','Active')
             ->where('tenants.provider_id','=',$id);

        return Datatables::of($models)

         ->editColumn('name',function($model){
            $pro_url=url('/backend/tenant/view/'.$model->tenant_id);
             return '<a href="'.$pro_url.'">'.$model->name.'</a>';

         })

         ->editColumn('title',function($model){
            $pro_url=url('/backend/property/view/'.$model->P_id);
             return '<a href="'.$pro_url.'">'.$model->title.'</a>';

         })->addColumn('action', function ($model) {
                     $url=url('/backend/tenants/contact/'.$model->id);
                     $delete_url=url('/backend/contact/delete/'.$model->id);
                     $to_url=url('/backend/tenants/emergency_contact');
                          return '<a style="cursor:pointer;"  title="Update This Contact" class="reject-modal glyphicon glyphicon-pencil "
                                data-title="Edit Contact"  data-url="'.$url.'" ></a>

                                <a data-href="'.$delete_url.'"   class="delete-record" style="margin-left:10%;" data-redirect-to="'.$to_url.'" data-name="Contact" ><span class="icon-trash"></span></a>



                                ';

                    
                    })->make(true);

    }



    public function fetch_assets(){
         $id=Auth::User()->getProvider->id;
        $models=Tenant::join('possessions','tenants.id','=','possessions.tenant_id')
             ->join('spaces','spaces.id','=','tenants.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['possessions.id','users.name','possessions.name as cname','properties.title','spaces.number','possessions.type','possessions.number','properties.id as P_id','tenants.id as tenant_id'])
             ->where('tenants.provider_id','=',$id);
              return Datatables::of($models)

         ->editColumn('name',function($model){
            $pro_url=url('/backend/tenant/view/'.$model->tenant_id);
             return '<a href="'.$pro_url.'">'.$model->name.'</a>';

         })

         ->editColumn('title',function($model){
            $pro_url=url('/backend/property/view/'.$model->P_id);
             return '<a href="'.$pro_url.'">'.$model->title.'</a>';

         })->addColumn('action', function ($model) {
                  $asset_url=url('/backend/tenants/edit_item/'.$model->id);
                     
                     $delete_url=url('/backend/item/delete/'.$model->id);
                     $to_url=url('/backend/tenants/registered_items');
                          return '<a style="cursor:pointer;"  title="Update This Asset" class="reject-modal glyphicon glyphicon-pencil "
                                data-title="Edit Asset"  data-url="'.$asset_url.'" ></a>

                                <a data-href="'.$delete_url.'"   class="delete-record" style="margin-left:10%;" data-redirect-to="'.$to_url.'" data-name="Asset" ><span class="icon-trash"></span></a>



                                ';

                    
                    })->make(true);


    }


    public function getOccupants(){
         $id=Auth::User()->getProvider->id;
        $models=Tenant::join('tenants_occupants','tenants.id','=','tenants_occupants.tenant_id')
             ->join('spaces','spaces.id','=','tenants.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['tenants_occupants.id','users.name','tenants_occupants.name as cname','properties.title','spaces.number','tenants_occupants.age','tenants_occupants.number','properties.id as P_id','tenants.id as tenant_id','identification'])
             ->where('tenants.provider_id','=',$id);
              return Datatables::of($models)

         ->editColumn('name',function($model){
            $pro_url=url('/backend/tenant/view/'.$model->tenant_id);
             return '<a href="'.$pro_url.'">'.$model->name.'</a>';

         })

         ->editColumn('title',function($model){
            $pro_url=url('/backend/property/view/'.$model->P_id);
             return '<a href="'.$pro_url.'">'.$model->title.'</a>';

         })->addColumn('action', function ($model) {
                  $asset_url=url('/backend/tenants/edit_item/'.$model->id);
                     
                     $delete_url=url('/backend/item/delete/'.$model->id);
                     $to_url=url('/backend/tenants/registered_items');
                          return '<a style="cursor:pointer;"  title="Update This Asset" class="reject-modal glyphicon glyphicon-pencil "
                                data-title="Edit Asset"  data-url="'.$asset_url.'" ></a>

                                <a data-href="'.$delete_url.'"   class="delete-record" style="margin-left:10%;" data-redirect-to="'.$to_url.'" data-name="Asset" ><span class="icon-trash"></span></a>



                                ';

                    
                    })->make(true);

    }


    public function getSpaceInvoices($space_id,$status=null){
        $status=(isset($status))? $status:'All';

       $id=Auth::User()->getProvider->id;
           if($status=="All"){
            $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
             ->join('invoices','spaces.id','=','invoices.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['invoices.id','users.name','invoice_number','properties.title','spaces.number','invoices.status','amount','properties.id as P_id','tenants.id as tenant_id','invoices.created_at','issue_date','due_date'])
            ->where(['invoices.space_id'=>$space_id])
             ->where('tenants.provider_id','=',$id);

           }else{
            $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
             ->join('invoices','spaces.id','=','invoices.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['invoices.id','users.name','invoice_number','properties.title','spaces.number','invoices.status','amount','properties.id as P_id','tenants.id as tenant_id','invoices.created_at','issue_date','due_date'])
             ->where(['invoices.space_id'=>$space_id])
             ->where('tenants.provider_id','=',$id);
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
                     
                      if($model->status=="Pending")
                      {
                        return '<ul class="icons-list">
                      <li><a href="'.$invoice_url.'" ><i class="icon-file-eye"></i></a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                          <li><a href="#"><i class="icon-envelope"></i> Email</a></li>
                           
                          <li class="divider"></li>
                          
                          <li><a 
                           style="cursor:pointer;"  title="Cancel This Invoice" class="reject-modal"
                                data-title="Invoice Cancellation"  data-url="'.$cancel_url.'"><i class="icon-cross2 reject-modal"></i> Cancel This Invoice</a></li>
                       
                        </ul>
                      </li>
                    </ul>';


                      }else{
                        return '<ul class="icons-list">
                      <li><a href="'.$invoice_url.'" ><i class="icon-file-eye"></i></a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                          <li><a href="#"><i class="icon-envelope"></i> Email</a></li>
                           
                          
                       
                        </ul>
                      </li>
                    </ul>';

                      }
            })->make(true);

    }

    public function getInvoices($status=null){
           $id=Auth::User()->getProvider->id;
           if($status=="All"){
            $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
             ->join('invoices','spaces.id','=','invoices.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['invoices.id','users.name','invoice_number','properties.title','spaces.number','invoices.status','amount','properties.id as P_id','tenants.id as tenant_id','invoices.created_at','issue_date','due_date'])
             ->where('tenants.provider_id','=',$id)
             ->orderBy('invoices.invoice_number','desc')
             ;

           }else{
            $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
             ->join('invoices','spaces.id','=','invoices.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['invoices.id','users.name','invoice_number','properties.title','spaces.number','invoices.status','amount','properties.id as P_id','tenants.id as tenant_id','invoices.created_at','issue_date','due_date'])
             ->where(['invoices.status'=>$status])
             ->where('tenants.provider_id','=',$id)
              ->orderBy('invoices.invoice_number','desc');
           }
        
              return Datatables::of($models)
        ->editColumn('invoice_number',function($model){
           $invoice_url=url('/backend/invoice/view/'.$model->id);
             return '<a title="View Details" href="'.$invoice_url.'">'.$model->invoice_number.'</a>';
        })

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
                  $pay_url=url('/backend/make/payments?invoice_id='.$model->id);
                  $download_url=url('/backend/invoice/download/'.$model->id);
                  $email_url=url('/backend/invoice/email/'.$model->id);
                     
                      if($model->status=="Pending")
                      {
                        return '<ul class="icons-list">
                      <li><a href="'.$invoice_url.'" ><i class="icon-file-eye"></i></a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">

                          <li ><a data-title="Pay Pending Invoices"   href="'.$pay_url.'"><i class="icon-cash3" ></i> Pay Now</a></li>
                          <li><a  target="_new" href="'.$download_url.'"><i class="icon-file-download"></i> Download</a></li>
                          <li><a data-url="'.$email_url.'" class="reject-modal" data-title="Email Invoice" href="#"><i class="icon-envelope"></i> Email</a></li>
                           
                          <li class="divider"></li>
                          
                          <li><a 
                           style="cursor:pointer;"  title="Cancel This Invoice" class="reject-modal"
                                data-title="Invoice Cancellation"  data-url="'.$cancel_url.'"><i class="icon-cross2 reject-modal"></i> Cancel This Invoice</a></li>
                       
                        </ul>
                      </li>
                    </ul>';


                      }else{
                        return '<ul class="icons-list">
                      <li><a href="'.$invoice_url.'" ><i class="icon-file-eye"></i></a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                         <li><a target="_new"  href="'.$download_url.'"><i class="icon-file-download"></i> Download</a></li>
                          <li><a data-url="'.$email_url.'" class="reject-modal" data-title="Email Invoice" href="#"><i class="icon-envelope"></i> Email</a></li>
                           
                          
                       
                        </ul>
                      </li>
                    </ul>';

                      }
            })->make(true);

    }


    public function getTenantInvoices($user_id,$status=null){
       if($status==null){
        $status="All";
       }

       $id=Auth::User()->getProvider->id;
           if($status=="All"){
            $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
             ->join('invoices','spaces.id','=','invoices.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['invoices.id','users.name','invoice_number','properties.title','spaces.number','invoices.status','amount','properties.id as P_id','tenants.id as tenant_id','invoices.created_at','issue_date','due_date'])
             ->where('tenants.provider_id','=',$id)
             ->where('users.id',$user_id);

           }else{
            $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
             ->join('invoices','spaces.id','=','invoices.space_id')
             ->join('properties','properties.id','=','spaces.property_id')
             ->join('users','users.id','=','tenants.user_id')
             ->select(['invoices.id','users.name','invoice_number','properties.title','spaces.number','invoices.status','amount','properties.id as P_id','tenants.id as tenant_id','invoices.created_at','issue_date','due_date'])
             ->where(['invoices.status'=>$status])
             ->where('tenants.provider_id','=',$id)
              ->where('users.id',$user_id);
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
                     
                      if($model->status=="Pending")
                      {
                        return '<ul class="icons-list">
                      <li><a href="'.$invoice_url.'" ><i class="icon-file-eye"></i></a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                          <li><a href="#"><i class="icon-envelope"></i> Email</a></li>
                           
                          <li class="divider"></li>
                          
                          <li><a 
                           style="cursor:pointer;"  title="Cancel This Invoice" class="reject-modal"
                                data-title="Invoice Cancellation"  data-url="'.$cancel_url.'"><i class="icon-cross2 reject-modal"></i> Cancel This Invoice</a></li>
                       
                        </ul>
                      </li>
                    </ul>';


                      }else{
                        return '<ul class="icons-list">
                      <li><a href="'.$invoice_url.'" ><i class="icon-file-eye"></i></a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="#"><i class="icon-file-download"></i> Download</a></li>
                          <li><a href="#"><i class="icon-envelope"></i> Email</a></li>
                           
                          
                       
                        </ul>
                      </li>
                    </ul>';

                      }
            })->make(true);


    }



    public function cancelInvoice($id,Request $request){
          if(Entrust::hasRole("Provider")){
            $model=Invoice::find($id);
             if(!$model){
                return "Resource Not Found On";
             }
              if($request->isMethod('post')){
                $data=$request->all();
                 $model->reason=$data['reason'];
                 $model->status="Cancelled";
                 $model->save();
                 Session::flash('success_msg','Invoice Cancelled successfully');
                 return redirect()->back();

              }

             $data['model']=$model;
             $data['url']=url('/backend/invoice/cancel/'.$model->id);
             return view('backend::notice.cancel',$data);
            }
            else
            {
            return "Access Denied.You do not have Permission to access this resource.";
            }

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
        return view('backend::show');
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


    public function viewPayment($id){
       $model=TenantPayment::find($id);

        if(!$model){
       return "Payment Details Not Found";
        }else{

          $data['model']=$model;

          return view('backend::notice.view_payment',$data);
          
        }

    }
}
