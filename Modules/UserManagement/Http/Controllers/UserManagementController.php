<?php namespace Modules\Usermanagement\Http\Controllers;

use Illuminate\Routing\Controller;
use Entrust;
use Auth;
use Illuminate\Http\Request;
use Modules\UserManagement\Entities\Role;
use Session;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use Modules\UserManagement\Entities\Permission;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Assignement;


class UserManagementController extends Controller {
	
	  public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index(){
		
			if(Entrust::hasRole('Admin')){
				$role=Role::orderBy('name')->get();
				$data['roles']=$role;
				$data['page_title']="System Roles";

				return view('usermanagement::roles.index',$data);	
			}else{
				return view('forbiden');
			}
		
	}
	public function create_role(){
	if(Auth::check()){
	if(Entrust::hasRole('Admin')){
				$data['permissions']=Permission::all();
				 
				$data['page_title']="User Management";
				return view('usermanagement::roles.create',$data);
			
			}else{
				return view('forbiden');
			}
		}else{
			return redirect('login');
		}
	
	}
	public function store(Request $param){
		
				
		if(Auth::check()){
         if(Entrust::hasRole('Admin')){

				$data=$param->request->all();


						 $v = Validator::make($data, [
							'name'=>'required|unique:roles',
							'display_name'=>'required'
							]);

				        // check for failure
				        if ($v->fails())
				        {
				          // set errors and return false
				            $this->errors = $v->errors();
				            //$this->setErrors($v->messages());
				            return false;
				        }
                $role=new Role();
				$role_data=array('name'=>$data['name'],'display_name'=>$data['display_name'],'description'=>$data['description']);
				$model=$role::create($role_data);
				 if(isset($data['permission'])){
				 	$permission=$data['permission'];
				 	$model->attachPermissions($permission);
				 }
				
				
			
				Session::flash('success_msg','Role added successfully');
				 return redirect()->back();
				}else{
					return view('forbiden');
				}
			}else{
				return redirect('login');
		}	
	}
	public function viewprofile()
	{	
		$model=Auth::User();
		$data['model']=$model;
		return view('usermanagement::profiles.index',$data);	
	}
	Public function edit($id){
		$model=Role::find($id);
		$data['model']=$model;
		return view('usermanagement::roles.edit',$data);	
	}

	public function editRole(Request $request,$id){
		 if(Entrust::hasRole("Admin")){
		 	$role=Role::find($id);
		 	 if(!$role){
		 	 	return "Resource Not Found";
		 	 }
		 	 $role_permission=Assignement::where(['role_id'=>$role->id])->get();
		 
		 	  if($request->isMethod("post")){
		 	  	$data=$request->all();
		 	  	$role->display_name=$data['display_name'];
		 	  	$role_description=$data['description'];
		 	  	$role->save();
		 	  	$permissions=$data['permission'];
		 	  	 foreach($role_permission as $key){
		 	  	 	$key->delete();
		 	  	 }

		 	  	 foreach($permissions as $key=>$value){
		 	  	 	$model=new Assignement();
		 	  	 	$model->role_id=$role->id;
		 	  	 	$model->permission_id=$value;
		 	  	 	$model->save();
                   }
                   Session::flash("success_msg","Role Permissions updated successfully");
                   return redirect()->back();
		 	  	 
		 	  	}

		 	  
            $data['model']=$role;
		 	$data['url']=url()->current();
		 	$data['available_permissions']=Permission::all();
		 	$role_list=array();
		 	foreach($role_permission as $role){
		 		$role_list[]=$role->permission_id;
		 	}
		 	 $data['my_perms']=$role_list;
		 	 return view('usermanagement::roles._edit',$data);




		 }else{
		 	return "Access Denied.";
		 }

	}





	Public function update($id){
		$model=Role::find($id);
		$model->name=Input::get('name');
		$model->display_name=Input::get('display_name');
		$model->description=Input::get('description');
		$model->save();
		Session::flash('success_msg','Role updated successfully');
		Return redirect('admin/role/index');	
	}
	public function upload() {
    $id=Input::get('profilepic');
    
    // getting all of the post data
    $file = array('image' => Input::file('profilepic'));
    // setting up rules
    $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
    // doing the validation, passing post data, rules and the messages
    $validator = Validator::make($file, $rules);
    if ($validator->fails()) {
      // send back to the page with the input data and errors
      return Redirect::to('admin/profile/index')->withInput()->withErrors($validator);
    }
    else {
      // checking file is valid.
      if (Input::file('profilepic')->isValid()) {
        $destinationPath = 'uploads'; // upload path
        $extension = Input::file('profilepic')->getClientOriginalExtension(); // getting image extension
        $fileName = rand(11111,99999).'.'.$extension; // renameing image
        Input::file('profilepic')->move($destinationPath, $fileName); // uploading file to given path
        // sending back with message
        $name= $fileName;
        
       $model=Auth::User()->profile;
       $model->photo=$name;
       if($model->save()){
        session::flash('success_msg','Details Updated successfully');
         return redirect()->back()->with('msg','Image Upload Successful');
       }
          
      }
      else {
        // sending back with error message.
        
        return redirect()->back()->with('msg','File is Not valis');
      }
    }
  }

  public function fetch_roles(){
  	 	  $posts = Role::select(['id', 'name', 'description', 'display_name', 'created_at', 'updated_at', \DB::raw('count(role_user.user_id) as count'),])->orderBy('created_at','desc')->join('role_user','roles.id','=','role_user.role_id')->groupBy('role_user.role_id','display_name','name','id','created_at','description','updated_at');
    return Datatables::of($posts) 
            ->editColumn('name', '{!! str_limit($name, 60) !!}')
            ->editColumn('display_name', function ($model) {
                return '<label title="'.$model->description.'">'.$model->display_name.'</label>';
            })
            ->addColumn('action', function ($model) {
            	$edit_url=url('/admin/roles/edit/'.$model->id);
                return "<a class='reject-modal' data-url='".$edit_url."' style='margin-left:20%;' data-title='Edit Role Permissions' ><span class='icon-pencil'></span></a>
                    <a href='audit?id=$model->id&type=App\Profile'><span class='fa fa-line-chart'></span></a>
                   

                ";
            })

            ->make(true);
          
  }

}