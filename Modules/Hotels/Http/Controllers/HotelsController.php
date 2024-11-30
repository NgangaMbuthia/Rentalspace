<?php

namespace Modules\Hotels\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller ;
use Entrust;
use Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;
use Modules\Hotels\Entities\HotelType;
use Modules\Hotels\Entities\Supplier;
use App\User;
use Modules\UserManagement\Entities\Profile;
use Modules\Hotels\Entities\RoomType;
use Modules\Hotels\Entities\BedType;
use Modules\Hotels\Entities\SupplierAmenty;
use Modules\Hotels\Entities\Hotel;
use PDF;


class HotelsController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(Entrust::hasRole("Admin")){
            $data['page_title']="Hotel Types";
          return view('hotels::hotels.type_index',$data);
        }else{
           return view('forbidden'); 
        }
        
    }

    public function suppliers(){
         if(Entrust::hasRole("Admin")){
            $data['page_title']="Supplier List";
          return view('hotels::hotels.supplier_list',$data);
        }else{
           return view('forbidden'); 
        }
        

    }

    public function getBedTypes(){
         if(Entrust::can("manage-hotel-rooms")){
            $data['page_title']="Bed Types";
            return view('hotels::hotels.bed_types',$data);
         }else{
            return view("forbidden");
         }
     }

     public function getAmentities(){

        if(Entrust::can("manage-hotel-rooms")){
            $data['page_title']="Supplier Amentities";
            return view('hotels::hotels.supplier_amentities',$data);
         }else{
            return view("forbidden");
         }

     }


    public function typeIndex(){
        if(Entrust::hasRole("Admin")){
            $data['page_title']="Hotel Types";
          return view('hotels::hotels.type_index',$data);
        }else{
           return view('forbidden'); 
        }
    }

    public function fetchHotelTypes(){
        $models=HotelType::all();
        return Datatables::of($models)->addColumn('action',function($model){
            if(Entrust::hasRole("Admin")){
              $edit_url=url("/hotels/hotel_type/update/".$model->id);
               $delete_url=url("/hotels/hotel_type/delete/".$model->id);
               $index_url=url("/hotels/hotel/types");

                $audit_url=url('/system/audit?id='.$model->id."&type=Modules\Hotels\Entities\HotelType");

            return '<a class="reject-modal" data-title="Edit Hotel Type" data-url="'.$edit_url.'"><span class="icon-pencil4 "></span></a>
                  <a data-redirect-to="'.$index_url.'"  class="delete-record" data-name="Hotel Type" data-title="Delete Role" style="margin-left:15%;" data-href="'.$delete_url.'"  data-url-to="'.$index_url.'"><span class="icon-trash"></span></a>
                  <a style="margin-left:15%;" href="'.$audit_url.'" title="Audit trail"><span class="icon-stats-growth2"></span></a>

                  ';

            }

          })->make(true);
    }


    public function fetchAmentities(){
        $models=SupplierAmenty::where(['user_id'=>auth::user()->id]);
        return Datatables::of($models)->addColumn('action',function($model){
            
              $edit_url=url("/hotels/amentity/update/".$model->id);
               $delete_url=url("/hotels/amentity/delete/".$model->id);
               $index_url=url("/hotels/amentities/index");

                $audit_url=url('/system/audit?id='.$model->id."&type=Modules\Hotels\Entities\SupplierAmenty");

            return '<a class="reject-modal" data-title="Edit Amentity" data-url="'.$edit_url.'"><span class="icon-pencil4 "></span></a>
                  <a data-redirect-to="'.$index_url.'"  class="delete-record" data-name="Amentity" data-title="Delete Role" style="margin-left:15%;" data-href="'.$delete_url.'"  data-url-to="'.$index_url.'"><span class="icon-trash"></span></a>
                  <a style="margin-left:15%;" href="'.$audit_url.'" title="Audit trail"><span class="icon-stats-growth2"></span></a>';
              })->make(true);

    }

  public function updateHotelTypes(Request $request,$id){
    if(Entrust::hasRole("Admin")){
        $model=HotelType::find($id);
          if(!$model){
          return "Resource Not Found On This Server";
          }
         if($request->isMethod("post")){
            $data=$request->all();
               try{
                $model->update($data);
                 Session::flash("success_msg","Hotel Type Details Updated Successfully");

               }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request");
               }
               return redirect()->back();
          }
          $data['model']=$model;
          $data['url']=url()->current();
        return view('hotels::hotels.type_create',$data);
      }else{
        return "Access Denied.";
    }
  }
  Public function deleteHotelType($id){
     if(Entrust::hasRole("Admin")){
         $model=HotelType::find($id);
         if($model){
             try{
                $model->delete();
                Session::flash("success_msg","Hotel Type Deleted Successfully");
              }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified about the error");
                 }

         }else{
            Session::flash("danger_msg","access Denied.Resorce not Found this Server.");
         }

     }else{
        Session::flash("danger_msg","access Denied.You do not have permission to delete this Resorce on this Server.");
     }

  }


  public function createHotelTypes(Request $request){
     if(Entrust::hasRole("Admin")){
         if($request->isMethod("post")){
            $this->validate($request,[
                'name'=>'required|unique:hotel_types',
                'description'=>'required',
                ]);
            $data=$request->all();
              try{
                $model=HotelType::create($data);
                Session::flash("success_msg","Hotel Type Details created Successfully");

              }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request");
              }
              return redirect()->back();

         }
          $data['model']=new HotelType();
          $data['url']=url()->current();
        return view('hotels::hotels.type_create',$data);




     }else{
        return "Access Denied.";
     }

  }


  public function fetchSuppliers(){
    if(Entrust::hasRole("Admin")){
        $models=Supplier::select('name','id','type','country','city','email','telephone','supplier_status');
        return Datatables::of($models)
        ->editColumn('supplier_status',function($model){
            if($model->supplier_status=="Pending"){
                return '<label class="label label-info">'.$model->supplier_status.'</label>';
            }
             elseif($model->supplier_status=="Approved"){
                return '<label class="label label-success">'.$model->supplier_status.'</label>';
            }
             elseif($model->supplier_status=="Rejected"){
                return '<label class="label label-danger">'.$model->supplier_status.'</label>';
            }else{
               return '<label class="label label-warning">'.$model->supplier_status.'</label>'; 
            }

        })
       ->addColumn('action',function($model){
          
              $edit_url=url("/hotels/supplier/update/".$model->id);
               $delete_url=url("/hotels/hotel_type/delete/".$model->id);
               $index_url=url("/hotels/hotel/types");

                $audit_url=url('/system/audit?id='.$model->id."&type=Modules\Hotels\Entities\HotelType");
       if($model->supplier_status=="Pending"){
                $approve_url=url('/hotels/suppler/approve/'.$model->id);
                $reject_url=url('/hotels/supplier/reject/'.$model->id);
                    return '  <div class="dropdown">
                      <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Action
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="'.$approve_url.'">Approve</a></li>
                        <li data-url="'.$reject_url.'" class="reject-modal" data-title="Reason For Rejecting"><a href="#">Reject</a></li>

                        <li><a data-title="Edit Supplier Details" class="reject-modal" data-url="'.$edit_url.'">Edit</a></li>
                        
                      </ul>
                    </div> ';
                }else if($model->supplier_status=="Approved"){
                    $reject_url=url('/hotels/suppler/suspend/'.$model->id);
                        return '
                        <div class="dropdown">
                          <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">Action
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li data-url="'.$reject_url.'" class="reject-modal" data-title="Reason For Suspending"><a href="#">Suspend</a></li>

                            <li><a data-title="Edit Supplier Details" class="reject-modal" data-url="'.$edit_url.'">Edit</a></li>


                            </ul>
                        </div> 
                        ';
                }else{
                    $approve_url=url('/hotels/suppler/approve/'.$model->id);
                    return '
                        <div class="dropdown ">
                          <button class="btn btn-md btn-info dropdown-toggle" type="button" data-toggle="dropdown">Action
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                             <li><a href="'.$approve_url.'">Reinstate</a></li>

                            <li><a data-title="Edit Supplier Details" class="reject-modal" data-url="'.$edit_url.'">Edit</a></li>
                            </ul>
                        </div> 
                        ';

                }
        
        
        })->make(true);

    }else{
        return view("forbidden");
    }

  }


  public function createSupplier(Request $request){
     if(Entrust::hasRole("Admin")){

         if($request->isMethod("post")){
            $data=$request->all();
            DB::beginTransaction();

             $this->validate($request,[
                'name'=>'required|string',
                'email'=>'required|email|unique:users',
                'telephone'=>'required|string',
                'tra_reg_no'=>'required|unique:service_suppliers',

                ]);
             $pass=substr(number_format(time() * rand(),0,'',''),0,6);
                $user_data=array('name'=>$data['name'],
                              'email'=>$data['email'],
                              'password'=>$pass,
                              'verification_code'=>substr(number_format(time() * rand(),0,'',''),0,6),
                              'provider'=>'manual',
                              'social'=>0,
                              );
             
            $user=User::create($user_data);
             if($user){
                $profile_data=array('user_id'=>$user->id,
                            'city'=>$data['city'],
                            'country'=>$data['country'],
                            'postal_address'=>$data['postal_address'],
                            'telephone'=>Helper::processNumber($data['telephone']),
                            'status'=>'Incomplete');
          $profile=Profile::create($profile_data);
          $role=Helper::FindRoleDetails('name',$data['type']);
          $user->roles()->attach($role->id);
          $model_data=array('user_id'=>$user->id,
                            'name'=>$user->name,
                            'tra_reg_no'=>$data['tra_reg_no'],
                            'country'=>ucfirst($data['country']),
                            'city'=>ucfirst($data['city']),
                            'postal_address'=>$data['postal_address'],
                            'box'=>$data['box'],
                            'supplier_code'=>$pass,
                            'email'=>$user->email,
                            'supplier_status'=>"Approved",
                            'extranet'=>str_slug($user->name,'-'),
                            'telephone'=>Helper::processNumber($data['telephone']),
                            'type'=>$data['type'],

                            );
            $model=Supplier::create($model_data);

             if($model->type=="Hotel"){
                $hotel=new Hotel();
                $hotel->supplier_id=$model->id;
                $hotel->hotel_name=$model->name;
                $hotel->hotel_code=$pass;
                $hotel->hotel_telephone=$model->telephone;
                $hotel->hotel_email=$model->email;
                $hotel->hotel_city=$model->city;
                $hotel->hotel_country=$model->country;
                $hotel->postal_address=$model->box." ".$model->postal_address;
               $hotel->tra_reg_no=$model->tra_reg_no;
               $hotel->hotel_status="Approved";
               $hotel->save();

             }



             


              DB::commit();
                   Session::flash('success_msg','Supplier added successfully')   ;
                   return redirect()->back();



             }

            }
        $data['model']=new Supplier();
        $data['url']=url()->current();
        $data['user']=new User();
          return view('hotels::hotels.supplier_create',$data);


     }else{
        return "<h3 style='color:red'>Access Denied.You do not have permission to access this functionality</h3>";
     }


  }

  public function updateSupplier($id,Request $request){
    if(Entrust::hasRole("Admin")){
        $model=Supplier::find($id);
          if($request->isMethod("post")){
            $data=$request->all();
            DB::beginTransaction();
              $user=$model->user;
           
                $user_data=array('name'=>$data['name'],
                              'email'=>$data['email'],
                              'provider'=>'manual',
                              'social'=>0,
                              );
             
            $user->update($user_data);
             if($user){
                $profile_data=array('user_id'=>$user->id,
                            'city'=>$data['city'],
                            'country'=>$data['country'],
                            'postal_address'=>$data['postal_address'],
                            'telephone'=>Helper::processNumber($data['telephone']),
                            );
          $profile=$user->profile();
          $profile->update($profile_data);

          $role=Helper::FindRoleDetails('name',$data['type']);
          $user->detachRoles($user->roles);
          $user->roles()->attach($role->id);
          $model_data=array('user_id'=>$user->id,
                            'name'=>$user->name,
                            'tra_reg_no'=>$data['tra_reg_no'],
                            'country'=>ucfirst($data['country']),
                            'city'=>ucfirst($data['city']),
                            'postal_address'=>$data['postal_address'],
                            'box'=>$data['box'],
                            'supplier_code'=>$user->verification_code,
                            'email'=>$user->email,
                            'supplier_status'=>"Approved",
                            'extranet'=>str_slug($user->name,'-'),
                            'telephone'=>Helper::processNumber($data['telephone']),
                            'type'=>$data['type'],

                            );
            $model->update($model_data);
              DB::commit();
                   Session::flash('success_msg','Supplier updated successfully')   ;
                   return redirect()->back();



             }

            }
            
             if(!$model){
             Session::flash("success_msg","Supplier Not Found");
             return redirect()->back();
             }
        $data['model']=$model;
        $data['url']=url()->current();
        $data['user']=new User();
          return view('hotels::hotels.supplier_create',$data);



    }else{
        return "<h3 style='color:red'>Access Denied.You do not have permission to access this functionality</h3>";
    }

  }

  public function suspendSupplier($id,Request $request){
    if(Entrust::hasRole("Admin")){
         $model=Supplier::find($id);
          if($request->isMethod("post"))
          {
            $data=$request->all();
            $text="Dear ".$data['name']." Your account at ".config('app.name')." has been suspened because of the following reason :\n".$data['reason'];
            $body="Dear ".$data['name']." Your account at ".config('app.name')." has been suspened because of the following reason :<br>".$data['reason']." Kindly Contact System admin For More Information";
            //$model->supplier_status="Suspended";
            $model->save();
             Helper::send($model->telephone,$text);
             Helper::sendEmail($model->email,$body,"Account Suspension");
             Session::flash("success_msg","Supplier Suspended Successfully");
             return redirect()->back();
           }
      if(!$model)
          {
             return "<h3 style='color:red'>Resource Not Found On This Server</h3>";
          }
          $data['model']=$model;
          $data['url']=url()->current();
          return view('hotels::hotels.reason',$data);
        }else{
        return "<h3 style='color:red'>Access Denied.You do not have permission to access this functionality</h3>";
    }


  }


