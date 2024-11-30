<?php

namespace Modules\Supplier\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Entrust;
use Auth;
use Modules\Supplier\Entities\Quatation;
use Modules\Supplier\Entities\Supplier;
use App\Http\Middleware\AccountSetUp;

class QuatationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AccountSetUp::class);

    }
    public function index()
    {
        return view('supplier::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {  
         if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider")){
             $data['page_title']="Supplier Module";
             $data['url']=url('supplier/quatation/create');
             $data['model']=new  Quatation();
             $data['products']=Supplier::select(['core_commodity'])->distinct()->get();
        
            return view('supplier::quatations.create',$data);

         }else{
            return view('not_found');
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
        return view('supplier::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('supplier::edit');
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
