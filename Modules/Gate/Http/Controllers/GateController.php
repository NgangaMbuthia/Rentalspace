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
use Modules\Backend\Entities\Property;
use Modules\Gate\Entities\Incident;
use App\Http\Middleware\AccountSetUp;

class GateController extends Controller
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
        return view('gate::index');
    }


    public function CreateIncidents(Request $request){
         if(Entrust::hasRole("Guard")){

             if($request->isMethod("post")){
                $data=$request->all();
            try{
                $guard_id=Auth::user()->guardDetails->id;
                 $gate_details=Helper::GateDetails($guard_id);
                 $provider_id=Helper::getProviderByPropertyID($gate_details->property_id);
                 $model=new Incident();
                 $model->provider_id=$provider_id;
                 $model->gate_id=$gate_details->id;
                 $model->property_id=$gate_details->property_id;
                 $model->incident_name =$data['incident_name'];
                 $model->insident_code=str_random(8);
                 $model->incident_time=date('H:i:s',strtotime($data['incident_time']));
                 $model->incident_date=date('Y-m-d',strtotime($data['incident_date']));
                 $model->incident_description=$data['description'];
                 $model->user_id=Auth::user()->id;
                 $model->save();
                 Session::flash("success_msg","Incident Created Successfully");
                 return redirect()->back();


             }catch(\Exception $e){
                Helper::sendEmailToSupport($e);
                Session::flash("danger_msg","Error occured and admin notified on the same");
                return redirect()->back();
             }
                 
                  




             }





            $data['page_title']="Report Incidents";
            $data['url']=url('/security/incident/report');

            return view('gate::incidents.create',$data);




         }else{
            return view("forbidden");
         }


    }

    public function getIncidents(){
        if(Entrust::hasRole("Guard")){
            $data['type']=$type=(isset($_GET['type']))? $_GET['type']: 'Property';
            $data['page_title']="Reported Incidents By ".$type;
             return view('gate::incidents._index',$data);
            }
        else{
            return view("forbidden");
         }

    }

    public function fetchIncidenst($type){
        if(Entrust::hasRole("Guard")){
            $guard_id=Auth::user()->guardDetails->id;
                 $gate_details=Helper::GateDetails($guard_id);
            if($type=="Person"){
                $models=Incident::join('properties','properties.id','=','gate_incidents.property_id')
                 ->join('gate_gates','gate_gates.id','=','gate_incidents.gate_id')
                   ->select(['gate_incidents.id','properties.title','gate_gates.name as gate_name','incident_name','incident_time','incident_date','gate_incidents.status as status'])
                 ->where(['user_id'=>Auth::user()->id]);
            }else{
                $models=Incident::join('properties','properties.id','=','gate_incidents.property_id')
                       ->join('gate_gates','gate_gates.id','=','gate_incidents.gate_id')
                       ->select(['gate_incidents.id','properties.title','gate_gates.name as gate_name','incident_name','incident_time','incident_date','gate_incidents.status as status'])
                       ->where(['gate_incidents.property_id'=>$gate_details->property_id]);
            }

            return Datatables::of($models)
             ->editColumn('incident_name',function($model){
                 $description_url=url('/security/incident/description/'.$model->id);
                return '<a data-title="Incident Description" data-url="'.$description_url.'" class="reject-modal" href="">'.$model->incident_name.'</a>';

             })->editColumn('status',function($model){
                if($model->status=="Open"){
                    return '<label class="label label-primary">'.$model->status.'</label>';
                }elseif ($model->status=="Pending") {
                    return '<label class="label label-warning">'.$model->status.'</label>';
                }
                elseif ($model->status=="Closed") {
                    return '<label class="label label-success">'.$model->status.'</label>';
                }else{
                     return '<label class="label label-danger">'.$model->status.'</label>';
                }

             })
            ->make(true);





        }else{
           return view("forbidden"); 
        }

    }


    public function getVisitorsReports(){
        if(Entrust::hasRole("Guard")){
            $data['page_title']="Visitors Reports";
            $data['type']=$type=(isset($_GET['type']))? $_GET['type']:'All';
            return view('gate::incidents._reports',$data);




        }
        else{
           return view("forbidden"); 
        }

    }

    public function getIncidentDescription($id,Request $request){
        $model=Incident::find($id);
         if($model){

              if($request->isMethod("post")){
                $data=$request->all();
                  try{
                    $model->update($data);
                    Session::flash("success_msg","Details updated Successfully");

                  }catch(\Exception $e){
                    Helper::sendEmailToSupport($e);
                    Session::flash("danger_msg","Error Occured while processing your details.System Admin Notified about the error");

                  }
                  return redirect()->back();
              }
             $data['model']=$model;
             $data['url']=url('/security/incident/description/'.$model->id);

            return view('gate::incidents.details',$data);

         }else{
            return "Incident Description Not Found";
         }

    }





    public function getGates(){
        
       
    if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
         $data['page_title']="Gates";

         return view('gate::gates.index',$data);
      }else{
            Session::flash('danger_msg',"You have not subscribed/purchased to this Security module");
            return view("forbidden");
        }

    }


    public function fetchGates(){
         $id=Auth::User()->getProvider->id;


        $models=Gate::join('properties','properties.id','=','gate_gates.property_id')
             ->select(['gate_gates.id','properties.title','name','telephone','alt_telephone','min_guards'])
             ->where('provider_id','=',$id);
               return Datatables::of($models)

         ->editColumn('name',function($model){
            $pro_url=url('/backend/tenant/view/'.$model->tenant_id);
             return '<a href="'.$pro_url.'">'.$model->name.'</a>';

         })
        
         ->editColumn('title',function($model){
            $pro_url=url('/backend/property/view/'.$model->P_id);
             return '<a href="#">'.$model->title.'</a>';

         })->addColumn('action',function($model){
            $edit_url=url('/security/gate/update/'.$model->id);
             return '<a data-href="" data-url="'.$edit_url.'" data-title="Update Gate Details" class="reject-modal">  <span class="reject-modal glyphicon  glyphicon-pencil"></span></a>  
             <a href="" style="margin-left:10%;">  <span class="glyphicon  glyphicon-trash"></span></a>';


         })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {

         if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
             $id=Auth::User()->getProvider->id;
            $model=new Gate();
             if($request->isMethod("post")){
                 try{
                    $data=$request->all();
                    $model=Gate::create($data);
                    Session::flash("success_msg","Gate Added Successfully");
                    return redirect()->back();

                   }catch(\Exception $e){
                    Helper::sendEmailToSupport($e);

                   }
                

             }
            $data['properties']=Property::where(['provider_id'=>$id])->get();
            $data['model']=$model;
            $data['url']=url('/security/gate/create');
            return view('gate::gates.create',$data);

      }else{
            Session::flash('danger_msg',"You have not subscribed/purchased to this Security module");
            return view("forbidden");
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
    public function update(Request $request,$id)
    {

         if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
             $P_id=Auth::User()->getProvider->id;
            $model=Gate::find($id);
             if($request->isMethod("post")){
                 try{
                    $data=$request->all();
                    $model=$model->update($data);
                    Session::flash("success_msg","Gate Added Successfully");
                    return redirect()->back();

                   }catch(\Exception $e){
                    Helper::sendEmailToSupport($e);
                    Session::flash("danger_msg","Error Occured and Technical Team Advised on what to do");
                     return redirect()->back();

                   }
                

             }
            $data['properties']=Property::where(['provider_id'=>$P_id])->get();
            $data['model']=$model;
            $data['url']=url('/security/gate/update/'.$id);
            return view('gate::gates.create',$data);

      }else{
            Session::flash('danger_msg',"You have not subscribed/purchased to this Security module");
            return view("forbidden");
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