public function rejectApplication($id,Request $request){
    if(Entrust::hasRole("Admin")){
         $model=Supplier::find($id);
          if($request->isMethod("post"))
          {
            $data=$request->all();
            $text="Dear ".$data['name']." Your Application at ".config('app.name')." has been reject because of the following reason :\n".$data['reason'];
            $body="Dear ".$data['name']." Your Application at ".config('app.name')." has been rejected because of the following reason :<br>".$data['reason']." Kindly Contact System admin For More Information";
            $model->supplier_status="Rejected";
            $model->save();
             Helper::send($model->telephone,$text);
             Helper::sendEmail($model->email,$body,"Application Rejected");
             Session::flash("success_msg","Supplier Application Rejected Successfully");
             return redirect()->back();
           }
      if(!$model)
          {
             return "<h3 style='color:red'>Resource Not Found On This Server</h3>";
          }
          $data['model']=$model;
          $data['url']=url()->current();
          return view('hotels::hotels.reason',$data);
        }else{
        return "<h3 style='color:red'>Access Denied.You do not have permission to access this functionality</h3>";
    }

}
public function approveApplication($id){
    if(Entrust::hasRole("Admin")){
        $model=Supplier::find($id);
         if(!$model){
            Session::flash("danger_msg","Resourece You are trying to access not found on this server") ;
           return redirect()->back();

         }else{
            $text="Dear ".$model->name." Your Application at ".config('app.name')." has been approved ";
            $body="Dear ".$model->name." Your Application at ".config('app.name')." has been approved.You can now access the application at ".url('/login');
          
             Helper::send($model->telephone,$text);
             Helper::sendEmail($model->email,$body,"Application Approved");
           $model->supplier_status="Approved";
           $model->save();
           return redirect()->back();

         }
     }else{
      Session::flash("danger_msg","Access Denied.You do not have permission to perform this functionality on the platform") ;
      return redirect()->back();
    }

}

