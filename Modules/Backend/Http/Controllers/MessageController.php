<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Message;
use Entrust;
use App\User;
use DB;
use App\Http\Controllers\Controller ;
use App\Helpers\Helper;
use App\Helpers\Sms;
use Auth;
use Illuminate\Support\Facades\Session;
use Modules\Backend\Entities\ContactGroup;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Modules\Backend\Entities\Contact;
use Modules\Backend\Entities\Topup;
use Modules\Backend\Entities\TopupHistrory;
use Modules\Backend\Entities\SMessage;
use App\Http\Middleware\AccountSetUp;
class MessageController extends Controller
{


    /**
     * Ensure a user is logged in to access resources on this controller
     * author:isanya
     */



      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AccountSetUp::class);

    }

    public function approvals(){
      if(Entrust::hasRole("Admin")){
        $data['page_title']="Approve Top Ups";
        return view('backend::message.approvals',$data);


      }else{
        return view("forbidden");
      }

    }

    public function fetch_histories(){
      if(Entrust::hasRole("Admin")){
        $models=TopupHistrory::join('agents','agents.id','=','topup_histories.owner_id')
                 ->join('users','users.id','=','agents.user_id')
                 ->join('profiles','profiles.user_id','=','users.id')
                 ->select(['users.name','profiles.telephone','topup_histories.id','topup_histories.gateway','topup_histories.created_at','topup_histories.transaction_code','topup_histories.status','topup_histories.amount'])
                 ;
         return Datatables::of($models)
         ->editColumn('gateway',function($model){
           if($model->gateway=="Safaricom Mpesa"){
            return '<label style="color:green">'.$model->gateway.'</label>';
           }else{
            return '<label style="color:red;">'.$model->gateway.'</label>';
           }
        })
          ->editColumn('status',function($model){
            if($model->status=="Pending"){
              return '<label class="label label-primary">'.$model->status.'</label>';
            }else if($model->status=="Accepted"){
              return '<label class="label label-success">'.$model->status.'</label>';
            }
            else {
              return '<label class="label label-danger">'.$model->status.'</label>';
            }
        })
         ->addColumn('action',function($model){

           if($model->status=="Pending"){
                $approve_url=url('/backend/providers/top_approve/'.$model->id);
                $reject_url=url('/backend/providers/top_reject/'.$model->id);
                    return '  <div class="dropdown">
                      <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Action
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="'.$approve_url.'">Approve</a></li>
                        <li data-url="'.$reject_url.'" class="reject-modal" data-title="Reason For Rejecting"><a href="#">Reject</a></li>
                        
                      </ul>
                    </div> ';
                }else{
                  return '<button class="btn btn-xm btn-info">No Action</button>';
                }
           



         })

         ->make(true);


      }else{
        return json_encode("forbidden.Access Denied.");
      }
    }


    public function ApprovePurchase($id){
       if(Entrust::hasRole("Admin")){
          $model=TopupHistrory::find($id);
            if(!$model){
              Session::flash("danger_msg","Resource Not Found");
             return redirect()->back();
              }
              else
              {

                try{
                      DB::beginTransaction();
                  $model->status="Accepted";
                  $model->save();
                   $top=Topup::where(['owner_type'=>'Provider','owner_id'=> $model->owner_id])->first();
                    
                      if(!$top){
                        $top=new Topup();
                        $top->owner_type="Provider";
                        $top->owner_id=$model->owner_id;
                        $top->amount=$model->amount;
                        $top->last_topup=date('Y-m-d');
                        $top->histrory_id=$model->id;
                        $top->active_balance=$model->amount;
                      }else{
                        $current_active_balance=$top->active_balance;
                        $top->active_balance=$current_active_balance+$model->amount;
                        $top->amount=$model->amount;
                        $top->last_topup=date('Y-m-d');
                        $top->histrory_id=$model->id;
                      }
                      $top->save();
                      DB::commit();

                       $message="Hello ".$model->agent->user->name." ,".$model->amount." has been debitedto your Bulk SMS and Email Account .You new Balance is ".$top->active_balance;
                        Helper::send($model->agent->telephone,$message);
                        Session::flash("success_msg","Amount Debitted Successfully");
                        return redirect("/backend/sms/index/approve");

                      }catch(\Exception $e){
                     Helper::sendEmailToSupport($e);
                    session::flash("danger_msg","An error occured while processing your request.System Developer notified ");
                    return redirect()->back();

                   }
                 }
     }else{
        Session::flash("danger_msg","Access Denied.You Do Not have necessary conditions to perform this action");
        return redirect()->back();
       }
    }


    public function RejectPurchase($id,Request $request){
      if(Entrust::hasRole("Admin")){
        $model=TopupHistrory::find($id);
         if(!$model){
         return "Resource Not Found";
         }
          if($request->isMethod("post")){
             $data=$request->all();
              try{
                $model->reason=$data['reason'];
                $model->status="Rejected";
               $model->save();
                  $message="Hello ".$model->agent->user->name."The last Transaction sent(".$model->transaction_code.") of KES ".$model->amount." has been rejected because of the following reason :".$model->reason;;

                        Helper::send($model->agent->telephone,$message);
                        Session::flash("success_msg","Transaction Rejected Successfully");
                        return redirect("/backend/sms/index/approve");


                 }catch(\Exception $e){
                  Helper::sendEmailToSupport($e);
                    session::flash("danger_msg","An error occured while processing your request.System Developer notified ");
                    return redirect()->back();

                 }
               
          }




        $data['url']=$reject_url=url('/backend/providers/top_reject/'.$model->id);
        $data['model']=$model;
         return view('backend::message._reject',$data);




      }else{
        Session::flash("danger_msg","Access Denied.You Do Not have necessary conditions to perform this action");
        return redirect()->back();

      }

    }



    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        if(Entrust::hasRole("Provider") && Helper::testModule("SMS and Bulk Emails Module",Auth::User()->getProvider->id))
          {
            $data['page_title']="Bulk SMS and Emails";
            $provider_id=Auth::User()->getProvider->id;

            if($request->isMethod("post")){
                $data=$request->all();
                
                 
                  $action=$data['action'];
                    switch ($action) {
                        case 'Schedule':

                           $test=Helper::ScheduleMessage($data);
                            if($test===true){
                                Session::flash("success_msg","Items Scheduled to be send Successfully");
                            }else{
                                Session::flash("danger_msg","Items Failed to be Scheduled");
                            }
                        
                        default:
                           $send=Sms::sendSms($data);
                           Session::flash("success_msg","Message Sent Successfully");
                    }
                  
                  return redirect()->back();



            }






            $data['groups']=ContactGroup::where(['owner_id'=>$provider_id,'owner_type'=>'Provider'])->get();
            $data['model']=new Message();
            $data['url']=url('/backend/message/sent/create');
            $owner_id=Auth::User()->getProvider->id;
         $top=Topup::where(['owner_type'=>'Provider','owner_id'=>$owner_id])->first();
         $balance=($top)?$top->active_balance:0;
          $data['groups_count']=ContactGroup::where(['owner_id'=>$provider_id,'owner_type'=>'Provider'])->count();
          $data['year_total']=Message::where(['type_id'=>$provider_id,'type'=>'Provider'])
                             ->whereYear('created_at',date('Y'))
                              ->sum('mesage_size');
        $data['month_spending']=Message::where(['type_id'=>$provider_id,'type'=>'Provider'])
                             ->whereMonth('created_at',date('m'))
                              ->sum('mesage_size');

     $data['contact_count']=Contact::join('bulk_groups','bulk_groups.id','=','contacts.group_id')
                ->where(['bulk_groups.owner_id'=>$provider_id])
                ->count();
            $data['balance']=$balance;

            return view('backend::message.create',$data);
        }else{
             return view("forbidden");
        }
    }

    public function calculateMessage($count,Request $request){
         $data=$request->all();
           if(isset($data)){
            $data=$data['data'];

             
              $contact_count=0;
              foreach($data as $key){
                 $name=$key['name'];

                   if($name=="group_id[]"){
                     if(isset($key['value'])){
                         $new_count=Contact::where(['group_id'=>$key['value']])->count();
                     $contact_count=$contact_count+$new_count;

                     }
                   
                     

                   }
              }

               $owner_id=Auth::User()->getProvider->id;
               $cost=$contact_count*$count;
            $top=Topup::where(['owner_type'=>'Provider','owner_id'=>$owner_id])->first();
             $action=($top->active_balance>=$cost)? 'Show':'Hide';
             
               $return_data=array('total_contacts'=>$contact_count,
                                   'total_cost'=>'KES: '.$contact_count*$count,
                                   'message_count'=>$count,
                                   'current_balance'=>$top->active_balance,
                                   'action'=>$action,
                                  );

               return json_encode($return_data);
           }
          

    }



    public function getScheduledMails(){

        if(Entrust::hasRole("Provider") && Helper::testModule("SMS and Bulk Emails Module",Auth::User()->getProvider->id))
          {
             $data['page_title']="Bulk SMS and Emails";

            return view('backend::message.schedule',$data);

          }else{
            return view("forbidden");
          }

    }



    public function fetchScedukle(){

        $owner_id=Auth::User()->getProvider->id;
              
        $models=SMessage::where(['owner_type'=>'Provider','owner_id'=>$owner_id]);
       return Datatables::of($models)->make(true);
           

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
}
