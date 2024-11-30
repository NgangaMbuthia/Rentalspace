<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Entrust;
use Modules\Backend\Entities\Agent;
use Modules\Backend\Entities\Property;
use Modules\Backend\Entities\Amentity;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\Space;
use Carbon;
use App\ProviderModule;
use Modules\Backend\Entities\Invoice;
use App\Helpers\TestClass;
use App\User;
use Modules\Gate\Entities\GateVisitor;
use Modules\Gate\Entities\GateGaurd;
use Modules\ServiceProviders\Entities\JobRequest;
use Modules\ServiceProviders\Http\Middleware\ApprovalMiddle;
use Modules\Gate\Entities\Incident;
use Modules\Tenants\Entities\RepairRequest;
use Modules\Backend\Entities\VaccationRequest;
use Modules\Backend\Entities\Booking;
use Modules\Hotels\Entities\Hotel;
use Auth;
use Modules\Hotels\Entities\RoomType;
use Modules\Hotels\Entities\BedType;
use Modules\Hotels\Entities\SupplierAmenty;
use Modules\Hotels\Entities\HotelRoom;
use App\Helpers\InvoiceSender;
use  App\Helpers\Helper;
use Session;
use App\Messaging;
use App\Http\Middleware\AccountSetUp;
use Modules\Backend\Entities\TenantSummary;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AccountSetUp::class);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      TestClass::AddNewDevice(7);



         if(Entrust::hasRole("Admin")){
            $data['page_title']="Admin Portal";
            $data['properties_count']=Property::count();
            $data['agents_count']=Agent::count();
            $data['property']=new Property();
            $data['agent']=new Agent();
            $data['properties']=Property::orderBy('created_at','desc')->take(5)->get();
            return view('home',$data);
        }elseif (Entrust::hasRole("Provider")) {

           
          
            $data['properties_count']=Property::where(['provider_id'=>\Auth::User()->getprovider->id])->count();
            $data['page_title']="Provider Portal";
            $data['spaces']=$this->getTotalSpaces();
             $data['fee_spaces']=$this->getTotalSpaces("Free");
              $data['occupied_spaces']=$this->getTotalSpaces("Occupied");
              $data['properties']=Property::where(['provider_id'=>\Auth::User()->getprovider->id])->get();
          $data['years']=$this->getYears();
          $data['payment_years']=TenantPayment::where('year','>',0)->select('year')->distinct()->get();

          $data['tenants_count']=Tenant::where(['provider_id'=>\Auth::User()->getprovider->id])->count();
          $data['model']=new  TenantPayment();
          $data['repair_request_count']=RepairRequest::join('spaces','spaces.id','=','repair_requests.space_id')->join('properties','properties.id','=','spaces.property_id')
            ->where(['properties.provider_id'=>\Auth::User()->getprovider->id])
           ->count();
           $data['vacattion_requests_count']=VaccationRequest::join('tenants','tenants.id','=','vaccation_notifications.tenant_id')->where(['tenants.provider_id'=>\Auth::User()->getprovider->id])->count();

           $data['bookings']=Booking::join('properties','properties.id','=','bookings.property_id')->where(['properties.provider_id'=>\Auth::User()->getprovider->id])->count();
           $data['summary']=new TenantSummary();
           
          

           return view('provider_dash',$data);
        }
        else if(Entrust::hasRole("Renter")){


           $data['page_title']="Tenant Portal";
           $tenant_id=\Auth::user()->tenant->id;
           $user_id=\Auth::user()->id;
           $data['active_space']=Tenant::where(['user_id'=>$user_id,'current_status'=>'Active'])->count();
           $data['pending_invoices']=Invoice::where(['issued_to'=>$user_id,'status'=>'Pending'])->count();
           $debit=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')->where(['user_id'=>$user_id])->sum('debit');
           $credit=TenantPayment::join('tenants','tenants.id','=','tenant_payments.tenant_id')->where(['user_id'=>$user_id])->sum('credit');
           

           $data['balance']=$credit-$debit;
           return view('dashboards.tenant_dash',$data);

        }
          else if(Entrust::hasRole("Guard")){
           $data['page_title']="Security Team  Portal";
           $id=$guard_id=\Auth::user()->guardDetails->id;
           $guard=GateGaurd::find($id);
           $property_id=$guard->property_id;
           $provider_id=$guard->provider_id;
           $data['visitor_count']=GateVisitor::where(['status'=>'Active','property_id'=>$property_id,'action1'=>'INSIDE'])->count();
           $data['current_stats']=GateVisitor::where(['property_id'=>$property_id,'action1'=>'INSIDE'])->whereMonth('created_at',date('m'))->count();
           $data['reported_incidents']=Incident::where('property_id',$property_id)->count();
            
           return view('dashboards.security_dash',$data);
           }

     else if(Entrust::can("view-supplier-dashboard")){
     $data['page_title']="Backend Portal";
     $data['years']=$this->getYears();
     $data['hotel_count']=Hotel::where(['supplier_id'=>auth::user()->supplier->id])->count();
     $data['bed_type_count']=BedType::where(['supplier_id'=>auth::user()->supplier->id])->count();
     $data['room_name_count']=RoomType::where(['supplier_id'=>auth::user()->supplier->id])->count();
     $data['amentities_count']=SupplierAmenty::where(['supplier_id'=>auth::user()->supplier->id])->count();
     $data['rooms_count']=HotelRoom::where(['supplier_id'=>auth::user()->supplier->id])->count();
    $data['empty_rooms_count']=HotelRoom::where(['supplier_id'=>auth::user()->supplier->id,'current_status'=>'Empty'])->count();

    $data['booked_rooms_count']=HotelRoom::where(['supplier_id'=>auth::user()->supplier->id,'current_status'=>'Booked'])->count();
     $data['occupied_rooms_count']=HotelRoom::where(['supplier_id'=>auth::user()->supplier->id,'current_status'=>'Occupied'])->count();

     
     $months=array();
     $months[]=date('F, Y');
for ($i = 1; $i < 6; $i++) {
  $months[]=date('F, Y', strtotime("-$i month"));
}
  $data['months']=$months;
  $data['hotels']=Hotel::where(['supplier_id'=>auth::user()->supplier->id])->get();






    return view('dashboards.supplier_dash',$data);

     }









           else if(Entrust::hasRole("serviceProvider"))
           {
              if(\Auth::user()->profile->status=="Incomplete"){
                return redirect('/serviceproviders/profile/update');


              }
                $data['page_title']="Service Provider Portal";
             $data['active_balance']=\Auth::user()->sprovider->current_balance;
             $data['total_earnings']=0;
             $data['total_works']=0;

             $data['job_requests']=JobRequest::where(['status'=>'Pending','provider_id'=>\Auth::user()->sprovider->id])->count();
             
             return view('dashboards.service_providers',$data);
             
           }
           elseif(Entrust::hasRole("Hotel")){
            $data['page_title']="Hotel Portal";
            $hotel=Hotel::where(['supplier_id'=>Auth::user()->supplier->id])->first();
             if($hotel){
              $status=$hotel->hotel_profile;
               if($status=="Incomplete"){
                return redirect('/hotels/hotel/profile/'.$hotel->id);
               }else{
                return view('dashboards.home',$data);
               }




             }






             
           


           }



        else{
           $data['page_title']="Agents Portal";
           return view('dashboards.home',$data);

        }
        
    }


   
    public function getTotalSpaces($status="all")
    {
         if($status=="all"){
            $spaces=Space::join('properties','spaces.property_id','=','properties.id')
                ->where(['provider_id'=>\Auth::User()->getprovider->id])->count();

         }
         else{
            $spaces=Space::join('properties','spaces.property_id','=','properties.id')
                ->where(['provider_id'=>\Auth::User()->getprovider->id])
                ->where(['spaces.status'=>$status])
                ->count();
         }
        
                return $spaces;
    }


  public function getBalance($unit,$param,$whereMonth=false,$year=null){

       if($year==null)
       {
         $year=date('Y');
       }
   
     if($whereMonth!=false){


        $sum_credit=TenantPayment::$param('created_at',$unit)
              ->where(['provider_id'=>\Auth::User()->getprovider->id])
              //->where(['type'=>'Rent'])
             ->whereYear('created_at',$year)
              ->sum('debit');

     }
     else{
        $sum_credit=TenantPayment::$param('created_at',$unit)
              ->where(['provider_id'=>\Auth::User()->getprovider->id])
             ->whereYear('created_at',$year)
              ->sum('debit');

     }

    
    return $sum_credit;
  }
   public function sendPaymentReminder(){
     dd("ghdghdgd");
   }

    public function paymentstatistics($year=null){
              if($year==null)
               {
                $year=date('Y');
               }
                
        $test_months=$this->testMonth($year);

       
           if($test_months!=false)
           {


            $months=$test_months;
             
             $data=array();

             foreach($months as $month)
             {
               if($year==null)
               {
                $year=date('Y');
               }
               
                


                $x=$year.'-'.$month.'-30';

                $y=$this->getBalance($month,"whereMonth",true,$year);
                $data[]=array('x'=>date('M',strtotime($x)),'y'=>$y);
             }

             return json_encode($data);
           }
           else{

            $days=$this->getDays();

             $data=array();

             foreach($days as $day)
             {
               if($year==null)
               {
                $year=date('Y');
               }
                $month=date('m');
                $x=$year.'-'.$month.'-'.$day;
                $y=$this->getBalance($day,"whereDay",false,$year);
                $data[]=array('x'=>date('dS-M-Y',strtotime($x)),'y'=>$y);
             }

             return json_encode($data);

           }

    }

    public function  testMonth($year)
    {
     
        $monthpaid=TenantPayment::where(['provider_id'=>\Auth::User()->getprovider->id])
             ->whereYear('created_at',$year)
              ->orderBy('created_at','asc')
              ->get()
              ->groupBy(function($date) {
              return \Carbon::parse($date->created_at)->format('m'); 
         });

        $months=array();
         if(sizeof($monthpaid)<2){
            return false;
         }
         else{
            foreach($monthpaid as $key){

            foreach($key as $model){
           if(!in_array($model->created_at->month, $months)){
                array_push($months,$model->created_at->month); 
               }
              }
            }

            return $months;

         }
        
}

 function  getMonthWithPayments(){
  $id=\Auth::User()->getprovider->id;
  $months=TenantPayment::where(['provider_id'=>\Auth::User()->getprovider->id])->latest()->first();
    if($months){
      return date('m',strtotime($months->created_at));
    }else{
      return date('m');
    }

 }

 public function getDailyPayment()
 {
   $id=\Auth::User()->getprovider->id;
  $days=TenantPayment::where(['provider_id'=>$id])->where('debit','>',0)->select('transaction_date')->distinct()->orderBy('transaction_date')->get();
   $data=array();
    foreach($days as $day)
    {
      $date=$day->transaction_date;

       $payment=TenantPayment::
                  where(['transaction_date'=>$date])
                  ->where(['provider_id'=>$id])
                ->where('debit','>',0)->sum('debit');
        $data[]=array($date,$payment);
    }

     return $data;

 }