public function roomTypes(){
    if(Entrust::can("manage-hotel-rooms")){
        $data['page_title']="Hotel Room Types";
         return view('hotels::hotels.room_type',$data);



    }else{
        return view("forbidden");
    }
}

public function fetchRoomTypes(){
    $models=RoomType::where(['user_id'=>auth::user()->id]);
  return Datatables::of($models)->addColumn('action',function($model){
           
              $edit_url=url("/hotels/room_type/update/".$model->id);
               $delete_url=url("/hotels/room_type/delete/".$model->id);
               $index_url=url("/hotels/rooms/room-types");

                $audit_url=url('/system/audit?id='.$model->id."&type=Modules\Hotels\Entities\RoomType");

            return '<a class="reject-modal" data-title="Edit Room Type" data-url="'.$edit_url.'"><span class="icon-pencil4 "></span></a>
                  <a data-redirect-to="'.$index_url.'"  class="delete-record" data-name="Room Type" data-title="Delete Role" style="margin-left:15%;" data-href="'.$delete_url.'"  data-url-to="'.$index_url.'"><span class="icon-trash"></span></a>
                  <a style="margin-left:15%;" href="'.$audit_url.'" title="Audit trail"><span class="icon-stats-growth2"></span></a>';
   })->make(true);
}

public function fetchBedTypes(){
     $models=BedType::where(['user_id'=>auth::user()->id]);
  return Datatables::of($models)->addColumn('action',function($model){
           
              $edit_url=url("/hotels/bed_type/update/".$model->id);
               $delete_url=url("/hotels/bed_type/delete/".$model->id);
               $index_url=url("/hotels/room/bed-types");

                $audit_url=url('/system/audit?id='.$model->id."&type=Modules\Hotels\Entities\BedType");

            return '<a class="reject-modal" data-title="Edit Bed Type" data-url="'.$edit_url.'"><span class="icon-pencil4 "></span></a>
                  <a data-redirect-to="'.$index_url.'"  class="delete-record" data-name="Bed Type" data-title="Delete Role" style="margin-left:15%;" data-href="'.$delete_url.'"  data-url-to="'.$index_url.'"><span class="icon-trash"></span></a>
                  <a style="margin-left:15%;" href="'.$audit_url.'" title="Audit trail"><span class="icon-stats-growth2"></span></a>';
   })->make(true);

}


