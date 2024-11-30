<?php namespace Modules\Usermanagement\Http\Controllers;
use App\Http\Controllers\Controller ;
use Entrust;
use Auth;

use Modules\UserManagement\Entities\Role;
use Modules\UserManagement\Entities\Profile;
use App\Events\UserRegisterEvent;
use App\Events\UserCompanyRegisterEvent;
use Session;
use Illuminate\Support\Facades\Input;
use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;
use Modules\Company\Entities\Company;
use Modules\Company\Entities\CompanyUser;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\SystemModule;
use App\Helpers\Helper;
use App\Messaging;


class userController extends Controller {


	 public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index(){	
		if(Auth::check()){
			if(Entrust::hasRole('Admin')){
			
			$data['roles']=Role::orderBy('name')->get();
			$data['page_title']="User Management";
			return view('usermanagement::users.viewuser',$data);
			}else{
				return view('forbiden');
			}
		}else{
		return redirect('login');
		}
	}
	public function add_user(){
		if(Auth::check()){
			if(Entrust::hasRole('Admin')){
		
			$role=Role::orderBy('name')->get();
			$data['roles']=$role;
      $data['company']=Role::where('name','Provider')->first();
			$data['page_title']="User Management";
			return view('usermanagement::users.adduser',$data);
		
		}else{
			return view('forbiden');
		}
		}else{
			return redirect('login');
		}
	}

  public function fetchModules(){
    if(Entrust::hasRole("Admin")){
      $models=SystemModule::where('id','>',0);
      return Datatables::of($models)->make(true);



    }else{
      return redirect('login');
    }

  }
     