public function getDays(){
    $year=date('Y');
    $month=$this->getMonthWithPayments();

        $monthpaid=TenantPayment::where(['provider_id'=>\Auth::User()->getprovider->id])
             ->whereYear('created_at',$year)
             ->whereMonth('created_at',$month)
              ->orderBy('created_at','asc')
              ->get()
              ->groupBy(function($date) {
              return \Carbon::parse($date->created_at)->format('d'); 
         });

        $months=array();
         
         if(sizeof($monthpaid)<1){
            return false;
         }
         else{
            foreach($monthpaid as $key){

            foreach($key as $model){
           if(!in_array($model->created_at->day, $months)){
                array_push($months,$model->created_at->day); 
               }
              }
            }

            return $months;

         }

}


public function paymentMethosStats()
{
  $month_array=array('Jan'=>1,'Feb'=>2,'Mar'=>3,'Apri'=>4,'May'=>5,'Jun'=>6,
                'Jul'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12);

     $data=array();
    foreach($month_array as $key=>$value){
      $bankslip=$this->getMethodSum($value,"Bankslip");
      $cheque=$this->getMethodSum($value,"Cheque");
      $cash=$this->getMethodSum($value,"Cash");
      $mpesa=$this->getMethodSum($value,"Mpesa");
      $paybal=$this->getMethodSum($value,"Paybal");
      $others=$this->getMethodSum($value,"Others");

      $data[]=array('x'=>$key,'y'=>$bankslip,'z'=>$cheque,'a'=>$cash,'k'=>$mpesa,'n'=>$paybal,
                  'p'=>$others
                 );

    }
    return json_encode($data);
}