public function createRoomType(Request $request){
     if(Entrust::can("manage-hotel-rooms")){
        if($request->isMethod("post")){
            try{
                $data=$request->all();
                  $a=array('user_id'=>auth::user()->id,
                       'supplier_id'=>auth::user()->supplier->id,
                    );
                $data=array_merge($a,$data);
                 
                $model=RoomType::create($data);     
                Session::flash("success_msg","Room Type Created Successfully");

               }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified");
               }
               return redirect()->back();
           }
        $data['page_title']="Hotel Room Types";
        $data['url']=url()->current();
        $data['model']=new HotelType();
        return view('hotels::hotels.create_room_type',$data);
      }
      else
      {
     return "<h3 style='color:red'>Access Denied.You do not have permission to access this functionality</h3>";
    }

}

public function createBedType(Request $request){
     if(Entrust::can("manage-hotel-rooms")){
        if($request->isMethod("post")){
            try{
                $data=$request->all();
                  $a=array('user_id'=>auth::user()->id,
                       'supplier_id'=>auth::user()->supplier->id,
                    );
                $data=array_merge($a,$data);
                  
                $model=BedType::create($data);     
                Session::flash("success_msg","Bed Type Created Successfully");

               }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified");
               }
               return redirect()->back();
           }
        $data['page_title']="Hotel Bed Types";
        $data['url']=url()->current();
        $data['model']=new BedType();
        return view('hotels::hotels.create_room_type',$data);
      }
      else
      {
     return "<h3 style='color:red'>Access Denied.You do not have permission to access this functionality</h3>";
    }

}

