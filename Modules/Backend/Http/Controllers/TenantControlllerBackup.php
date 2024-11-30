<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller ;
use Entrust;
use App\User;
use Modules\Backend\Entities\Space;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\Property;
use Modules\Backend\Base\TenantPdf;
use Modules\Backend\Base\TenantInvoice;
use Auth;
use Modules\UserManagement\Entities\Role;
use Modules\UserManagement\Entities\Profile;
use DB;
use App\Messaging;
use App\Events\UserRegisterEvent;
use Session;
use App\Helpers\Helper;
use Modules\Backend\Entities\Agent;
use Modules\Backend\Entities\Deposit;
use Modules\Backend\Entities\EmergencyContact;
use Modules\Backend\Entities\TenantsOccupant;
use Modules\Backend\Entities\Student;
use Modules\Backend\Entities\Employer;
use Modules\Backend\Entities\Possession;
use Modules\Backend\Entities\TenantCharges;
use Modules\Backend\Entities\Invoice;
use Illuminate\Support\Facades\Input;
use Modules\Backend\Entities\Repair;
use Modules\Backend\Reports\Receipt;
use Redirect;
use Excel;
use Modules\Backend\Reports\InvoicePDf;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Modules\Supplier\Entities\Supplier;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\AdditionCharge;
use Modules\Tenants\Entities\SubmittedPayment;
use App\Http\Middleware\AccountSetUp;
use Modules\Backend\Entities\InvoiceComponent;
use Modules\Backend\Entities\InvoiceItem;
use Modules\Backend\Entities\TenantSummary;
use Modules\Backend\Entities\Payment;
use Modules\Backend\Base\Import;
use Modules\Backend\Entities\PropertyAccount;
use Modules\Backend\Entities\PropertyExpense;
use Modules\Backend\Entities\PropertyTransaction;
use Modules\Backend\Entities\ProviderTransaction;
class TenantController extends Controller
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


    public function dashboard(){
      $data['page_title']="Tenants Dashboard";
      $data['tenant_count']=Tenant::where(['provider_id'=>Auth::User()->getProvider->id])->count();
      return view('backend::tenants.dashboard',$data);

    }

    public function getSystemCharges()
    {
      if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent") || Entrust::hasRole("Admin")){
            $data['page_title']="Utility Settings";
             $data['system_currency']=config('app.system_currency');
              return view('backend::system_charges',$data);


        }else{
            return view("forbidden");
        }
    }
    public function index()
    {
        return view('backend::index');
    }


    public function getVacatted()
    {
       if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent") ){
            $data['page_title']="Vaccated Tenants";
            $data['properties']=Property::where(['provider_id'=>auth::user()->getProvider->id])->get();
            
              return view('backend::notice.vacated',$data);


        }else{
            return view("forbidden");
        }

    }

    public function addNewCharge($id,Request $request)
    {
      
        $data['url']=url()->current();

          if($request->isMethod("post"))
          {
            $data=$request->all();

               $tenants=Tenant::join('spaces','spaces.id','=','tenants.space_id')
                          ->where(['tenants.current_status'=>'Active','property_id'=>$id])
                          ->select('tenants.id','monthly_fee')
                          ->get();

                    foreach($tenants as $tenant)
                    {
                       $mod=new TenantCharges();
                        $mod->tenant_id=$tenant->id;
                        $mod->charge_name=$data['charge_name'];
                        $mod->amount=$data['charge_amount'];
                        $mod->effective_from=date('Y-m-d');
                        $mod->status="Active";
                        $mod->save();
                        $tenant->monthly_fee=$tenant->monthly_fee+$mod->charge_amount;
                        //$tenant->save();
                    }
             Session::flash("success_msg","Charges Added To All Active Tenants Successfully");
             return redirect()->back();

          }


       return view('backend::tenants._add_new_charge',$data);


    }

    public function startReversal()
    {
      if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent") ){
            $data['page_title']="Reverse Payments";
            $data['properties']=Property::where(['provider_id'=>auth::user()->getProvider->id])->get();
            
              return view('backend::tenants.reverse_payments',$data);


        }else{
            return view("forbidden");
        }

    }

    public function LoadPaidUnits(Request $request)
    {
      $data=$request->all();

       return view('backend::tenants._reverse',$data);

    }


    public function ReverseTransaction()
    {
      if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent") ){
            $data['page_title']="Reverse Payments";
            $data['properties']=Property::where(['provider_id'=>auth::user()->getProvider->id])->get();
            
              return view('backend::tenants.reverse_transaction',$data);


        }else{
            return view("forbidden");
        }


    }

    public function loadLandloadPayments(Request $request)
    {
      $data=$request->all();



       return view('backend::tenants._land_reverse',$data);

    }




    public function getPropertTenants($id,Request $request)
    {
         
     


       $tenants=Tenant::join('spaces','spaces.id','=','tenants.space_id')
              ->leftjoin('users','users.id','=','tenants.user_id')

              ->where(['spaces.property_id'=>$id,'current_status'=>'Active'])

              ->select('spaces.number','tenants.id','name','entry_date')
              ->get();
          

        $models=array();

          foreach($tenants as $tenant){
            $balanceModel=\App\TenantMonthlyReport::where(['tenant_id'=>$tenant->id])->latest()->first();
             $balance=($balanceModel)?$balanceModel->balance:0;

            $models[]=(object)array('number'=>$tenant->number,'id'=>$tenant->id,'name'=>$tenant->name,'entry_date'=>date('Y,M-d'),strtotime($tenant->entry_date),'balance'=>$balance);
          }


         $data['models']=$models;
         $data['url']=url()->current();
           if($request->isMethod("post"))
             {
               $data=$request->all();
                 $ids=$data['tenantid'];
                  foreach($ids as $id)
                  {
                    $tenant=Tenant::find($id);

                      if($tenant)
                      {
                        $balanceModel=\App\TenantMonthlyReport::where(['tenant_id'=>$tenant->id])->latest('id')->first();



                        $balance=($balanceModel)?$balanceModel->balance:0;
                        $tenant->current_status="Inactive";
                        $tenant->vacation_balance=$balance;
                        $tenant->vacation_date=date('Y-m-d');
                        $tenant->save();
                        $space=$tenant->space;
                        $space->status="FREE";
                        $space->save();


                         if($balanceModel)
                           {
                             $balanceModel->space_status=0;
                             $balanceModel->invoice_amount=0;
                             $balanceModel->new_balance=0;
                             $balanceModel->amount_paid=0;
                             $balanceModel->balance=0;
                             $balanceModel->save();
                           }
                      }
                     
                  }

                  Session::flash("success_msg","Tenant Vaccated Successfully");
                  return redirect()->back();

             }

     


      return view('backend::notice._bulk',$data);

    }


    public function importTenants(Request $request)
    {

       if(Entrust::hasRole("Provider")|| Entrust::hasRole("Agent"))
        {

           if($request->isMethod("post"))
           {

            $data=$request->all();

               $file = $request->file('file_name');
                $filePath = $file->getPathName();

                 $array=[]; 
                    \Excel::load($filePath, function($reader) {
          $results = $reader->get()->toArray();
        
            
             foreach($results[7] as $result)
             {\DB::beginTransaction();
                     
              $space=$this->createSpace($result['property_name'],$result['unit'],$result['amt_paid']);
                   $name=$result['tenant_full_name'];
                   $email=$result['tenant_email_address'];
                   $idnumber=$result['tenant_id_number'];
                   $telephone=$result['tenant_id_number'];
                    if($space)
                    {
                       $space_id=$space->id;

                   $result['spaceid']= $space_id;
                   $rent=doubleval($result['rent']);
                   $deposit=doubleval($result['deposit']);
                   $baance=doubleval($result['balance']);

                $user=Import::createExcelUser($result);
                if($user)
                  {
                    $tenant=Import::createTenant($user,$result);
                  }

                    }
                  
                  
                
                  
               

                  \DB::commit();
                

             }$count=0;
              });
                Session::flash("success_msg","Tenants Imported Successfully");
                return redirect()->back();
           }
           $data['page_title']="Import Tenants";
         $data['properties']=Property::where(['provider_id'=>auth::user()->getProvider->id])->get();
           $data['url']=url()->current();

             return view('backend::tenants.import',$data);



        }else{
          return view("forbidden");
        }

    }
    public function getPendingInvoices($user_id,$space_id)
    {
      $models=Invoice::where(['issued_to'=>$user_id,'space_id'=>$space_id,'status'=>"Pending"])->get();
       return $models;

    }


    public function getPriodicPayments()
    {
      $data['properties']=Property::where(['provider_id'=>auth::user()->getProvider->id])->get();
      return view('backend::tenants._payment_report',$data);
    }

    public function getPPayments(Request $request)
    {
       $data=$request->all();
         return view('backend::tenants._mypayment_report',$data);


    }

    public function loadTenants($id)
    {
       $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
              ->join('users','users.id','=','tenants.user_id')
              ->where('spaces.property_id',$id)
              ->where('spaces.status','Occupied')
              ->select('tenants.id','spaces.number','users.name','users.id as user_id','spaces.id as space_id')
              ->get();

          foreach($models as $model)
          {
            $pendings=$this->getPendingInvoices($model->user_id,$model->space_id);

             $html='<tr>

               <td>'.$model->name.'</td>
               <td>'.$model->number.'</td>
               <td><select name="invoiceNumber[]" required>';
                foreach($pendings as $pending):

          $html.='<option value="">---InvoiceNumber--</option>
          <option value="'.$pending->id.'">'.$pending->invoice_number.'</option>';
            endforeach;
            $html.='</select><td>




             </tr>';

             echo $html;



              
            /*echo '<tr>
              <td>'.$model->name.'</td>
               <td>'.$model->number.'</td>

                <td><select>'; foreach($pendings as $pend):

                '
                  <option>A</option>

                  '.endforeach;.'

                </select></td>

              </tr>';*/


          }



    }

    public function getTemplate()
    {
      $id=$_GET['property_id'];
      $models=Space::where(['property_id'=>$id,'status'=>"Free"])->get();
       $format="Xls";
       $oreintation="landscape";
         Excel::create('TenantImport', function($excel) use($oreintation,$format,$models) {
          $excel->sheet('Sheet1', function($sheet) use($oreintation,$format,$models) {
         
          
                $arr =array();
                foreach($models as $model) {

                  
  $data =array($model->floor,$model->number,$model->id,
                               
                     );
                    array_push($arr, $data);
                    }
               $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                       'Floor','Unit','SpaceID','Tenant Full Name',"Tenant Email Address","Tenant ID Number","Tenant Telephone","Rent","Deposit","Balance"
                    )
                );
                
                $sheet->row(1,function($row){
                    $row->setFont(array(
                        'family'     => 'Calibri',
                        'bold'       =>  true
                    ));});

                $sheet->setOrientation($oreintation);

$sheet->getProtection()->setPassword('password');
$sheet->getProtection()->setSheet(true);
$sheet->getStyle('D1:J100')->getProtection()->setLocked(\PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
$sheet->getColumnDimension('C')->setVisible(false);

 

                 });

        })->export($format);
    }

    public function downloadTemplate()
    {
      $data['properties']=Property::where(['provider_id'=>auth::user()->getProvider->id])->get();
       return view('backend::tenants.template',$data);
    }

    public function submittedPayments()
    {
       if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent"))
        {
          $data['page_title']="Sumitted Payment";
          return view('backend::tenants.submitted_payment',$data);

        }else{
          return view("forbidden");
        }
    }

    public function addNewExpenses(Request $request)
    {
        if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent"))
        {
          
            $data['properties']=Property::where(['provider_id'=>auth::user()->getProvider->id])->get();
               if($request->isMethod("post"))
               {
                 $data=$request->all();
                   DB::beginTransaction();
                  $id=$data['property'];
               $test=   $this->processExpenses($id,$data);
                DB::commit();
                Session::flash("success_msg","Expenses Added Successfully");
                return redirect()->back();
              }
          return view('backend::expenses.create_bulk_expenses',$data);

        }else{
          return view("forbidden");
        }

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        
         if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent")){
          $data['page_title']="Tenant Management";
          $models=Property::where(['provider_id'=>Auth::User()->getProvider->id])->get();
          $data['properties']=$models;
          $data['charges']=InvoiceComponent::where(['type'=>'Occurance'])->get();
            if($request->isMethod("post"))
            {
                $data=$request->all();
            DB::beginTransaction();
          $user=new User();
          $user->name=(isset($data['name']))?$data['name']:null;
        $user->email=(isset($data['email']))?$data['email']:null;
        $user->password=$data['id_number'];
        $user->verification_code=str_random(8);
        $user->confirmed_at=date('Y-m-d H:i:s');
        $user->provider="Manual";
        $user->save();

          $this->assignTenantRole($user);
            $profile=$this->createProfile($user,$data);
            $tenant=$this->createNewTenant($user,$data);
            $space=Space::find($data['space_id']);
             $space->status="Occupied";
             $space->save();
              
            DB::commit();
            Session::flash("success_msg","Tenant Added Successfully");
            return redirect()->back();




            }

        
          return view('backend::tenants.create',$data);



         }else{
          return view("forbidden");
         }
         
    }

    public function createNewTenant($user,$data)
    {
        
      $property=Property::find($data['property_id']);
          $tenant=new Tenant();
          $tenant->user_id=$user->id;
          $tenant->provider_id=$property->provider_id;
          $tenant->space_id=$data['space_id'];
          $tenant->entry_date=date('Y-m-d');
          $tenant->status="Occupied";
          $tenant->monthly_fee=$data['rent']+$data['water']+$data['gabbage'];
          $tenant->is_emailable=0;
          $tenant->property_id=$property->id;
          $tenant->save();
          $tenant_charges=array("Rent"=>$data['rent'],"Water"=>$data['water'],'Gabbage'=>$data['gabbage']);
          

          foreach($tenant_charges as $key=>$value)
          { 
            if($value>0)
              {
              $mod=new TenantCharges();
              $mod->tenant_id=$tenant->id;
              $mod->charge_name=$key;
              $mod->amount=$value;
              $mod->effective_from=date('Y-m-d');
              $mod->status="Active";
              $mod->save();
             }
           }
            if(isset($data['deposit']))
            {
               if($data['deposit']>0)
               {
                $this->createDeposit($tenant,$data['deposit']);
               }
               
            }
        $invoice=TenantInvoice::create($tenant,$data['amount_due']);

       return true;

            




    }

    public function updateAmountDue($tenant,$amount)
    {
        $summary=\App\TenantMonthlyReport::where(['tenant_id'=>$tenant->id,'month'=>date("M"),'year'=>date('Y')])->latest('id')->first();
          if($summary)
          {
            $summary->invoice_amount=$amount;
            $summary->new_balance=$amount;
            $summary->balance=$amount;
            $summary->save();
          }
    }


    public function getPropertTenantUnits($id,Request $request)
    {
        $data['id']=$id;
         $data['property']=$model=Property::find($id);
         $data['expected_amount']=$model->tenants->where('status','Occupied')->sum('monthly_fee');
           $p=Auth::User()->getProvider->id;

            

            $data['models']=\App\TenantMonthlyReport::join('spaces','spaces.id','=','tenant_monthly_reports.space_id')
          ->where(['spaces.property_id'=>$id])
          ->where('balance','>',0)
          ->where(['month'=>date('M')])
          ->where(['year'=>date('Y')])
          ->where(['space_status'=>1])
          ->orderBy('space_id','asc')
          ->get();

           $data['expenses']=PropertyExpense::where(['property_id'=>$id,'month'=>date('M'),'year'=>date('Y')])->get();





         



         
           
          $data['amount_paid']=TenantSummary::join('tenants','tenants.id','=','tenant_summaries.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','spaces.id','=','tenants.space_id')
          ->where(['tenant_summaries.property_id'=>$id])
      
          ->where(['month'=>date('M')])
          ->where(['year'=>date('Y')])
          ->where(['spaces.status'=>'Occupied'])
          ->sum('amount_paid');
         

          

           if($request->isMethod("post"))
           {
             
              
                $data=$request->all();

                  dd($data);
                 
                

              $datepaid=$data['datepaid'];
              $amountpaid=$data['amountpaid'];
              $refNumber=$data['refNumber'];
              $tenants=$data['tenantId'];
              $spaceid=$data['spaceId'];
              $rent=$data['rent'];
              $deposit=$data['deposit'];
              $method=$data['method'];
              $amountDue=$data['amountDue'];
                foreach ($datepaid as $key => $value) {
                   $amount=$amountpaid[$key];
                   $amountdue=$amountDue[$key];

                      
                     if(strlen($amount)>0)
                     {
                      $tenant=Tenant::find($tenants[$key]);
                      $this->updateAmountDue($tenant,$amountdue);
                      DB::beginTransaction();
                       $payment=new TenantPayment();
                       $payment->provider_id=$tenant->provider_id;
                       $payment->space_id=$tenant->space_id;
                          if(strlen($refNumber[$key])>0)
                          {
                            $payment->reference_number=$refNumber[$key];
                          }else{
                            $payment->reference_number=str_random(6);
                          }
                       
                       $payment->credit=0;
                       $payment->debit=$amount;
                       $payment->description="Being Rent Payment";
                       $payment->transaction_date=(strlen($datepaid[$key])>0)?date('Y-m-d',strtotime($datepaid[$key])):null;
                       $payment->system_transaction_number=$this->getTransactionNumber();
                       $payment->year=date('Y');
                       $payment->month=date('m');
                       $payment->tenant_id=$tenant->id;
                       $payment->payment_mode=$method[$key];
                       $payment->save();
                        
                        


                       

                      $summary=TenantSummary::where(['tenant_id'=>$tenant->id,'month'=>date("M"),'year'=>date('Y')])->latest()->first();
                         

                           if($summary)
                           {
                              $summary->outstanding_balance=$summary->bal_brought_forward+$summary->invoice_amount;
                              $summary->amount_paid=$summary->amount_paid+$payment->debit;
                              $summary->bal_carried_foward=$summary->outstanding_balance-$summary->amount_paid;
                              $summary->new_balance=$summary->outstanding_balance-$summary->amount_paid;
                             if($summary->bal_carried_foward==0)
                             {
                              $summary->remarks="No Balance";
                             }else if($summary->bal_carried_foward>0)
                             {
                              $summary->remarks="Has Balance";
                             }else{
                                $summary->remarks="has OverPaid";
                             }
                             $summary->save();
                             


                           }
                           $rentAmount=$rent[$key];
                           $depositAmount=$deposit[$key];
                            if($depositAmount=="")
                            {
                              $depositAmount=0;
                            }
                             if($method[$key]=="Direct" || preg_match('/Direct/i',$method[$key] ))
                             {
                              $directAmount=$rentAmount;


                               $this->createDirectPayment($directAmount,$payment->provider_id,$id,$datepaid[$key],$payment,$data);

                             }else{
                              $directAmount=0;
                             }

                             
                           $test=$this->DetermineRentBracketToUse($tenant);
                           if($test==1)
                           {
                            $actual_Rent_amount=$this->getRentAmount($tenant);
                          }else{
                            $actual_Rent_amount=$this->getSecondRentAmount($tenant,$rentAmount);
                          }
                                                      
                             




                            if($actual_Rent_amount>0)
                            {
                               if($test==1)
                               {
                                    if($rentAmount<$actual_Rent_amount)
                                   {
                                     $rentAmount=$rentAmount;
                                   }else{
                                    $rentAmount=$actual_Rent_amount;
                                   }

                               }else{
                                  $rentAmount= $actual_Rent_amount;  
                                
                               }

                            


                               
                                


                        Helper::repopulateMonthlyBreakdown($summary,$payment->credit,$payment->debit,$rentAmount,$depositAmount,$directAmount);

                            }
                           
                             

                        DB::commit();

                        $invoices=Invoice::where(['space_id'=>$tenant->space_id,'status'=>'Pending'])->get();


                        

                         
                           foreach($invoices as $invoice)
                           {

                              if($amount>=$invoice->amount)
                            {
                              $invoice->status="Paid";
                              $invoice->amount_paid=$invoice->amount;
                              $myamount=$invoice->amount;
                              $invoice->balance=$invoice->amount-$invoice->amount_paid;

                              $invoice->save();
                               $this->checkFullInvoices($invoice,$tenant);

                             

                              

                            }else{
                               
                              $invoice->status="Pending";
                              $invoice->amount_paid=$invoice->amount_paid+$amount;
                              $myamount=$amount;
                              $invoice->balance=$invoice->amount-$invoice->amount_paid;
                              $invoice->save();
                                
                              $this->checkHalfInvoices($invoice,$tenant,$amount);
                            }

                          




                            $amount=$amount-$invoice->amount;
                            if($tenant->is_emailable==1)
                              {
                                 try
                                 {
                                 $this->sendReceipt($tenant,$invoice);
                                 }catch(Exception $p)
                                 {
                                  Helper::sendEmailToSupport($e);
                                 }


                                
                              }

                           }
                           

                        }
                         
                    

                }
                Session::flash('success_msg',"Payment Made Successfully");
                return redirect()->back();
              

           }
           $data['url']=url()->current();

           
            
       return view('backend::tenants.my_bulk_payments',$data);

    }

    public function getSecondRentAmount($tenant,$amount)
    {
        $model=InvoiceItem::join('invoices','invoices.id','=','invoice_items.invoice_id')
            ->where(['issued_to'=>$tenant->user_id,'space_id'=>$tenant->space_id])
            ->where(['invoice_items.name'=>'Rent'])
            ->select('invoice_items.id','invoice_items.amount','invoice_items.amount_paid','invoice_items.balance')
            ->latest('invoice_items.id')->first();
          
           if($amount>$model->balance)
           {
            $new_amount=$model->amount;
           }else{
            $new_amount=$model->amount_paid+$amount;
           }
            return $new_amount;

    }

    public function DetermineRentBracketToUse($tenant)
    {
      $model=InvoiceItem::join('invoices','invoices.id','=','invoice_items.invoice_id')
            ->where(['issued_to'=>$tenant->user_id,'space_id'=>$tenant->space_id])
            ->where(['invoice_items.name'=>'Rent'])
            ->select('invoice_items.id','invoice_items.amount','invoice_items.amount_paid','invoice_items.balance')
            ->latest('invoice_items.id')->first();
         if($model)
         {
           if($model->amount_paid==0)
       {
        return 1;
       }else{
        return 2;
       }

         }else{
           return 1;
         }

       



    }

    public function getRentAmount($tenant)
    {
      $model=InvoiceItem::join('invoices','invoices.id','=','invoice_items.invoice_id')
            ->where(['issued_to'=>$tenant->user_id,'space_id'=>$tenant->space_id])
            ->where(['invoice_items.name'=>'Rent'])
            ->select('invoice_items.id','invoice_items.amount','invoice_items.amount_paid','invoice_items.balance')
            ->latest('invoice_items.id')->first();

        if($model)
        {
            return $model->balance;
          

        }else{
          return $tenant->monthly_fee;
        }
    }

    public function checkHalfInvoices($invoice,$tenant,$amount)
    {
       

       $summary=\App\TenantMonthlyReport::where(['tenant_id'=>$tenant->id,'month'=>date("M"),'year'=>date('Y')])->latest('id')->first();
         if(!$summary)
         {
           $amount=$amount;
         }else{
           $amount=$summary->amount_paid;
         }


          
           
       foreach($invoice->items as $item)
                             {
                                
                                  
                                if(preg_match('/Rent/i', $item->name) && $item->balance>0)
                                {
                                   

                                 $summary=\App\TenantMonthlyReport::where(['tenant_id'=>$tenant->id,'month'=>date("M"),'year'=>date('Y')])->latest('id')->first();
                                    if($summary)
                                    {
                                       if($amount>=$item->amount)
                                       {
                                        $summary->rent=$summary->rent_amount_paid;
                                       }else{
                                        $summary->rent=$summary->rent_amount_paid;
                                       }
                                       $summary->save();
                                      $item->amount_paid=$summary->rent;
                                      $item->balance=$item->amount-$item->amount_paid;
                                      $item->save();
                                       





                                        $amount=$amount-$summary->rent;
                                      
                                      
                                    }
                                }


                                


                                if(preg_match('/water/i', $item->name) && $amount>0 && $item->balance>0 )
                                {
                                   
                                 $summary=\App\TenantMonthlyReport::where(['tenant_id'=>$tenant->id,'month'=>date("M"),'year'=>date('Y')])->latest('id')->first();
                                    if($summary)
                                    {
                                       if($amount>=$item->amount)
                                       {
                                      $summary->water_bill=$summary->water_bill+$item->amount;
                                       } else{
                                       $summary->water_bill=$summary->water_bill+$amount;
                                       }
                                      $summary->save();

                                      $item->amount_paid=$summary->water_bill;
                                      $item->balance=$item->amount-$item->amount_paid;
                                      $item->save();
                                      

                                      
                                    }
                                }

                                 if(preg_match('/gabb/i', $item->name)&& $amount>0 && $item->balance>0)
                                {
                                   
                                 $summary=\App\TenantMonthlyReport::where(['tenant_id'=>$tenant->id,'month'=>date("M"),'year'=>date('Y')])->latest('id')->first();
                                    if($summary)
                                    {
                                       if($amount>=$item->amount)
                                       {
                                      $summary->gabbage_bill=$summary->gabbage_bill+ $item->amount;
                                        }else{
                                      $summary->gabbage_bill=$amount;
                                        }
                                      $summary->save();
                                      $item->amount_paid=$summary->gabbage_bill;
                                      $item->balance=$item->amount-$item->amount_paid;
                                      $item->save();
                                       
                                    }
                                }
                        }


    }


    public function checkFullInvoices($invoice,$tenant)
    {

       foreach($invoice->items as $item)
                             {
                              
                                if($item->name=="Rent")
                                {
                                   
                                 $summary=\App\TenantMonthlyReport::where(['tenant_id'=>$tenant->id,'month'=>date("M"),'year'=>date('Y')])->latest('id')->first();
                                    if($summary)
                                    {
                                      $summary->rent=$summary->rent+$item->amount;
                                      $summary->save();
                                      $item->amount_paid=$item->amount;
                                      $item->balance=$item->amount-$item->amount_paid;
                                      $item->save();
                                       

                                      
                                    }
                                }

                                if(preg_match('/water/i', $item->name))
                                {
                                   
                                 $summary=\App\TenantMonthlyReport::where(['tenant_id'=>$tenant->id,'month'=>date("M"),'year'=>date('Y')])->latest('id')->first();
                                    if($summary)
                                    {
                                      $summary->water_bill=$summary->water_bill+$item->amount;
                                      $summary->save();
                                      $item->amount_paid=$item->amount;
                                      $item->balance=$item->amount-$item->amount_paid;
                                      $item->save();
                                      
                                    }
                                }

                                 if(preg_match('/gabb/i', $item->name))
                                {
                                   
                                 $summary=\App\TenantMonthlyReport::where(['tenant_id'=>$tenant->id,'month'=>date("M"),'year'=>date('Y')])->latest('id')->first();
                                    if($summary)
                                    {
                                      $summary->gabbage_bill=$summary->gabbage_bill+ $item->amount;
                                      $summary->save();
                                      $item->amount_paid=$item->amount;
                                      $item->balance=$item->amount-$item->amount_paid;
                                      $item->save();
                                       
                                    }
                                }






                             }

    }


    public function createDirectPayment($amount,$p_id,$property_id,$pay_date,$payment,$data)
    {

        /*$property=Property::find($property_id);
        $percentage=$property->agent_commission_percentage;*/
           
       

           DB::beginTransaction();
            $balance=PropertyTransaction::where(['property_id'=>$property_id])->latest('id')->first();
             if($balance)
             {
                if(strlen($balance->landloard_balance)<1)
                 {
                  $landload_balance=0;
                 }else{
                  $landload_balance=$balance->landloard_balance;
                 }
              
             }else{
              $landload_balance=0;
             }
             


               $transaction=new PropertyTransaction();
              $transaction->provider_id=$p_id;
              $transaction->property_id=$property_id;
              $transaction->credit=$amount;
               $transaction->tran_date=date('Y-m-d',strtotime($pay_date));
              $transaction->debit=0;
              $transaction->total_amount=0;
              $transaction->year=date('Y',strtotime($transaction->tran_date));
              $transaction->month=date('M',strtotime( $transaction->tran_date));
              $transaction->type="Debit";
              $transaction->method=$payment->payment_mode;
              $transaction->landloard_balance=$landload_balance-$transaction->credit;
              $transaction->Description="Direct Payment For Unit: ".$payment->space->number;
              $transaction->ref_no=$payment->reference_number;
              $account=PropertyAccount::where(['provider_id'=>$p_id,'property_id'=>$property_id,'account_type'=>'Credit'])->first();
              $transaction->account_id=$account->id;
              $transaction->save();
               
              DB::commit();
    }


    public function getTransactionNumber()
    {
      $model=Payment::latest('id')->first();
         
       if($model)
       {
        $number="PAY-".str_random(7);
        
        return "PAY-".$number;
       }else{
        return "PAY001";
       }
    }


    public function getPropertyTenants($id)
    {
       $models=Property::join('spaces','spaces.property_id','=','properties.id')
               ->join('tenants','tenants.space_id','=','spaces.id')
               ->join('users','users.id','=','tenants.user_id')
               ->where(['spaces.property_id'=>$id]);

       return Datatables::of($models)
       ->addColumn('amount_paid',function(){

         return '<input type="text" name="amountpaid[]" class="amountPaid">';
       })
       ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function storeTenants(Request $request)
    {
         
         
         $this->validate($request,[
            'property_id'=>'required|integer',
            'space_id'=>'required|integer',
            'name'=>'required',
            'id_number'=>'required',
            'phone'=>'required',
            'postal_address'=>'required',
            'expected_end_date'=>'date|required',
            'expected_end_date'=>'date|required',
            'email'=>'required|email',
            'charge'=>'required'
            ]);

         $data=$request->all();

          try{

    DB::beginTransaction();
    
     $user=User::where(['email'=>$data['email']])->first();
     if(!$user)
     {
      $user=$this->createUser($data);
     }
    
     $tenant=$this->createTenant($user,$data);
      
         DB::commit();
      Session::flash('success_msg','Tenant added successfully');
      return redirect()->back();
    }catch(\Exception $e)
     {
      Helper::sendEmailToSupport($e);
      Session::flash("danger_msg","Error occured while adding Tenant");
        return redirect()->back();
             
      }
  
      }

      public function createUser($data)
      {
        $user=new User();
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->password=$data['id_number'];
        $user->verification_code=str_random(8);
        $user->confirmed_at=date('Y-m-d H:i:s');
        $user->provider="Manual";
        
          if($user->save())
          {
            $this->assignTenantRole($user);
            $profile=$this->createProfile($user,$data);
            return $user;
          }else{
            return false;
          }
          
       }

      public function assignTenantRole($user)
      {
         try{
          $test=$this->verifyRole($user);
          $user->roles()->attach($test);


         }catch(\Exception $e)
          {
            Helper::sendEmailToSupport($e);
            return false;
          }
      }

      public function payMyInvoices($id,Request $request){
        $model=Invoice::find($id);
         if(!$model)
        {
          return "<h4 style='color:red;'>Resource Not Found</h4>";
        }

         if($request->isMethod("post"))
         {
          $this->validate($request,[
        'reference_number'=>'required|unique:tenant_payments',
        'payment_mode'=>'required|string',
        'credit'=>'required|integer',
        'transaction_date'=>'required|date',
        'description'=>'required'
        ]);
    $data=$request->all();
    $space=$model->space;
    $property=$space->property;


     $tenant=Tenant::where(['space_id'=>$space->id])->latest('id')->first();
      $invoice=$model;
     if($tenant):
      
   $payment_data=array('provider_id'=>$tenant->provider_id,
                        'space_id'=>$space->id,
                        'invoice_id'=>$invoice->id,
                        'reference_number'=>strtoupper($data['reference_number']),
                        'credit'=>0,
                        'debit'=>$data['credit'],
                        'description'=>$data['description'],
                        'payment_mode'=>$data['payment_mode'],
                        'type'=>$data['payment_type'],
                        'transaction_date'=>date('Y-m-d',strtotime($data['transaction_date'])),
                        'system_transaction_number'=>str_random(8),
                        'year'=>date('Y'),
                        'month'=>date('m'),
                        'fee_charges'=>0,
                        'tenant_id'=>$tenant->id,
                        );
       
    $user=$model->user;
    $name=$user->name;
    $phone=$user->profile->telephone;
    $year=date('Y',strtotime($model->issue_date));
    $month=date('F',strtotime($model->issue_date));
  $model=TenantPayment::create($payment_data);
      if($model){
        $invoice->status="Paid";
        $invoice->save();
      }

      $message=$body="Dear ".$name." we have received your payment  of ".$model->amount." ,for ".$year.",".$month." Your Ref Number for this payment incase of any query is ".strtoupper($data['reference_number']).". Thank you";

     
          $message=new Messaging();
           $message->receiver_id=$user->id;
           $message->sender_id=Auth::User()->id;
           $message->subject="Payment Acknowledgement";
           $message->content=$body;
           $message->flag="message";
           $message->key=strtoupper(str_random(8));
           $message->save();
          //$this->sendEmail($model);
    Session::flash('success_msg','Payment Saved Successfully');
    return redirect()->back();

     else:

    return redirec()->back()->withErrors("Tenant Specified Not Found ");

    endif;
     
     
     
         }







        $data['model']=$model;
         $data['url']=url()->current();
        return view('backend::tenants.invoice_pay',$data);

      }

     public function createTenantCharges($tenant,$data)
     {
      try{
        $charge_name=$data['charge'];
        $amount=$data['amount'];
        $total=0;$deposit=0;
        foreach($charge_name as $key=>$value)
          { 
            $mod=new TenantCharges();
            $mod->tenant_id=$tenant->id;
            $mod->charge_name=$charge_name[$key];
             if($mod->charge_name=="Deposit");
             {
              $deposit=$amount[$key];
              $this->createDeposit($tenant,$amount[$key]);
             }
              if(isset($amount[$key]) && strlen($amount[$key])>0){
               $mod->amount=$amount[$key];
              }else{
               $mod->amount=0;
              }
            $mod->effective_from=$data['entry_date'];
            $mod->status="Active";
            $total=$total+$amount[$key];
            $mod->save();
          }
        return true;

      }catch(\Exception $e)
       {
         
         Helper::sendEmailToSupport($e);
         return false;
       }

     }

public function CreditTenantAccount($tenant,$invoice)
{
  try{
      $system_ref=str_random(7);
      $payment=new TenantPayment();
      $payment->tenant_id=$tenant->id;
      $payment->payment_mode="BankSlip";
      $payment->reference_number=strtoupper(str_random(13));
      $payment->type="Intail Payment";
      $payment->space_id=$tenant->space_id;
      $payment->provider_id=$tenant->provider_id;
      $payment->debit=0;
      $payment->credit=$invoice->amount;
      $payment->month=date("M");
      $payment->year=date('Y');
      $payment->fee_charges=0;
       if(isset($invoice)){
        $payment->invoice_id=$invoice->id;
       }
       $payment->transaction_date=date('Y-m-d');
       $payment->system_transaction_number=$system_ref;
       $payment->description='Being New Payment For The Space + Deposit';
       $payment->save();
      return $payment;
  }catch(\Exception $e)
   {
     Helper::sendEmailToSupport($e);
     return false;

   }

}

  public function createTenantFirstInvoice($tenant)
  {
          $amount=($tenant->charges)?$tenant->charges->sum('amount'):0;
          $invoice=new Invoice();
          $invoice->provider_id=Auth::User()->getProvider->id;
          $invoice->issued_to=$tenant->user_id;
          $invoice->space_id=$tenant->space_id;
          $invoice->issue_date=date('Y-m-d');
          $invoice->amount=$amount;
          $invoice->status="Pending";
          $invoice->type="Monthly Invoice";
          $invoice->due_date=date('Y-m-d', strtotime($invoice->issue_date . "+7 days"));
          $invoice->invoice_number=substr(number_format(time() * rand(),0,'',''),0,6);
          $invoice->save(); 
          Helper::CreateTenantMonthlySummary($invoice,$tenant);



          $this->createInvoiceItems($tenant,$invoice);
          $this->CreditTenantAccount($tenant,$invoice);
           
  }
  public function findItemCode($item)
  {
    $model=InvoiceComponent::where(['name'=>$item])->first();
    return ($model)?$model->code:null;

  }

  public function createInvoiceItems($tenant,$invoice)
  {
  try{
      $items=$tenant->charges;
      foreach($items as $item)
      {

        $itemName=$item->charge_name;
        $rentAmount=$item->amount;
        $rentCode=self::findItemCode($itemName);
        $invoiceitem=new InvoiceItem();
        $invoiceitem->invoice_id=$invoice->id;
        $invoiceitem->code= $rentCode;
        $invoiceitem->name=$itemName;
        $invoiceitem->amount=$rentAmount;
        $invoiceitem->save();
              
      }

    }catch(\Exception $e)
    {
      Helper::sendEmailToSupport($e);
      return false;
    }
     

  }



 public function createDeposit($tenant,$amount)
 {

  $deposit=Deposit::where(['tenant_id'=>$tenant->id])->first();
      if(!$deposit){
           $deposit=new Deposit();
        }
        $deposit->amount=$amount;
        $deposit->status="Unpaid";
        $deposit->tenant_id=$tenant->id;
        $deposit->save();

        

 }



    public function createTenant($model,$data){
     try{
            $provider=Property::find($data['property_id']);
            $smokers=(strlen($data['smoker_number'])<1)? 0: $data['smoker_number'];
            $tenant_data=array('user_id'=>$model->id,
              'provider_id'=>$provider->provider_id,
              'space_id'=>$data['space_id'],
              'status'=>'Occupied',
              'has_smokers'=>$data['do_you_have_smokers'],
              'smoker_number'=>$smokers,
              'stay_duration'=>$data['stay_duration'],
              'has_requirement'=>$data['has_requirement'],
              'requirement'=>$data['requirement'],
              'scanned_id'=>0,
              'type'=>$data['employement_type'],
              'expected_end_date'=>date('Y-m-d',strtotime($data['expected_end_date'])),
              'entry_date'=>date('Y-m-d',strtotime($data['entry_date'])),
            );
            $tenant=Tenant::create($tenant_data);
            $charges=$this->createTenantCharges($tenant,$data);
            if($charges)
            { 
             $this->createTenantFirstInvoice($tenant);
           }

           if($tenant->type=="Student"){
            $this->createStudent($tenant,$data);

          }elseif($tenant->type=="Employed"){
            $this->createEmployer($tenant,$data);
          }
          $this->createEmergencyContact($tenant,$data);
          $pet_present=$data['do_you_have_pet'];
          if($pet_present=="Yes"){
            $this->addPossession($tenant,$data,"pet");
          }
          $vehicle_present=$data['do_you_have_vehicle'];
          if($vehicle_present=="Yes"){
            $this->addPossession($tenant,$data,"vehicle");
          }
          $space=$tenant->space;
          if($space)
          {
           $space->status="Occupied";
           $space->save();
         }
         return $tenant;

 }
catch(\Exception $e)
 {
  Helper::sendEmailToSupport($e);
  return false;
}
 }


     public function createStudent($tenant,$data){

       $student=Student::where(['tenant_id'=>$tenant->id])->first();
        if(!$student){
        $student=new Student();
        }
       $student->tenant_id=$tenant->id;
       $student->reg_number=$data['reg_number'];
       $student->institution_name=$data['university_name'];
       $student->year_of_study=$data['year_of_study'];
       $student->course_title=$data['course'];
       $student->course_duration=$data['course_length'];
       $student->save();
       return true;

     }
     public function createEmployer($tenant,$data){
       $employer=Employer::where(['tenant_id'=>$tenant->id])->first();
        if(!$employer){
      $employer=new Employer();
        }

      $employer->tenant_id=$tenant->id;
      $employer->employer_name=$data['employer'];
      $employer->job_title=$data['job_title'];
      $employer->contact_name=$data['reference_name'];
      $employer->contact_phone=$data['reference_phone'];
      $employer->status="Pending";
      $employer->save();
       return $employer;
     }


     public function addPossession($tenant,$data,$product){
       if($product=="pet"){
        $type="Pet";
        $pos_name=$pet_name=$data['pet_name'];
        $pos_number=$pet_number=$data['pet_number'];

          }else{
          $pos_name=$data['body_type'];
          $type="Vehicle";
          $pos_number=$data['vehicle_number'];
          }
      
        
          foreach($pos_name as $key=>$value)
          {
            $mod=new Possession();
            $mod->tenant_id=$tenant->id;
            $mod->type=$type;
            $mod->name=$pos_name[$key];
            $mod->number= $pos_number[$key];
           
            $mod->save();
          }
        return true;
     }


     private function  verifyRole($user){
         $role_id=Role::where(['name'=>'Renter'])->first()->id;
        if($role_id){
           return $role_id;
        }
        else{
            return false;
        }
       
   }

   public function createProfile($user,$data)
   {
     
     $profile_data=array('user_id'=>$user->id,
                        'telephone'=>Helper::processNumber($data['phone']),
                        'status'=>'Incomplete',
                        'id_number'=>$data['id_number'],
                        'timezone'=>'Africa/Nairobi',
                        );
     $message="Dear ".$user->name." You have a new Account created for you on qooetu.com for accessing your rental properties.To access your account use \n 
     Email : ".$user->email." \n Password :".$data['id_number'];
     $telephone=Helper::processNumber($data['phone']);
      Helper::sendSms($telephone,$message);
     $profile=Profile::create($profile_data);
     return $profile;

   }

   public function createEmergencyContact($tenant,$data){
     $contact_data=array('tenant_id'=>$tenant->id,
                          'name'=>$data['kin_name'],
                          'relationship'=>$data['relationship'],
                          'postal_address'=>$data['conatct_postal_address'],
                          'postal_code'=>$data['conatct_postal_address'],
                          'email'=>$data['kin_email'],
                          'phone'=>$data['tel']
                           );
        $model=EmergencyContact::where(['tenant_id'=>$tenant->id])->first();
         if(!$model){
            $model=EmergencyContact::create($contact_data);

         }
         else{
            $model->update($contact_data);
         }

        $this->createSpaceOccupancy($tenant,$data);
         return true;
   }


   public function  createSpaceOccupancy($tenant,$data){

        $occupant_name=$data['person_name'];
        $occupant_identification=$data['identification'];
        $occupant_number=$data['occupant_number'];
        $occupant_age=$data['age'];
        $total=0;
         $current_occupants=TenantsOccupant::where(['tenant_id'=>$tenant->id])->get();
           if(sizeof($current_occupants)>0){
             foreach($current_occupants as $kid){
               $kid->delete();

             }

           }
          foreach($occupant_name as $key=>$value)
          {

            if(isset($occupant_number[$key]) && !empty($occupant_number[$key])){
              
            $mod=new TenantsOccupant();
            $mod->tenant_id=$tenant->id;
            $mod->name=$occupant_name[$key];
            $mod->identification=$occupant_identification[$key];
            $mod->number= $occupant_number[$key];
            $mod->age =$occupant_age[$key];
            $mod->save();

            }
           
            

            
          }

    
        return true;
       }


   public function createTenantPayments($tenant,$data,$total=0,$deposit_paid=0,$invoice=null)
   {
      $system_ref=str_random(7);
      $payment=new TenantPayment();
      $payment->tenant_id=$tenant->id;
      $payment->payment_mode="Cash";
      $payment->reference_number=strtoupper(str_random(13));
      $payment->type="Payment Reversal";
      $payment->space_id=$tenant->space_id;
      $payment->provider_id=$tenant->provider_id;
      $payment->debit=0;
      $payment->credit=$total;
      $payment->fee_charges=0;
       if(isset($invoice)){
        $payment->invoice_id=$invoice->id;
       }
       $payment->transaction_date=date('Y-m-d');
       $payment->system_transaction_number=$system_ref;
       $payment->description='Being New Payment For The Space';
       
       $payment->save();
       return $payment;
   }

   public function fetchTenants()
   {
    if(Entrust::hasRole("Provider") || Entrust::hasRole("Caretaker"))
       {
        $data['page_title']="Tenant Management";
        // 

         if(Entrust::hasRole("Caretaker"))
         {
            return view('backend::tenants.care_index',$data);
         }else{
           return view('backend::tenants.index',$data);
         }
       
        }
       else
       {
        return view("forbidden");
       }
   }


   public function fetchdepositpayments(){

    if(Entrust::hasRole("Provider"))
       {
        $data['page_title']="Payment Management";
        $data['payments']=TenantPayment::where(['type'=>'Deposit','provider_id'=>Auth::User()->getProvider->id])->get();
        return view('backend::tenants._index',$data);
        }
       else
       {
        return view("forbidden");
       }

   }
   public function fetchrentPayments(){
    if(Entrust::hasRole("Provider"))
       {
        $data['page_title']="Payment Management";
        $data['payments']=TenantPayment::where(['type'=>'Rent','provider_id'=>Auth::User()->getProvider->id])->get();
        return view('backend::tenants._rindex',$data);
        }
       else
       {
        return view("forbidden");
       }

   }
   public function getInvoiceDetails($id)
   {
    $invoice=Invoice::find($id);
     
      if($invoice)
      {
         
        $user=$invoice->user;
        $data=array('name'=>$user->name,
                     'telephone'=>$user->profile->telephone,
                     'id_number'=>$user->profile->id_number,
                     'email'=>$user->email,
                     'invoice_number'=>$invoice->invoice_number,
                     'date_billed'=>$invoice->issue_date,
                     'invoice_amount'=>$invoice->amount,
                     'space'=>$invoice->space->number,
                     'property'=>$invoice->space->property->title,
                     'amount_paid'=>$invoice->amount_paid,
                     'balance'=>$invoice->balance,

                   );
         return json_encode($data);

      }

   }

   public function createSpace($pname,$space_number,$amount)
   {
   
    $property=Property::where('title','like','%'.$pname."%")->first();
      if($property)
      {
        $model=Space::where(['property_id'=>$property->id,'title'=>$space_number])->first();
              if($model)
              {

              }else{
                 DB::beginTransaction();
                  if(strlen($space_number)>0)
                  {
                    $model=new Space();
                    $model->template_id=1;
                    $model->property_id=$property->id;
                    $model->unit_price=doubleval($amount);
                    $model->currency="KES";
                    $model->title=$space_number;
                    $model->number=$space_number;
                   
                    $model->floor="Ground Floor";
                    $model->save();

                  }
                
                    DB::commit();

              }

              return $model;
                    

      }

   }

   public function makepayment(){
    if(Entrust::hasRole("Provider"))
       {
        $data['page_title']="Payment Management";
        $models=Property::where(['provider_id'=>Auth::User()->getProvider->id])->get();
        $data['properties']=$models;
        $data['invoice_id']=(isset($_GET['invoice_id']))?$_GET['invoice_id']:0;

        return view('backend::tenants.create_payment',$data);
        }
       else
       {
        return view("forbidden");
       }

   }

   public function getTenantDetails($id)
   {
      $model=Tenant::where(['space_id'=>$id])->first();
       if($model){
        $data=array('id'=>$model->id,'name'=>$model->user->name,'email'=>$model->user->email,'id_number'=>$model->user->profile->id_number,'phone'=>$model->user->profile->telephone);
        return json_encode($data);


       }
       else{
        echo json_encode("Tenant Details not Found");
       }
   }

   public function storePayment(Request $request)
   {
    //DB::beginTransaction();
    $this->validate($request,[
  
        'space_id'=>'required|exists:spaces,number',
        'reference_number'=>'required|unique:tenant_payments',
        'payment_mode'=>'required|string',
        'credit'=>'required|integer',
        'transaction_date'=>'nullable|date',
        'description'=>'required'
        ]);
    $data=$request->all();
    
     

      try{

    
     $invoice=Invoice::where(['invoice_number'=>$data['invoice']])->first();
     $property=Property::where(['title'=>$data['property_id']])->first();
     $space=Space::where(['property_id'=>$property->id,'number'=>$data['space_id']])->first();
     $tenant=Tenant::where(['space_id'=>$space->id])->first();
      
      $comm_percentage=$property->agent_commission_percentage;
      
    if($tenant):
     
   $payment_data=array('provider_id'=>$tenant->provider_id,
                        'space_id'=>$space->id,
                        'invoice_id'=>($invoice)?$invoice->id:null,
                        'reference_number'=>$data['reference_number'],
                        'credit'=>0,
                        'debit'=>$data['credit'],
                        
                        'description'=>$data['description'],
                        'payment_mode'=>$data['payment_mode'],
                        'type'=>$invoice->type,
                        'transaction_date'=>date('Y-m-d',strtotime($data['transaction_date'])),
                        'system_transaction_number'=>str_random(8),
                        'year'=>date('Y'),
                        'month'=>date('m'),
                        'fee_charges'=>0,
                        'tenant_id'=>$tenant->id,
                        );

    
    $model=TenantPayment::create($payment_data);
     
      if($model){
         if(isset($data['receipt']))
         {
          Helper::uploadReceipt($model,$data);
         }
         
          
         $amount=$invoice->amount_paid+$data['credit'];
          
        $invoice->amount_paid=doubleval($amount);
        
        if(strlen($invoice->balance)<1)
          {
            $invoice->balance=$invoice->amount;
            $invoice->save();
          }

        $invoice->balance=$invoice->amount-$invoice->amount_paid;
        $invoice->status=($invoice->balance>0)?"Pending":"Paid";
        $invoice->save();

       
          if(isset($data['itemIds']))
          {
            $ids=$data['itemIds'];
            $amounts=$data['itemAmount'];

              foreach($ids as $key=>$value)
              {
                 
                 $id=$ids[$key];
                 $amount=$amounts[$key];
                
                  //dd($amount);
                $invoiceitem=InvoiceItem::find($id);
                 if($invoiceitem)
                 {

                   

                     

                   
            /*$component=InvoiceComponent::where(['name'=>$invoiceitem->name])->first();
              dd($component);*/
                   $invoiceitem->amount_paid=$amount;
                  $invoiceitem->balance=$invoiceitem->amount-$invoiceitem->amount_paid;
                  $invoiceitem->save();

                 $test= Helper::updateTenantMonthReport($invoiceitem,$tenant,$model);

                               
                    

                 }
                 

              }

          }
         

         
         DB::commit();
         //$this->sendReceipt($model,$invoice);
         
         Session::flash("success_msg","Payment Received successfully and receipt emailed to the tenant");
         return redirect('/backend/invoices/index?status=Pending');
          

       
       
         

      }
    Session::flash('success_msg','Payment Saved Successfully');
    return redirect()->back();

     else:

    return redirec()->back()->withErrors("Tenant Specified Not Found ");

    endif;


      }catch(\Exception $e)
       {
         dd($e);
       }
     
     }

   public function sendReceipt($model,$invoice)
   {
    try{
      $receipt=Receipt::generate($model,$invoice);

    }catch(\Exception $e){
      dd($e);

    }
   
   }
   public function createMyPayment($comm,$comm_amount,$opayment)
   {
                   $payment=new Payment();
                   $payment->amount=$comm_amount;
                   $payment->month=$opayment->month;
                   $payment->year=$opayment->year;
                   $payment->space_id=$opayment->space_id;
                   $payment->property_id=$opayment->property_id;
                   $payment->charge_id=$comm->id;
                   $payment->tenant_id=$opayment->tenant_id;
                   $payment->save();
                    

   }

  


   public function emergency_contact(){
     if(Entrust::hasRole("Provider")){
      $data['page_title']="Emergency Contacts For Tenants";
       return view('backend::tenants.emergency_contacts',$data);
     }else{
      return view("forbidden");
     }
   }


   public function  registered_items(){
    if(Entrust::hasRole("Provider")){
      $id=Auth::User()->getProvider->id;
      $data['page_title']="Assets Management";
        return view('backend::tenants.registered_items',$data);
      
      }else{
      return view("forbidden");
    }

   }

   public function getoccupants(){
    if(Entrust::hasRole("Provider")){
      $id=Auth::User()->getProvider->id;
      $data['page_title']="Occupant Management";
        return view('backend::tenants.occupants_list',$data);
      
      }else{
      return view("forbidden");
    }

   }


   public function view($id){
     if(Entrust::hasRole("Provider")){
      $provider_id=Auth::User()->getProvider->id;
       $model=Tenant::where(['provider_id'=>$provider_id,'id'=>$id])->first();

        if(!$model){
          return view("not_found");
        }
        $data['model']=$model;
        $data['contact']=$model->contact;
        $data['occupants']=$model->occupants;
        $data['items']=$model->items;
        $data['payments']=$model->payments();
        $data['page_title']="Tenants Details";
        return view('backend::tenants.detail_view',$data);

     }else{
      return  view("forbidden");
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



    public function add_new_occupant($id,Request $request){
      $method = $request->method();

      $model=new TenantsOccupant();
       

     
       if($request->isMethod('post')) {
        $data=$request->all();
        $tenant=array('tenant_id'=>$id);
        $data=array_merge($data,$tenant);
        unset($data['_token']);

         $model=TenantsOccupant::firstOrCreate($data);
          if($model){
            Session::flash("success_msg","Occupant Added Successfully");

          }else{
           Session::flash("danger_msg",$model->errors());
          }
          $url_to=url('/backend/tenant/view/'.$id);
          return redirect($url_to);


       }else{
        $url=url("backend/tenant/add_occupants/".$id);
         $data['url']=$url;
         $data['model']=$model;
         return view('backend::tenants.add_occupant',$data);

       }


    }

    public function edit_occupant($id,Request $request){
      $model=TenantsOccupant::find($id);
       if($request->isMethod("post")){
         $data=$request->all();
         $model->update($data);

          if($model){
            Session::flash("success_msg","Occupant Updated Successfully");

          }else{
           Session::flash("danger_msg",$model->errors());
          }
          $url_to=url('/backend/tenant/view/'.$model->tenant_id);

          return redirect()->back();
        }else{
        $url=url("backend/tenants/edit_occupant/".$id);
        $data['url']=$url;
        $data['model']=$model;
        $data['label']="Update";
        //$data['occupant']=$model->occupants;

         return view('backend::tenants.add_occupant',$data);

       }


    }


    public function delete_occupant($id){
      if(Entrust::hasRole("Provider")){
        $provider_id=Auth::User()->getProvider->id;
        $model=TenantsOccupant::find($id);
            if($model){
              
              $model->delete();

              Session::flash("success_msg",'Occupant Deleted successfully');

            }else{
              Session::flash("danger_msg",'Resource you are trying to delete was not found on this server');
            }

      }else{
        Session::flash("danger_msg",'You do not have permissions to perform this task');
      }
    }


    public function add_item($id,Request $request){
       $model=new Possession();
       if($request->isMethod("Post")){
        $data=$request->all();
        $tenant=array('tenant_id'=>$id);
        $data=array_merge($data,$tenant);
        unset($data['_token']);

         $model=Possession::firstOrCreate($data);
          if($model){
            Session::flash("success_msg","Item Added Successfully");

          }else{
           Session::flash("danger_msg",$model->errors());
          }
          $url_to=url('/backend/tenant/view/'.$id);
          return redirect($url_to);

       }else{
        $data['url']=url('/backend/tenant/add_item/'.$id);
        $data['model']=$model;
        return view('backend::tenants.add_item',$data);
       }
    }

    public function edit_item($id,Request $request){

      $model=Possession::find($id);
     
       if($request->isMethod("post")){
         $data=$request->all();
         $model->update($data);

          if($model){
            Session::flash("success_msg","Item Updated Successfully");

          }else{
           Session::flash("danger_msg",$model->errors());
          }
          

          return redirect()->back();



       }else{
        $url=url("backend/tenants/edit_item/".$id);
        $data['url']=$url;
        $data['model']=$model;
        $data['label']="Update";
         return view('backend::tenants.add_item',$data);

       }


    }

     public function delete_item($id){
      if(Entrust::hasRole("Provider")){
        $provider_id=Auth::User()->getProvider->id;
        $model=Possession::find($id);
            if($model){
              
              $model->delete();

              Session::flash("success_msg",'Item Deleted successfully');

            }else{
              Session::flash("danger_msg",'Resource you are trying to delete was not found on this server');
            }

      }else{
        Session::flash("danger_msg",'You do not have permissions to perform this task');
      }
    }



    public function edit_contact(Request $request,$id){
      $model=EmergencyContact::find($id);

      if($request->isMethod("post")){
         $data=$request->all();
          if($model->update($data)){
            Session::flash("success_msg","Details updated successfully");
          }

          return redirect()->back();

      }else{
        $data['model']=$model;
        $data['url']=url('/backend/tenants/contact/'.$id);
        $data['label']='Update';

      return view('backend::tenants.edit_contact',$data);

      }

    }

    public function updateTenant($id=null)
    {
        if(Entrust::hasRole("Provider")){
             $provider_id=Auth::User()->getProvider->id;
           $model=Tenant::where(['provider_id'=>$provider_id,'id'=>$id])->first();
            if($model){
              $data['page_title']="Update Tenant's Details";
              $data['model']=$model;
                $deposit_model=Deposit::where(['tenant_id'=>$model->id])->first();

              $data['deposit']=($deposit_model)? $deposit_model->amount:0;
              $models=Property::where(['provider_id'=>Auth::User()->getProvider->id])->get();
              $data['properties']=$models;
              $data['space']=Space::find($model->space_id);


               
              
              return view('backend::tenants.edit_tenant',$data);



            }else{
              return view("not_found");
            }




        }else{
          return view("forbidden");
        }
    }

    public function getstudents(){
       if(Entrust::hasRole("Provider")){
        $data['page_title']="Students Tenants";
        $data['students']=Student::join('tenants','students.tenant_id','=','tenants.id')->where(['type'=>'Student'])->orderBy('reg_number')->get();
         return view('backend::tenants.student_tenant',$data);
         }else{
        return view("forbidden");
       }
    }

    public function getnonstudent(){
      if(Entrust::hasRole("Provider")){
        $data['page_title']="Tenants Details";
        $data['students']=Employer::join('tenants','employed_tenants.tenant_id','=','tenants.id')->where('type','!=','Student')->get();
         return view('backend::tenants.student_tenant',$data);
         }else{
        return view("forbidden");
       }

    }

    public function updateTdetails(Request $request,$id){

       if(Entrust::hasRole("Provider")){
          $data=$request->all();
                
    DB::beginTransaction();
      $user_data=array('name'=>$data['name'],'email'=>$data['email'],'password'=>$data['id_number'],'verification_code'=>str_random(8),'confirmed_at'=>date('Y-m-d H:i:s'),'provider'=>"Manual");
        $model=User::where(['email'=>$data['email']])->first();
         if($model){
           $user=$model->update($user_data);
           $profile=$this->editProfile($model,$data);
          }

     $this->editTenantD($model,$data);
    return redirect()->back();

       }else{
        return view("forbidden");
       }

    }
    public function editProfile($user,$data)
   {

     
     $profile_data=array('user_id'=>$user->id,
                        'gender'=>$data['gender'],
                        'telephone'=>$data['phone'],
                        'postal_address'=>$data['postal_address'],
                        'status'=>'Incomplete',
                        'id_number'=>$data['id_number'],
                        'timezone'=>'Africa/Nairobi',
                        );
       $profile=Profile::where(['user_id'=>$user->id])->first();
       if($profile){
        $profile->update($profile_data);
       }
       
        return $profile;

   }
    public function editTenantD($model,$data){

      $provider=Property::find($data['property_id']);
       $tenant_data=array('user_id'=>$model->id,
                          'provider_id'=>$provider->provider_id,
                          'space_id'=>$data['space_id'],
                          'status'=>'Occupied',
                          'stay_duration'=>$data['stay_duration'],
                          'has_requirement'=>$data['has_requirement'],
                          'requirement'=>$data['requirement'],
                          'scanned_id'=>0,
                          'type'=>$data['employement_type'],
                          'expected_end_date'=>date('Y-m-d',strtotime($data['expected_end_date'])),
                          'entry_date'=>date('Y-m-d',strtotime($data['entry_date'])),
                          );


       $tenant=Tenant::find($data['tenant_id']);
       $tenant->update($tenant_data);
       

   
        if($tenant->type=="Student"){
          $this->createStudent($tenant,$data);

        }elseif($tenant->type=="Employed"){
          $this->createEmployer($tenant,$data);
        }
      $charge_name=$data['charge'];
      $amount=$data['amount'];
      $date_effective=$data['effective_from'];
         $tenant_charges=TenantCharges::where(['tenant_id'=>$tenant->id])->get();
         $intial_total=TenantCharges::where(['tenant_id'=>$tenant->id])->sum('amount');

         //being refund of the intial payment
          $payment_data=array('tenant_id'=>$tenant->id,
                         'payment_mode'=>'Cash',
                         'reference_number'=>strtoupper(str_random(13)),
                         'type'=>'Intail Payments',
                         
                         'space_id'=>$tenant->space_id,
                         'provider_id'=>$tenant->provider_id,
                         'debit'=>$intial_total,
                         'credit'=>0,
                         'fee_charges'=>0,
                         'transaction_date'=>date('Y-m-d'),
                         'system_transaction_number'=>strtoupper(str_random(10)),
                         'description'=>'Being  Intail Payment Reversal For The Space that was charged on',
                       );
        $payment=TenantPayment::create($payment_data);
          foreach($tenant_charges as $tena){
               $tena->delete();
            }

       
          $total=0;
          $deposit=0;
           
        
          foreach($charge_name as $key=>$value)
          {$mod=new TenantCharges();
            $mod->tenant_id=$tenant->id;
            $mod->charge_name=$charge_name[$key];
            $mod->amount= $amount[$key];
            $mod->effective_from=$date_effective[$key];
            $mod->status="Active";
            $total=$total+$amount[$key];
            $mod->save();
          }
          $deposit=TenantCharges::where(['tenant_id'=>$tenant->id,'charge_name'=>'Deposit'])->first()->amount;
        $payments=$this->createTenantPayments($tenant,$data,$total,$deposit,null);
       $x=$this->createEmergencyContact($tenant,$data);
       $space=Space::find($data['space_id']);
       $space->status="Occupied";
       $space->save();
       $y=$this->editPossession($tenant,$data,"pet");
       
       DB::commit();
       Session::flash('success_msg','Payment Saved Successfully');
    return $this->redirectToHo0me();

       

    }

    public function redirectToHo0me(){
      return redirect('/');
    }

    public function GetInvoiceComponents($number=null)
    {  
      $number=Input::get('Number');
      $model=Invoice::where(['invoice_number'=>$number])->first();
        $i=1;
         foreach($model->items as $item)
         {
          echo '<tr>
          <td>'.$i.'<input type="hidden" name="itemIds[]" value="'.$item->id.'"></td>
        
          <td>'.$item->name.'</td>
          <td>'.$item->amount.'</td>
           <td>'.$item->amount_paid.'</td>
            <td>'.$item->balance.'</td>

             <td><input type="text" class="number"  name="itemAmount[]" required></td>
          </tr>';

          $i++;
         }

    }

    public function editPossession($tenant,$data,$product){
       
        if(isset($data['item_name']))
        {
           $pos_name=$data['item_name'];
          $pos_number=$data['item_number'];
          $pos_type=$data['item_type'];
           $models=Possession::where(['tenant_id'=>$tenant->id])->get();

            if(sizeof($models)>0){
               foreach($models as $mod){
               $mod->delete();
              }
           }
           
             
         foreach($pos_name as $key=>$value)
          {
            $mod=new Possession();
            $mod->tenant_id=$tenant->id;
            $mod->type=$pos_type[$key];
            $mod->name=$pos_name[$key];
            $mod->number= $pos_number[$key];
            $mod->save();
          }

        }
         

        return true;
     }


     public function lease_expiry(){
      if(Entrust::hasRole("Provider"))
       {
        $data['page_title']="Tenant Management";
        $status=(isset($_GET['status']))? $_GET['status']:"All";
        $data['status']=$status;
        return view('backend::tenants._e_index',$data);
        }
       else
       {
        return view("forbidden");
       }

     }

     public function fetch_leases($status){

      if($status=="All"){
        $p_id=Auth::User()->getProvider->id;
        $bookings=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id'])
          ->where(['properties.provider_id'=>$p_id,'current_status'=>'Active'])
          ->get();

      }else{
          if($status=="monthly"){
             $p_id=Auth::User()->getProvider->id;
             $year=date('Y');
             $month=date('m');
        $bookings=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id'])
          ->where(['properties.provider_id'=>$p_id])
          ->whereYear('expected_end_date','=',$year)
          ->whereMonth('expected_end_date','=',$month)
          ->get();

          }elseif($status=="year"){
            $p_id=Auth::User()->getProvider->id;
             $year=date('Y');
             $month=date('m');
            $bookings=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id'])
          ->where(['properties.provider_id'=>$p_id])
          ->whereYear('expected_end_date','=',$year)
          ->get();
          }else{
            $p_id=Auth::User()->getProvider->id;
             $year=date('Y');
             $month=date('m');
        $bookings=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id'])
          ->where(['properties.provider_id'=>$p_id,'current_status'=>$status])
          ->get();
          }
       
      }


       
  return Datatables::of($bookings)
              ->editColumn('name',function($model){
                $url=url('/backend/tenant/view/'.$model->tenant_id);
                return '<a href="'.$url.'" >'.ucwords($model->name).'</a>';



              })
               ->editColumn('current_status',function($model){
                $today=date('Y-m-d');
                 if($model->current_status=="InActive"){
                  return '<label class="label label-danger"> Expired</lable>';
                 }elseif ($today>=$model->expected_end_date) {
                   return '<label class="label label-danger"> Expired</lable>';
                 }

                 else{
                  $ed=\Carbon::parse($model->expected_end_date);
                  $months=$ed->diffInMonths();
                  $days=$ed->diffInDays();
                   if($months<2){
                    return '<label class="label label-warning" title="'.$days.' Days Remaining">'.$model->current_status.' </lable>';
                   }else{
                    return '<label class="label label-success" title="'.$months.' Months Remaining">'.$model->current_status.'</lable>';
                   }



                  
                 }



              })
     
               ->addColumn('action', function ($model) {
                     $url=url('/backend/v-notice/extend/'.$model->id);
                     $url_to=url('/backend/notices/create/'.$model->tenant_id);
                      return '<a data-url="'.$url_to.'" style="cursor:pointer;"  title="Create New Tenant Vaccation Notice" 
                                data-title="Create New Tenants Vaccation Notice"class="icon-clapboard reject-modal"></a>

                              <a  style="margin-left:15%" title="Extend The Lease Period" data-url="'.$url.'" class="glyphicon glyphicon-pencil reject-modal"
                               data-title="Extend The Lease Period"
                              ></a>
                                ';

                    
                    })->make(true);

     }








     public function getChargeBreakdown($space_id){
       $tenant=Tenant::where(['space_id'=>$space_id])->first();
        if(sizeof($tenant->charges)>0){
       $models=$tenant->charges;
       $deposit= TenantCharges::where(['tenant_id'=>$tenant->id,'charge_name'=>'Deposit'])->sum('amount');
       $data['models']=$models;
       $data['deposit']=$deposit;
       $data['monthly']=TenantCharges::where(['tenant_id'=>$tenant->id])
                       ->where('charge_name','!=','Deposit')
                       ->sum('amount');
         return view('backend::tenants._charge',$data);
        }else{
           return "<h4 style='color:red'>No Charges Break Down Has Been Provided For This Client<h3>";
        }
     }

     public function getBreakdown($id){
       $tenant=Tenant::where(['id'=>$id])->first();
        if(sizeof($tenant->charges)>0){
       $models=$tenant->charges;
       $deposit= TenantCharges::where(['tenant_id'=>$tenant->id,'charge_name'=>'Deposit'])->sum('amount');
       $data['models']=$models;
       $data['deposit']=$deposit;
       $data['monthly']=TenantCharges::where(['tenant_id'=>$tenant->id])
                       ->where('charge_name','!=','Deposit')
                       ->sum('amount');
         return view('backend::tenants._charge',$data);
        }else{
           return "<h4 style='color:red'>No Charges Break Down Has Been Provided For This Client<h3>";
        }

     }



     public function getTenancy($space_id){
      $tenancy=Tenant::where(['space_id'=>$space_id])->get();
        if(sizeof($tenancy)<1){
          return "<h4 style='color:red'> TO Tenants Have Occupied The Space/Unit </h4>";

        }else{
          $data['tenancy']=$tenancy;
          return view('backend::tenants._space_tanants',$data);
        }

     }

     public function extendTenancy($id,Request $request){
        $model=Tenant::find($id);
         if(!$model){
          return "Resource Was Not Found on Our Server";
         }

         if($request->isMethod("post")){
           DB::beginTransaction();
           $data=$request->all();
            $model->expected_end_date=date('Y-m-d',strtotime($data['expected_end_date']));
            $model->current_status="Active";
            $model->save();
            $model->space->status="Occupied";
            $model->space->save();
            DB::commit();

             Session::flash('success_msg',"Tenancy Period Extended Successfully");
             return redirect()->back();

         }
         $data['model']=$model;

         $data['url']=url('/backend/v-notice/extend/'.$model->id);
         return view('backend::notice.extend_tenancy',$data);




     }


     public function getInvoices(){
       if(Entrust::hasRole("Provider"))
       {
        $data['page_title']="Invoice Management";
         $status=(isset($_GET['status']))? $_GET['status']:"all";
         $data['status']=ucwords($status);

         return view('backend::tenants.invoices',$data);
        }
       else
       {
        return view("forbidden");
       }

     }
     public function downloadInvoices($id)
     {
       $model=Invoice::find($id);
        if($model)
        {
          
          InvoicePDf::generate($model);
        }

     }




     public function getbalances(){
      if(Entrust::hasRole("Provider"))
       {
        $data['page_title']="Balance Management";
         $status=(isset($_GET['status']))? $_GET['status']:"all";
         $data['status']=ucwords($status);
         return view('backend::payments.balances',$data);
        }
       else
       {
        return view("forbidden");
       }


     }


     public function getInvoiceStats(){
       if(Entrust::hasRole("Provider"))
       {
        $data['page_title']="Invioce Statistics";
        $model=new Invoice();
        $data['model']=$model;
        $data['provider_id']=Auth::User()->getProvider->id;
         
        return view('backend::tenants.invoice_stats',$data);
        }
       else
       {
        return view("forbidden");
       }

     }

     public function invoiceView($id){
       if(Entrust::hasRole("Provider") || Entrust::hasRole("Renter"))
       {
        $data['page_title']="Invioce Statistics";
         if(Entrust::hasRole("Provider"))
          {
            $provider_id=Auth::User()->getProvider->id;
              $data['provider']=Auth::User()->getProvider;

        $model=Invoice::where(['id'=>$id,'provider_id'=>$provider_id])->first();

          }else{



        $model=Invoice::where(['id'=>$id,'issued_to'=>auth::user()->id])->first();

          }
        
        $data['model']=$model;
       
        return view('backend::tenants._invoice',$data);
        }
       else
       {
        return view("forbidden");
       }


     }


     public function viewRepairCosting($id){

       if(Entrust::hasRole("Provider") || Entrust::hasRole("Admin") || Entrust::hasRole("Renter"))
       {
        $data['id']=$id;
        $model=Repair::find($id);
         if(!$model){
          return "Repair Details Not Found";
         }
         $supplier=new Supplier();
         $invoice=Invoice::where(['invoice_number'=>$model->invoice_number])->first();
         $data['model']=$model;
         $data['invoice']=$invoice;
         $data['supplier']=$supplier;
         return view('backend::repairs._costing',$data);
        }
       else
       {
        return view("forbidden");
       }


     }


     public function getTechnician($id){
      if(Entrust::hasRole("Provider") || Entrust::hasRole("Renter"))
       {
        $data['id']=$id;
        $model=Repair::find($id);
         if(!$model){
          return "Repair Details Not Found";
         }
         $invoice=Invoice::where(['invoice_number'=>$model->invoice_number])->first();
         $data['model']=$model;
         $data['invoice']=$invoice;
         return view('backend::repairs._technician',$data);
        }
       else
       {
        return view("forbidden");
       }

     }

     public function verifyInvoice(){
       $q=Input::get('term');

        if(strlen($q)>3){


        $models=Invoice::where('invoice_number','like','%'.$q.'%')->get();
         

        if(sizeof($models)>0){
           $data=array();
       foreach($models as $model){

         $invoice=Invoice::find($model->id);
          $user_name=$invoice->user->name;
          $phone=$invoice->user->profile->telephone;
          $space=$invoice->space->number;
          $property=$invoice->space->property->title;
          $id_number=$invoice->user->profile->id_number;
           $date_billed=$invoice->issue_date;
           $email=$invoice->user->email;
           $description=$invoice->description;
           $expected_amoutnt=$invoice->amount;
           $invoice_id=$invoice->invoice_number;
           $data[]=array($invoice_id,$date_billed,$property,$space,$user_name,$id_number,$email,$phone,$expected_amoutnt,$description);
    
       }
      
   
   $data=json_encode($data);
   return $data;


        }else{

          $data=json_decode("Invoice Not Found In Our Records");
           return $data;

        }
      

    }


     }


     public function fetchTenantsList(){
       if(Entrust::hasRole("Caretaker"))
       {
        $p_id=Auth::User()->property_id;
        $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id'])
          ->where(['properties.id'=>$p_id,'current_status'=>'Active']);
         
          


       }else{
        $p_id=Auth::User()->getProvider->id;
        $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id'])
          ->where(['properties.provider_id'=>$p_id,'current_status'=>'Active']);
         
          

       }
         return Datatables::of($models)
           ->editColumn('name',function($model){
            return str_limit($model->name,25);

           })
           ->editColumn('updated_at',function($model){
            $tenant_id=$model->id;
            $space_id=$model->space_id;

             $model=TenantPayment::where(['tenant_id'=>$tenant_id,'space_id'=>$space_id])->latest('id')->first();

                if($model){
                  $balance=$model->balance;
                }else{
                  $balance=0;
                }

           return $balance;
             })
            ->editColumn('created_at',function($model){
            $tenant_id=$model->id;
            $space_id=$model->space_id;

             $model=TenantPayment::where(['tenant_id'=>$tenant_id,'space_id'=>$space_id])->latest('id')->first();
              $totals=TenantCharges::where(['tenant_id'=>$tenant_id,'charge_name'=>'Rent'])->sum('amount');

           return $totals;
             })
           ->addColumn('action',function($model){
            $edit_url=url('/backend/tenant/update/'.$model->id);
            $view_url=url('/backend/tenant/view/'.$model->id);
            $unit_url=url('/backend/space/view/'.$model->space_id);
            $create_vr_url=url('/backend/notices/create/'.$model->id);
            $invoices_url=url('/backend/tenant/invoice/'.$model->user_id);
            $transaction_url=url('/backend/payment/history?tenant_id='.$model->id);
            $charges_url=url('/backend/payment/tenants/charges?tenant_id='.$model->id);
            $addcharge_url=url('/backend/new_charge/create/'.$model->id);
            $addition_url=url('/backend/addition_charge/list/'.$model->id);
            $login_url=url('/backend/tenant/editLogin/'.$model->id);


            return '<div class=" btn-group pull-left" style="width:100%;" >
                       <button class="btn btn-sm btn-info " >Action</button>
                       <button class="btn btn-sm dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                         </button>
                        <ul class="dropdown-menu">
                       <li><a href="'.$edit_url.'"><i class="icon-pencil3"></i> Edit Details</a></li>

                          <li><a class="reject-modal"  data-title="Edit User Logins" data-url="'.$login_url.'"><i class="icon-pencil3"></i> Edit Logins</a></li>
                          <li><a href="'.$view_url.'"><i class="icon-file-eye"></i> Detail View</a></li>
                          <li><a href="'.$unit_url.'"><i class=" icon-library2"></i> Unit Details</a></li>
                          <li><a   style="cursor:pointer;"  title="Create New Tenant Vaccation Notice" class="reject-modal"
                                data-title="Create New Tenants Vaccation Notice"   data-url="'.$create_vr_url.'"
                                 ><i class="icon-clapboard"></i>Vacate Tenant</a></li>
                          <li><a href="'.$invoices_url.'"><i class="icon-folder-search"></i>View Client Invoices</a></li>
                          <li><a href="'.$transaction_url.'"><i class="icon-stack2"></i>Payment History</a></li>
                           <li><a  class="reject-modal" data-title="Add New Charge To Tenants Account" data-url="'.$addcharge_url.'"><i class="icon-stack2"></i>Add Charge</a></li>
                          <li><a href="'.$addition_url.'"><i class="icon-list"></i>Additional Charges Incured</a></li>

                          
                          <li><a href="'.$charges_url.'"><i class="icon-quill4"></i> Charges Break Down</a></li>

                             
                          </ul>
                          </div>

                    ';






            

              })

           ->make(true);
     }


     public function fetchTenantInvoice($id){
      $data['page_title']="Tenant Invoices";
      $data['user_id']=$id;
      $data['user']=User::find($id);
      return view('backend::tenants._invoicelist',$data);


     }

     public function getMyPayments($id,Request $request)
     {
      $data=$request->all();
      $start_date=date('Y-m-d 00:00:00',strtotime($data['start_date']));
      $end_date=date('Y-m-d 23:59:59',strtotime($data['end_date']));
        $models=TenantPayment::join('spaces','spaces.id','=','tenant_payments.space_id')
               ->join('properties','properties.id','=','spaces.property_id')
               ->join('tenants','tenants.id','=','tenant_payments.tenant_id')
               ->join('users','users.id','=','tenants.user_id')
               ->where(['spaces.property_id'=>$id])
               ->where('debit','>',0)
               ->where('reverse_status','!=',1)
               ->whereBetween('transaction_date',array($start_date,$end_date))
               ->select('tenant_payments.id','transaction_date','users.name','number','debit','reference_number')
               ->orderBy('tenant_payments.created_at','desc');
        return Datatables::of($models)
        ->addColumn("action",function($model){
    $reverse_url=url('/backend/Payment/Reverse/'.$model->id);
          return '<button  data-url="'.$reverse_url.'" class="btn btn-danger btn-sm reject-modal" data-title="Reverse Payment ">Reverse</button>';
        })
        ->make(true);

     }

     public function ReversePayment($id,Request $request)
     {
      $model=TenantPayment::find($id);
       $data['model']=$model;
       $data['url']=url()->current();
         if($request->isMethod("post"))
         {
           $data=$request->all();
             DB::beginTransaction();
             $model->reason=$data['reason'];
             $model->reverse_status=1;
             $model->save();
             $reverse_model=new TenantPayment();
             $reverse_model->tenant_id=$model->tenant_id;
             $reverse_model->payment_mode=$model->payment_mode;
             $reverse_model->reference_number=str_random(6)."-" .$model->id;
             $reverse_model->space_id=$model->space_id;
             $reverse_model->provider_id=$model->provider_id;
             $reverse_model->debit =0;
             $reverse_model->credit=$model->debit;
             $reverse_model->fee_charges=0;
             $reverse_model->type="Reversal";
             $reverse_model->transaction_date=date('Y-m-d');
             $reverse_model->year=date('Y');
             $reverse_model->month =date('M');
             $reverse_model->system_transaction_number=str_random(6);
             $reverse_model->reverse_status=0;
             $reverse_model->save();
             $this->reverseTotalPaymentd($model);
             $this->reverseInvoice($model);
              DB::commit();
              Session::flash("success_msg","Payment Reversed Successfully");
              return redirect()->back();

            
         }


       return view('backend::tenants._reverse_pay',$data);

     }
     public function reverseInvoice($model)
     {

       $invoice=Invoice::where(['issued_to'=>$model->tenant->user_id,'space_id'=>$model->space->id])->first();
       if($invoice)
       {

       $invoice->status="Pending";
       $invoice->amount_paid=0;
       $invoice->balance=$invoice->amount-$invoice->amount_paid;
       $invoice->save();

       }
       $items=$invoice->items;
        foreach($items as $item)
        {
          $item->amount_paid=0;
          $item->balance=$item->amount-$item->amount_paid;
          $item->save();

        }
      
      

     }

     public function reverseTotalPaymentd($model)
     {
      $property=$model->space->property;
      
      $payment=\App\TenantMonthlyReport::where(['tenant_id'=>$model->tenant_id])->latest('id')->first();
        
       if($payment)
       {
        $text="Tenant Payment For Unit :".$model->space->number;

        $propety=PropertyTransaction::where(['property_id'=>$property->id,'description'=>$text])->latest('id')->first();


          if($propety)
          {
            $propety->is_reserved=1;
            $propety->save();
            $newmodel=new PropertyTransaction();
            $newmodel->provider_id=$propety->provider_id;
            $newmodel->property_id=$propety->property_id;
            $newmodel->account_id=$propety->account_id;
            $newmodel->credit=$propety->debit;
            $newmodel->debit=$propety->credit;
            $newmodel->type="Credit";
            $newmodel->method="System";
            $newmodel->Description="Reverse For ".$text;
            $newmodel->year=date('Y');
            $newmodel->month=date('M');
            $newmodel->balance=$newmodel->debit-$newmodel->credit;
            $newmodel->is_reserved=1;
            $newmodel->tran_date=date('Y-m-d');
            $balance=PropertyTransaction::where(['property_id'=>$propety->property_id])->latest('id')->first();

             if($balance)
             {
             
            $new_balance=$balance->balance-$newmodel->credit;

             }else{
              $new_balance=0;
             }
             $newmodel->balance=$new_balance;
             $newmodel->landloard_balance=$new_balance;
             $newmodel->save();
            

            



          }
                 

        $payment->amount_paid=$payment->amount_paid-$model->debit;
        $payment->new_balance=$payment->invoice_amount-$payment->amount_paid;
        $payment->balance=$payment->new_balance;
        $payment->rent=0;
        $payment->water_bill=0;
        $payment->gabbage_bill=0;
        $payment->agent_commision=0;
        $payment->landload_amount=0;
        $payment->save();
         
       

        
       }

     }


     public function CreateNewInvoice(Request $request)
     {
       $data['url']=url()->current();
       $data['properties']=Property::where(['provider_id'=>Auth::User()->getProvider->id])->get();
         if($request->isMethod("post"))
         {
           $data=$request->all();
            $id=$data['property_id'];
            $unit=$data['unit'];
            $amount=$data['amount'];
            $description=$data['Description'];
              if($unit=="All")
              {
                $spaces=Tenant::join("spaces",'spaces.id','=','tenants.space_id')
                       ->where('spaces.property_id',$id)
                       ->select('spaces.id','tenants.id as tenant_id','user_id')
                       ->where(['spaces.status'=>'Occupied'])
                       ->get();
                      foreach($spaces as $space):
                        $this->CreateInvoice($space,$amount,$description);


                      endforeach;
              }else{

                 $spaces=Tenant::join("spaces",'spaces.id','=','tenants.space_id')
                       ->where('spaces.property_id',$id)
                       ->select('spaces.id','tenants.id as tenant_id','user_id')
                       ->where(['spaces.status'=>'Occupied'])
                       ->where(['spaces.id'=>$unit])
                       ->get();
                       foreach($spaces as $space):
                        $this->CreateInvoice($space,$amount,$description);


                      endforeach;
              }
            Session::flash("success_msg","Invoice Added Successfully");
            return redirect()->back();
         }



           return view('backend::tenants.create_new',$data);

     }

     public function CreateInvoice($space,$amount,$detail){
        
      DB::beginTransaction();
      $invoice=new Invoice();
                $invoice->provider_id=Auth::User()->getProvider->id;
                $invoice->issued_to=$space->user_id;
                $invoice->space_id=$space->id;
                $invoice->issue_date=date('Y-m-d');
                $invoice->amount=doubleval($amount);
                $invoice->status="Pending";
                $invoice->due_date=date('Y-m-d', strtotime($invoice->issue_date . "+30 days"));
                $invoice->invoice_number=substr(number_format(time() * rand(),0,'',''),0,6);
                $invoice->save(); 

                $system_ref=str_random(7);
                $payment=new TenantPayment();
                $payment->tenant_id=$space->tenant_id;
                $payment->payment_mode="Cash";
                $payment->reference_number=$invoice->invoice_number;
                $payment->type="Additional Invoice";
                $payment->space_id=$space->id;
                $payment->provider_id=$invoice->provider_id;
                $payment->debit=$amount;
                $payment->credit=0;
                $payment->fee_charges=0;
                $payment->invoice_id=$invoice->id;
                $payment->transaction_date=date('Y-m-d');
                $payment->system_transaction_number=$invoice->invoice_number;
                $payment->description=$detail;
               $payment->save();
                
                //repopulate monthly Summaries
              Helper::checkForMonthReports($space,$amount);
               DB::commit();
             




    
                 

     }


     public function addCharge($id,Request $request)
     {
       if(Entrust::hasRole("Provider"))
       {
        $model=Tenant::find($id);
         $data['url']=url()->current();
         $data['model']=$model;
          if($request->isMethod("post"))
          {
            $data=$request->all();
           try{
             DB::beginTransaction();
             $charge=new AdditionCharge();
             $charge->charge_name=strtoupper($data['charge_name']);
             $charge->charge_amount=doubleval($data['charge_amount']);
             $charge->charge_code=strtoupper(str_random(5));
             $charge->charge_status="Active";
             $charge->charge_description=$data['charge_description'];
             $charge->charge_date=date("Y-m-d");
             $charge->year=date("Y");
             $charge->month=date("M");
             $charge->notification=($data['send_notification']=="Yes")?1:0;
             $charge->provider_id=$model->provider_id;
             $charge->tenant_id=$model->id;
             $charge->property_id=$model->space->property_id;
             $charge->space_id=$model->space->id;
              $charge->save();
              if($charge)
              {
                $invoice=new Invoice();
                $invoice->provider_id=Auth::User()->getProvider->id;
                $invoice->issued_to=$model->user_id;
                $invoice->space_id=$model->space->id;
                $invoice->issue_date=date('Y-m-d');
                $invoice->amount=doubleval($data['charge_amount']);
                $invoice->status="Pending";
                $invoice->due_date=date('Y-m-d', strtotime($invoice->issue_date . "+30 days"));
                $invoice->invoice_number=substr(number_format(time() * rand(),0,'',''),0,6);
                $invoice->save(); 
                 





                $system_ref=str_random(7);
                $payment=new TenantPayment();
                $payment->tenant_id=$model->id;
                $payment->payment_mode="Cash";
                $payment->reference_number=$charge->charge_code;
                $payment->type=$charge->charge_name;
                $payment->space_id=$charge->space_id;
                $payment->provider_id=$charge->provider_id;
                $payment->debit=0;
                $payment->credit=$charge->charge_amount;
                $payment->fee_charges=0;
                $payment->invoice_id=$invoice->id;
                $payment->transaction_date=date('Y-m-d');
                $payment->system_transaction_number=$charge->charge_code;
                $payment->description='Being New Payment For '.$charge->charge_name;
               $payment->save();

                if($charge->notification==1)
                {
                  $text="Dear ".$model->user->name." addition charge ".$charge->charge_name." for KES ".$charge->charge_amount." has been added to your account.for more info,access your rental account at ".config('app.name');
                  $phone=str_replace('-','',$model->user->profile->telephone);
                   Helper::sendSms($phone,$text);
                   Helper::sendEmail($model->user->email,$text,"New Addition Charge");
                }
       
                DB::commit();
                Session::flash("success_msg","Charge Added to provider Account successfully");
                return redirect()->back();
              }


             



              }catch(\Exception $e)
               {
                 dd($e);
               }
          }

         return view('backend::tenants._addcharge',$data);
        }
       else
       {
        return view("forbidden");
       }

     }


     public function ReverseLandLoad($id,Request $request)
     {
        $model=PropertyTransaction::find($id);
          $data['model']=$model;
          $data['url']=url()->current();
             if($request->isMethod("post"))
             {
              $data=$request->all();
              DB::beginTransaction();
              $model->is_reserved=1;
              $model->save();
              $latest=PropertyTransaction::where(['property_id'=>$model->property_id])->latest()->first();
               
              $newModel=new PropertyTransaction();
              $newModel->provider_id=$model->provider_id;
              $newModel->property_id=$model->property_id;
              $newModel->account_id=$model->account_id;
              $newModel->credit=0;
              $newModel->debit=$model->credit;
              $newModel->ref_no="RVS-".$model->ref_no;
              $newModel->type="Credit";
              $newModel->method="System";
              $newModel->Description=$model->Description." Reversal";
              $newModel->year=date('Y');
              $newModel->month=date('M');
              $newModel->tran_date=date('Y-m-d');
              $newModel->transaction_id=$model->id;
              $newModel->landloard_balance=0;
              $newModel->is_reserved=1;
              $newModel->other_details="Reversal";
              $newModel->save();
               if($model->Description=="Expense")
               {
                $expense=PropertyExpense::where(['ref_no'=>$model->ref_no])->latest('id')->first();
                if($expense)
                {
                  $expense->delete();
                }

               }
                   
              

               
              DB::commit();

              Session::flash("success_msg","Transaction Reversed Successfully");
              return redirect()->back();

               
             }
          return view('backend::tenants._my_reverse',$data);

     }

     public function getProSpaces($id)
     {
      $models=Space::where(['property_id'=>$id,'status'=>'Occupied'])->get();
       echo '<option>All</option>';
        foreach($models as $model)
        {
       echo '<option value="'.$model->id.'">'.$model->number.'</option>';
        }

     }
     public function editLoginDetails($id,Request $request)
     {
        $tenant=Tenant::find($id);
         if($tenant)
         {
          $user=$tenant->user;
           
            $user=User::find($tenant->user_id);
            $data['user']=$user;
           $data['model']=$tenant;
           $data['url']=url()->current();

            if($request->isMethod("post"))
            {
              $data=$request->all();
              
              $new_user=User::where(['email'=>$data['email']])->first();
              if(!$new_user)
              {
                $new_user=$user;
              }
               
              $new_user->email=$data['email'];
              $new_user->name=$data['name'];
              $new_user->password=$data['password'];
              $new_user->username=$data['username'];
              $new_user->save();
              $message="Dear ".$user->name.",your user login details for ".config('app.name')." are <p>Email :".$user->email."<br>Password :".$data['password'];
               Helper::sendEmail($user->email,$message,"User Login Details");

              Session::flash("success_msg","User Details Updated Successfully");
              return redirect()->back();

               
            }




           return view('backend::tenants.user',$data);



         }

     }

     public function getAdditionCharges($id)
     {


       if(Entrust::hasRole("Provider"))
       {
         $data['page_title']="Additional Charges";
         $data['tenant_id']=$id;
         return view('backend::tenants._chargelist',$data);
        }
       else
       {
        return view("forbidden");
       }


     }


     public function paymentHistory(){


       if(Entrust::hasRole("Provider"))
       {
         $data['page_title']="Tenant Transactions";
         $data['tenant_id']=(isset($_GET['tenant_id']))? $_GET['tenant_id'] :'All';
         return view('backend::tenants._paymentlist',$data);
        }
       else
       {
        return view("forbidden");
       }

     }

     public function getSpacePaymentHistory($space_id){

     
      $p_id=Auth::User()->getProvider->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
           ->join('spaces','tenants.space_id','=','spaces.id')
            ->join('properties','properties.id','=','spaces.property_id')
              ->join('profiles','profiles.user_id','=','users.id')
          ->where(['tenant_payments.space_id'=>$space_id])
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id']);
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



     public function getPaymentHistory($tenant_id){
         

          if($tenant_id=="All"){
            $p_id=Auth::User()->getProvider->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id'])
          ->where(['properties.provider_id'=>$p_id]);

          }else{
            $p_id=Auth::User()->getProvider->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id'])
          ->where(['properties.provider_id'=>$p_id,'tenant_id'=>$tenant_id]);
          }
        
         
           return Datatables::of($models)
           
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

     public function getTenantsCharges(){
       if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider") || Entrust::hasRole("Renter")){
        $data['page_title']="Tenant Charge Break Down";
        $data['tenant_id']=(isset($_GET['tenant_id']))? $_GET['tenant_id']:"All";
      return view('backend::tenants.charge_break',$data);

       }else{
        return view('forbidden');
       }
      
     }

     public function getTenantCharges($tenant_id){

       if($tenant_id=="All"){
            $p_id=Auth::User()->getProvider->id;
        $models=TenantCharges::join('tenants','tenants.id','=','tenant_charges.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenant_charges.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','tenant_charges.status as t_status','charge_name','effective_from','amount',
            'properties.id as pro_id'])
          ->where(['properties.provider_id'=>$p_id,'current_status'=>'Active']);

          }else{
            $p_id=Auth::User()->getProvider->id;
        $models=TenantCharges::join('tenants','tenants.id','=','tenant_charges.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
           ->join('spaces','tenants.space_id','=','spaces.id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenant_charges.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','tenant_charges.status as t_status','charge_name','effective_from','amount','properties.id as pro_id'])
          ->where(['properties.provider_id'=>$p_id,'tenant_id'=>$tenant_id,'current_status'=>'Active']);
          }
        
         
           return Datatables::of($models)
           ->editColumn('name',function($model){
            list($a,$b)=explode(' ', $model->name);
             $view_url=url('/backend/tenant/view/'.$model->tenant_id);
            $unit_url=url('/backend/space/view/'.$model->space_id);

             $name=ucwords($a)." " .ucfirst($b);
             return '<a href="'.$view_url.'" >'.$name.'</a>';

           })
           ->editColumn('number',function($model){
            
            $unit_url=url('/backend/space/view/'.$model->space_id);
             return '<a href="'.$unit_url.'" >'.$model->number.'</a>';

           })

            ->editColumn('title',function($model){
            
            $unit_url=url('/backend/property/view/'.$model->pro_id);
             return '<a href="'.$unit_url.'" >'.$model->title.'</a>';

           })

             ->editColumn('amount',function($model){
            
            
             return '<span style="color:green">'.$model->amount.'</span>';

           })




           ->make(true);

     }


     public function paidPayments(){
       if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider") ){
         $data['page_title']="Debit Payments";
         $data['tenant_id']=(isset($_GET['tenant_id']))? $_GET['tenant_id']:"All";
         return view('backend::tenants.debitlist',$data);



       }else{
        return view('forbidden');
       }
     }

     public function fetchDebits($tenant_id){


          if($tenant_id=="All"){
            $p_id=Auth::User()->getProvider->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')
          ->join('properties','properties.id','=','spaces.property_id')
           ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
          ->join('profiles','profiles.user_id','=','users.id')
         ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id','tenant_payments.created_at','sub_categories.name as sub_cat','tenant_payments.id as payment_id'])
          ->where('debit','>',0)
          ->where(['properties.provider_id'=>$p_id]);

          }else{
            $p_id=Auth::User()->getProvider->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')

          ->join('properties','properties.id','=','spaces.property_id')
           ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id','tenant_payments.created_at','sub_categories.name as sub_cat','tenant_payments.id as payment_id'])
          ->where('debit','>',0)
          ->where(['properties.provider_id'=>$p_id,'tenant_id'=>$tenant_id])
          ;
          }
        
         
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

     public function chargedPayments(){

        if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider") ){
         $data['page_title']="Charges Made on Tenants";
         $data['tenant_id']=(isset($_GET['tenant_id']))? $_GET['tenant_id']:"All";
         return view('backend::tenants.creditlist',$data);



       }else{
        return view('forbidden');
       }

     }


     public function addBulkPayments()
     {
       if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider") ){
         $data['page_title']="Perform Bulk Payment";
          $data['properties']=Property::where(['provider_id'=>auth::user()->getProvider->id])->get();
         
         return view('backend::tenants.create_bulk_payment',$data);



       }else{
        return view('forbidden');
       }

     }

     public function fetchCredits($tenant_id){

         if($tenant_id=="All"){
            $p_id=Auth::User()->getProvider->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id','tenant_payments.created_at','sub_categories.name as sub_cat','tenant_payments.id as payment_id'])
          ->where('credit','>',0)
          ->where(['properties.provider_id'=>$p_id]);

          }else{
            $p_id=Auth::User()->getProvider->id;
        $models=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')
          ->join('users','users.id','=','tenants.user_id')
          ->join('spaces','tenants.space_id','=','spaces.id')
          ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
          ->join('properties','properties.id','=','spaces.property_id')
          ->join('profiles','profiles.user_id','=','users.id')
          ->select(['tenants.id as id','tenants.entry_date','users.name','spaces.number','properties.title','tenants.current_status','expected_end_date','tenants.id as tenant_id','tenants.space_id','users.email','telephone','tenants.updated_at','tenants.created_at','users.id as user_id','balance','debit','credit','reference_number','transaction_date','invoice_id','tenant_payments.created_at','sub_categories.name as sub_cat','tenant_payments.id as payment_id'])
          ->where('credit','>',0)
          ->where(['properties.provider_id'=>$p_id,'tenant_id'=>$tenant_id])
          ;
          }
        
         
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

     public function createNewCategory(Request $request){
       $model=new Category();

         if($request->isMethod('post')){
          $data=$request->all();
          $model->name=$data['name'];
          $model->scope="local";
          $model->provider_id=Auth::User()->getProvider->id;
          $model->save();
          Session::flash("success_msg","Your Category Has Been Added Successfully");
          return redirect()->back();



         }
         $data['model']=$model;
         $data['url']=url("backend/category/add");

        return view('backend::tenants._addcat',$data);

    
     }


     public function getTenantReports($id)
     {

       $tenants=Tenant::join('spaces','spaces.id','=','tenants.space_id')->where(['property_id'=>$id])
       ->join('users','users.id','=','tenants.user_id')
       ->select('tenants.id','entry_date','expected_end_date','current_status','number','users.name')
       ->get();
       $property=Property::find($id);
        if(!$property){
          return view("not_found");
        }
        TenantPdf::generate($tenants,$property);

     }

     public function emailInvoice($id,Request $request)
     {
      $model=Invoice::find($id);
        if($model)
        {
          $data['url']=url()->current();
          $data['model']=$model;
           if($request->isMethod("post"))
           {
            $data=$request->all();
            $pdfPath=InvoicePDf::genareEmailPDF($model,$data['email']);
            Session::flash("success_msg","Invoice has Been Emailed to ".$data['email']." successfully");
            return redirect()->back();

             
           }



          return view('backend::tenants._emailInvoice',$data);

        }else{
          return "Resource Not Found";
        }

     }


     public  function RejectSubmittedPayments($id,Request $request)
     {
       
        if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent"))
          {
            $model=SubmittedPayment::find($id);
            $data['model']=$model;
            $data['url']=url()->current();
             if($request->isMethod("post"))
             {
              $data=$request->all();
               try{

                $model->approve_status="Rejected";
                $model->reason=$data['reason'];
                $model->save();
                 
                          $messages="Dear ".$model->user->name." your payment with Ref No ".$model->ref_no." has been rejected because of the following reason ".$data['reason'];
                           $phone=str_replace('-','',$model->user->profile->telephone);
                          $subject="Rejected Payment #".$model->ref_no;
                           $email=$model->user->email;

                          Helper::sendSms($phone,$messages);
                          Helper::sendEmail($email,$messages,$subject);
                           $message=new Messaging();
                           $message->receiver_id=$model->user->id;
                           $message->sender_id=Auth::User()->id;
                           $message->subject="Rejected Payment #".$model->ref_no;
                           $message->content=$messages;
                           $message->flag="notification";
                           $message->key=strtoupper(str_random(8));
                           $message->save();
                           Session::flash('success_msg',"Payment Rejected Successfully and Tenant notified via email and phone");
                           return redirect()->back();
                }catch(\Exception $e)
               {
                 Helper::sendEmailToSupport($e);
                 Session::flash('danger_msg',"System Error Occured.System Admin notified on the error");
                  return redirect()->back();
               }
              


             }




              return view('tenants::tenants._reject',$data);

          

          }else{
            return 'access Denied.';
          }

     }

     public function ApproveSubmittedPayments($id)
     {
      $model=SubmittedPayment::where(['id'=>$id,'provider_id'=>auth::user()->getProvider->id])->first();
        if($model)
        {
           
           try{
            DB::beginTransaction();
          $tenant=Tenant::where(['space_id'=>$model->space_id,'current_status'=>'Active','user_id'=>$model->user_id])->first();
             if($tenant)
              {

                 $payment_data=array('provider_id'=>$model->provider_id,
                        'space_id'=>$model->space_id,
                        'invoice_id'=>$model->invoice_id,
                        'reference_number'=>strtoupper($model->ref_no),
                        'credit'=>0,
                        'debit'=>doubleval($model->amount_paid),
                        'description'=>"Peing Payment for Invoice Number".$model->invoice->number,
                        'payment_mode'=>$model->method,
                        'type'=>"Rent",
                        'transaction_date'=>date('Y-m-d',strtotime($model->transaction_date)),
                        'system_transaction_number'=>str_random(8),
                        'year'=>date('Y'),
                        'month'=>date('M'),
                        'fee_charges'=>0,
                        'tenant_id'=>$tenant->id,
                        );
                 $payment=$this->createnewPayment($payment_data,$model);
                   if($payment)
                   {
                    $model->approve_status="Approved";
                    $model->save();
                    DB::commit();
                    Session::flash("success_msg","Payment Approved successfully");
                    return redirect()->back();
                   }else{
                    Session::flash("success_msg","Payment Approved successfully");
                    return redirect()->back();

                   }
               


              }else{
                  Session::flash("danger_msg","Tenant Details not found.");
          return redirect()->back();
              }
              


           }catch(\Exception $e)
           {
            dd($e);
           }


        }else{
          Session::flash("danger_msg","Resource you are looking for is not found on this server.");
          return redirect()->back();
        }

     }

     public function createnewPayment($payment_data,$submitted_payment)
     {
     
       $model=TenantPayment::create($payment_data);
      if($model){

        $invoice=$model->invoice;
        $invoice->status="Paid";
        $invoice->save();
      
      }
      $user=$submitted_payment->user;
       $message=$body="Dear ".$user->name." we have receipt your payment  of ".$model->debit." ,for invoice ".$submitted_payment->invoice->invoice_number.". Your Receipt has been emailed to your for future reference";
       $message=new Messaging();
       $message->receiver_id=$user->id;
       $message->sender_id=Auth::User()->id;
       $message->subject="Payment Acknowledgement";
       $message->content=$body;
       $message->flag="message";
       $message->key=strtoupper(str_random(8));
       $message->save();

          return $model;
     }

     public function emptyCurrentExpenses($id)
     {
      $models=PropertyExpense::where(['property_id'=>$id,'month'=>date('M'),'year'=>date('Y')])->get();
         foreach($models as $model)
          {
            $transaction=PropertyTransaction::where(['ref_no'=>$model->ref_no])->first();
              if($transaction)
              {
                $transaction->delete();
              }
              $model->delete();
          }
        return true;

     }


     public function processExpenses($id,$data)
     {
       $this->emptyCurrentExpenses($id);

        if(isset($data['expenseName']) && isset($data['expenseAmount'])):
        $names=$data['expenseName'];
        $dates=$data['expensedate'];
        $amounts=$data['expenseAmount'];
         foreach($names as $key=>$value)
         {
             if(strlen($names[$key])>0 && strlen($amounts[$key])>0 && $amounts[$key]>0 )
             {
                 DB::beginTransaction();
                 $expense=new PropertyExpense();
                 $expense->property_id=$id;
                 $expense->provider_id=Auth::User()->getProvider->id;
                 $expense->expense_name=ucfirst($names[$key]);
                 $expense->amount=$amounts[$key];
                 $expense->expense_date=(strlen($dates[$key]))?date('Y-m-d',strtotime($dates[$key])):date('Y-m-d');
                 $expense->month=date('M',strtotime($expense->expense_date));
                 $expense->year=date('Y',strtotime($expense->expense_date));
                 $expense->ref_no=str_random(7);
                 $expense->save();


              $transaction=new PropertyTransaction();
              $transaction->provider_id=$expense->provider_id;
              $transaction->property_id=$id;
              $transaction->credit=$amounts[$key];
               $transaction->tran_date=date('Y-m-d',strtotime($expense->expense_date));
              $transaction->debit=0;
              $transaction->total_amount=0;
              $transaction->year=date('Y',strtotime($expense->expense_date));
              $transaction->month=date('M',strtotime( $expense->expense_date));
              $transaction->type="Debit";
              $transaction->method=null;
              $transaction->landloard_balance=0;
              $transaction->Description="Expense";
              $transaction->other_details=$expense->expense_name;
              $transaction->ref_no=$expense->ref_no;
              $account=PropertyAccount::where(['provider_id'=>$expense->provider_id,'property_id'=>$id,'account_type'=>'Credit'])->first();
               if($account)
               {
                $transaction->account_id=$account->id;
               }
              
              $transaction->save();
               DB::commit();




                
             }
         }
            endif;
         return true;
     }


     public function getPExpenseList()
     {

        if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent")){
          $data['page_title']="Expense List";
         

        
          return view('backend::expenses.index',$data);



         }else{
          return view("forbidden");
         }
         

     }


     public function fetchExpenseList()
     {
      $p_id=Auth::User()->getProvider->id;
      $models=PropertyExpense::join('properties','properties.id','=','property_expenses.property_id')
            ->where(['property_expenses.provider_id'=>$p_id])
            ->select('properties.title','property_expenses.id','property_expenses.amount','expense_name','expense_date')
            ->orderBy('property_expenses.created_at','desc');

        return Datatables::of($models)->make(true);
     }



     public function fetchAllCreditPayments($id,Request $request)
     {
      $data=$request->all();
       $start_date=date('Y-m-d 00:00:01',strtotime($data['start_date']));
       $end_date=date('Y-m-d 23:59:59',strtotime($data['end_date']));
       $models=PropertyTransaction::where(['property_id'=>$id])
             ->where(['is_reserved'=>0,'type'=>'Debit'])
               ->whereBetween('created_at',array($start_date,$end_date))
               ->orderBy('id','desc');

      return Datatables::of($models)
      ->addColumn('action',function($model){
       
       $reverse_url=url('/backend/Transaction/Reverse/'.$model->id);
          return '<button  data-url="'.$reverse_url.'" class="btn btn-danger btn-sm reject-modal" data-title="Reverse Transaction ">Reverse</button>';

      })
      ->make(true);

     }





}