public function getMethodSum($month,$method){
  $year=date("Y");
 $amount=TenantPayment::where(['provider_id'=>\Auth::User()->getprovider->id])
              ->whereMonth('created_at',$month)
              ->whereYear('created_at',$year)
              ->where(['payment_mode'=>$method])
              ->sum('debit');
    return $amount;

}

public function getYears()
{
  $year=date('Y');
  $lowerYear=$year-4;
  $data=array();

   for($i=$year;$i>=$lowerYear;$i--){
    $data[]=$i;
   }
   return $data;
}


public function getInvoivesStatitsics(){
  $id=\Auth::User()->getProvider->id;

  $status_array=array("Paid","Pending");
   $enterprise_count=TenantSummary::count();
            if($enterprise_count>0){
              
              
                 $phparray=[];
  
                    foreach ($status_array as $key) {
                        if($key=="Paid")
                        {

                          $amount=TenantSummary::where(['provider_id'=>$id,'month'=>date('M'),'year'=>date('Y')])->sum('amount_paid');
                        $sum=$amount;
                      
                      
                        }else{
                           $amount=TenantSummary::where(['provider_id'=>$id,'month'=>date('M'),'year'=>date('Y')])->sum('outstanding_balance');
                           $sum=$amount;
                      
                      

                        }
                     
                       $phparray[]=["status" =>$key,
                                    "sum"=>abs($sum),
                                     ];

                          }  
                         $json =json_encode($phparray,true);
                      $jsonArray2=array();
                       $ar=array();
                       foreach ($phparray as $key2 => $value) {
                        $d=(int)$value['sum'];
                           $loop=array($value['status'],$d);
                           //print_r($loop);
                           $jsonArray2[]=$loop;
                        //$jsonArray2[]=$loop;
                         
                       
                      }
                      return $jsonArray2;

            }else{
               return  "No Data To Show";
            }









}

