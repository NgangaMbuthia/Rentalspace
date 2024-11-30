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
class ProviderAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('backend::index');
    }


     public function BlockedAccounts()
    {
      if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent")){
        $data['page_title']="Blocked Account";
         $model=Auth::user()->getProvider;
         $data['model']=$model;
           return view('backend::accounts.blocked',$data);
    }else{
      return redirect('/home');
    }
    }

     public function getSetUpAccount(Request $request)
    {
       if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent")){
        $data['page_title']="Account SetUp";
        $data['url']=url()->current();
        $data['user']=auth::user();
        $data['model']=auth::user()->getProvider;
         
          if($request->isMethod("post"))
          {
            $data=$request->all();
            $this->validate($request,[
              'auth_key'=>'required|string|exists:agents,auth_key',
              'name'=>'string',
              'postal_address'=>'required',
              'email'=>'required|email'

            ]);
            try{
              
              $test=Agent::where(['id'=>auth::user()->getProvider->id,'auth_key'=>$data['auth_key']])->first();
                if(!$test)
                {
                  return redirect()->back()->withInput()->withErrors("Provided Authorization(Product) Key Not in our Records");
                }else{


                  $a=array('is_first_time_login'=>"No");
                  $data=array_merge($a,$data);

                   $model=auth::user()->getProvider;
                   $model->update($data);
                   Session::flash("success_msg","Your Account Has been activated successfully");
                   return redirect('/home');
                   
                }



            }catch(\Exception $e)
             { 
               Helper::sendEmailToSupport($e);
               return redirect()->back()->withInput()->withErrors("Error Occured while activating your account.KIndly contact 0708236804 for assistance");

              }



             
          }



         
          return view('backend::accounts.wizard',$data);
        
      }else{
        return view("forbidden");
      }

    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('backend::create');
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
