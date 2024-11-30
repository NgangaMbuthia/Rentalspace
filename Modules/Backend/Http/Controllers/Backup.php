<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller ;
use Entrust;
use App\User;
use DB;
use Modules\UserManagement\Entities\Role;
use Modules\UserManagement\Entities\Profile;
use Session;
use Modules\Backend\Entities\Agent;
use Modules\Backend\Entities\Property;
use Modules\Backend\Entities\Amentity;
use Modules\Backend\Entities\Space;
use Auth;
use Modules\Backend\Entities\PropertyImage;
use Modules\Backend\Entities\SpaceImage;
use Modules\Backend\Entities\PropertyUtility;
use Modules\Backend\Entities\SubCategory;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\Booking;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\SystemModule;
use App\ProviderModule;
use App\Messaging;
use App\Helpers\Helper;
use Modules\Backend\Entities\Repair;
use Modules\Backend\Entities\TenantCharges;
use Modules\Backend\Entities\Upload;
use Modules\Backend\Entities\TenantPayment as Payment;
use Modules\Backend\Entities\ProviderAccount;
use Modules\Backend\Entities\PropertyAccount;
use Modules\Backend\Entities\PropertyExpense;
use Modules\Backend\Entities\PropertyTransaction;
use Modules\Backend\Entities\ProviderTransaction;
use Modules\Backend\Entities\TenantSummary;
use Modules\Backend\Entities\SpaceTemplate;
use Modules\Backend\Reports\MonthlySummary;
use App\Http\Middleware\AccountSetUp;
class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public $provider_id;

      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AccountSetUp::class);

    }

    public function getLandloadPayments()
    {
      $data['page_title']="Landloads Payment List";
      return view('backend::provider.payment_list',$data);

    }

    public function getMinStatement($id,Request $request)
    {
      $data=$request->all();
       $start_date=date('Y-m-d 00:00:01',strtotime($data['start_date']));
       $end_date=date('Y-m-d 23:59:59',strtotime($data['end_date']));
       $models=PropertyTransaction::where(['property_id'=>$id])
               ->whereBetween('created_at',array($start_date,$end_date))
               ->orderBy('tran_date','desc');

      return Datatables::of($models)->make(true);
    }


    public function ImportSpaces(Request $request)
    {
      if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent")){
            $data['page_title']="Import Spaces";
            $data['url']=url()->current();
              if($request->isMethod("post"))
              {
                 $data=$request->all();
                 try{
                     $file = $request->file('file');
                $filePath = $file->getPathName();
                 $array=[]; 
                 ;
                    \Excel::load($filePath, function($reader) {
          $results = $reader->get()->toArray();
            $numbers=array();
             foreach($results as $result)
             {\DB::beginTransaction();
               
                
                $property=Property::where('title','like','%'.$result['property'].'%')->first();
                 if($property)
                 {
                  
                   $model=Space::where(['property_id'=>$property->id,'number'=>$result['unit_name']])->first();
                     if(!$model)
                     {
                      $model=new Space();
                     }
                    
                  $model->template_id=null;
                    $model->property_id=$property->id;
                    $model->unit_price=doubleval($result['rent']);
                    $model->currency="KES";
                    $model->title=$result['unit_name'];
                    $model->number=$result['unit_name'];
                    $status=$result['status'];
                    $model->status=(preg_match('/occupied/i', $status))?"Occupied":"Empty";
                    
                    $model->save();
                      if($model->status=="Occupied")
                      {

                         $user=$this->createTenantUser($result);
                         $tenant=new Tenant();
                         $tenant->user_id=$user->id;
                         $tenant->provider_id=$property->provider_id;
                         $tenant->space_id=$model->id;
                         $tenant->status="Occupied";
                         $tenant->current_status="Active";
                         $tenant->monthly_fee=$result['rent'];
                         $tenant->stay_duration=date('Y-m-d');
                         $tenant->entry_date=$tenant->stay_duration;
                         $tenant->is_emailable=0;
                         $tenant->save();

                         $tenant_charges=array("Rent"=>$tenant->monthly_fee,"Deposit"=>$tenant->monthly_fee);


                         foreach($tenant_charges as $key=>$value)
                          {$mod=new TenantCharges();
                            $mod->tenant_id=$tenant->id;
                            $mod->charge_name=$key;
                            $mod->amount= $value;
                            $mod->effective_from=date('Y-m-d');
                            $mod->status="Active";
                            
                            $mod->save();

                          }
                        }




                 }

                 

              \DB::commit();
                

             };
              });

                    Session::flash("success_msg","Property Spaces Successfully");
                    return redirect('/backend/property/index');


                 }catch(\Exception $e)
                 {
                  Session::flash("danger_msg","Error Occured while processing your request.System Admin Notified");
                  Helper::sendEmailToSupport($e);
                  return redirect()->back();
                 }


                 


              }




             
              return view('backend::import_properties',$data);


        }else{
            return view("forbidden");
        }
    }


    public function createTenantUser($result)
    {
       $user=new User();
       $faker = \Faker\Factory::create();


       $user->name=$faker->name;
       $user->email=$faker->email;
       $user->username=$faker->username;
       $user->password="Pass123";
       $user->verification_code=str_random(6);
       $user->status="Blocked";
       $user->save();
       $profile=new Profile();
       $profile->user_id=$user->id;

       $profile->timezone='Africa/Nairobi';
       $profile->save();
       $role=Helper::FindRoleDetails("name","Renter");
       $user->roles()->attach($role->id);
       return $user;

    }

    public function getLandloadStatement()
    {
       $data['page_title']="Generate Payment Statement";
       $p_id=\Auth::User()->getprovider->id;
       $data['properties']=Property::where(['provider_id'=>$p_id])->get();
      return view('backend::provider.statement',$data);

    }

    public function getStementDetails(Request $request)
    {
       $data=$request->all();
        $property=Property::find($data['id']);
        $data['property']=$property;
          return view('backend::provider._statement',$data);

    }


    public function PayLoadLoads(Request $request)
    {
    $p_id=\Auth::User()->getprovider->id;
       $data['properties']=Property::where(['provider_id'=>$p_id])->get();
        $data['url']=url()->current();
        $data['model']=new PropertyTransaction();
          if($request->isMethod("post"))
          {
             $data=$request->all();
             DB::beginTransaction();
               $transaction=new PropertyTransaction();
              $transaction->provider_id=$p_id;
              $transaction->property_id=$data['property_id'];
              $transaction->credit=$data['amount'];
               $transaction->tran_date=date('Y-m-d',strtotime($data['date']));
              $transaction->debit=0;
              $transaction->ref_no=strtoupper(str_random(6));
              $transaction->year=date('Y',strtotime($data['date']));
              $transaction->month=date('M',strtotime($data['date']));
              $transaction->type="Debit";
              $transaction->method=$data['method'];
              $transaction->Description=$data['payment_type'];
              $transaction->ref_no=(isset($data['ref_no']))?$data['ref_no']:strtoupper(str_random(6));
              $account=PropertyAccount::where(['provider_id'=>$p_id,'property_id'=>$data['property_id'],'account_type'=>'Credit'])->first();
              $transaction->account_id=$account->id;
              
              $transaction->save();
              DB::commit();
               Session::flash("success_msg","Transaction Saved Successfully");
               return redirect()->back();
          }



        return view('backend::provider.transaction',$data);

    }


    public function fetchLandloadPayments()
    {
      $p_id=\Auth::User()->getprovider->id;
      $models=PropertyTransaction::where(['property_transactions.type'=>"Debit",'property_transactions.provider_id'=>$p_id])
              ->join('properties','properties.id','=','property_transactions.property_id')
              ->select('title','tran_date','credit','method','ref_no','property_transactions.Description')
              ->orderBy('tran_date','desc');

      return Datatables::of($models)->make(true);
    }


    public function adminView(){
      if(Entrust::hasRole("Admin")){
        $data['page_title']="Properties Listed In The System";

        return view('backend::provider.property_list',$data);
         }else{
        Session::flash("danger_msg","Access Denied");
        return view("forbidden");
      }
    }

    public function fetchAgents()
    {
      $models=Agent::orderBy('created_at','desc');

      return Datatables::of($models)
      ->addColumn('action',function($model){
        $remote_url=url('/backend/provider/remoteLogin/'.$model->user_id);
        $password_url=url('/backend/Provider/PasswordReset/'.$model->user_id);
         if($model->status=="Pending")
         {
          $approve_url=url('/backend/provider/approve/'.$model->id);
           $reject_url=url('/backend/provider/reject/'.$model->id);
          return '<div class="dropdown">
                  <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Actions
                   <span class="caret"></span></button>
                   <ul class="dropdown-menu">
                    <li><a href="'.$approve_url.'">Approve</a></li>
                    <li><a data-title="Reject Approval"   class="reject-modal"  data-url="'.$reject_url.'">Reject</a></li>
                     <li><a data-title="Password Reset"   class="reject-modal"  data-url="'.$password_url.'">Reset Password</a></li>

                     <li><a href="'.$remote_url.'">Remote LogIn</a></li>
                   </ul>
                   </div>';
          }
          else  if($model->status=="Rejected")
         {
          $approve_url=url('/backend/provider/approve/'.$model->id);
          
          return '<div class="dropdown">
                  <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Actions
                   <span class="caret"></span></button>
                   <ul class="dropdown-menu">
                    <li><a href="'.$approve_url.'">Approve</a></li>
                     <li><a data-title="Password Reset"   class="reject-modal"  data-url="'.$password_url.'">Reset Password</a></li>
                       <li><a href="'.$remote_url.'">Remote LogIn</a></li>
                   
                   </ul>
                   </div>';
          }
          else if($model->status=="Approved"){
             $reject_url=url('/backend/provider/suspend/'.$model->id);
            return '<div class="dropdown">
                  <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Actions
                   <span class="caret"></span></button>
                   <ul class="dropdown-menu">
                    <li><a data-title="Suspend Account"   class="reject-modal"  data-url="'.$reject_url.'">Suspend</a></li>
                     <li><a data-title="Password Reset"   class="reject-modal"  data-url="'.$password_url.'">Reset Password</a></li>

                    <li><a href="'.$remote_url.'">Remote LogIn</a></li>
                   
                   </ul>
                   </div>';

          }else{

               $approve_url=url('/backend/provider/approve/'.$model->id);
            return '<div class="dropdown">
                  <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Actions
                   <span class="caret"></span></button>
                   <ul class="dropdown-menu">
                    <li><a   href="'.$approve_url.'">Re-Approve</a></li>
                     <li><a data-title="Password Reset"   class="reject-modal"  data-url="'.$password_url.'">Reset Password</a></li>
                    <li><a href="'.$remote_url.'">Remote LogIn</a></li>
                   
                   </ul>
                   </div>';



          }
          

      })
      ->make(true);
    }

    public function ApproveProvider($id)
    {
       if(Entrust::hasRole("Admin"))
        {
          $model=Agent::find($id);
           if(!$model)
           {
            return view("not_found");
           }
           $model->auth_key=str_random(64);
           $model->status="Approved";
           $model->save();
           $this->notifyProvider($model);
            Session::flash("success_msg","Provider Account Approved Successfully");
            return redirect()->back();

        }else{
          return view("forbidden");
        }
    }
    public function suspendAccount($id,Request $request)
    {
      if(Entrust::hasRole("Admin"))
        {
          $model=Agent::find($id);
           if(!$model)
           {
            return "Resource Not Found";
           }
           $data['model']=$model;
           $data['url']=url()->current();
            if($request->isMethod("post"))
            {
              $data=$request->all(); 
              $model->reason=$data['reason'];
              $model->status="Suspended";
              $model->save();
              //ALTER TABLE `agents` CHANGE `status` `status` ENUM('Pending','Approved','Suspended','Expired','Rejected') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending';
              $message="Dear ".$model->name.", your application on the ".config('app.name')." has been suspended because of the following reason<br> ".$data['reason'];
              $text="Dear ".$model->name.",your application at ".config('app.name')." has been suspended and details emailed to you";
              try{
                Helper::sendSMS($text,$model->telephone);
              Helper::sendEmail($model->email,$message,"Account Suspended");
               Session::flash("success_msg","Provider account suspended Successfully");
               return redirect()->back();
              }catch(\Exception $e)
               {
                   Session::flash("danger_msg","Provider account suspended Successfully");
               return redirect()->back();
               }
              
               
            }



            return view('backend::provider._reject',$data);



        }else{
          return "Access Denied";
        }

    }

    public function rejectProvider($id,Request $request)
    {
       if(Entrust::hasRole("Admin"))
        {
          $model=Agent::find($id);
           if(!$model)
           {
            return "Resource Not Found";
           }
           $data['model']=$model;
           $data['url']=url()->current();
            if($request->isMethod("post"))
            {
              $data=$request->all(); 
              $model->reason=$data['reason'];
              $model->status="Rejected";
              $model->save();
              //ALTER TABLE `agents` CHANGE `status` `status` ENUM('Pending','Approved','Suspended','Expired','Rejected') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending';
              $message="Dear ".$model->name.", your application on the ".config('app.name')." has been rejected because of the following reason<br> ".$data['reason'];
              $text="Dear ".$model->name.",your application at ".config('app.name')." has been rejected and details emailed to you";
              try{
                Helper::sendSMS($text,$model->telephone);
              Helper::sendEmail($model->email,$message,"Application Rejected");
               Session::flash("success_msg","Provider application rejected Successfully");
               return redirect()->back();
              }catch(\Exception $e)
               {
                   Session::flash("danger_msg","Provider application rejected Successfully");
               return redirect()->back();
               }
              
               
            }



            return view('backend::provider._reject',$data);



        }else{
          return "Access Denied";
        }

    }

    public function notifyProvider($model)
    {
      try{
       $message="Dear ".$model->name.", Your account has been successfully approved.Your Application Authorization Key is <br><b>".$model->auth_key."</b><p>. You will need this key during your account configuration process.Note,It is a one time key." ;
       $text="Hello, your account at ".config('app.name')." has been approved and details send to you via email ";
       Helper::sendSMS($model->telephone,$text);
      Helper::sendEmail($model->email,$message,"Account Approval");

      }catch(\Exception $e)
       {
        return false;
       }
      

       
    }

    public function PasswordReset($id,Request $request)
    {
      $data['user']=$user=User::find($id);
      $data['url']=url()->current();
        if($request->isMethod("post"))
        {
          $this->validate($request,[
            'password'=>'required|min:6|confirmed',

        ]);
           $data=$request->all();
           $user->password=$data['password'];
           $user->save();
           Session::flash("success_msg","User Password Reset Successfully");
           return redirect()->back();
        }

        return view('backend::provider._password',$data);

    }

    public function fetchAllProperties(){
      if(Entrust::hasRole("Admin")){
        $models=Property::join('agents','agents.id','=','properties.provider_id')
               ->join('categories','categories.id','=','properties.category_id')
               ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
               ->select(['properties.id','sub_categories.name as sub_category','properties.title','agents.name','categories.name as category','properties.status','properties.town','properties.location']);
        return Datatables::of($models)->make(true);



      }else{
        return json_encode("Access Denied");
      }
  
    }
    
    public function index()

    {  if(Entrust::hasRole("Admin"))
      {
         $data['page_title']="Manage Providers/Agents";
        
        return view('backend::provider.index',$data);

      }  else{
        return view("forbidden");
      }
    
    }



    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
         $data['page_title']="Provider Management";
         $data['auth_key']=str_random(65);
         $modules=SystemModule::all();
         $data['modules']=$modules;
         return view('backend::provider.create',$data);
    }

    public function providerAccount()
    {
       if(Entrust::hasRole("Provider"))
        {
          $data['page_title']="Provider Main Accounts";
          return view('backend::provider._account',$data);

        }else{
          return view("forbidden");
        }
    }

    public function getMyBookings()
    {
      if(Entrust::hasRole("Provider"))
        {
          $data['page_title']="Booking Requests";
          return view('backend::bookings.index',$data);

        }else{
          return view("forbidden");
        }

    }

    public function propertyAccounts()
    {
      if(Entrust::hasRole("Provider"))
        {
          $data['page_title']="Property Accounts";
          return view('backend::provider._p_account',$data);

        }else{
          return view("forbidden");
        }

    }

    public function fetchBookings()
    {
      $models=Booking::join('spaces','spaces.id','=','bookings.space_id')
             ->join('properties','properties.id','=','bookings.property_id')
           ->where(['properties.provider_id'=>\Auth::User()->getprovider->id])
             ->select('properties.title','spaces.number','name','email','phone','expected_entry','booking_status','bookings.created_at','bookings.id');

        return Datatables::of($models)
        ->addColumn('action',function($model){
          $mark_url=url('/backend/bookings/markAs/'.$model->id);

        
                      return '
                                <div class="dropdown">
                              <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Action
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu ">
                               
                                <li><a href="#" class="reject-modal" data-url="'.$mark_url.'" data-title="Booking Details">Mark As</a></li>
                               
                              </ul>
                            </div> 
                                ';

        })
        ->make(true);
    }


    public function markAs($id,Request $request)
    {
       $model=Booking::find($id);
        $data['model']=$model;
        $data['url']=url()->current();
         if($request->isMethod("post"))
         {
          $data=$request->all();
          $model->reply_email=$data['reply_to_email'];
          $model->contact_telephone=$data['reply_to_phone'];
          $model->response=$data['response'];
          $model->booking_status=$data['mark_as'];
          $model->save();
          $provider=$model->space->property->getProvider;

          
          $message="Dear ".$model->name." Thank you for expressing interest in renting our spaces.<p> ".$model->response."<p><p> .For more details kindly reach us through ".$model->contact_telephone ." or ".$model->reply_email;
          $space=$model->space;
            $subject="Booking Request";

            try{
              $email=$model->email;
              
              \Mail::send('emails.booking', array('space'=>$space,'model'=>$model,'provider'=>$provider,'url'=>"djhd"), function ($message) use ($email, $subject,$model,$provider) {
                $message->to($email)
                ->subject($subject)
                ->cc($provider->reply_email, "Booking Request")
                ->replyTo($model->reply_email, "Booking Request")
                ->from($provider->email, "Booking Request");
            });

             Session::flash("success_msg","Action completed successfully");
              return redirect()->back();
               


             }catch(\Exception $e)
              {
                 
                 return true;
              }
            
         }

        return view('backend::bookings._markus',$data);


    }





    public function fetchProviderAccounts()
    {
      $provider_id=\Auth::User()->getProvider->id;
      $models=ProviderAccount::where(['provider_id'=>$provider_id]);
       return Datatables::of($models)->make(true);

    }
    public function createCreditAccounts($model)
    {
      $account=ProviderAccount::where(['provider_id'=>$model->id,'account_type'=>'Credit'])->first();
        if(!$account)
        {
          $account=new ProviderAccount();
          $account->provider_id=$model->id;
          $account->account_type="Credit";
          $account->account_name="Expense Account";
          $account->current_balance=0;
          $account->save();
        }

    }

    public function createDebitAccounts($model)
    {
      $account=ProviderAccount::where(['provider_id'=>$model->id,'account_type'=>'Debit'])->first();
        if(!$account)
        {
          $account=new ProviderAccount();
          $account->provider_id=$model->id;
          $account->account_type="Debit";
          $account->account_name="Earnings Account";
          $account->current_balance=0;
          $account->save();
        }

    }

    public function GetSpacePrice($id)
    {
      $model=Space::find($id);
      return ($model)?$model->unit_price:0;

    }




    public function synaccounts()
    {
      $models=Agent::all();
       foreach($models as $model)
       {
        $this->createCreditAccounts($model);
        $this->createDebitAccounts($model);
       }
       Session::flash("success_msg","Accounts Syncronized Successfully");
       return redirect('/backend/provider/account');

       
    }


    public function synpropertiesAccount()
    {

      $models=Agent::all();
       foreach($models as $model)
       {
        $this->getProperties($model);
       }
       Session::flash("success_msg","Accounts Syncronized Successfully");
       return redirect('/backend/property/account');
        }

  public function getProperties($provider)
  {
    $models=Property::where(['provider_id'=>$provider->id])->get();
      foreach($models as $model)
      {
         $this->createPropertyCreditAccounts($model);
        $this->createPropertyAccounts($model);

      }

  }

  public function createPropertyCreditAccounts($model)
  {
     
    $account=PropertyAccount::where(['provider_id'=>$model->provider_id,'property_id'=>$model->id,'account_type'=>'Credit'])->first();
      if(!$account)
       {
         $account=new PropertyAccount();
          $account->provider_id=$model->provider_id;
          $account->property_id=$model->id;
          $account->account_type="Credit";
          $account->account_name="Expense Account";
          $account->current_balance=0;
          $account->save();
        }
  }


  public function createPropertyAccounts($model)
  {
    $account=PropertyAccount::where(['provider_id'=>$model->provider_id,'property_id'=>$model->id,'account_type'=>'Debit'])->first();
      if(!$account)
       {
         $account=new PropertyAccount();
          $account->provider_id=$model->provider_id;
          $account->property_id=$model->id;
          $account->account_type="Debit";
          $account->account_name="Earning Account";
          $account->current_balance=0;
          $account->save();
          }

  }

    public function fetchPropertiesAccounts()
    {
      $models=PropertyAccount::join('properties','properties.id','=','properties_accounts.property_id')
      ->select(['title','properties_accounts.account_type','properties_accounts.account_name','current_balance','current_balance','properties_accounts.created_at'])
      ->where(['properties_accounts.provider_id'=>Auth::User()->getProvider->id])
      ;
      return Datatables::of($models)->make(true);
    }


    public function getPropertiesExenses()
    {
     if(Entrust::hasRole("Provider"))
      {
        $data['page_title']="Expenses List";
        $id=Auth::User()->getProvider->id;
        $data['months']=PropertyExpense::where(['provider_id'=>$id])->select(['month'])->distinct()->get();
         $data['years']=PropertyExpense::where(['provider_id'=>$id])->select(['year'])->distinct()->get();
        $data['properties']=property::where(['provider_id'=>$id])->get();
        $data['expenses']=PropertyExpense::where(['provider_id'=>$id])->select('expense_name')->distinct()->get();

            return view('backend::properties.expenses',$data);
      }else{
        return view("forbidden");
      }
    }




    public function edit_property($id=null)
    {
       if(Entrust::hasRole("Provider"))
       {

         $model=Property::where(['id'=>$id,'provider_id'=>Auth::User()->getProvider->id])->first();
          if($model)
          {
            $amentities=$model->amentities;
             
             $final_amentities=array();
             foreach($amentities as $key){
              $final_amentities[]=$key->name;

             }
         $data['page_title']="Property Managemnt";
         $data['amentities']=$final_amentities;
           $data['model']=$model;
           $data['categories']=Category::orderBy('name')->get();
           $data['subcateories']=SubCategory::orderBy('name')->get();
          

            return view('backend::properties.update',$data);
          }
          else
          {
            return view('not_found');
          }
       }
       else
       {
        return view("forbidden");
       }

    }


    public function getPropertName($id){
      $model1=Space::find($id);
      $model=Property::find($model1->property_id);
      $name=($model)? $model->title:'Property Name Not Set';
      return $name;

    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
          if(Entrust::hasRole("Admin"))
          {
            $this->validate($request,[
                 'first_name'=>'required|min:2',
                 'last_name'=>'required',
                 'email'=>'email|required|unique:users',
                 'phone'=>'required',
                 'postal_address'=>'required',
                 'town'=>'required',
                 'password' => 'required|min:6|confirmed',
                 'auth_key'=>'required|min:65|max:65|unique:agents',

                ]);
             
         DB::beginTransaction();
            $user_data=array('name'=>$data['first_name'].' '.$data['last_name'],
                              'email'=>$data['email'],
                              'password'=>$data['password'],
                              'verification_code'=>str_random(6),
                              'provider'=>'manual',
                              'social'=>0,
                              );
            $user=User::create($user_data);
             if($user)
             {
               $profile= $this->createProfile($user,$data);
                 if($profile)
                 {
                   
                  $role=Role::where(['name'=>"Provider"])->first();
                 $user->roles()->attach($role->id);
                 $provider=$this->createAgent($user,$data);
                  $key=$provider->auth_key;
                 $body="Dear ".$provider->name.",You have Successfully been registered on ".config('app.name').". You are requested to to complete your account setup process once you log in to your account.<p>Your account Activation Key is <Br><b>".$key."</b>";
                
                  
                  $modules=$data['module_id'];
                  $amounts=$data['amount'];
                   
                    foreach($modules as $key=>$value){
                        $selected_module_id=$value;
                        $amount_charged=$amounts[$value];
                        $module_id=$modules[$key];
                          if($module_id==$selected_module_id){
                            $module_model=new ProviderModule();
                            $module_model->type="Provider";
                            $module_model->type_id =$provider->id;
                            $module_model->amount=$amount_charged;
                            $module_model->module_id=$module_id;
                            $module_model->no_of_users=1;
                            $module_model->date_subscribed=date('Y-m-d');
                            $module_model->last_renewed_on=date('Y-m-d');
                            $module_model->save();
                          }

                    }



           $message=new Messaging();
           $message->receiver_id=$user->id;
           $message->sender_id=Auth::User()->id;
           $message->subject="Account Added Successfully";
           $message->content="Dear ".$user->name.",an account has been created for you on ".config('app.name').",You are requested to to complete your account set up process once you log in.Your account Activation Key is <Br><b>".$key."</b>";
            
           $message->flag="message";
           $message->key=strtoupper(str_random(8));
           $message->save();
       

                   
                  DB::commit();
                   try{
 Helper::sendEmail($provider->email,$body,"Account Activation Key");
  Session::flash('success_msg','Agent/provider added successfully')   ;
                   }catch(\Exception $e)
                    {

                    Session::flash('danger_msg','Agent/provider added successfully but the system failed to send activation key ')   ;
                    }
                 
                  
                   return redirect()->back();
                 }
             }else
             {
           DB::rollback();
           return redirect()->back();
             }


          }
          else
          {
            return view('forbidden');
          }
    }

  public function createAgent($user,$data)
  {
          $now=date('Y-m-d H:i:s');
          $months=12;
          $expiry_date=date('Y-m-d H:i:s', strtotime($now . "+".$months." months") );;
         
          $agency_name=ucfirst($data['first_name']."  ".$data['last_name']);

           $agent_data=array('user_id'=>$user->id,
                      'auth_key'=>$data['auth_key'],
                       'validity_in_months'=>12,
                       'expiry_date'=>$expiry_date,
                       'status'=>'Approved',
                       'name'=>$agency_name,
                       'telephone'=>Helper::processNumber($data['phone']),
                       'email'=>$data['email'],
                       'postal_address'=>$data['postal_address'],
                       'town'=>$data['town'],

                        );
            
            $agent=Agent::create($agent_data);
            return $agent;

              if($agent)
              {
               return $agent;
              }
              else
              {
              DB::rollback();
              Session::flash('danger_msg','Error occured while processing your request.Try again ');
               return redirect()->back();

              }

  }

  public function view($id){
     $model= Space::find($id);
      if(!$model){
      return view("not_found");
      }

  $data['page_title']="Space Details";
  $data['model']=$model;
  $tenants=$model->tenants;
  $data['tenants']=$tenants;
   return view('backend::properties.spaces.view',$data);


  }
  public function createUtility($model,$utilities)
  {
    foreach($utilities as $utitlity)
    {
       
      $utility=new PropertyUtility();
      $utility->property_id=$model->id;
      $utility->utility_id=$utitlity;
      $utility->save();
    }

  }
   public function createAmentities($model,$amenities){
   

     foreach($amenities as $key)
     {
      $amentity_model=new Amentity();
      $amentity_model->property_id=$model->id;
      $amentity_model->name=$key;
      $amentity_model->save();

     }

     return true;
      
   }
    
    public function save_property(Request $request)
    {

      

       $this->validate($request,[
       'title'=>'string|required',
       'description'=>'required|string',
       'town'=>'required|string',
       'location'=>'required|string',
       'category_id'=>'required|integer',
       'type'=>'required',
       'images'=>'nullable'

        ]);
       $data=$request->all();

        if(isset($data['utilities']))
        {
          $utilities=$data['utilities'];
          unset($data['utilities']);
        }

       if(isset($data['amenities']))
       {
         $amentities=$data['amenities'];
          unset($data['amenities']);
       }

    $category=$data['subcategory_id'];

    $mysub=$this->getSubcategory($category);
      

          
       if(isset($data['images']))
       {
           $images=$data['images'];

           unset($data['images']);
        }

     
        DB::beginTransaction();
       $provider_id=\Auth::User()->getProvider->id;

       $servant_quater=(empty($data['servant_quater']))? 0: $data['servant_quater'];
      unset($data['servant_quater']);

       $status=Helper::testModule("Advertising Module",$provider_id);
         if($status==true){
           $property_status="Approved";
         }else{
          $property_status="Pending";
         }


    $agent_data=array('provider_id'=>$provider_id,'other_details'=>'not Set','subcategory_id'=>$mysub,'servant_quater'=>$servant_quater,'status'=>$property_status);

       $data=array_merge($data,$agent_data);
        if($data['type']!="For Rent"){
          $model=Property::create($data);
        }else{
          unset($data['unit_price']);
          $model=Property::create($data);
        }

        $this->processImages($images,$model);
        if($model)
        {
          $test=$this->createAmentities($model,$amentities);
          if(isset($data['utilities']))
        {
          $utiilty=$this->createUtility($model,$utilities);
        }


         
           DB::commit();
            Session::flash('success_msg','Property added successfully')   ;
              return redirect()->back();

        }
        else
        {
          DB::rollback();
          Session::flash('danger_msg',$model->errors());
          return redirect()->back();
        }
    }

    public function getSubcategory($name){
      $model=SubCategory::where(['name'=>$name])->first();
       return ($model)? $model->id: 0;
    }


    public function editspace($id,Request $request){
      if(Entrust::hasRole("Provider")){

        if($request->isMethod("Post")){
          $data=$request->all();
          $images=$data['images'];
          $data3=array('title'=>$data['title'],
                         'number'=>$data['number'],
                         'property_id'=>$data['property_id'],
                         'unit_price'=>$data['unit_price'],
                         'currency'=>'KES',
                         'description'=>$data['description'],
                         'electricity_meter_number'=>$data['electricity_meter_number'],
                         'water_meter_number'=>$data['water_meter_number'],
                         

                         );
          if($data['category']=="Commercial residential property" || $data['category']=="Commercial residential property"){
                 $data2=array('no_of_bathrooms'=>$data['number_of_bathrooms'],
                              'no_of_bedrooms'=>$data['number_of_bedrooms'],
                               );

                 $data=array_merge($data3,$data2);
              }else{
                $data=$data3;
              }

             $model=Space::find($id);
              if($model){
                $model->update($data);
                Session::flash("success_msg","Space Updated successfully");

              }else{

                Space::create($data);
                Session::flash("success_msg","Space created Successfully");
              }
              return redirect("/backend/space/listView");
        }else{
          return redirect()->back();
        }




      }else{
        return view("forbidden");
      }
    }


    protected function processImages($images,$property)
    {

       $images=explode(',', $images);

       $model=PropertyImage::where(['property_id'=>$property->id])->first();
        
      if($model)
         {
           $models=PropertyImage::where(['property_id'=>$property->id])->get();
              foreach ($models as $mod ) 
              {
                 $mod->delete();
              }

           foreach($images as $key)
             {

              try{
                        if(isset($key) && !empty($key))
                         {
                            $image=new PropertyImage();
                            $image->property_id=$property->id;
                            $image->image_id=$key;
                            $image->save();

                          
                          }


                     }catch(\Exception $e){
                      Helper::sendEmailToSupport($e);

                     }
                
            }
                   
           
            
          
         }
         else
         { 
            
             foreach($images as $key)
             {
                 if(isset($key) && !empty($key))
                 {
                    $image=new PropertyImage();
                    $image->property_id=$property->id;
                    $image->image_id=$key;
                    $image->save();
                  
                  }
                
             }

          $image=PropertyImage::where(['property_id'=>$property->id])->first();
           if($image)
           {
            $property->cover_image=$image->id;
          $property->save();

           }
          
             return true;

         }
    }


    protected function createProfile($user,$data)
    {
          $profile_data=array('user_id'=>$user->id,
                            'city'=>$data['town'],
                            'postal_address'=>$data['postal_address'],
                            'telephone'=>$data['phone'],
                            'status'=>'Incomplete'
                );
          $profile=Profile::create($profile_data);
           if($profile)
           { 
            return true;
           }else
           {
            DB::rollback();
            return false;
           }

    }

    public function fetchProperties($type=null){
       if(Entrust::hasRole("Admin")){
         $models=Property::join('categories','categories.id','=','properties.category_id')
                ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
                ->select(['properties.title']);

       }else{
            $models=Property::join('categories','categories.id','=','properties.category_id')
                ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
                ->select(['properties.title','properties.id','categories.name','sub_categories.name as subcat','type','town','location'])
                ->where(['properties.provider_id'=>Auth::User()->getProvider->id])
                ;
                 return Datatables::of($models)
             ->addColumn('action', function ($model) {
                     $url=url('/backend/property/view/'.$model->id);
                     $url_to=url('/backend/property/update/'.$model->id);
                     $url_manager=url('/backend/property/manager/'.$model->id);
                     $delete_url=url('backend/property/delete/'.$model->id);
                     $redirect_to_url=url('backend/property/index');
                     $url_bank=url('/backend/property/bank/'.$model->id);
                     $pdf_url=url('/backend/report/property/'.$model->id);
                     $units_url=url('/backend/units/index/'.$model->id);
                     $tenant_url=url('/backend/tenants/index/'.$model->id);
                     $repair_url=url('/backend/repair/index/'.$model->id);
                      return '
                                <div class="dropdown">
                              <button class="btn btn-info btn-md dropdown-toggle" type="button" data-toggle="dropdown">Actions
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                <li><a href="'.$url.'">Detailed View</a></li>
                                <li><a href="'.$url_to.'">Update Details</a></li>
                                <li><a href="#" class="reject-modal" data-url="'.$url_manager.'" data-title="Properety Managed By">View Manager</a></li>
                                <li><a class="reject-modal"   data-title="Properety Bank Details" data-url="'.$url_bank.'">Bank Details</a></li>
                                <li><a target="_new" href="'.$pdf_url.'">Export to Pdf</a></li>
                                <li><a href="'.$units_url.'">View Units</a></li>
                                <li><a href="'.$tenant_url.'">View Tenants</a></li>
                                 <li><a href="'.$repair_url.'">View Repairs</a></li>
                                <li ><a data-redirect-to="'.$redirect_to_url.'" class="delete-record" data-href="'.$delete_url.'" data-name="Property"  >Delete Property</a></li>
                              </ul>
                            </div> 
                                ';

                    
                    })->make(true);


       }



    }

    public function getManager(Request $request,$id){
       if(Entrust::hasRole("Provider")){
         $model=Property::where(['id'=>$id,'provider_id'=>Auth::User()->getProvider->id])->first();
          if(!$model){
            return "<h3 style='color:red'>Access Denied</h3>";
          }
           if($request->isMethod('post')){
             $data=$request->all();
             DB::beginTransaction();
              if(strlen($model->caretaker_user_id)<1)
              {

                $user=new User();
                $user->name=$data['managed_by'];
                $user->password=$data['password'];
               $user->username=$data['id_number'];
                
                $user->property_id=$model->id;
                $user->confirmed_at=date('Y-m-d H:i:s');
                $user->verification_code=str_random(8);
                $user->save();
                $profile=new Profile();
                $profile->user_id=$user->id;
                $profile->telephone=$data['manager_phone'];
                $profile->id_number=$data['id_number'];
                $profile->timezone="Africa/Nairobi";
                $profile->save();
                $role=Helper::FindRoleDetails("name","caretaker");
                 $user->roles()->attach($role->id);
                $model->caretaker_user_id=$user->id;
                $model->save();

                 $phone=$model->manager_phone;
              $message="Dear ".$model->managed_by." You have been added as the caretaker  for ".$model->title." property by the ".Auth::user()->getProvider->name.",\n your account login username is:".$data['id_number']." and password is :".$data['password'];



                


              }
              $model->managed_by=$data['managed_by'];
              $model->manager_phone=$data['manager_phone'];
              $model->Manager_email=$data['Manager_email'];
              $model->save();
           
             DB::commit();
             
          $test=  Helper::sendSms2($phone,$message);
              
               
             

             
            
            
            Session::flash('success_msg',"Manager Details updated successfully");
            return redirect()->back();
          }
          $data['url']=url('/backend/property/manager/'.$model->id);
          $data['model']=$model;
        return view('backend::properties.manager',$data);
           


       }
       else
       {
        return "<h3 style='color:red'>Access Denied</h3>";
       }
          



    }


    public function getBank(Request $request,$id){
         if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider")){
              $model=Property::find($id);
                if(!$model){
                  return "Resource Not found in our Server";
                }

                 if($request->isMethod("post")){
                  $data=$request->all();
                    $model->update($data);
                    Session::flash('success_msg','You have successfully update the Property Account details');
                    return redirect()->back();



                 }
                  $data['url']=url('/backend/property/bank/'.$model->id);
                  $data['model']=$model;
                  return view('backend::properties.bank',$data);









         }else{
          return view('forbidden');
         }



    }

    public function get_propreties()
    {
      $data['page_title']="Property Management";
        $type=(isset($_GET['item']))? $_GET['item'] :"all";
        $data['type']=$type;
        return view('backend::properties.index',$data);
    }


    public function getSpaces(){

      if(Entrust::hasRole("Provider"))
      {

      $data['page_title']="Space Management";
      $data['status']=(isset($_GET['status']))? $_GET['status']:'All';
      return view('backend::properties.spaces.index',$data);



      }else{
        return view("forbidden");
      }

    }


    public function update_property(Request $request,$id){
        
      if(Entrust::hasRole("Provider"))
      {
         $model=Property::where(['id'=>$id,'provider_id'=>Auth::User()->getProvider->id])->first();
        if($model)
        {
          $this->validate($request,[
       'title'=>'string|required',
       'description'=>'required|string',
       'town'=>'required|string',
       'location'=>'required|string',
       

        ]);

          
           $data=$request->all();

            //dd($data);
      

       if(isset($data['amenities']))
       {
         $amentities=$data['amenities'];
          unset($data['amenities']);
       }
       if(isset($data['images']))
       {
           $images=$data['images'];
            if(isset($data['images']) && !empty($data['images'])){
            $this->processImages($images,$model);
            }
            
           
           unset($data['images']);
        }
          
     
        DB::beginTransaction();


        
         
        $property_details=array('title'=>$data['title'],
                                'category_id'=>$data['category_id'],
                                'subcategory_id'=>$data['subcategory_id'],
                                'description'=>$data['description'],
                                'town'=>$data['town'],
                                'type'=>$data['type'],
                                'location'=>$data['location'],
                                'postal_address'=>$data['postal_address'],
                                'area'=>(!empty($data['area']))?$data['area'] :0,
                                'no_of_bedrooms'=>(!empty($data['no_of_bedrooms']))?                $data['no_of_bedrooms'] :0,
                                'no_of_bathroom'=>(!empty($data['no_of_bathroom']))?               $data['no_of_bathroom'] :0,
                                'servant_quater'=>(!empty($data['servant_quater']))?               $data['servant_quater'] :0,
                                'managed_by'=>$data['managed_by'],
                                'manager_phone'=>$data['manager_phone'],
                                'Manager_email'=>$data['Manager_email'],
                                'manager_postal'=>$data['manager_postal'],
                                'description'=>$data['description'],
                                'country'=>$data['country'],
                                'street_road'=>$data['street_road'],
                                'tax_charged'=>(isset($data['tax_charged']))? $data['tax_charged']:null,
                                'account_number'=>$data['account_number'],
                                'account_name'=>$data['account_name'],
                                'bank_name'=>$data['bank_name'],
                                'branch'=>$data['branch'],
                                'paybill'=>$data['paybill'],
                                'mpesa_phone'=>$data['mpesa_phone'],
                                'longitude'=>$data['longitude'],
                                'latitude'=>$data['latitude'],
                                'agency'=>$data['agency'],
                                'unit_price'=>(isset($data['unit_price']))? $data['unit_price']:null,
                                'currency'=>(isset($data['currency']))? $data['currency']:'KES', 
                               

                              );
              
          
         if($model->update($property_details))
         {
            $this->updateAmentities($model,$amentities);
             $this->checkAgents($model);
             DB::commit();
            Session::flash('success_msg','Property Updated successfully')   ;
              return redirect("/backend/property/index");

         }
         else
         {
         DB::rollback();
         return redirect()->back()->withInput()->withErrors($model->errors());
         }

        }
        else
        {
         return view("not_found");
        }
        

      }
      else
      {
        return view("forbidden");
      }

    }


    /*updates amentities belonging to aparticular property
    *Author:Isanya L Hillary
    *param property_id (int) and array of amentitries
    */

    public function updateAmentities($model,$data)
    {
     $id=$model->id;
      //delete all the amentities in the amentities table
        $models=Amentity::where(['property_id'=>$id])->get();
        if(sizeof($models)>0)
        { 
          foreach($models as $deleteModel):
             $deleteModel->delete();
             endforeach;
        }

        //insert new amentities
         foreach($data as $key)
         {
          $insertModel=new Amentity();
          $insertModel->name=$key;
          $insertModel->property_id=$id;
          $insertModel->save();

         }

         return true;
       }

       public function checkAgents($model){
        
         $user=User::where(['email'=>$model->Manager_email])->first();
           
            if($user){
               $model->agent_id=$user->id;
               $model->save();
               return true;
            }else{
                DB::beginTransaction();
                $user=new User();
                $user->email=$model->Manager_email;
                $user->name=$model->managed_by;
                $user->verification_code=str_random(8);
                $user->confirmed_at=date('Y-m-d H:i:s');
                $user->password=$password=str_random(6);
                $user->provider="Manual";
                $user->save();
                $model->agent_id=$user->id;
                $model->save();
                $profile=new Profile();
                $profile->user_id=$user->id;
                $profile->telephone=$model->manager_phone;
                $profile->postal_address=$model->manager_postal;
                 $profile->save();
                 $role=Helper::FindRoleDetails('name',"Agents");
                 $user->roles()->attach($role->id);
                 $message="Dear ".$user->name." A new Account has been created for you at the Qootu.com platform. use your email :".$user->email."  and  Password :".$password." to log to the portal";
                 Helper::sendSMS($profile->telephone,$message,null,2);
                 Helper::sendEmail($user->email,$message,"User Account");
                 DB::commit();
                 return true;





            }
       }



       public function delete_property($id=null){

         if(Entrust::hasRole("Provider"))
         {
          $model=Property::where(['id'=>$id,'provider_id'=>Auth::User()->getProvider->id])->first();
            if($model)
            {
                try{
                   $model->delete();
                   Session::flash("success_msg","Property Delete Successfully");

                 }
                 catch(Exception $e)
                 {
                  Session::flash("danger_msg",$e);

                 }


            }
            else
            {

            }
         }
         else
         {
           Session::flash("danger_msg",'Access Denied.You cannot Delete this property because it does not belong to you');
         }

       }


       public function addspace(Request $request){
         if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent") || Entrust::can("Add-spaces"))
         {
         
           $models=Property::where(['provider_id'=>Auth::User()->getProvider->id])->get();
           $data['properties']=$models;
           $data['page_title']="Add Spaces";
           $data['templates']=SpaceTemplate::where(['provider_id'=>auth::user()->getProvider->id])->get();
           $data['url']=url()->current();
             if($request->isMethod("post"))
             {
              $data=$request->all();
               try{
                $unitNames=$data['unitname'];
                $floors=$data['floor'];
                $waters=$data['watermeter'];
                $powers=$data['powermeter'];
                DB::beginTransaction();

                 foreach($unitNames as $key=>$value)
                 {
                    $model=new Space();
                    $model->template_id=$data['template_id'];
                    $model->property_id=$data['property_id'];
                    $model->unit_price=doubleval($data['unit_rate']);
                    $model->currency="KES";
                    $model->title=$unitNames[$key];
                    $model->number=$unitNames[$key];
                    $model->water_meter_number=(isset($waters[$key]))?$waters[$key]:null;
                    $model->electricity_meter_number=(isset($powers[$key]))?$powers[$key]:null;
                    $model->floor=$floors[$key];
                    $model->save();

                     
                 }
                  DB::commit();
                 Session::flash("success_msg","Spaces Added Successfully");
                 return redirect()->back();
                
                 



               }catch(\Exception $e)
                {
                   dd($e);
                }
             }



           return view('backend::properties.spaces.create_space',$data);



        }
        else{
          return view("forbidden");
        }
       }


       public function getattributes($id){
         $model=Property::find($id);
           if($model){
              $data=array('category'=>$model->category->name,'subcategory'=>$model->subcategory->name);

              return json_encode($data);

           }else{
            return view("forbidden");
           }
       }

       public function storespace(Request $request){
        if(Entrust::hasRole("Provider"))
         {
           $data=$request->all();

            $this->validate($request,[
            'number'=>'required',
            'unit_price'=>'required',
            'property_id'=>'required|integer',
            'category'=>'required'
              ]);

            


              $images=$data['images'];
              

              $data3=array('title'=>$data['title'],
                         'number'=>$data['number'],
                         'property_id'=>$data['property_id'],
                         'unit_price'=>$data['unit_price'],
                         'currency'=>'KES',
                         'description'=>$data['description'],
                         'status'=>'Free',
                         'water_meter_number'=>$data['water_meter_number'],
                         'electricity_meter_number'=>$data['electricity_meter_number'],

                         );
              if($data['category']=="Commercial residential property" || $data['category']=="Commercial residential property"){
                 $data2=array('no_of_bathrooms'=>$data['number_of_bathrooms'],
                              'no_of_bedrooms'=>$data['number_of_bedrooms'],
                               );

                 $data=array_merge($data3,$data2);
              }else{
                $data=$data3;
              }
              
              


              $model=Space::where(['property_id'=>$data['property_id'],'number'=>$data['number']])->first();
              if(!$model){
                $model=Space::create($data);
              }
              else{
                $model->update($data);
              }
             
              if($model)
              {
                $this->processSpaceImage($images,$model);
                 Session::flash("success_msg","Space Added Successfully");
                 return redirect()->back();

              }
              else{
                return redirect()->back()->withErrors($model->errors());
              }



        }
        else{
          return view("forbidden");
        }


       }

        protected function processSpaceImage($images,$property)
    {
       $images=explode(',', $images);
       
       $model=SpaceImage::where(['space_id'=>$property->id])->first();
      if($model)
         {
          $this->updateImages($model->id,$images);
         }
         else
         {  
             foreach($images as $key)
             {
                 if(isset($key) && !empty($key))
                 {
                    $image=new SpaceImage();
                    $image->space_id=$property->id;
                    $image->image_id=$key;
                    $image->save();
                  
                  }
                
             }
             return true;

         }
    }


    public function fetchSpaces($id=null)
    {
       if(Entrust::hasRole("Provider"))
       {
        $spaces=Space::where(['property_id'=>$id,'status'=>'Free'])->get();

          if(sizeof($spaces)>0){
             echo "<option value=''>----select Space Number-----</option>";
          foreach ($spaces as $space) {
            echo '<option value="'.$space->id.'">'.$space->number.'</option>';
            
          }

          }else{
            echo "<option value=''>----No Empty Spaces Found in This Property-----</option>";
          }


          

          exit;


        }
        else{
          Session::flash('danger_msg','Access Denied...You are not allowed to perform this action .Contact isanyad for more information');
        }
    }

    public function fetchoccupiedSpaces($id){
      if(Entrust::hasRole("Provider"))
       {
        $spaces=Space::where(['property_id'=>$id,'status'=>'Occupied'])->get();

          if(sizeof($spaces)>0){
             echo "<option value=''>----select Space Number-----</option>";
          foreach ($spaces as $space) {
            echo '<option value="'.$space->id.'">'.$space->number.'</option>';
            
          }

          }else{
            echo "<option value=''>----No Tenant Found in The Space Specified-----</option>";
          }


          

          exit;


        }
        else{
          Session::flash('danger_msg','Access Denied...You are not allowed to perform this action .Contact isanyad for more information');
        }

    }

    public function FetchMyCategory(){

      $models=SubCategory::where(['category_id'=>$id])->get();
       echo '<option value="" >any</option>';

       foreach($models as $model){
        echo '<option value="'.$model->id.'" >'.$model->name.'</option>';
       }

    }




    public function getPropertyRepairs($id){
        if(Entrust::hasRole("Provider") || Entrust::hasRole("Admin")){
          if(Entrust::hasRole("Admnin") ){
          $model=Property::find($id);
         }else{
           $provider_id=Auth::user()->getProvider->id;
           $model=Property::where(['provider_id'=>$provider_id,'id'=>$id])->first();
         }

         if(!$model){
          return view("not_found");
         }


         $data['model']=$model;
         $data['page_title']="Property Repairs";
         $data['view_menu']="display";
         return view('backend::properties._repairs',$data);




        }else{
          return view('forbidden');
        }

    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('backend::provider.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {

    }

    public function getProviderSpaces()
    {
       if(Entrust::hasRole("Admin"))
        {

        }else{
          return view("forbidden");
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function updatespace($id)
    {
       if(Entrust::hasRole("Provider")){
        $data['page_title']="Update Space";
          $model=Space::join('properties','properties.id','=','spaces.property_id')
                 ->where(['spaces.id'=>$id,'provider_id'=>auth::user()->getProvider->id])->first();
            if(!$model){
              Session::flash("danger_msg","Spaces Details Not Found on this Server");
              return redirect()->back();
              return view("not_found");

           }else{
            $data['model']=$model;
           }

          $models=Property::where(['provider_id'=>Auth::User()->getProvider->id])->get();
          $data['properties']=$models;
          
          return view('backend::properties.spaces.edit',$data);

       }else{
        return view("forbidden");
       }
    }

    public function delete_space($id){

      if(Entrust::hasRole("Provider")){
        $model=Space::find($id);
         if($model){
          $model->delete();
          Session::flash("success_msg",'Space Deleted Successfully');
         }
      }else{
        Session::flash("danger_msg","Access Denied.");
      }
    }

    public function getstatiscs(){

      if(Entrust::hasRole("Provider")){
         $categories=Category::orderBy('name')->groupBy('name')->get();
          $data['categories']=$categories;
          $data['page_title']="Property Statistics";
          $data['subcateories']=SubCategory::orderBy('name')->get();
          return view('backend::properties.spaces.property_stats',$data);
        
      }else{
        return view("forbidden");
      }

    }

    public function getSetUpAccount(Request $request)
    {
       if(Entrust::hasRole("Provider")){
        $data['page_title']="Account SetUp";
        $data['url']=url()->current();
        $data['user']=auth::user();
        $data['model']=auth::user()->getProvider;
          if($request->isMethod("post"))
          {
            $data=$request->all();
            $this->validate($request,[
              'auth_key'=>'required|string|exists:agents,auth_key',
              'name'=>'string',
              'postal_address'=>'required',
              'email'=>'required|email'

            ]);
            try{
              
              $test=Agent::where(['id'=>auth::user()->getProvider->id,'auth_key'=>$data['auth_key']])->first();
                if(!$test)
                {
                  return redirect()->back()->withInput()->withErrors("Provided Authorization(Product) Key Not in our Records");
                }else{


                  $a=array('is_first_time_login'=>"No");
                  $data=array_merge($a,$data);

                   $model=auth::user()->getProvider;
                   $model->update($data);
                   Session::flash("success_msg","Your Account Has been activated successfully");
                   return redirect('/home');
                   
                }



            }catch(\Exception $e)
             { 
               Helper::sendEmailToSupport($e);
               return redirect()->back()->withInput()->withErrors("Error Occured while activating your account.KIndly contact 0708236804 for assistance");

              }



             
          }



         
          return view('backend::accounts.wizard',$data);
        
      }else{
        return view("forbidden");
      }

    }



    public function getProperySpaces($id){
       if(Entrust::hasRole("Provider") || Entrust::hasRole("Admnin")){

         if(Entrust::hasRole("Admnin") ){
          $model=Property::find($id);
         }else{
           $provider_id=Auth::user()->getProvider->id;
           $model=Property::where(['provider_id'=>$provider_id,'id'=>$id])->first();
         }

         if(!$model){
          return view("not_found");
         }


         $data['model']=$model;
         $data['page_title']="Property Units/Spaces";
         $data['view_menu']="display";
         return view('backend::properties._spaces',$data);

       }else{
        return view('forbidden');
       }

    }


    public function fetchUnitTenants($id){

       if(Entrust::hasRole("Provider") || Entrust::hasRole("Admnin")){

         if(Entrust::hasRole("Admnin") ){
          $model=Property::find($id);
         }else{
           $provider_id=Auth::user()->getProvider->id;
           $model=Property::where(['provider_id'=>$provider_id,'id'=>$id])->first();
         }

         if(!$model){
          return view("not_found");
         }


         $data['model']=$model;
         $data['page_title']="Tenants List";
         $data['view_menu']="display";
         return view('backend::properties._tanants',$data);

       }else{
        return view('forbidden');
       }

    }


    public function fetchUnits($value)
    {
       $models=Space::where(['property_id'=>$value]);
           return Datatables::of($models)
              ->editColumn('created_at',function($model){
                 $tenant_count=Tenant::where(['space_id'=>$model->id])->count();
                 return $tenant_count;
               })

              ->editColumn('updated_at',function($model){
                 $tenant_count=Repair::where(['space_id'=>$model->id])->count();
                 return $tenant_count;
               })
              ->make(true);
       
    }

    public function getSpaceRepairs($value=''){
       $models=Repair::join('spaces','spaces.id','=','repairs.space_id')
              ->select(['repairs.id','repair_code','repair_date','repair_date','total_cost','person_responsible','invoice_number','number','technician_fee'])
              ->where(['property_id'=>$value]);
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

    public function fetchSpaceTenants($value=''){

      $models=Tenant::join('users','users.id','=','tenants.user_id')
             ->join('spaces','spaces.id','=','tenants.space_id')
             ->select(['tenants.id','users.name','tenants.created_at','spaces.number','entry_date','expected_end_date','current_status'])
             ->where(['property_id'=>$value]);
           return Datatables::of($models)
              ->editColumn('created_at',function($model){
                  $debosit=TenantCharges::where('tenant_id',$model->id)->where('charge_name','Deposit')->sum('amount');
                  $totals=TenantCharges::where('tenant_id',$model->id)->sum('amount');
                 return $totals-$debosit;
               })->make(true);

    }

    public function view_property($id){
       if(Entrust::hasRole("Provider")){
         $data['page_title']="Property Details";
          $model=Property::find($id);

           if(!$model){
            return view("not_found");
           }
           $occupants=Tenant::join('spaces','spaces.id','=','tenants.space_id')
                      ->join('properties','properties.id','=','spaces.property_id')

                      ->where(['property_id'=>$model->id,'current_status'=>'Active'])
                       ->get();

            
                       

            $data['occupants']=$occupants;
           $data['model']=$model;


          return view('backend::properties.detail_view',$data);
        
      }else{
        return view("forbidden");
      }



    }
    public function GetMoreSpaceDetails($id)
    {
       $model=Space::find($id);
       $data['model']=$model;
        return view('backend::properties.spaces._view',$data);

    }


    public function fetchUnitsAll($status){
       if($status=="All"){
        $models=Space::select(['spaces.id','properties.title','number','spaces.title as name','spaces.currency','spaces.unit_price','spaces.status','spaces.floor','water_meter_number','electricity_meter_number'])->join('properties','properties.id','=','spaces.property_id')->where(['provider_id'=>Auth::User()->getProvider->id]);

       }else{
        $models=Space::select(['spaces.id','properties.title','number','spaces.title as name','spaces.currency','spaces.unit_price','spaces.status','spaces.floor','water_meter_number','electricity_meter_number'])->join('properties','properties.id','=','spaces.property_id')->where(['provider_id'=>Auth::User()->getProvider->id,'spaces.status'=>$status]);
       }

      
           return Datatables::of($models)
            ->editColumn('number',function($model){
              $url=url('/backend/spaces/moreDetails/'.$model->id);
              return '<a data-title="Space Details" data-url="'.$url.'" class="reject-modal" title="Click to View More Details">'.$model->number.'</a>';

            })
              ->editColumn('created_at',function($model){
                 $tenant_count=Tenant::where(['space_id'=>$model->id])->count();
                 return $tenant_count;
               })

              ->editColumn('updated_at',function($model){
                 $tenant_count=Repair::where(['space_id'=>$model->id])->count();
                 return $tenant_count;
               })
              ->addColumn('action',function($model){
                $url=url('/backend/property/view/'.$model->id);
                     $url_to=url('/backend/property/update/'.$model->id);
                     $url_manager=url('/backend/property/manager/'.$model->id);
                     $delete_url=url('backend/space/delete/'.$model->id);
                     $redirect_to_url=url('backend/space/listView');
                     $url_bank=url('/backend/property/bank/'.$model->id);
                     $pdf_url=url('/backend/report/property/'.$model->id);
                     $units_url=url('/backend/units/index/'.$model->id);
                     $tenant_url=url('/backend/tenants/spaces/index/'.$model->id);
                     $repair_url=url('/backend/repair/spaces/index/'.$model->id);
                     $invoice_url=url('/backend/space/invoice/index/'.$model->id);
                     $payment_url=url('/backend/space/payments/index/'.$model->id);
                     $gallery_url=url('/backend/space/gallery/index/'.$model->id);
                     $edit_url=url('/backend/space/update/'.$model->id);

                      return '
                                <div class="dropdown">
                              <button class="btn btn-info btn-md dropdown-toggle" type="button" data-toggle="dropdown">Actions
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">

                               <li><a href="'.$edit_url.'">Edit Details</a></li>
                              
                                <li><a href="'.$tenant_url.'" title="Used to show all tenants who have rented this space/unit in history">View Tenants</a></li>
                                 <li><a href="'.$repair_url.'">View Repairs</a></li>
                                 <li><a href="'.$invoice_url.'">Invoice History</a></li>
                                  <li><a href="'.$payment_url.'">Payment History</a></li>
                                  <li><a href="'.$gallery_url.'">Space Gallery</a></li>
                                <li><a target="_new" href="'.$pdf_url.'">Export to Pdf</a></li>

                                <li ><a data-redirect-to="'.$redirect_to_url.'" class="delete-record" data-href="'.$delete_url.'" data-name="Space"  >Delete Unit</a></li>
                              </ul>
                            </div> 
                                ';
              })
              ->make(true);

    }


    public function getSpaceTenants($id){

       if(Entrust::hasRole("Provider") || Entrust::hasRole("Admnin")){

         if(Entrust::hasRole("Admnin") ){
          $model=Space::find($id);
         }else{
           $provider_id=Auth::user()->getProvider->id;
           $model=Space::join('properties','properties.id','=','spaces.property_id')
           ->where(['provider_id'=>$provider_id,'spaces.id'=>$id])->first();
         }

         if(!$model){
          return view("not_found");
         }


         $data['model']=$model;
         $data['page_title']="Tenants List";
         $data['view_menu']="display";
         $data['id']=$id;
         return view('backend::properties.spaces._tanants',$data);

       }else{
        return view('forbidden');
       }

    }

    public function fetchExpenses(Request $request)
    {
      $models=PropertyExpense::join('properties','properties.id','=','property_expenses.property_id')
             ->orderBy('property_expenses.created_at','desc')
              ->get();

        return Datatables::of($models)->make(true);

    }

    public function addExpenses(Request $request)
    {
       if(Entrust::hasRole("Provider") )
        {
          $data['url']=url()->current();
          $provider_id=Auth::user()->getProvider->id;
          $data['models']=Property::where(['provider_id'=>$provider_id])->get();
          $data['model']=$model=new PropertyExpense();
           if($request->isMethod("post"))
           {
            $data=$request->all();
            DB::beginTransaction();
            $model->property_id=$data['property_id'];
            $model->provider_id=$provider_id;
            $model->expense_name=$data['expense_name'];
            $model->amount=doubleval($data['amount']);
            $model->expense_date=date("Y-m-d",strtotime($data['expense_date']));
            $model->other_descriptions=$data['other_descriptions'];
            $model->year=date("Y",strtotime($data['expense_date']));
            $model->month=date("M",strtotime($data['expense_date']));
            $model->ref_no=strtoupper(str_random(5));
            $model->save();
             if($model)
             {
              $transaction=new PropertyTransaction();
              $transaction->provider_id=$provider_id;
              $transaction->property_id=$model->property_id;
              $transaction->credit=0;
              $transaction->debit=$model->amount;
              $transaction->ref_no=$model->ref_no;
              $balance=$model->amount-0;
              $transaction->year=$model->year;
              $transaction->month=$model->month;
              $transaction->tran_date=$model->expense_date;
              $account=PropertyAccount::where(['provider_id'=>$provider_id,'property_id'=>$model->property_id,'account_type'=>'Credit'])->first();
               $transaction->account_id=$account->id;
               $transaction->save();
                
               DB::commit();
              Session::flash("success_msg","Expenses Added Successfully");
              return redirect()->back();
             }


             dd($model);
             dd($data);

           }





          return view('backend::expenses._form',$data);
        


        }else{
          return "Access Denied";
        }

    }





    public function fetchSpaceTenancyHistory($id){
       $models=Tenant::join('users','users.id','=','tenants.user_id')
             ->join('spaces','spaces.id','=','tenants.space_id')
             ->select(['tenants.id','users.name','tenants.created_at','spaces.number','entry_date','expected_end_date','current_status','space_id'])
             ->where(['space_id'=>$id]);

           return Datatables::of($models)
              ->editColumn('created_at',function($model){
                $url=url('/backend/tenants/charge_break2/'.$model->id);
                  $debosit=TenantCharges::where('tenant_id',$model->id)->where('charge_name','Deposit')->sum('amount');

                  $totals=TenantCharges::where('tenant_id',$model->id)->sum('amount');
                      $mc=$totals-$debosit;
                  return '<a style="cursor:pointer;"  title="View Charge Breakdown"   class="reject-modal" data-url="'.$url.'"
                                data-title="Payment Break Down" >'. $mc.'</a>';
                 
               })->make(true);

    }
    public function fetchGivenSpaceRepairs($value){
       $models=Repair::join('spaces','spaces.id','=','repairs.space_id')
              ->select(['repairs.id','repair_code','repair_date','repair_date','total_cost','person_responsible','invoice_number','number','technician_fee'])
              ->where(['space_id'=>$value]);
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

    public function getSpaceRepairments($id){
       if(Entrust::hasRole("Provider") || Entrust::hasRole("Admnin")){

         if(Entrust::hasRole("Admnin") ){
          $model=Space::find($id);
         }else{
           $provider_id=Auth::user()->getProvider->id;
           $model=Space::join('properties','properties.id','=','spaces.property_id')
           ->where(['provider_id'=>$provider_id,'spaces.id'=>$id])->first();
         }

         if(!$model){
          return view("not_found");
         }


         $data['model']=$model;
         $data['page_title']="Space Repairment History";
         $data['view_menu']="display";
         $data['id']=$id;
         return view('backend::properties.spaces._repairs',$data);

       }else{
        return view('forbidden');
       }

    }


    public function getSpaceInvoices($id){

      if(Entrust::hasRole("Provider") || Entrust::hasRole("Admnin")){

         if(Entrust::hasRole("Admnin") ){
          $model=Space::find($id);
         }else{
           $provider_id=Auth::user()->getProvider->id;
           $model=Space::join('properties','properties.id','=','spaces.property_id')
           ->where(['provider_id'=>$provider_id,'spaces.id'=>$id])->first();
         }

         if(!$model){
          return view("not_found");
         }


         $data['model']=$model;
         $data['page_title']="Space Invoice History";
         $data['view_menu']="display";
         $data['id']=$id;
         return view('backend::properties.spaces._invoices',$data);

       }else{
        return view('forbidden');
       }

    }


    public function getSpacePayments($id){

      if(Entrust::hasRole("Provider") || Entrust::hasRole("Admnin")){

         if(Entrust::hasRole("Admnin") ){
          $model=Space::find($id);
         }else{
           $provider_id=Auth::user()->getProvider->id;
           $model=Space::join('properties','properties.id','=','spaces.property_id')
           ->where(['provider_id'=>$provider_id,'spaces.id'=>$id])->first();
         }

         if(!$model){
          return view("not_found");
         }


         $data['model']=$model;
         $data['page_title']="Space Payment History";
         $data['view_menu']="display";
         $data['id']=$id;
         return view('backend::properties.spaces._payments',$data);

       }else{
        return view('forbidden');
       }

    }


    public function getManagers()
    {
      if(Entrust::hasRole("Provider") || Entrust::hasRole("Admnin")){

         
         $data['page_title']="Properties Managers";
        
        
         return view('backend::properties._managers',$data);

       }else{
        return view('forbidden');
       }
    }


    public function fetchManagerList(){

       $models=Property::join('categories','categories.id','=','properties.category_id')
                ->join('sub_categories','sub_categories.id','=','properties.subcategory_id')
                ->select(['properties.title','properties.id','categories.name','sub_categories.name as subcat','manager_phone','managed_by','Manager_email','manager_postal','bank_name','account_name','account_number','paybill','mpesa_phone'])
                ->where(['properties.provider_id'=>Auth::User()->getProvider->id])
                ;
                 return Datatables::of($models)->make(true);

    }

    public function getSpaceStatistcis(){

      if(Entrust::hasRole("Provider") || Entrust::hasRole("Admin")){

           $data['page_title']="Space Statistics By Status";
           
           $data['statuses']=array("Free","Occupied","OnNotice");
        
        
         return view('backend::properties.space_statistics',$data);

       }else{
        return view('forbidden');
       }




    }

    public function fetchStatistics(){

      $models=Property::where(['provider_id'=>Auth::User()->getProvider->id])->get(); 

      $data=array();
      foreach($models as $model){
        $empty=Space::where(['status'=>'Free','property_id'=>$model->id])->count();
         
        $occupied=Space::where(['status'=>'Occupied','property_id'=>$model->id])->count();
        $onNotice=Space::where(['status'=>'OnNotice','property_id'=>$model->id])->count();
        $b=array('x'=>$model->title,'y'=>$empty,'z'=>$occupied,'a'=>$onNotice);
        $data[]=$b;

      }
      return json_encode($data);

    }





    public function getBankDetails(){
      if(Entrust::hasRole("Provider") || Entrust::hasRole("Admin")){

         
         $data['page_title']="Rent Payments Accounts";
        
        
         return view('backend::properties._banks',$data);

       }else{
        return view('forbidden');
       }

    }


    public function getGallery(){
       if(Entrust::hasRole("Provider") || Entrust::hasRole("Admnin")){

         
         $data['page_title']="Uploaded Images";
         $data['images']=Upload::where(['user_id'=>Auth::User()->id])->orderBy('created_at','desc')->get();
        
        
         return view('backend::properties.gallery',$data);

       }else{
        return view('forbidden');
       }

    }

    public function getSpaceImages($id)
    {
      
      if(Entrust::hasRole("Provider") || Entrust::hasRole("Admnin")){

         $model=Space::find($id);
         if($model)
         {
           if($model->template)
           {
             $data['page_title']="Space Images";
           $data['images']=$model->template->images;

           }else{
            Session::flash("danger_msg","Your Spaces have not been linked to any space template.Kindly Create Template and link all your spaces to them for future easy of management");
            return redirect('/backend/templates/create');
           }
          

         }else{
          return view("not_found");
         }
        
         
        
        
         return view('backend::properties.spaces.gallery',$data);

       }else{
        return view('forbidden');
       }
    }

    public function getPropertiesTransaction()
    {
       if(Entrust::hasRole("Provider") || Entrust::hasRole("Admnin") || Entrust::hasRole("Agent")){

         
         $data['page_title']="Property Transaction";
         $data['type']=(isset($_GET['period']))?$_GET['period']:"All";
       
        
        
         return view('backend::properties.transactions',$data);

       }else{
        return view('forbidden');
       }

    }
    public function fetchPropertyTransactions($type)
    {
      $models=PropertyTransaction::join('properties','properties.id','=','property_transactions.property_id')
              ->join('properties_accounts','properties_accounts.id','=','property_transactions.account_id')
              ->select('property_transactions.id','properties.title','properties_accounts.account_name','tran_date','debit','property_transactions.balance','property_transactions.ref_no','property_transactions.month','property_transactions.year','property_transactions.created_at','property_transactions.credit','transaction_id')
              ->where(['property_transactions.provider_id'=>auth::user()->getProvider->id])
              ->orderBy('property_transactions.created_at','desc')
              ;

        return Datatables::of($models)
        ->editColumn('created_at',function($model){
        return  (isset($model->created_at))?date('Y-m-d G:i:s',strtotime($model->created_at)):"Not Set";

        })
        ->editColumn('title',function($model){
       return str_limit($model->title,20);
        })
        ->editColumn('ref_no',function($model){
          $detail_url=url('/backend/propert_transaction/view/'.$model->id);
       return '<a data-url="'.$detail_url.'" class="reject-modal" data-title="Transaction Details">'.$model->ref_no.'</a>';
        })
        ->make(true);


    }

     public function ViewTransactionDetails($id)
     {
        if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider") || Entrust::hasRole("Agent")){
           $model=PropertyTransaction::find($id);
               
             if($model)
             {
               $payment=Payment::find($model->transaction_id);
                   
                if($payment)
                {
                   $data['payment']=$payment;
                   $data['model']=$model;
                    

                  return view('backend::properties._dpayment',$data);
                }else{

                  $expense=PropertyExpense::where(['ref_no'=>$model->ref_no])->first();
                   $data['model']=$model;
                   $data['expense']=$expense;
                    return view('backend::properties._dexpense',$data);

                }
              }else{
              return "Transaction Details Not Found";
             }

        }else{
          return "Access Denied";
        }


     }




    public function getPropertyPaymentStatistics($year){
      if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider")){
        $data['page_title']="Property Payment Statistics";
        $data['model']=new Payment();
        $data['years']=$this->getYears();

            $months=array('Jan'=>1,'Feb'=>2,'Mar'=>3,'Apri'=>4,'May'=>5,'Jun'=>6,
                'Jul'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12
           );  
            $data['months']=$months;
            $data['mwaka']=$year;

            $data['properties']=Property::where(['properties.provider_id'=>Auth::User()->getProvider->id])->get();
        return view('backend::properties.payment_statistics',$data);



      }else{
        return view('forbidden'); 
      }
    }

    protected function getYears($property_id=null){
       $id=Auth::User()->getProvider->id;
        if($property_id==null){
          $years=Payment::where(['provider_id'=>$id,'tenant_payments.type'=>'Rent'])->orderBy('tenant_payments.created_at','desc')
              ->get()
              ->groupBy(function($date) {
              return \Carbon::parse($date->created_at)->format('Y'); // grouping by years
        //return Carbon::parse($date->created_at)->format('m'); // grouping by months
         });

        }else{
          
          $years=Payment::join('spaces','spaces.id','=','tenant_payments.space_id')->where(['provider_id'=>$id,'tenant_payments.type'=>'Rent','spaces.property_id'=>$property_id])->orderBy('tenant_payments.created_at','desc')
              ->get()
              ->groupBy(function($date) {
              return \Carbon::parse($date->created_at)->format('Y'); // grouping by years
        //return Carbon::parse($date->created_at)->format('m'); // grouping by months
         });



        }
        


      
        
        $mwaka=array();
        foreach($years as $key){
            foreach($key as $model){
           if(!in_array($model->created_at->year, $mwaka)){
                array_push($mwaka,$model->created_at->year); 
               }
              }
            }

             if(sizeof($mwaka)>0){
              return $mwaka;

             }else{
              return array(date('Y'));
             }
             


      }


      public function getPropertyStatistic($id){
        if(Entrust::hasRole("Provider")){
          $provider_id=Auth::User()->getProvider->id;
          $model=$details=Property::where(['id'=>$id,'provider_id'=>$provider_id])->first();
            if(!$model){
             return view("not_found");
            }
            $data['page_title']="Rent Payment Statistics For ".$model->title;
            $data['model']=new Payment();
            $data['years']=$this->getYears($model->id);

            $months=array('Jan'=>1,'Feb'=>2,'Mar'=>3,'Apri'=>4,'May'=>5,'Jun'=>6,
                'Jul'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12
           );  
            $data['months']=$months;
             $data['properties']=Property::where(['properties.provider_id'=>Auth::User()->getProvider->id])->get();
             $data['property']=$id;
             $data['detail']=$details;
             return view('backend::properties.property_statistics',$data);


        }else{
          return view("forbidden");
        }

      }

      public function getGraphData($id){
         $months=array('Jan'=>1,'Feb'=>2,'Mar'=>3,'Apri'=>4,'May'=>5,'Jun'=>6,
                'Jul'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12
           );  
         $data=array();
            $label=array();
        foreach ($months as $key=>$value) {
             $day=$key;




            $rowarray = array();
           ;
             $rowarray['x'] =$key;

            $years=$this->getYears($id);


          foreach($years as $model){
                $property=Property::find($id);
               
                  $payment=new Payment();
                 
                 $count=$payment->propertystatistics($property,$model,$value);
                  $rowarray[$model]=$count;
                 if(in_array($model, $label)){

                 }
                 else{
                     array_push($label,$model);
                 }
                 
                  // $bus=array($model->name=>$model->id);
                  // array_push($rowarray,$bus);

              }
                $data[]=$rowarray;

       }
         $mydata=array('mydata'=>$data,'label'=>$label);
        


         echo json_encode($mydata);

                

      }


      public function getPropertyGraphData($year,$property){
          $months=array('Jan'=>1,'Feb'=>2,'Mar'=>3,'Apri'=>4,'May'=>5,'Jun'=>6,
                'Jul'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12
           ); 

           
          $graph_data=array();
            $payment=new Payment();
         

           foreach($months as $key=>$value){
             if(preg_match('/all/i', $property)){
                     
          $count=$payment->propertystatistics(false,$year,$value);
            }else{
              $model=Property::find($property);
                    
          $count=$payment->propertystatistics($model,$year,$value);
            }
            

            $y=$year.' '.$key;
            $graph_data[]=array('y'=>$y,'a'=>$count);

           }

           return json_encode($graph_data);

      }

      public function getProviderTransactions()
      {
         if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent"))
          {
            $data['page_title']="Provider Transaction";
            $data['type']=(isset($_GET['period']))?$_GET['period']:"All";
            return view('backend::properties.provider_transactions',$data);


          }else{
            return view("forbidden");
          }
      }

      public function fetchProviderTransaction($type)
      {
        $models=ProviderTransaction::join('provider_accounts','provider_accounts.id','=','provider_transactions.account_id')
                ->select('provider_transactions.id','provider_transactions.created_at','amount','balance','account_type','account_name','tran_date','ref_no')
                ->where(['provider_transactions.provider_id'=>auth::user()->getProvider->id])
                ->orderBy('provider_transactions.created_at','desc');

        return Datatables::of($models)->make(true);

      }

      public function getMonthlySummary()
      {
        if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent"))
          {
            $data['page_title']="Monlty Summary";
            $data['type']=(isset($_GET['period']))?$_GET['period']:"All";
            return view('backend::tenants.monthly_summaries',$data);


          }else{
            return view("forbidden");
          }

      }

      public function getMonthlyBreadown(Request $request)
      {
        $data['properties']=Property::where(['provider_id'=>auth::user()->getProvider->id])->get();
        $data['months']=\App\TenantMonthlyReport::select('month')->distinct()->get();
        $data['years']=\App\TenantMonthlyReport::select('year')->distinct()->get();
        $data['url']=url()->current();
         if($request->isMethod('post'))
         {
           $data=$request->all();
           $property_id=$data['property_id'];
           $month=$data['month'];
           $year=$data['year'];

                $advance=PropertyTransaction::where(['property_id'=>$property_id,'month'=>$month,'year'=>$year,'type'=>"Debit"])->sum('credit');
          
           $models=\DB::select(\DB::raw("call getMonthlyBreakdown($property_id,'$month','$year')"));;
         
            try{

              MonthlySummary::generateBreakdown($models,$data,$advance);

            }catch(\Exception $e)
             {
               dd($e);
             }
           
         }


        return view('backend::tenants._monthlyreport',$data);

      }

      public function getMonthlyReports(Request $request)
      {
        $data['properties']=Property::where(['provider_id'=>auth::user()->getProvider->id])->get();
        $data['months']=TenantSummary::select('month')->distinct()->get();
        $data['years']=TenantSummary::select('year')->distinct()->get();
        $data['url']=url()->current();
         if($request->isMethod('post'))
         {
           $data=$request->all();
           $models=TenantSummary::where(['property_id'=>$data['property_id'],'month'=>$data['month'],'year'=>$data['year']])->orderBy('space_id')->get();
            try{

              MonthlySummary::generate($models,$data);

            }catch(\Exception $e)
             {
               dd($e);
             }
           
         }


        return view('backend::tenants._monthlyreport',$data);
      }

      public function fetchMonlySummary()
      {

        if(Entrust::hasRole("Renter"))
          {
              $models=TenantSummary::join('spaces','spaces.id','=','tenant_summaries.space_id')
                 ->join('properties','properties.id','=','spaces.property_id')
                 ->join('tenants','tenants.id','=','tenant_summaries.tenant_id')
                 ->join('users','users.id','=','tenants.user_id')
                 ->where(['tenant_summaries.user_id'=>auth::user()->id])
              ->select('tenant_summaries.id','number','bal_brought_forward','invoice_amount','outstanding_balance','amount_paid','users.name','tenant_summaries.month','tenant_summaries.year','properties.title')
                ->orderBy('tenant_summaries.created_at','desc');

          }else{
              $models=TenantSummary::join('spaces','spaces.id','=','tenant_summaries.space_id')
                 ->join('properties','properties.id','=','spaces.property_id')
                 ->join('tenants','tenants.id','=','tenant_summaries.tenant_id')
                 ->join('users','users.id','=','tenants.user_id')
                 ->where(['tenant_summaries.provider_id'=>auth::user()->getProvider->id])
                  ->select('tenant_summaries.id','number','bal_brought_forward','invoice_amount','outstanding_balance','amount_paid','users.name','tenant_summaries.month','tenant_summaries.year','properties.title')
                ->orderBy('tenant_summaries.created_at','desc');
          }
      

        return Datatables::of($models)
        ->editColumn('name',function($model){
        return str_limit($model->name,12);
        })
        ->editColumn('bal_carried_foward',function($model){
           if($model->bal_carried_foward>0)
           {
            return "-".$model->bal_carried_foward;
           }else{
            $a=abs($model->bal_carried_foward);
           return  number_format($a);
           }

        })



           ->editColumn('title',function($model){
        return str_limit($model->title,18);
        })
        ->make(true);
      }


      public function remoteLogIn($id,Request $request)
      {
         $user=User::find($id);

       if($user){
        $request->session()->put('isAdmin', 1);
        $request->session()->put('adminID', Auth::id());
        Auth::loginUsingId($user->id, true);
        Session::flash("success_msg","You have logged to Provider/Agent account");
             
             return redirect('/home');

       }else{
        Session::flash("danger_msg","Provider Account Not Found");
       }

      }
}
