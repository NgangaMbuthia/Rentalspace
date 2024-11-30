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
use Modules\Site\Entities\ServiceProvider;
use Validator;
use Redirect;
use Modules\Tenants\Entities\RepairRequest;


class ServiceProvidersController extends Controller
{

      public function __construct()
    {
        $this->middleware('auth');
    }

     public function home(){
        $data['page_title']="Unuuthorize Provider";
        return view('serviceproviders::_authorised',$data);

     }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    { if(Entrust::hasRole("Admin")){

        return view('serviceproviders::index');
    }else{
        return view("forbidden");
    }
    }

    public function provodersList(){
         if(Entrust::hasRole("Admin")){
            $data['page_title']="Service Providers";

            return view('serviceproviders::index',$data);



         }else{
            return view("forbidden");
         }
    }


    public function CreateJobRequest($id){
        if(Entrust::hasRole("Provider")){
        $model=RepairRequest::find($id);
         if(!$model){
         return "No Repair Request Found with The Provider ID";
         }
          $data['url']=url('/serviceproviders/job_requests/create/'.$model->id);
          $data['model']=$model;
          return view('serviceproviders::jobs.create_request',$data);
             



        }
        else{
            return view("forbidden");
         }
         

    }


    public function fetchProviders(){
        $models=ServiceProvider::join('users','users.id','=','service_providers.user_id')
                ->join('profiles','profiles.user_id','=','users.id')
                ->select(['users.name','profiles.id_number','profiles.telephone','service_providers.location','service_providers.town','service_providers.type',
                    'service_providers.status','service_providers.id']);
        return Datatables::of($models)
        ->editColumn('status',function($model){
            if($model->status=="Pending"){
            return '<label class="label label-info">'.$model->status.'</label>';
            }
            if($model->status=="Approved"){
            return '<label class="label label-success">'.$model->status.'</label>';
            }
            else{
               return '<label class="label label-danger">'.$model->status.'</label>';     
            }




        })
        ->addColumn('action',function($model){
             if($model->status=="Pending"){
                $approve_url=url('/serviceproviders/providers/approve/'.$model->id);
                $reject_url=url('/serviceproviders/providers/other/reject/'.$model->id);
                    return '  <div class="dropdown">
                      <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Action
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="'.$approve_url.'">Approve</a></li>
                        <li data-url="'.$reject_url.'" class="reject-modal" data-title="Reason For Rejecting"><a href="#">Reject</a></li>
                        
                      </ul>
                    </div> ';
                }else if($model->status=="Approved"){
                    $reject_url=url('/serviceproviders/providers/other/suspend/'.$model->id);
                        return '
                        <div class="dropdown">
                          <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Action
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li data-url="'.$reject_url.'" class="reject-modal" data-title="Reason For Suspending"><a href="#">Suspend</a></li>
                            </ul>
                        </div> 
                        ';
                }else{
                    $approve_url=url('/serviceproviders/providers/approve/'.$model->id);
                    return '
                        <div class="dropdown">
                          <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Action
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                             <li><a href="'.$approve_url.'">Reinstate</a></li>
                            </ul>
                        </div> 
                        ';

                }
        
        
        })->make(true);


    }

    public function approveProvider($id){
        if(Entrust::hasRole("Admin")){
            $model=ServiceProvider::find($id);
            $model->service_code=substr(number_format(time() * rand(),0,'',''),0,6);;
            $model->status="Approved";
            $model->save();
            $message="Dear ".$model->user->name." Your account has been approved at qooetu.com .You Service Code is :".$model->service_code .' Kindly Note.You will require this Code  whenever you want to request payment on this platform.It should be safe guarded';
            Helper::send($model->user->profile->telephone,$message);
            Session::flash('success_msg',"Account Approved successfully");
            return redirect('/serviceproviders/providers/index');




        }else{
            Session::flash("danger_msg","Access Denied.You do not have necessary permission to perform this task");
            return view("forbidden");
        }


    }


