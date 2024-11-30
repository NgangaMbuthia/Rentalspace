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
use Auth;
use App\Helpers\Helper;
use Modules\Backend\Entities\EmergencyContact;

class UserController extends Controller
{
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
    public function AccountSetUp(Request $request)
    { 
         if(Entrust::hasRole("Renter"))
        {
            $data['user']=$user=auth::user();
            $data['url']=url()->current();

             if($request->isMethod("post"))
             {
                $data=$request->all();
                try{
                    $user->name=$data['name'];
                    $user->email=$data['email'];
                    $user->username=$data['username'];
                    $user->save();
                    $profile=$user->profile;
                    $profile->telephone=Helper::processNumber($data['telephone']);
                    $profile->city=$data['town'];
                    $profile->street=$data['street'];
                    $profile->save();
                    $profile->id_number=$data['id_number'];
                    $profile->gender=$data['gender'];
                    $contact=$user->tenant->contact;
                    
                     if(!$contact)
                      {
                        $contact=new EmergencyContact();
                      }
                      $contact->tenant_id=$user->tenant->id;
                      $contact->name=$data['emargecy_name'];
                      $contact->relationship=$data['relationship'];
                      $contact->phone=$data['emergency_phone'];
                      $contact->email=$data['emergency_email'];
                      $contact->save();
                      Session::flash("success_msg","Account Details Updated Successfully");
                      return redirect('/home');

                     
                }catch(\Exception $e)
                {
                 Helper::sendEmailToSupport($e);
                  dd($e);
                }
             }

            return view('backend::users.create',$data);
        }else{
            return redirect('home');
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
