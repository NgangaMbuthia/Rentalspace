<?php

namespace Modules\ServiceProviders\Http\Controllers;

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
use Modules\ServiceProviders\Entities\JobRequest;
use Modules\ServiceProviders\Http\Middleware\ApprovalMiddle;

class JobController extends Controller
{


       public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(ApprovalMiddle::class);
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {  if(Entrust::hasRole("serviceProvider")){
        $data['page_title']="Job Requests";
        $data['status']=(isset($_GET['status']))? $_GET['status']:'All';


        return view('serviceproviders::jobs.index',$data);
      }else{
        return view("forbidden");
      }


    }


    public function fetchJobRequests($status){
         if($status=="All"){
         $models =JobRequest::join('users','users.id','=','job_requests.client_user_id')
                  ->join('properties','properties.id','=','job_requests.property_id')
                  ->join('service_providers','service_providers.id','=','job_requests.provider_id')
                   ->join('profiles','users.id','=','profiles.user_id')
                   ->select(['job_requests.id','properties.title','users.name','profiles.telephone','properties.location','job_requests.status','job_requests.request_close_date','job_requests.created_at'])
                  ->where(['service_providers.user_id'=>\Auth::user()->id])->get();


         }else{
             $models =JobRequest::join('users','users.id','=','job_requests.client_user_id')
                  ->join('profiles','users.id','=','profiles.user_id')
                  ->join('properties','properties.id','=','job_requests.property_id')
                  ->join('service_providers','service_providers.id','=','job_requests.provider_id')
                  ->select(['job_requests.id','properties.title','users.name','profiles.telephone','properties.location','job_requests.status','job_requests.request_close_date','job_requests.created_at'])
                  ->where('job_requests.status',$status)
                  ->where(['service_providers.user_id'=>\Auth::user()->id]);

         }

         
          return Datatables::of($models)
          ->editColumn('status',function($model){
             if($model->status=="Pending"){
                return '<label class="label label-warning">'.$model->status.'</label>';
             }
             if($model->status=="Completed"){
                return '<label class="label label-success">'.$model->status.'</label>';
             }
             if($model->status=="Approved"){
                return '<label class="label label-primary">'.$model->status.'</label>';
             }

              if($model->status=="Suspended"){
                return '<label class="label label-danger">'.$model->status.'</label>';
             }else{
                 return '<label class="label label-info">'.$model->status.'</label>';
             }



          })
          ->addColumn('action',function($model){
             if($model->status=="Pending"){
                $approve_url=url('/serviceproviders/job/response/Approve/'.$model->id);
                  $reject_url=url('/serviceproviders/job/response/Reject/'.$model->id);

                return '<a href="'.$approve_url.'" class="btn btn-xs btn-primary">Approve</a>
                 <a data-url="'.$reject_url.'" class="btn btn-xs btn-danger reject-modal" data-title="Reason For Rejecting">Reject</a>';
             }
             if($model->status=="Approved"){
                $cancel_url=url('/serviceproviders/job/cancel_response/'.$model->id);

                return '<a data-url="'.$cancel_url.'" class="btn btn-xs btn-warning reject-modal" data-title="Reason For cancelling This Job">Cancel</a>';

             }else{
                return "<button class='btn btn-xs btn-info'>No Action</button>";
             }






          })->make(true);

    }


    public function closejobRequests($action,$id,Request $request){
         if($action=="Approve"){
            $provider_id=\Auth::user()->sprovider->id;
            $model=JobRequest::where(['provider_id'=>$provider_id,'id'=>$id])->first();
             $model->status="Approved";
             $model->service_number=substr(number_format(time() * rand(),0,'',''),0,6);
             $model->save();
             $user=User::find($model->client_user_id);
             $telephone=$user->profile->telephone;
             $message="Dear ".$user->name." ,".Auth::user()->name."has accepted to take requested job.The job Service Number is ".$model->service_number.".Kindly get in tourch with him/her.Ensure the job is completed before you release the money";
             Helper::send($telephone,$message);
             Session::flash("success_msg","Job Approved Successfully and Client Notified");
             return redirect()->back();
           }else{


            $provider_id=\Auth::user()->sprovider->id;
            $model=JobRequest::where(['provider_id'=>$provider_id,'id'=>$id])->first();
              if($request->isMethod("post")){
              $data=$request->all();
              $model->reason=$data['reason'];
                 $model->status="Rejected";
                 $model->save();
                 $user=User::find($model->client_user_id);
             $telephone=$user->profile->telephone;
             $message="Dear ".$user->name." ,".Auth::user()->name." has rejected the requested job because of the following reason : ".$data['reason'];
             Helper::send($telephone,$message);
             Session::flash("success_msg","Job Rejected Successfully and Client Notified");
             return redirect()->back();

              }

              $data['url']=url('/serviceproviders/job/response/Reject/'.$model->id);
             $data['model']=$model;

             return view('serviceproviders::jobs._cancel',$data);










           }

    }


    public function cancelJob($id,Request $request){
         if(Entrust::hasRole("serviceProvider")){
            $provider_id=\Auth::user()->sprovider->id;
            $model=JobRequest::where(['provider_id'=>$provider_id,'id'=>$id])->first();

             if(!$model){
                return "Resource Not Found On Our Server";
             }


             if($request->isMethod("post")){
                $data=$request->all();
                 $model->reason=$data['reason'];
                 $model->status="Suspended";
                 $model->save();
                 $user=User::find($model->client_user_id);
             $telephone=$user->profile->telephone;
             $message="Dear ".$user->name." ,".Auth::user()->name." has cancelled the requested job because of the following reason : ".$data['reason'];
             Helper::send($telephone,$message);
             Session::flash("success_msg","Job Cancelled Successfully and Client Notified");
             return redirect()->back();



             }
             $data['url']=url('/serviceproviders/job/cancel_response/'.$model->id);
             $data['model']=$model;

             return view('serviceproviders::jobs._cancel',$data);


            
         }else{
            return "Access Denied";
         }

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('serviceproviders::create');
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
        return view('serviceproviders::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('serviceproviders::edit');
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