public function editHotel($id,Request $request){
    if(Entrust::can("manage-hotel-rooms")){
         $model=RoomType::where(['id'=>$id,'supplier_id'=>auth::user()->supplier->id])->first();
          if(!$model){
             return "<h3 style='color:red'>Resource Not Found</h3>";
          }
          if($request->isMethod("post")){
            try{
                $data=$request->all();
                  $a=array('user_id'=>auth::user()->id,
                       'supplier_id'=>auth::user()->supplier->id,
                    );
                $data=array_merge($a,$data);
                 
                $model->update($data);     
                Session::flash("success_msg","Room Type Updated Successfully");

               }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified");
               }
               return redirect()->back();
           }

      $data['page_title']="Room Types";
        $data['url']=url()->current();
        $data['model']=$model;
        return view('hotels::hotels.create_room_type',$data);


    }else{
      return "<h3 style='color:red'>Access Denied.You do not have permission to access this functionality</h3>";   
    }

}

public function deletRoomType($id){

    if(Entrust::can("manage-hotel-rooms")){
         $model=RoomType::where(['id'=>$id,'supplier_id'=>auth::user()->supplier->id])->first();
         if($model){
             try{
                $model->delete();
                Session::flash("success_msg","Room Type Deleted Successfully");
              }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified about the error");
                 }

         }else{
            Session::flash("danger_msg","access Denied.Resorce not Found this Server.");
         }

     }else{
        Session::flash("danger_msg","access Denied.You do not have permission to delete this Resorce on this Server.");
     }

}
public function deleteAmentity($id){
     if(Entrust::can("manage-hotel-rooms")){
         $model=SupplierAmenty::where(['id'=>$id,'supplier_id'=>auth::user()->supplier->id])->first();
         if($model){
             try{
                $model->delete();
                Session::flash("success_msg","Amentity Deleted Successfully");
              }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified about the error");
                 }

         }else{
            Session::flash("danger_msg","access Denied.Resorce not Found this Server.");
         }

     }else{
        Session::flash("danger_msg","access Denied.You do not have permission to delete this Resorce on this Server.");
     }

}




