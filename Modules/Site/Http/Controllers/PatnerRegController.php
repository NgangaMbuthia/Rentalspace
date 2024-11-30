<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller ;
use App\User;
use Modules\Site\Entities\ServiceProvider;
use DB;
use App\Helpers\Helper;
use Modules\UserManagement\Entities\Profile;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class PatnerRegController extends Controller
{

     use AuthenticatesUsers;


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('site::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {

         if($request->isMethod("post")){
            $this->validate($request,[
                'email'=>'email|required|unique:users',
                'id_number'=>'required|unique:profiles',
                'name'=>'required|string',
                'type'=>'required|string',
                'first_ref'=>'required|string',
                'ref_one_phone'=>'required|string',
                'second_ref'=>'required|string',
                'ref_two_phone'=>'required|string',
                'telephone'=>'required|string',
                'location'=>'required'
                ]);
             DB::beginTransaction();
            $data=$request->all();
            try{

                $user_data=array('name'=>$data['name'],
                              'email'=>$data['email'],
                              'password'=>$data['id_number'],
                              'verification_code'=>str_random(8),
                              'confirmed_at'=>date('Y-m-d H:i:s'),
                              'provider'=>"Manual"
                              );
              $user=User::create($user_data);
               $role_id=Helper::FindRoleDetails("name","serviceProvider")->id;
               $user->roles()->attach($role_id);
               
               try{
                       $profile_data=array('user_id'=>$user->id,
                        'telephone'=>Helper::processNumber($data['telephone']),
                        'postal_address'=>$data['postal_address'],
                        'status'=>'Incomplete',
                        'id_number'=>$data['id_number'],
                        'timezone'=>'Africa/Nairobi',
                        );
                       $profile=Profile::create($profile_data);
                         try{
                            $proivider_data=array('user_id'=>$user->id,
                                                   'type'=>strtoupper($data['type']),
                                                   'nationality'=>ucwords($data['nationality']),
                                                   'current_nationality'=>ucfirst($data['current_country']),
                                                   'location'=>$data['location'],
                                                   'town'=>ucfirst($data['town']),
                                                   'first_ref'=>$data['first_ref'],
                                                   'ref_one_phone'=>Helper::processNumber($data['ref_one_phone']),
                                                   'second_ref'=>$data['second_ref'],
                                                   'ref_two_phone'=>$data['ref_two_phone'],
                                                  );
                            $provider=ServiceProvider::create($proivider_data);
                              DB::commit();
                               try{
                                    $text="Hello ".$user->name." ,You have an account created for you at the qooetu.com. Use \n Email: ".$user->email."\n Password: ".$profile->id_number."\n verification code:".$user->verification_code." \n As your loging details to access your account";
                                    $number=$profile->telephone;
                                    Helper::send($number,$text);
                                    $text2="Dear Admin ,".$user->name." (".$profile->telephone.") has created a provider account with qooetu.Kindly verify his account";
                                    $phone=config('app.phone');

                                    Helper::send($phone,$text2);

                                    $credentials = array(
                                    'email' => $user->name,
                                    'password' =>$profile->id_number
                                    );
                                    Session::flash("success_msg","Accont created.You will be able to start transacting on thus platform once Your account has been verified and approved by the platform provider");
                                     \Auth::loginUsingId($user->id);

                                      



                                     

                                  }
                                  catch(\Exception $e)
                                  {
                                    Helper::sendEmailToSupport($e);
                                    }

                            }catch(\Exception $e){
                    Helper::sendEmailToSupport($e);
                    
                    }
                       

                           
                        


                  }catch(\Exception $e){
                    Helper::sendEmailToSupport($e);
                    
                    }
               




            


            }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                return redirect()->back();

            }
            


              

            

         }

         $data['url']=url('/application/patners');
        return view('site::patners',$data);
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
        return view('site::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('site::edit');
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
