<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Entrust;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Auth;
use App\Http\Middleware\AccountSetUp;

class MessageController extends Controller
{

       public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AccountSetUp::class);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Entrust::hasRole("Provider")){
             $data['page_title']="Sent SMS";
        return view('messages.sent_sms',$data);

        }else{
            return view('forbidden');
        }
       




    }


    public function fetchSent(){

         if(Entrust::hasRole("Provider")){
            $p_id=Auth::User()->getProvider->id;

            $models=Message::where(['type_id'=>$p_id]);
            return Datatables::of($models)->make(true);


         }else if(Entrust::hasRole("Admin")){


         }else{
            return view("forbidden");
         }




    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