public function deletBedType($id){

    if(Entrust::can("manage-hotel-rooms")){
         $model=BedType::where(['id'=>$id,'supplier_id'=>auth::user()->supplier->id])->first();
         if($model){
             try{
                $model->delete();
                Session::flash("success_msg","Bed Type Deleted Successfully");
              }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified about the error");
                 }

         }else{
            Session::flash("danger_msg","access Denied.Resorce not Found this Server.");
         }

     }else{
        Session::flash("danger_msg","access Denied.You do not have permission to delete this Resorce on this Server.");
     }

}

public function editBedType($id,Request $request){
    if(Entrust::can("manage-hotel-rooms")){
         $model=BedType::where(['id'=>$id,'supplier_id'=>auth::user()->supplier->id])->first();
          if(!$model){
             return "<h3 style='color:red'>Resource Not Found</h3>";
          }
          if($request->isMethod("post")){
            try{
                $data=$request->all();
                  $a=array('user_id'=>auth::user()->id,
                       'supplier_id'=>auth::user()->supplier->id,
                    );
                $data=array_merge($a,$data);
                 
                $model->update($data);     
                Session::flash("success_msg","Bed Type Updated Successfully");

               }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified");
               }
               return redirect()->back();
           }

      $data['page_title']="Bed Types";
        $data['url']=url()->current();
        $data['model']=$model;
        return view('hotels::hotels.create_room_type',$data);


    }else{
      return "<h3 style='color:red'>Access Denied.You do not have permission to access this functionality</h3>";   
    }

}



public function createSAmentity(Request $request){
      if(Entrust::can("manage-hotel-rooms")){
        if($request->isMethod("post")){
            try{
                $data=$request->all();
                  $a=array('user_id'=>auth::user()->id,
                       'supplier_id'=>auth::user()->supplier->id,
                    );
                $data=array_merge($a,$data);
                  
                $model=SupplierAmenty::create($data);     
                Session::flash("success_msg","Amentity Created Successfully");

               }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified");
               }
               return redirect()->back();
           }
        $data['page_title']="Supplier Amentities";
        $data['url']=url()->current();
        $data['model']=new SupplierAmenty();
        return view('hotels::hotels.create_s_amentity',$data);
      }
      else
      {
     return "<h3 style='color:red'>Access Denied.You do not have permission to access this functionality</h3>";
    }

}

public function updateSAmetity($id,Request $request){
    if(Entrust::can("manage-hotel-rooms")){
         $model=SupplierAmenty::where(['id'=>$id,'supplier_id'=>auth::user()->supplier->id])->first();
        if($request->isMethod("post")){
           
             if(!$model){
                return "<h3 style='color:red'>Resource Not Found On This Server</h3>";

             }
            try{
                $data=$request->all();
                  $a=array('user_id'=>auth::user()->id,
                       'supplier_id'=>auth::user()->supplier->id,
                    );
                $data=array_merge($a,$data);
                  
                $model->update($data);     
                Session::flash("success_msg","Amentity Created Successfully");

               }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error Occured while Processing Your Request.System Admin notified");
               }
               return redirect()->back();
           }
        $data['page_title']="Supplier Amentities";
        $data['url']=url()->current();
        $data['model']=$model;
        return view('hotels::hotels.create_s_amentity',$data);
      }
      else
      {
     return "<h3 style='color:red'>Access Denied.You do not have permission to access this functionality</h3>";
    }


}


