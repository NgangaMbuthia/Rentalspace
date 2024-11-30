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
use Modules\Gate\Entities\GateGaurd;
use Modules\Gate\Entities\GateAssignment;
use Modules\Gate\Entities\GateVisitor;
use Modules\Gate\Entities\VisitorElecronic;
use Modules\Backend\Entities\Property;
use App\User;
use Modules\UserManagement\Entities\Role;
use Modules\UserManagement\Entities\Profile;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\Space;
use Modules\Gate\Entities\GateVehicle;
use App\Http\Middleware\AccountSetUp;
class GateVisitorController extends Controller
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
        return view('gate::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
         if(Entrust::hasRole("Guard")){

            $guard_id=Auth::user()->guardDetails->id;
        $data['page_title']="Add Visitor";
        $data['model']=new GateVisitor();
         $tenants=$this->getTenants($guard_id);
         if($request->isMethod('post')){
              $data=$request->all();
               $guard_id=Auth::user()->guardDetails->id; 
               $gate_details=$this->GateDetails($guard_id);
               $v_a=array('gate_id'=>$gate_details->id,
                           'property_id'=>$gate_details->property_id,
                            'action1'=>"Inside",
                            'time_in'=>date("Y-m-d H:i:s"),


                           );
               $visitor_data=array_merge($data['visitor'],$v_a);
                
                 $model=GateVisitor::create($visitor_data);
                   if($model){
                    $boolen_electronics=$data['has_electronics'];
                       if($boolen_electronics=="Yes"){
                          $electronics=$data['items'];
                          $v_e=array('gate_id'=>$gate_details->id,
                           'property_id'=>$gate_details->property_id,
                            'action1'=>"Inside",
                            'time_in'=>date("Y-m-d H:i:s"),
                            'visitor_id'=>$model->id,


                           );
                           $electronics=array_merge($electronics,$v_e);
                           $elctron=VisitorElecronic::create($electronics);

                       }
                 $boolen_vehicle=$data['has_vehicle'];
                    if($boolen_vehicle=="Yes"){
                        $v_v=array('gate_id'=>$gate_details->id,
                           'property_id'=>$gate_details->property_id,
                            'action1'=>"Inside",
                            'visitor_id'=>$model->id,
                            );
                         $vehicle_data=$data['vehicle'];
                         $vehicle_data=array_merge($vehicle_data,$v_v);
                          $vehicle=GateVehicle::create($vehicle_data);
                        }
                        Session::flash("success_msg","visitor Added succesfully");
                        return redirect()->back();


          

                   
                   }
                 
                
         }
         $data['tenants']=$tenants;
         $data['url']=url('/security/visitor/create');

         return view('gate::visitor.create',$data);





       }else{
        return view("forbidden");
       }
    }


    public function GateDetails($id){
        $today=date('Y-m-d');


       
           try{
             $assingment=GateAssignment::where(['status'=>'Active'])->where('guard_id',$id)->first();
                try{
                      
                     $id=($assingment)?$assingment->gate_id:null;

                    $model=Gate::find($id);
                     return ($model)?$model:null;

                   }
                   catch(\Exception $e)
                   {  
                      

                    Helper::sendEmailToSupport($e);
                   } 
         }catch(\Exception $e){
             Helper::sendEmailToSupport($e);
         }

    }


    public function getTenants($guard_id){
        $guard=GateGaurd::find($guard_id);
           if($guard){
             $property_id=$guard->property_id;
             $provider_id=$guard->provider_id;
             $tenants=array();

             $models=Tenant::where(['provider_id'=>$provider_id,'current_status'=>'Active'])->get();
                foreach($models as $model){
                    $space=Space::where('id',$model->space_id)->first();
                      if($space->property_id==$property_id){
                        $tenants[]=array('id'=>$model->user->id,'name'=>$model->user->name);
                      }


                }

                return $tenants;



           }

    }

     public function fetVisitorDetails($id){
        $model=GateVisitor::where(['id_number'=>$id])->first();
           if($model){
            $data=array('name'=>$model->name,'email'=>$model->email_address,'mobile'=>$model->mobile);
             return json_encode($data);
           }
     }


     public function getVisitorlist(){

         if(Entrust::hasRole("Guard")){
            $data['page_title']="Gate CheckOut";



         return view('gate::visitor.index',$data);



         }else{
            return view("forbidden");
         }

     }


     public function fetchVisirors(){
       if(Entrust::hasRole("Guard"))
        {
          $guard_id=Auth::user()->guardDetails->id;
         $gate_details=$this->GateDetails($guard_id);
          if($gate_details)
          {
             $id= $gate_details->property_id;
           }else{
            $id=0;
           }
        $models=GateVisitor::join('users','users.id','=','gate_visitors.host_id')
                ->join('gate_gates','gate_gates.id','=','gate_visitors.gate_id')
                ->select(['gate_gates.name as gate_name','users.name as host_name','gate_visitors.name','id_number','gate_visitors.id','gate_visitors.created_at as checkin_time'])
                ->where(['gate_gates.property_id'=>$id,'gate_visitors.status'=>'Active']);
               

        return Datatables::of($models)->addColumn('action',function($model){
             $checkout_url=url('security/gate/checkout/'.$model->id);
            return '<button data-url="'.$checkout_url.'"    data-title="check Out Details" class="btn-sm btn btn-primary reject-modal ">Check Out</button>';

        })->make(true);

        }else{
          return redirect('home');
        }
        
     }


    public function getTelephone($id){
        try
        {
            $user=User::find($id);
             if($user){
                $profile=$user->profile;
                 if($profile){
                   return  $profile->telephone;

                 }

             }

        }catch(\Exception $e){
            Helper::sendEmailToSupport($e);
        }

    }


    public function getCheckOutDetails(Request $request,$id){
        try{
        $model=GateVisitor::find($id);

          if($model){
            $items=array();

        $vehicles=GateVehicle::where(['visitor_id'=>$model->id])->get();
           foreach($vehicles as $vehicle){
             $items[]=array('item_name'=>'Vehicle','item_id'=>$vehicle->id,'number'=>$vehicle->reg_number,'make'=>$vehicle->make,'model'=>$vehicle->model);
           }
         $electronic=VisitorElecronic::where(['visitor_id'=>$model->id])->get();
           foreach($electronic as $item){
              $items[]=array('item_name'=>$item->type,'item_id'=>$item->id,'number'=>$item->serial_number,'make'=>$item->make,'model'=>$item->model);

           }

            if($request->isMethod("post")){
                 $data=$request->all();
                    if(isset($data['items'])){
                      $data_items=$data['items'];

                   foreach($data_items as $item=>$value){
                    $this->processCheckOutItems($value);
                      
                    
                   }

                    }
                  
                   $model->action2="OUTSIDE";
                   $model->status="Inactive";
                   $model->time_out=date('Y-m-d H:i:s');
                   $model->save();

                   Session::flash("success_msg","Visitor Checked Out succesfully");
                   return redirect()->back();

                








            }






            $data['models']=$items;
            $data['model']=$model;
            $data['url']=url('/security/gate/checkout/'.$model->id);
            return view('gate::visitor._checkout',$data);

          }else{
             Helper::sendEmailToSupport($model->errrors());
            return "Resource not found on our server";
          }
        

           }
         catch(\Exception $e){
            Helper::sendEmailToSupport($e);
            Session::flash("danger_msg","Error Occured while processing your request.System Admin Notified");
            return redirect()->back();
        }




    }


    public function processCheckOutItems($items){
        list($type,$type_id)=explode('_', $items);
          switch ($type) {
              case 'Vehicle':
                   try{
                    $model=GateVehicle::find($type_id);
                      $model->action2="OUTSIDE";
                      $model->status="Inactive";
                      $model->save();
                       return true;



                     }catch(\Exception $e){
                       Helper::sendEmailToSupport($e);
                       return false; 
                     }
                  break;
              
              default:
                    try{
                        $model=VisitorElecronic::find($type_id);
                        $model->action2="OUTSIDE";
                        $model->status="Inactive";
                        $model->time_out=date('Y-m-d H:i:s');
                        $model->save();
                        return true;



                      }catch(\Exception $e){
                       Helper::sendEmailToSupport($e);
                       return false; 
                     }
                  break;
          }

    }


    public function fetchVisitorsList(){
     if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
        $data['page_title']="Visitors' Report";
        $data['type']=(isset($_GET['type'])) ? $_GET['type']:"all";
         return view('gate::visitor._index',$data);



        }else{
            return view("forbidden");
        }
    }

    public function fetchVisitorReports($type){


      $guard_id=Auth::user()->guardDetails->id;
       $gate_details=Helper::GateDetails($guard_id);
        if($gate_details)
        {
       $property_id=$gate_details->property_id;
       }else{
          $property_id=0;
        }

      if($type=="Month"){
             $month=date('m');
             $models=GateVisitor::join('gate_gates','gate_gates.id','=','gate_visitors.gate_id')
                ->join('properties','gate_gates.property_id','=','properties.id')
                ->join('users','users.id','=','gate_visitors.host_id')
                ->select(['properties.title','gate_gates.name as gate_name','gate_visitors.name','id_number','gate_visitors.id','gate_visitors.created_at','gate_visitors.time_out','users.name as host_name','time_in'])
                 ->where(['properties.provider_id'=>$property_id])
                ->whereMonth('gate_visitors.created_at',$month);
                }
            elseif($type=="Year"){
             $month=date('Y');
             $models=GateVisitor::join('gate_gates','gate_gates.id','=','gate_visitors.gate_id')

                ->join('properties','gate_gates.property_id','=','properties.id')
                ->join('users','users.id','=','gate_visitors.host_id')
                ->select(['properties.title','gate_gates.name as gate_name','gate_visitors.name','id_number','gate_visitors.id','gate_visitors.created_at','gate_visitors.time_out','users.name as host_name','time_in'])
                 ->where(['properties.provider_id'=>$property_id])
                ->whereYear('gate_visitors.created_at',$month);
                }
                else{
                    $models=GateVisitor::join('gate_gates','gate_gates.id','=','gate_visitors.gate_id')
                ->join('properties','gate_gates.property_id','=','properties.id')
                ->join('users','users.id','=','gate_visitors.host_id')
                ->select(['properties.title','gate_gates.name as gate_name','gate_visitors.name','id_number','gate_visitors.id','gate_visitors.created_at','gate_visitors.time_out','users.name as host_name','time_in'])->where(['properties.provider_id'=>$property_id]);;
                

                }

        
                

         return Datatables::of($models)
          ->make(true);

    }





    public function viewVisitorsList($type){
         if($type=="Active"){
            $models=GateVisitor::join('gate_gates','gate_gates.id','=','gate_visitors.gate_id')
                ->join('properties','gate_gates.property_id','=','properties.id')
                ->select(['properties.title','gate_gates.name as gate_name','gate_visitors.name','id_number','gate_visitors.id','gate_visitors.created_at','gate_visitors.time_out'])
                ->where('gate_visitors.status','Active')
                ->where(['properties.provider_id'=>Auth::User()->getProvider->id]);
                ;
            }
         elseif($type=="Week"){
             $today=date('Y-m-d',strtotime('+1 days'));
             $today_minu=date('Y-m-d',strtotime('-7 days'));
             $models=GateVisitor::join('gate_gates','gate_gates.id','=','gate_visitors.gate_id')
                ->join('properties','gate_gates.property_id','=','properties.id')
                ->select(['properties.title','gate_gates.name as gate_name','gate_visitors.name','id_number','gate_visitors.id','gate_visitors.created_at','gate_visitors.time_out'])
                ->whereBetween('gate_visitors.created_at',array($today_minu,$today))
                 ->where(['properties.provider_id'=>Auth::User()->getProvider->id]);;
                }

            elseif($type=="Month"){
             $month=date('m');
             $models=GateVisitor::join('gate_gates','gate_gates.id','=','gate_visitors.gate_id')
                ->join('properties','gate_gates.property_id','=','properties.id')
                ->select(['properties.title','gate_gates.name as gate_name','gate_visitors.name','id_number','gate_visitors.id','gate_visitors.created_at','gate_visitors.time_out'])
                 ->where(['properties.provider_id'=>Auth::User()->getProvider->id])
                ->whereMonth('gate_visitors.created_at',$month);
                }
            elseif($type=="Year"){
             $month=date('Y');
             $models=GateVisitor::join('gate_gates','gate_gates.id','=','gate_visitors.gate_id')
                ->join('properties','gate_gates.property_id','=','properties.id')
                ->select(['properties.title','gate_gates.name as gate_name','gate_visitors.name','id_number','gate_visitors.id','gate_visitors.created_at','gate_visitors.time_out'])
                 ->where(['properties.provider_id'=>Auth::User()->getProvider->id])
                ->whereYear('gate_visitors.created_at',$month);
                }
                else{
                    $models=GateVisitor::join('gate_gates','gate_gates.id','=','gate_visitors.gate_id')
                ->join('properties','gate_gates.property_id','=','properties.id')
                ->select(['properties.title','gate_gates.name as gate_name','gate_visitors.name','id_number','gate_visitors.id','gate_visitors.created_at','gate_visitors.time_out'])->where(['properties.provider_id'=>Auth::User()->getProvider->id]);;
                

                }

        
                

         return Datatables::of($models)
          ->editColumn('time_out',function($model){
             return (isset($model->time_out))?$model->time_out:'Active';

          })
          ->setRowClass(function ($model) {
               return (!isset($model->time_out))?'alert-danger':'';
                //return $model->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            })
          ->make(true);

    }


    public function advancedSearch(){
        if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
            $data['properties']=Property::where(['properties.provider_id'=>Auth::User()->getProvider->id])->get();

             return view('gate::visitor._search',$data);

        }else{

         return "You have not subscribed to this module currently";
        }
    }


    public function vihicles(){
     if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
        $data['page_title']="Vehicles Trackings";

        return view('gate::visitor._vehicles',$data);
     }else{
        return view("forbidden");
     }

    }


    public function fetch_vehicles(){
        $models=GateVehicle::join('gate_visitors','gate_visitors.id','=','gate_vehicles.visitor_id')
                ->join('properties','gate_vehicles.property_id','=','properties.id')
                ->join('users','gate_visitors.host_id','=','users.id')
                ->join('gate_gates','gate_vehicles.gate_id','=','gate_gates.id')
                ->select(['properties.title','gate_gates.name as gate_name','gate_visitors.name','id_number','gate_visitors.id','gate_visitors.created_at','gate_visitors.time_out','users.name as host_name','reg_number','time_in','time_out'])
                ->where(['properties.provider_id'=>Auth::User()->getProvider->id]);
        return Datatables::of($models)
         ->editColumn('time_out',function($model){
             return (isset($model->time_out))?$model->time_out:'Active';

          })
          ->setRowClass(function ($model) {
               return (!isset($model->time_out))?'alert-danger':'';
                //return $model->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            })->make(true);

    }


    public function electronics(){

        if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
        $data['page_title']="Assets Tracking";

        return view('gate::visitor._assets',$data);
     }else{
        return view("forbidden");
     }

    }

    public function fetch_electronics(){

        $models=VisitorElecronic::join('gate_visitors','gate_visitors.id','=','gate_electronics.visitor_id')
                ->join('properties','gate_electronics.property_id','=','properties.id')
                ->join('users','gate_visitors.host_id','=','users.id')
                ->join('gate_gates','gate_electronics.gate_id','=','gate_gates.id')
                ->select(['properties.title','gate_gates.name as gate_name','gate_visitors.name','id_number','gate_visitors.id','gate_visitors.created_at','gate_visitors.time_out','users.name as host_name','serial_number','gate_electronics.time_in','gate_electronics.time_out'])
                ->where(['properties.provider_id'=>Auth::User()->getProvider->id]);
        return Datatables::of($models)
         ->editColumn('time_out',function($model){
             return (isset($model->time_out))?$model->time_out:'Active';

          })
          ->setRowClass(function ($model) {
               return (!isset($model->time_out))?'alert-danger':'';
                //return $model->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            })->make(true);

    }

    public function getTableStatistics(){
          if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
            $data['page_title']="Statistics";
            $months=array('Jan'=>1,'Feb'=>2,'Mar'=>3,'Apri'=>4,'May'=>5,'Jun'=>6,
                'Jul'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12
           );  
            $data['months']=$months;
            $data['properties']=Property::where(['properties.provider_id'=>Auth::User()->getProvider->id])->get();
            $data['model']=new GateVisitor();
            $data['year']=date('Y');


            return view('gate::visitor.table_statistics',$data);



             }else{
               return view("forbidden"); 
             }

    }

    public function getGraphicalStats(){
         if(Entrust::hasRole("Provider") && Helper::testModule("Users and Gate Module",Auth::user()->getProvider->id)){
            $data['page_title']="Statistics";
            $months=array('Jan'=>1,'Feb'=>2,'Mar'=>3,'Apri'=>4,'May'=>5,'Jun'=>6,
                'Jul'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12
           );  
            $data['months']=$months;
            $data['properties']=Property::where(['properties.provider_id'=>Auth::User()->getProvider->id])->get();
           
            $data['year']=date('Y');


            return view('gate::visitor.graph_statistics',$data);



             }else{
               return view("forbidden"); 
             }

    }

    public function fetchGraphData($year,$property){
          $months=array('Jan'=>1,'Feb'=>2,'Mar'=>3,'Apri'=>4,'May'=>5,'Jun'=>6,
                'Jul'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12
           );
          $graph_data=array();
          $model=new GateVisitor();
           foreach($months as $key=>$value){
             if(preg_match('/all/i', $property)){
              $count=$model->statistics(false,$year,$value);
            }else{
              $count=$model->statistics($property,$year,$value);
            }
            

            $y=$year.' '.$key;
            $graph_data[]=array('y'=>$y,'a'=>$count);

           }

           return json_encode($graph_data);

    }


      public function getMonthList($number){
     $first  = strtotime('first day next month');

$months = array();

for ($i = $number; $i >= 1; $i--) {
   $year=date('Y', strtotime("-$i month", $first));
   $month=date('M', strtotime("-$i month", $first));
   $months[]=array($year=>$month);
  
}
 return $months;

}



    public function getStatistics(){

      $id=$guard_id=\Auth::user()->guardDetails->id;
           $guard=GateGaurd::find($id);
           $property_id=$guard->property_id;
           $provider_id=$guard->provider_id;



           $enterprise_count=GateVisitor::where(['property_id'=>$property_id])->count();

             if($enterprise_count>0){

                $months=$this->getMonthList(6);
                $data=array();
                 foreach($months as $month){
                     foreach($month as $key=>$value):
                         $y=$value.' '.$key;
                        $value=date_parse($value);
                         $value=$value['month'];
                
                $sum=GateVisitor::where(['property_id'=>$property_id])->whereYear('created_at',$key)->whereMonth('created_at',$value)->count();

                $data[]=array('y'=>$y,'a'=>$sum);

              endforeach;
            }

           echo json_encode($data);

             }else{
               echo "No Data To Show";
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
