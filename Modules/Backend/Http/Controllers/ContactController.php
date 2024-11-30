<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Entrust;
use App\User;
use DB;
use App\Http\Controllers\Controller ;
use App\Helpers\Helper;
use Auth;
use Modules\Backend\Entities\ContactGroup;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Modules\Backend\Entities\Contact;
use Excel;
use Modules\Backend\Entities\Topup;
use Modules\Backend\Entities\TopupHistrory;
use App\Jobs\SendReminderEmail;
use App\EventCode;
use Modules\Backend\Entities\Agent;
use App\ProviderModule;
use App\Http\Middleware\AccountSetUp;

class ContactController extends Controller
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
        if(Entrust::hasRole("Provider") && Helper::testModule("SMS and Bulk Emails Module",Auth::User()->getProvider->id)){
            $data['page_title']="Bulk SMS And Emails";


        return view('backend::contacts.index',$data);    
        }else{
            Session::flash("You Have Not Subscribed To This Module");
            return view("forbidden");
        }
        
    }

    public function fetchContacts(){
        $id=Auth::User()->getProvider->id;
        $models=Contact::join('bulk_groups','bulk_groups.id','=','contacts.group_id')
               ->select(['group_name','contacts.id','contacts.name','contacts.email','contacts.mobile','contacts.alt_phone'])
                ->where(['bulk_groups.owner_id'=>$id]);
         return Datatables::of($models)
               ->addColumn('action',function($model){
                 $edit_url=url('/backend/contacts/edit/'.$model->id);
                 $redirect_url=url('/backend/message/contact/index');
                 $delete_url=url('/backend/contacts/delete/'.$model->id);
                return '<a data-title="Edit Contact Details" data-url="'.$edit_url.'" class="reject-modal glyphicon glyphicon-pencil"></a>

               

                  <a style="margin-left:15%;"  data-redirect-to="'.$redirect_url.'" class="delete-record glyphicon glyphicon-trash" data-href="'.$delete_url.'" data-name="Contact"  ></a>


                ';
               })
               ->make(true);


    }


    public function searchMyContact($param,$operant,$value){

         $id=Auth::User()->getProvider->id;
        $models=Contact::join('bulk_groups','bulk_groups.id','=','contacts.group_id')
               ->select(['group_name','contacts.id','contacts.name','contacts.email','contacts.mobile','contacts.alt_phone'])
                ->where(['bulk_groups.owner_id'=>$id]);

                 if($param=="name"){
                   $models->where('contacts.name', 'like', "$value%"); 
                 }else if($param=="email"){

                   $models->where('contacts.email', 'like', "$value%");  
                 }else if($param=="mobile"){
                    $models->where('contacts.mobile', 'like', "$value%"); 
                 }
                 
                
            
            
         return Datatables::of($models)
               ->addColumn('action',function($model){
                 $edit_url=url('/backend/contacts/edit/'.$model->id);
                 $redirect_url=url('/backend/message/contact/index');
                 $delete_url=url('/backend/contacts/delete/'.$model->id);
                return '<a data-title="Edit Contact Details" data-url="'.$edit_url.'" class="reject-modal glyphicon glyphicon-pencil"></a>

               

                  <a style="margin-left:15%;"  data-redirect-to="'.$redirect_url.'" class="delete-record glyphicon glyphicon-trash" data-href="'.$delete_url.'" data-name="Contact"  ></a>


                ';
               })
               ->make(true);

    }

    public function getMyModules($id){
        $models=ProviderModule::where(['type_id'=>$id,'type'=>'Provider'])->get();
         $data=array();
          foreach($models as $model){
            $edata=date('Y-m-d', strtotime($model->date_subscribed . "+12 months"));
            $a=array('module'=>$model->module->name,'amount'=>$model->amount,'date'=>$model->date_subscribed,'status'=>$model->status,'edate'=>$edata);
            $data[]=$a;
          }
          return json_encode($data);

    }











    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
         if(Entrust::hasRole("Provider") && Helper::testModule("SMS and Bulk Emails Module",Auth::User()->getProvider->id)){
            $data['page_title']="Bulk SMS And Emails";
            $model=new Contact();
             if($request->isMethod("post")){

                $data=$request->all();

                  try{
                    $model->group_id=$data['group_id'];
                    $model->name=ucfirst($data['name']);
                    $model->email=$data['email'];
                    $model->mobile=Helper::processNumber($data['mobile']);
                    $model->alt_phone=Helper::processNumber($data['alt_phone']);
                    $model->save();

                    $job = (new SendReminderEmail($model))
                    ->delay(\Carbon::now()->addMinutes(10))
                    ->onQueue('processing');;

                 dispatch($job);

                    
                    Session::flash("success_msg","Contact Added Successfully");
                    return redirect()->back();
                    

                  }catch(\Exception $e){
                     Helper::sendEmailToSupport($e);
                     Session::flash("danger_msg","Contact Failed to add.Error Emailed to Technical support Team");
                     return redirect()->back();
                  }

             }



            $data['url']=url('/backend/message/contact/create');
            $data['model']=$model;
              $provider_id=Auth::User()->getProvider->id;
             $data['groups']=ContactGroup::where(['owner_id'=>$provider_id])->get();


        return view('backend::contacts._form',$data);    
        }else{
            Session::flash("You Have Not Subscribed To This Module");
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
    }


    public function getModules(){
        if(Entrust::hasRole("Admin")){
            $data['page_title']="System Modules";

             return view('backend::contacts._modules',$data);  


        }
        else{
            Session::flash("You Have Not Subscribed To This Module");
            return view("forbidden");
        }
    }

    public function getProviderSubscriptions(){

         if(Entrust::hasRole("Admin")){
            $data['page_title']="Agent/Property Owners Subscriptions";
            $data['models']=Agent::orderBy('name')->get();

             return view('backend::contacts._subscriptions',$data);  


        }
        else{
            Session::flash("You Have Not Subscribed To This Module");
            return view("forbidden");
        }

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
    public function update(Request $request,$id)
    {

        if(Entrust::hasRole("Provider") && Helper::testModule("SMS and Bulk Emails Module",Auth::User()->getProvider->id)){
            $provider_id=Auth::User()->getProvider->id;
            $model=Contact::join('bulk_groups','bulk_groups.id','=','contacts.group_id')
                   ->where(['contacts.id'=>$id,'owner_id'=>$provider_id])
                    ->first();
             if(!$model){
                Session::flash("danger_msg","Contact Not found on this Server");
                return "Contact Not found on this Server";
                return redirect()->back();

             }
              if($request->isMethod("post")){
                 $data=$request->all();

                  try{
                    $model->group_id=$data['group_id'];
                    $model->name=ucfirst($data['name']);
                    $model->email=$data['email'];
                    $model->mobile=Helper::processNumber($data['mobile']);
                    $model->alt_phone=Helper::processNumber($data['alt_phone']);
                    $model->save();
                    Session::flash("success_msg","Contact updated Successfully");
                    return redirect()->back();
                    

                  }catch(\Exception $e){
                     Helper::sendEmailToSupport($e);
                     Session::flash("danger_msg","Contact Failed to add.Error Emailed to Technical support Team");
                     return redirect()->back();
                  }
                  



              }




             $data['url']=url('/backend/contacts/edit/'.$model->id);
             $data['model']=$model;
             $data['groups']=ContactGroup::where(['owner_id'=>$provider_id])->get();
        return view('backend::contacts._form',$data);    
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {

        if(Entrust::hasRole("Provider") && Helper::testModule("SMS and Bulk Emails Module",Auth::User()->getProvider->id))
        {
            $provider_id=Auth::User()->getProvider->id;
            
                    try{
                        $model=Contact::join('bulk_groups','bulk_groups.id','=','contacts.group_id')
                   ->where(['contacts.id'=>$id,'owner_id'=>$provider_id])
                    ->first();
                      $model->delete();


                    }catch(\Exception $e){


                            Helper::sendEmailToSupport($e);

                         }




                    



     }else{
        Session::flash("danger_msg","You have not subscribed to this module");
     }
    }

    public function import(Request $request){
         if(Entrust::hasRole("Provider") && Helper::testModule("SMS and Bulk Emails Module",Auth::User()->getProvider->id)){

             if($request->isMethod("post")){

                $file = $request->file('file');
                $filePath = $file->getPathName();
                 $array=[]; 
                     Excel::load($filePath, function($reader) {
          $results = $reader->get();
          
          $count=0;
           foreach($results as $row){
              
      if(isset($row->group) && isset($row->name)  && isset($row->mobile)){
              $group_id=$this->getGroup($row->group);
              $name=(isset($row->name)) ?$row->name:null;
              $email=(isset($row->email)) ?$row->email:null;
              $model=Contact::where(['group_id'=>$group_id,'name'=>$name,'email'=>$email])->first();
              if(!$model){
                 $count=$count+1;
                $model=new Contact();
             $model->group_id=$group_id;
             $model->name=$row->name;
             $model->email=$row->email;
             $model->mobile=Helper::processNumber($row->mobile);
             $model->alt_phone=(isset($row->alt_telephone)) ? Helper::processNumber($row->alt_telephone):null;
             $model->save();

              }



              }
            
           

             




    
           
                   
          
           

           }

           Session::flash("success_msg",$count." Contacts Imported Successfully");
              return redirect()->back();



});





             }



            $data['page_title']="Bulk SMS And Emails";
            $data['url']=url('/backend/message/contact/import');


        return view('backend::contacts.import',$data);    
        }else{
            Session::flash("You Have Not Subscribed To This Module");
            return view("forbidden");
        }

    }



    public function getGroup($name){
        $group_name=$name;
        $owner_id=Auth::User()->getProvider->id;
         $model=ContactGroup::where(['group_name'=>$group_name,'owner_id'=>$owner_id,'owner_type'=>'Provider'])->first();
          if(!$model){
            $model=new ContactGroup();
            $model->group_name=$group_name;
            $model->owner_id=$owner_id;
            $model->owner_type="Provider";
            $model->save();
            return $model->id;
          }else{
            return $model->id;
          }

     }

     public function accountTopups(Request $request){

         if(Entrust::hasRole("Provider") && Helper::testModule("SMS and Bulk Emails Module",Auth::User()->getProvider->id)){

            $model=new TopupHistrory();
             if($request->isMethod("post")){
                $this->validate($request,[
                     'amount'=>'required|integer|between:250,20000',
                     'gateway'=>'required|in:Safaricom Mpesa,Airtel Money',
                     'transaction_code'=>'required|unique:topup_histories'

                    ]);
                DB::beginTransaction();
                $data=$request->all();
                $model->amount=$data['amount'];
                $model->gateway=$data['gateway'];
                $model->transaction_code=$data['transaction_code'];
                $model->owner_id=Auth::User()->getProvider->id;
                $model->owner_type="Provider";
                $model->status="Pending";
                $model->save();
                 if($model){
                    

                    $top=Topup::where(['owner_type'=>'Provider','owner_id'=> $model->owner_id])->first();
                      if(!$top){
                        $top=new Topup();
                        $top->owner_type="Provider";
                        $top->owner_id=$model->owner_id;
                        $top->amount=$model->amount;
                        $top->last_topup=date('Y-m-d');
                        $top->histrory_id=$model->id;
                        $top->active_balance=0;
                        
                        //$top->active_balance=$model->amount;
                      }else{
                        $current_active_balance=$top->active_balance;
                        $top->active_balance=$current_active_balance+0;
                        $top->amount=$model->amount;
                        $top->last_topup=date('Y-m-d');
                        $top->histrory_id=$model->id;
                      }

                      
                      $top->save();
                       $this->sendNotifications($model);
                      DB::commit();
                     

                      Session::flash("success_msg","Account Recharged Successfully");

                     

                 }

                 return redirect()->back();



             }





            $data['url']=url('/backend/message/account/top-up');
            $data['model']=new TopupHistrory();
            $data['page_title']="Bulk SMS and Emails";
             return view('backend::contacts.topup',$data);



         }else{
            Session::flash("danger_msg","You Have Not Subscribed To This Module");
            return view("forbidden");

         }

     }

     public function sendNotifications($model){
        $provider=Auth::User()->getProvider;

        
          if(isset($provider->telephone)){
            $phone=$provider->telephone;
            $email=$provider->email;
            $name=$provider->name;
          }else{
            $phone=Auth::User()->profile->telephone;
            $email=Auth::User()->email;
            $name=Auth::User()->name;
          }
          $message="Dear ".$name .", ".$model->amount." has been debitted to your account.You will be notified shortly once transaction has been approved by SMS Service Provider";
         Helper::sendSms($phone,$message,Auth::User()->getProvider->id,2);
         $admin_array=array('Isanya Hillary'=>'+254708236804',"David Otuya"=>'+254719289389',"Patrick Omari"=>'+254780224456');
            foreach($admin_array as $key=>$value){
                $message_b="Transaction #:".$model->transaction_code.", Dear ".$key." ,".$name ."  has purchased SMS Items for ".$model->amount.". Kindly approve the transaction to activate the sms items";
                  Helper::sendSms($value,$message_b,Auth::User()->getProvider->id,0);
            }

            //send Email to
            return true;

         
        
     }

     public function getHistory(){

         if(Entrust::hasRole("Provider") && Helper::testModule("SMS and Bulk Emails Module",Auth::User()->getProvider->id)){
            $data['page_title']="Bulk SMS and Email";
            $id=Auth::User()->getProvider->id;
            $data['balance']=Topup::where(['owner_type'=>'Provider','owner_id'=>$id])->first()->active_balance;

            return view('backend::contacts.history',$data);


         }else{
            Session::flash("danger_msg","You Have Not Subscribed To This Module");
            return view("forbidden");

         }




     }

     public function fetchHistory(){
        $id=Auth::User()->getProvider->id;
        $models=TopupHistrory::where(['owner_type'=>'Provider','owner_id'=>$id]);
        return Datatables::of($models)
        ->editColumn('gateway',function($model){
             if($model->gateway=="Safaricom Mpesa"){
               return '<label style="color:green;">'.$model->gateway.'</labe>';
             }else{

                 return '<label  style="color:red;">'.$model->gateway.'</labe>';

             }

        })->editColumn("status",function($model){
             if($model->status=="Pending"){
                return '<label class="label label-info">'.$model->status.'</labe>';
             }elseif($model->status=="Accepted"){
                 return '<label class="label label-success" >'.$model->status.'</labe>';
             }else{
                 return '<label class="label label-danger" >'.$model->status.'</labe>';
             }

        })->make(true);
     }


     public function getStatistics($year){

        if(Entrust::hasRole("Provider") && Helper::testModule("SMS and Bulk Emails Module",Auth::User()->getProvider->id)){
            $data['page_title']="Bulk SMS and Emails";
            $data['mwaka']=$year;
            $data['years']=$this->getYears(Auth::User()->getProvider->id,"provider");
             $months=array('Jan'=>1,'Feb'=>2,'Mar'=>3,'Apri'=>4,'May'=>5,'Jun'=>6,
                'Jul'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12
           );  
            $data['months']=$months;
            $data['model']=new TopupHistrory();
            $data['detail']=Auth::User()->getProvider;
            return view('backend::contacts.top_statistics',$data);


            }else{
            Session::flash("danger_msg","You Have Not Subscribed To This Module");
            return view("forbidden");

         }




     }

     protected function getYears($provider_id,$type){
       $id=Auth::User()->getProvider->id;
          $years=TopupHistrory::where(['owner_type'=>'Provider','owner_id'=>$id])->orderBy('created_at','desc')
              ->get()
              ->groupBy(function($date) {
              return \Carbon::parse($date->created_at)->format('Y'); // grouping by years
        //return Carbon::parse($date->created_at)->format('m'); // grouping by months
         });
        


      
        
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

      public function searchContacts(Request $request){
         if(Entrust::hasRole("Provider") && Helper::testModule("SMS and Bulk Emails Module",Auth::User()->getProvider->id)){
              $data['url']=url('/backend/message/contact/search');

               if($request->isMethod("post")){
                $data=$request->all();

                $data['page_title']="Bulk SMS and Emails";
                $data['param']=$data['param'];
                $data['operand']=$data['operand'];
                $data['value']=$data['value'];
                return view('backend::contacts._search_index',$data);
               }

               return view('backend::contacts._search',$data);




         }else{
            Session::flash("danger_msg","You Have Not Subscribed To This Module");
            return view("forbidden");

         }

      }
}