public function AmentitiesReports(){
     if(Entrust::can("manage-hotel-rooms")){
           PDF:: SetTopMargin (20);
      PDF::SetTitle('Hotel List');
      PDF::setPageOrientation("l");
      PDF::SetCreator(PDF_CREATOR);
      PDF::SetAlpha(1);
      PDF::SetAuthor('Isanya Hillary');
      PDF::Write(0,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
      PDF::SetTitle("Report-Amentities");
      PDF::SetSubject('Enterprise');
      PDF::SetKeywords('TCPDF, PDF, example, test, guide');
       //dd(Auth::user()->supplier->id);
       $models=SupplierAmenty::where(['supplier_id'=>Auth::user()->supplier->id])->get();
      PDF::AddPage();
      // set default monospaced font
      PDF::Image('http://localhost/kenya/public/uploads/c.png', 135, 12, 20, 20, '', '', '', true, 72);
      $htm2="<h1 style='margin-bottom:0.7%;''></h2>";
      PDF::writeHTML($htm2, true, false, true, false, '');
      PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      PDF::SetAlpha(1);
      PDF::SetFont('times', '', 14);
      PDF::Ln();
      PDF::Ln();
     PDF::Ln();
     
      
      
    PDF::Write(0,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
    PDF::SetFont('times', 15);
      PDF::SetFont('times', 15);
      $html="<label style='margin-left:70%;'>List of Amentities ".auth::user()->supplier->name."</label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:11pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th>";
   $html.=" 
  <th>Category</th>                                       
  <th>Name</th> 
                                                                       
  </tr>
  </thead>
  <tbody>";
  $i=1;
  foreach ($models  as $key):


               
$html.=
 
  "
  <tr>
  <td >".$i."</td>
  <td colspan='2'>".$key->category."</td>
  <td colspan='2'>".$key->name."</td>
  </tr> ";
 $i++;
  endforeach; 

  $html .=
  "</tbody> 
</table>";

// output the HTML content
 PDF::SetFont('times', '', 10);
PDF::writeHTML($html, true, false, true, false, '');
      PDF::Ln();

      
     
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();
     PDF::ln();
     PDF::Output('amentity_list.pdf');



     }else{
        Session::flash("danger_msg","Access Denied.You do not have permission to access this functionality");
        return redirect()->back();
     }
}


public function BedTypesReports(){
    if(Entrust::can("manage-hotel-rooms")){
      PDF:: SetTopMargin (20);
      PDF::SetTitle('Hotel List');
      PDF::setPageOrientation("l");
      PDF::SetCreator(PDF_CREATOR);
      PDF::SetAlpha(1);
      PDF::SetAuthor('Isanya Hillary');
      PDF::Write(0,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
      PDF::SetTitle("Report-Bed Types");
      PDF::SetSubject('Bed Type');
      PDF::SetKeywords('TCPDF, PDF, example, test, guide');
       //dd(Auth::user()->supplier->id);
       $models=BedType::where(['supplier_id'=>Auth::user()->supplier->id])->get();
      PDF::AddPage();
      // set default monospaced font
      PDF::Image('http://localhost/kenya/public/uploads/c.png', 135, 12, 20, 20, '', '', '', true, 72);
      $htm2="<h1 style='margin-bottom:0.7%;''></h2>";
      PDF::writeHTML($htm2, true, false, true, false, '');
      PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      PDF::SetAlpha(1);
      PDF::SetFont('times', '', 14);
      PDF::Ln();
      PDF::Ln();
     PDF::Ln();
     
      
      
    PDF::Write(0,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
    PDF::SetFont('times', 15);
      PDF::SetFont('times', 15);
      $html="<label style='margin-left:70%;'>List of Bed Types ".auth::user()->supplier->name."</label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:11pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th>";
   $html.=" 

  <th>Name</th>                                                                     
  </tr>
  </thead>
  <tbody>";
  $i=1;
  foreach ($models  as $key):

               
$html.=
 
  "
  <tr>
  <td >".$i."</td>
  <td colspan='2'>".$key->name."</td>
  </tr> ";
 $i++;
  endforeach; 

  $html .=
  "</tbody> 
</table>";

// output the HTML content
 PDF::SetFont('times', '', 10);
PDF::writeHTML($html, true, false, true, false, '');
      PDF::Ln();

      
     
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();
     PDF::ln();
     PDF::Output('amentity_list.pdf');



    }
    else{
        Session::flash("danger_msg","Access Denied.You do not have permission to access this functionality");
        return redirect()->back();
     }
}


public function RoomTypeReports(){
    if(Entrust::can("manage-hotel-rooms")){
      PDF:: SetTopMargin (20);
      PDF::SetTitle('Hotel List');
      PDF::setPageOrientation("l");
      PDF::SetCreator(PDF_CREATOR);
      PDF::SetAlpha(1);
      PDF::SetAuthor('Isanya Hillary');
      PDF::Write(0,"--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
      PDF::SetTitle("Report-Bed Types");
      PDF::SetSubject('Bed Type');
      PDF::SetKeywords('TCPDF, PDF, example, test, guide');
       //dd(Auth::user()->supplier->id);
       $models=RoomType::where(['supplier_id'=>Auth::user()->supplier->id])->get();
      PDF::AddPage();
      // set default monospaced font
      PDF::Image('http://localhost/kenya/public/uploads/c.png', 135, 12, 20, 20, '', '', '', true, 72);
      $htm2="<h1 style='margin-bottom:0.7%;''></h2>";
      PDF::writeHTML($htm2, true, false, true, false, '');
      PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
      PDF::SetAlpha(1);
      PDF::SetFont('times', '', 14);
      PDF::Ln();
      PDF::Ln();
     PDF::Ln();
     
      
      
    PDF::Write(0,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------", '', 0, 'L', true, 0, false, false, 0);
    PDF::SetFont('times', 15);
      PDF::SetFont('times', 15);
      $html="<label style='margin-left:70%;'>List of Room Names  Under ".auth::user()->supplier->name."</label>";
      PDF::writeHTML($html, true, false, true ,false, '');


      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();

$html ="
<style>table{border-radius:4px;border:1px solid green;}table td{text-align:left} table th #m{border-left:1px solid black;}table td #m{border-left:1px solid black;} th{text-align:left;background-color:#F2F2F2;font-weight:bold;font-size:11pts;border-bottom:1px solid black;border-right:1px solid black;}td{background-color:white;border-bottom:1px solid black}</style><table><thead>
  <tr><th>ID</th>";
   $html.="                                       
  <th>Name</th>                                                                     
  </tr>
  </thead>
  <tbody>";
  $i=1;
  foreach ($models  as $key):
$html.="
  <tr>
  <td >".$i."</td>
   <td colspan='2'>".$key->name."</td>
  </tr> ";
 $i++;
  endforeach; 

  $html .=
  "</tbody> 
</table>";

 PDF::SetFont('times', '', 10);
  PDF::writeHTML($html, true, false, true, false, '');
      PDF::Ln();
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::SetFont('times', '', 11);
      PDF::Ln();
      PDF::Ln();
     PDF::ln();
     PDF::Output('amentity_list.pdf');



    }
    else{
        Session::flash("danger_msg","Access Denied.You do not have permission to access this functionality");
        return redirect()->back();
     }
}


public function getStatistics($hotel,$year){
   if($hotel=="All"){

       if($year=="All"){
        $model=substr(number_format(time() * rand(),0,'',''),0,6);
       }else{
        $model=substr(number_format(time() * rand(),0,'',''),0,5);;
       }
    }else{
       if($year=="All"){
        $model=substr(number_format(time() * rand(),0,'',''),0,6);;
       }else{
        $model=substr(number_format(time() * rand(),0,'',''),0,4);
       }

    }
    $months=array('Jan'=>'01','Feb'=>'02','Mar'=>'03','Apr'=>'04','May'=>'05','Jun'=>'06','Jul'=>'07','Aug'=>'08','Sep'=>'09','Oct'=>10,'Nov'=>11,'Dec'=>'12',);

     foreach($months as $key=>$value)
             {
                $year=date('Y');
                
                $y=substr(number_format(time() * rand(),0,'',''),0,4);
                $data[]=array('x'=>$key,'y'=>$y);
             }

                return json_encode($data);

        }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('hotels::create');
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
        return view('hotels::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('hotels::edit');
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
