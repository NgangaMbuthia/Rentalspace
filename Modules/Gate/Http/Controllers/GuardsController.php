<?php

namespace Modules\Gate\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Entrust;
use Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;
use Modules\Gate\Entities\Gate;
use Modules\Gate\Entities\GateGaurd;
use Modules\Gate\Entities\GateAssignment;
use Modules\Backend\Entities\Property;
use App\User;
use Modules\UserManagement\Entities\Role;
use Modules\UserManagement\Entities\Profile;
use App\Http\Middleware\AccountSetUp;
class GuardsController extends Controller
{
    
         public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AccountSetUp::class);

    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(Entrust::hasRole("Provider") || Entrust::hasRole("Admin")){
            $data['page_title']="Guards Management";
            return view('gate::guards.index',$data);
        }else{
            return view("forbidden");
        }
        
    }


     public function getPropertyGates($name){
       if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
         $id=Auth::User()->getProvider->id;
         $property=Property::where(['provider_id'=>$id,'title'=>$name])->first();
            try{
              $models=Gate::where(['property_id'=>$property->id])->get();
                 echo "<option value=''></option>";
                 foreach($models as $model):
                  echo "<option value='".$model->name."'> ".$model->name."</option>";
                  endforeach;
               }catch(\Exception $e)
               {
                  Helper::sendEmailToSupport($e);
              }



       }
       else{
            return view("forbidden");
        }
      

     }



     public function findGaurds($gate){

      $id=Auth::User()->getProvider->id;
       $gate=Gate::where(['name'=>$gate])->first();
          if($gate){
        $models=GateAssignment::where(['gate_id'=>$gate->id])->get();
          try{
                echo "<option value=''></option>";
                 foreach($models as $model):
                  echo "<option value='".$model->guards->user->name."'> ".$model->guards->user->name."</option>";
                  endforeach;


          }catch(\Exception $e)
               {
                  Helper::sendEmailToSupport($e);
              }

          }




     }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
         if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
            $user=new User();

            $id=Auth::User()->getProvider->id;
            $profile=new Profile();
            $model=new GateGaurd();


             if($request->isMethod("post")){

                 $data=$request->all();
                  DB::beginTransaction();
                   try{
                   $user->name=$data['name'];
                   $user->email=$data['email'];
                   $user->password=$data['id_number'];
                   $user->provider="Manual";
                   $user->verification_code=str_random(6);
                   $user->status="Active";
                   $user->confirmed_at=date('Y-m-d H:i:s');
                   $user->save();
                    try{
                           $profile->user_id=$user->id;
                           $profile->id_number=$data['id_number'];
                           $profile->telephone=$data['telephone'];
                           $profile->postal_address=$data['postal_address'];
                           $profile->save();

                            try{

                                   $model->user_id=$user->id;
                                   $model->provider_id=$id;
                                   $model->property_id=$data['property_id'];
                                   $model->employer_name=$data['employer_name'];
                                   $model->employer_mobile=$data['employer_mobile'];
                                   $model->save();
                                    $role=Helper::FindRoleDetails('name','Guard');
                                      if($role){
                                        $user->roles()->attach($role->id);
                                        DB::commit();
                                        Session::flash("success_msg","Guard Added successfully");
                                        return redirect()->back();


                                      }
                                     DB::rollback();



                               }catch(\Exception $e){
                             Helper::sendEmailToSupport($e);
                            Session::flash("danger_msg","Error Occured while processing  Technical Team Notified");
                             return redirect()->back();

                             }


                        }
                        catch(\Exception $e){
                         Helper::sendEmailToSupport($e);
                        Session::flash("danger_msg","Error Occured while processing  Technical Team Notified");
                         return redirect()->back();

                         }


                   }catch(\Exception $e){
                     Helper::sendEmailToSupport($e);
                    Session::flash("danger_msg","Error Occured while processing  Technical Team Notified");
                     return redirect()->back();

                   }
                   
                  
                   

                




             }

            $data['page_title']="Guards Management";
            $data['url']=url('/security/guards/create');
            $data['user']=$user;
            $data['profile']=$profile;
            $data['model']=$model;
            $data['properties']=Property::where(['provider_id'=>$id])->get();

            return view('gate::guards.create',$data);
        }else{
            return view("forbidden");
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
     public function fetchGuards(){
      $models=User::join('gate_guards','users.id','=','gate_guards.user_id')
              ->join('profiles','users.id','=','profiles.user_id')
              ->join('properties','properties.id','=','gate_guards.property_id')
              ->select(['users.name','gate_guards.id','profiles.id_number','profiles.telephone','employer_mobile','employer_name','title','assignment_status']);
             
            return Datatables::of($models)
              ->addColumn('action',function($model){
                 $update_url=url('/security/guards/update/'.$model->id);
                return '<a data-url="'.$update_url.'"  data-title="Update Guard Details"   class="reject-modal glyphicon glyphicon-pencil"></a>

                    <a style="margin-left:20%;"  href="#" class="glyphicon glyphicon-trash"></a>



                  ';

              })->make(true);

     }


     public function updateGuardDetails($id,Request $request){

      if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
        $model=GateGaurd::find($id);
         if(!$model){
           return "Resource Not Found on this Server";
         }
         $user=$model->user;
         $profile=$user->profile; 
          $id=Auth::User()->getProvider->id;
           if(!$request->isMethod("get")){
              $data=$request->all();
              $user->name=$data['name'];
              $user->email=$data['email'];
              $user->save();
                 $profile->user_id=$user->id;
                 $profile->id_number=$data['id_number'];
                 $profile->telephone=$data['telephone'];
                 $profile->postal_address=$data['postal_address'];
                 $profile->save();
                   $model->user_id=$user->id;
                   $model->provider_id=$id;
                   $model->property_id=$data['property_id'];
                   $model->employer_name=$data['employer_name'];
                   $model->employer_mobile=$data['employer_mobile'];
                   $model->save();
               

               Session::flash("success_msg","Guard Details Updated successfully");
               return redirect()->back();




           }


            $data['page_title']="Guards Management";
            $data['url']=url('/security/guards/update/'.$model->id);
            $data['user']=$user;
            $data['profile']=$profile;
            $data['model']=$model;
            $data['properties']=Property::where(['provider_id'=>$id])->get();
            return view('gate::guards.create',$data);
          }else{
        return view("forbidden");
      }

     }


     public function assignments(){
       if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
           $id=Auth::User()->getProvider->id;
           $data['properties']=Property::where(['provider_id'=>$id])->get();
           $data['url']=url('/security/guards/assign');
           $data['page_title']="Assign Guards To Gates";
         return view('gate::guards.assingments',$data);

       }else{
             return view("forbidden");
          }

     }


     public function getAssignments(){
      if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
           $id=Auth::User()->getProvider->id;
           $data['properties']=Property::where(['provider_id'=>$id])->get();
           $data['page_title']="Guards Assignments";
         return view('gate::guards._index',$data);

       }else{
             return view("forbidden");
          }

     }
    public function getCurrentAssingments(){
      $id=Auth::User()->getProvider->id;
      $models=GateAssignment::join('gate_gates', 'gate_gates.id', '=', 'gate_gateassignments.gate_id')
         ->join('gate_guards','gate_guards.id','=','gate_gateassignments.guard_id')
         ->join('users','users.id','=','gate_guards.user_id')
         ->join('profiles', 'profiles.user_id', '=', 'users.id')
         ->join('properties','properties.id','=','gate_gates.property_id')
         ->select([ 'users.id as rownum','users.name','gate_gateassignments.id','profiles.id_number','properties.title','gate_gates.name as gate_name','gate_gateassignments.start_date','gate_gateassignments.end_date','gate_gateassignments.status as assign_status'])
         ->where(['properties.provider_id'=>$id])
         ;
        return Datatables::of($models)->addColumn('action',function($model){
          return true;

        })->make(true);



    }




     public function fetchAllAssignments(Request $request){

       $posts =GateAssignment::join('gate_gates', 'gate_gates.id', '=', 'gate_gateassignments.gate_id')
         ->join('gate_guards','gate_guards.id','=','gate_gateassignments.guard_id')
         ->join('users','users.id','=','gate_guards.user_id')
         ->join('profiles', 'profiles.user_id', '=', 'users.id')
         ->join('properties','properties.id','=','gate_gates.property_id')
         ->select([ 'users.id as rownum','users.email','users.id','users.created_at','users.created_at as mydate', 'users.name as name','title','gate_gates.name as gate_name','start_date','end_date','profiles.telephone'])->get();
             
         return Datatables::of($posts)
           /*->filter(function ($instance) use ($request) {
                if ($request->has('email')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['email'], $request->get('email')) ? true : false;
                    });
                }
                 if ($request->has('name')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['name'], ucwords($request->get('name'))) ? true : false;
                    });
                }
                  if ($request->has('branch_id')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['clerk'], $request->get('branch_id')) ? true : false;
                    });
                }
                if ($request->has('county')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['country'], $request->get('county')) ? true : false;
                    });
                }
                if ($request->has('date_created')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['mydate'], $request->get('date_created')) ? true : false;
                    });
                }

                if ($request->has('property')) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['title'], $request->get('property')) ? true : false;
                    });
                }
                 if ($request->has('status')) {
                   
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        return Str::contains($row['mystatus'], $request->get('status')) ? true : false;
                    });
                }
            }) */
            ->editColumn('name', '{!! str_limit($name, 60) !!}')
            ->editColumn('name', function ($model) {
                return '<a href="'.url('/admin/user/view/'.$model->id).'">'.$model->name.'</a>';
            })
             ->editColumn('block_status', function ($model) {

                return  (($model->status)=='Active') ? '<a href="'.url('/admin/user/block/'.$model->id).'" class="btn-xs btn-success">Block</a>' : '<a href="'.url('/admin/user/unblock/'.$model->id).'" class="btn-xs btn-danger">Unblock</a>';
            })
            ->addColumn('action', function ($model) {
                return "<a href='".url('/admin/user/update/'.$model->id)."' style='margin-right:10%;'><span class='glyphicon glyphicon-pencil'></span></a>

                <a href='".url('/admin/user/update/'.$model->id)."' style='margin-right:10%;'><span class='glyphicon glyphicon-trash'></span></a>
                    
                   

                ";
            })

                

            ->make(true);



     }


     public function addVisitor(){
      

     }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('gate::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('gate::edit');
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