public function getPaymentStaticstsic()
{
  $id=\Auth::User()->getProvider->id;
  $lists=array("Invoiced","Paid","Balance");
  $months=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

     $big_array=array();
      foreach($lists as $list)
      {
           if($list=="Invoiced")
           { 
             $data=array();
             
               foreach($months as $month)
               {
                  $data[]=TenantSummary::where(['month'=>$month,'year'=>date('Y'),
                    'provider_id'=>$id])->sum('invoice_amount');
               }
              $small_array=array("name"=>"Invoiced","data"=>$data);
              $big_array[]=$small_array;

           }else if($list=="Paid")
           {
            $data=array();
             
               foreach($months as $month)
               {
                  $data[]=TenantSummary::where(['month'=>$month,'year'=>date('Y'), 'provider_id'=>$id])->sum('amount_paid');
               }
              $small_array=array("name"=>"Paid","data"=>$data);
              $big_array[]=$small_array;

           }else{
            $data=array();
             
               foreach($months as $month)
               {
                  $data[]=abs(TenantSummary::where(['month'=>$month,'year'=>date('Y'), 'provider_id'=>$id])->sum('outstanding_balance'));
               }
              $small_array=array("name"=>"Balance","data"=>$data);
              $big_array[]=$small_array;

           }




      }

       return $big_array;


}

public function settings(Request $request){
   if(Entrust::hasRole("Provider")){
    $data['page_title']="Account Details";
    $user=\Auth::user();
     $data['user']=$user;
     $model=Agent::where(['user_id'=>$user->id])->first();

    if($request->isMethod('post')){

       $data=$request->all();
        try{
          $model->name=$data['provider_name'];
       $model->email=$data['email'];
       $model->telephone=$data['phone'];
       $model->postal_address=$data['postal_address'];
       $model->street=$data['street'];
       $model->town=$data['town'];
       $model->building=ucfirst($data['building']);
       $model->website=$data['website'];
       $model->save();
       $message=new Messaging();
       $message->receiver_id=Auth::User()->id;
       $message->sender_id=Auth::User()->id;
       $message->subject="Account Details Updated";
       $message->content="Your Account details have been updated Successfully";
       $message->flag="notification";
       $message->key=strtoupper(str_random(8));
       $message->save();
       Helper::sendEmail(auth::user()->email,"Your Account details have been updated Successfully","Provider Details Updated Success");


        }catch(\Exception $e)
         {
          Helper::sendEmailToSupport($e);
          Session::flash("danger_msg","Error occured while processing your information,System Developer notified");
         }
        
       
       return redirect('/account/settings');


    }

 $provider_id=\Auth::User()->getProvider->id;
     $modules=ProviderModule::where(['type'=>'Provider','type_id'=>$provider_id])->get();
     $data['modules']=$modules;
     $data['model']=$model;

     return view('dashboards.tenant_settings',$data);



   }else{
    return view("forbidden");
   }


}


public function sendInvoices()
{
  

  InvoiceSender::send();
}


public function  getOpenningBalance()
{
   $balance=Helper::getAccountBalances("0020167798225","KE","2019-03-09");
   $statement=Helper::getMinStatement("KE","0020167798225");
    dd($statement);
}





}
