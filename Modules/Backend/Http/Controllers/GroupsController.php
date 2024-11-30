<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Entrust;
use App\User;
use DB;
use App\Http\Controllers\Controller ;
use App\Helpers\Helper;
use Auth;
use Modules\Backend\Entities\ContactGroup;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\AccountSetUp;
class GroupsController extends Controller
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
         if(Entrust::hasRole("Provider")){
             $provider=Auth::User()->getProvider->id;
               if(Helper::testModule("SMS and Bulk Emails Module",$provider)){
                $data['page_title']="Bulk SMS";



                return view('backend::groups.index',$data);
                }else{
                return view("forbidden");
               }


         }
        
    }

    public function getStatistics(){


         if(Entrust::hasRole("Provider")){
             $provider=Auth::User()->getProvider->id;
               if(Helper::testModule("SMS and Bulk Emails Module",$provider)){
                $data['page_title']="Bulk SMS and Emails";



                return view('backend::groups.statistics',$data);
                }else{
                return view("forbidden");
               }


         }



    }

    public function fetchGroups(){
         $provider_id=Auth::User()->getProvider->id;
         $models=ContactGroup::where(['owner_id'=>$provider_id,'owner_type'=>'Provider']);
          return Datatables::of($models)->addColumn('action',function($model){
                $url=url('/backend/group/update/'.$model->id);
                          return '<a data-url="'.$url.'" class="glyphicon glyphicon-pencil reject-modal" data-title="Edit Group Name"></a>';
          })->make(true);

    }

    public function getGroupStatics(){
        $provider_id=Auth::User()->getProvider->id;
         $models=ContactGroup::where(['owner_id'=>$provider_id,'owner_type'=>'Provider'])
                  ->select([
            'bulk_groups.id',
            'bulk_groups.group_name',
            'bulk_groups.created_at',
           
            \DB::raw('count(contacts.group_id) as count'),
           
            'bulk_groups.updated_at'
        ])->join('contacts','contacts.group_id','=','bulk_groups.id')
        ->groupBy('contacts.group_id','bulk_groups.id','group_name','bulk_groups.created_at','bulk_groups.updated_at');;
          return Datatables::of($models)->addColumn('action',function($model){
                $url=url('/backend/group/update/'.$model->id);
                          return '<a data-url="'.$url.'" class="glyphicon glyphicon-pencil reject-modal" data-title="Edit Group Name"></a>';
          })->make(true);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        if(Entrust::hasRole("Provider")){
             $provider=Auth::User()->getProvider->id;
               if(Helper::testModule("SMS and Bulk Emails Module",$provider)){
                $data['page_title']="Bulk SMS";
                  if($request->isMethod("post")){
                    $data=$request->all();
                    $provider_id=Auth::User()->getProvider->id;
                    $model=ContactGroup::where(['group_name'=>$data['name'],'owner_type'=>'Provider','owner_id'=>$provider_id])->first();
                      if($model){
                        Session::flash("danger_msg","Group Name Already In System");
                        return redirect()->back();
                      }else{
                        $model=new ContactGroup();
                        $model->group_name=$data['name'];
                        $model->owner_id=$provider_id;
                        $model->owner_type="Provider";
                         $model->save();
                         Session::flash("success_msg","Group Added Successfully");
                         return redirect()->back();
                      }



                  }






                $data['url']=url('/backend/group/create');
                $data['model']=new ContactGroup();



                return view('backend::groups._form',$data);
                }else{
                return view("forbidden");
               }


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
    public function update(Request $request,$id)
    {

        if(Entrust::hasRole("Provider")){
             $provider=Auth::User()->getProvider->id;
               if(Helper::testModule("SMS and Bulk Emails Module",$provider)){
                $data['page_title']="Bulk SMS";
                $model=ContactGroup::where(['id'=>$id,'owner_type'=>'Provider'])->first();
                 if(!$model){
                 return "Resource not Found";
                 }

                  if($request->isMethod("post")){
                     $data=$request->all();
                      $model->group_name=$data['name'];
                      $model->save();
                      Session::flash("success_msg","Group Updated Successfully");
                      return redirect()->back();



                  }






                 $data['url']=url('/backend/group/update/'.$model->id);
                 $data['model']=$model;



                return view('backend::groups._form',$data);
                }else{
                return view("forbidden");
               }


         }

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