	public function store(Request $param){

    $this->validate($param, [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);
     
   if(Entrust::hasRole("Admin")){
    $data=$param->request->all();
    DB::beginTransaction();
    $user=new User();
		$user->name=$data['name'];
		$user->email=$data['email'];
		$user->password=$data['password'];
		$user->verification_code=str_random(8);
		$user->confirmed_at=date('Y-m-d H:i:s');
    $user->provider="Manual";
    $model=$user->save();
        if($model){
    $test=$this->verifyRole($data,$user);
    if($test===true){
      $user->roles()->attach($data['role']);
      event(new UserRegisterEvent($user));
      DB::commit();
      Session::flash('success_msg','User added successfully');

    }

else{

     DB::rollback();
    }
		
		return redirect()->back();
     }else{
		 	 return redirect()->back()->withErrors($model->errors);
		  }
    }else{
     	return view('forbiden');
     }
		}

    private function  verifyRole($data,$user){
       
       $role=$data['role'];
       $provider_id=Role::where(['name'=>'Provider'])->first()->id;
        if($provider_id==$role){
          $company=new Company();
           $company_data=array('company_name'=>$data['company_name'],
                          'company_taxno'=>$data['company_taxno'],
                          'company_phone'=>$data['company_taxno'],
                           'type'=>$data['type'],
                          );


          
        if($company->validate($company_data)){
          $mymodel=company::create($company_data);
          event(new UserCompanyRegisterEvent($user,$mymodel));
          return true;

            }else{
              return redirect()->back()->withInput()->withErrors($company_data);
            }
           }else{
          return true;
            }
      }
	
	Public function edit($id){
		if(Auth::check()){
			$model=User::find($id);
			$roles=Role::all();
			$data['roles']=$roles;
      $data['page_title']="User Management";
			$data['model']=$model;
			return view('usermanagement::users.update',$data);
		}else{
			return redirect('login');
		}
	}
	
	Public function update($id){
		$model=User::find($id);
		$model->name=Input::get('name');
		$model->email=Input::get('email');
		$role_id=Input::get('role');
		$model->detachRoles($model->roles);
		$model->roles()->attach($role_id);
		
		$model->save();
		Session::flash('success_msg','User details updated successfully');
		return redirect('admin/user/viewuser');
	}
	Public function view($id){
     if(Entrust::hasRole("Admin")){
      $user=User::find($id);
    $name=$user->name;
    $data['user']=$user;
    $data['page_title']="User Management";
    return view('usermanagement::users.view',$data);

     }else if($id==\Auth::User()->id){
    $user=User::find($id);
    $name=$user->name;
    $data['user']=$user;
    $data['page_title']="User Management";
    return view('usermanagement::users.view',$data);

     }else{
      Session::flash('danger_msg','Access Denied');
      return view('forbiden');
     }
		
		
	}

function fetch_users(Request $request){

	  $posts = User::join('profiles', 'profiles.user_id', '=', 'users.id')
         ->join('role_user','role_user.user_id','=','users.id')
         ->join('roles','roles.id','=','role_user.role_id')
            ->select([ 'users.id as rownum','users.email','users.id','users.created_at','users.created_at as mydate', 'users.name as name',  'profiles.gender','roles.display_name','roles.name as role_name','users.status as mystatus','users.status' ,'profiles.telephone','users.status as block_status','verification_code']);
             
         return Datatables::of($posts)->editColumn('name', '{!! str_limit($name, 60) !!}')
            
             ->editColumn('status', function ($model) {
               if($model->status=="Active"){
                 return '<label class="label label-info">'.$model->status.'</label>';

               }else{
                return '<label class="label label-warning">'.$model->status.'</label>';
               }

                
            })
            ->addColumn('action', function ($model) {
                return  (($model->status)=='Active') ? '<a href="'.url('/admin/user/block/'.$model->id).'" class="btn-xs btn-success">Block</a>' : '<a href="'.url('/admin/user/unblock/'.$model->id).'" class="btn-xs btn-danger">Unblock</a>';
            })

                

            ->make(true);
        }
        public function get_statistics($year){
        	if(Entrust::hasRole("Admin")){
        		$data['page_title']="User Management";
        		$data['model']=new Role();
        		$data['months']=$this->getMonths();
        		$data['roles']=Role::orderBy('name')->get();
        		$data['year']=$year;
        		$data['years']=$this->getYears();

        		return view('usermanagement::users.statistics',$data);

        	}else{
        		Session::flash('danger_msg','Access Denied');
        		return view('forbiden');
        	}
        }

        public function getMonths(){
        	$data=array('01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>
        		'Nov','12'=>'Dec');
        	return $data;
        }

        public function getYears(){
        $years=User::orderBy('created_at','asc')
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

            return $mwaka;
       }

       public function block_user($status,$id){
       	 if(Entrust::hasRole("Admin")){
       	 	$allowed_status=array("block","unblock");
       	 	 if(!in_array($status, $allowed_status)){
       	 	 	
            Session::flash('danger_msg','Specified Action Not Allowed');
                return redirect('/home');
       	 	 }
       	 	if($status=="block"){
       	 		$action="Blocked";
       	 		$message="User Account Blocked Successfully";
       	 	}else{
       	 		$action="Active";
       	 		$message="User Account Activate Successfully";
             }
             if(Auth::User()->id==$id){
             	Session::flash('danger_msg','You Cannot Block Your own Account');
                return redirect('/admin/user/viewuser');
             }
             $model=User::find($id);
               if($model){
               	$model->status=$action;
               	$model->save();
               		Session::flash('success_msg',$message);
                return redirect('/admin/user/viewuser');

               }


       	 }else{
       	 	return view('forbiden');
       	 }
       }

       public function update_profile(){
       	if(Entrust::can("access-backend")){
       	$data['page_title']="User Management";
        $data['user']=Auth::User();
        $data['profile']=Auth::User()->profile();
        
        return view('usermanagement::profiles.update',$data);

       	}else{
       		return view('forbiden');
       	}
       }


       public function update_profile_store(Request $request){
       	 $data=$request->all();
         if(isset($data['avatar']))
         {
          $upload=Helper::uploadFile2($data);
           if($upload){
            $user_data=array('avatar'=>$upload->id,'name'=>$data['name'],'email'=>$data['email']);

           }else{
            $user_data=array('name'=>$data['name'],'email'=>$data['email']);
           }
           
         }else{
           $user_data=array('name'=>$data['name'],'email'=>$data['email']);
         }
          
           



       	 
       	  $profile_data=array('id_number'=>$data['id_number'],'telephone'=>Helper::processNumber($data['telephone']),'gender'=>$data['gender'],'postal_address'=>$data['postal_address'],'country'=>$data['country'],'city'=>$data['city'],'timezone'=>'Africa/Nairobi','status'=>'Compelete');
       	   $model=Auth::User();
       	   $model->update($user_data);
           $model->profile->update($profile_data);
           $message=new Messaging();
           $message->receiver_id=Auth::User()->id;
           $message->sender_id=Auth::User()->id;
           $message->subject="Profile Updated";
           $message->content="Your Profile details have been updated Successfully";
           $message->flag="notification";
           $message->key=strtoupper(str_random(8));
           $message->save();







       	   Session::flash('success_msg','Profile details update successfully');
       	   return redirect('/home');

       }
}