    public function editDetails(Request $request){
         try{
             DB::beginTransaction();
            $data=$request->all();
         $user=Auth::User();
         $user->name=$data['name'];
         $user->email=$data['email'];
         $user->save();
         $profile=$user->profile;
         $profile->city=$data['city'];
         $profile->postal_address=$data['postal_address'];
         $profile->id_number=$data['id_number'];
         $profile->telephone=Helper::processNumber($data['telephone']);
         $profile->country=$data['country'];
         $profile->status="Compelete";
         $profile->save();
      


         $model=$user->sprovider;
         $model->type=strtoupper($data['type']);
         $model->current_nationality=ucwords($data['country']);
         $model->town=ucwords($data['city']);
         $model->first_ref=ucwords($data['first_ref']);
         $model->ref_one_phone=Helper::processNumber($data['ref_one_phone']);
         $model->second_ref=ucwords($data['second_ref']);
         $model->ref_two_phone=Helper::processNumber($data['ref_two_phone']);
         $model->qualification=ucwords($data['qualification']);
         $model->institution=ucwords($data['institution']);
         $model->years=$data['years'];

         $model->daily_price=$data['daily_price'];
         $model->payment_frequency=$data['payment_frequency'];
         if(isset($data['scanned_id']) && !empty($data['scanned_id'])){
             $model->scanned_id=$this->processImage($data['scanned_id'],"scanned_id");
         }
         if(isset($data['good_conduct']) && !empty($data['good_conduct'])){
            $model->good_conduct=$this->processImage($data['good_conduct'],"good_conduct"); 
         }
        
        
         $model->save();
         DB::commit();
         Session::flash('success_msg','Details submittd successfully');
         return redirect()->back();
            


         }catch(\Exception $e){
            Helper::sendEmailToSupport($e);
         }
        

    }

     private function processImage($photo,$name){

          $model=Auth::User()->sprovider;
    $id=Auth::User()->id;
    $file = array('image' => $photo);
    $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
    $validator = Validator::make($file, $rules);
    if ($validator->fails()) {
      // send back to the page with the input data and errors
      return redirect()->back()->withInput()->withErrors($validator);
    }
    else {
     // checking file is valid.
      if ($photo->isValid()) {

      $paths= base_path() . '/storage/uploads/ids/';
     $destinationPath = base_path() . '/storage/';; // upload path
        $extension = $photo->getClientOriginalExtension(); // getting 
        $fileName =$model->user_id.'_'.$name.'.'.$extension; // renameing image
         
        //dd($model->photo_image_passport);
        @unlink(storage_path($model->name));
      $photo->move($destinationPath, $fileName); // uploading file to 
        $name= $fileName;
       return $name;
       }
      else {
        return redirect()->back()->with('msg','File is Not valis');
      }
    }


     }

     public function updateDetails(){
        if(Entrust::hasRole("serviceProvider")){
            $data['page_title']="Edit Profile Details";
                return view('dashboards.account_wizard',$data);
            }else{
                return view("forbidden");
            }

     }

     public function otherActions($action,$id,Request $request){
         if(Entrust::hasRole("Admin")){
             $data['action']=$action;
             $perm=$action;
            $model=ServiceProvider::find($id);
             if(!$model){
                return "Resource Not Found";
             }
               if($request->isMethod('post')){
                $data=$request->all();
                try{
                     
                    $model->reason=$data['reason'];
                    $perm=$data['action'];


                  if($perm=="reject"){
                    $model->status="Rejected";
                    $message="Dear ".$model->user->name." Your application for using the qooetu platform has been rejected because of the following reason :".$model->reason." Contact Us for more details";
                  }else{
                    $model->status="Suspended";
                    $message="Dear ".$model->user->name." Your application for using the qooetu platform has been Suspended because of the following reason :".$model->reason." Contact Us for more details";
                  }
                  $model->save();
                   
                  Helper::send($model->user->profile->telephone,$message);
                  Session::flash("success_msg","Account ".$model->status." successfully");

                  return redirect()->back();


                }catch(\Exception $e){
                    Helper::sendEmailToSupport($e);
                    session::flash("danger_msg","An error occured while processing your request.System Developer notified ");

                  return redirect()->back();

                }
                 


               }







             $data['url']=url('/serviceproviders/providers/other/reject/'.$model->id);
             $data['model']=$model;

              return view('serviceproviders::_reject',$data);







         }else{
            return "Forbidden";
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
