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
use Modules\Backend\Entities\Amentity;
use Modules\Backend\Entities\Space;
use Auth;
use Modules\Backend\Entities\PropertyImage;
use Modules\Backend\Entities\SpaceImage;
use Modules\Backend\Entities\SubCategory;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\Tenant;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\SystemModule;
use App\ProviderModule;
use App\Helpers\Helper;
use Modules\Backend\Entities\Repair;
use Modules\Backend\Entities\TenantCharges;
use Modules\Backend\Entities\Upload;
use Modules\Backend\Entities\TenantPayment as Payment;
use App\Http\Middleware\AccountSetUp;

class StatisticsControlerController extends Controller
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
        return view('backend::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('backend::create');
    }

    public function getPropertyRepairsStatistics($year){
         if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider")){
            
            $data['page_title']="Property Repair Statistics";
            $data['years']=$this->getRepairYears();
            $months=array('Jan'=>1,'Feb'=>2,'Mar'=>3,'Apri'=>4,'May'=>5,'Jun'=>6,
                'Jul'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12
             );  
            $data['months']=$months;
            $data['properties']=Property::where(['properties.provider_id'=>Auth::User()->getProvider->id])->get();
            $data['model']=new Repair();
            $data['mwaka']=$year;

              return view('backend::properties.repair_statistics',$data);




         }else{
            return view("forbidden");
         }

    }

    public function getRepairYears($property_id=null){
         $id=Auth::User()->getProvider->id;
        if($property_id==null){
          $years=Repair::where(['provider_id'=>$id,])->orderBy('repairs.created_at','desc')
              ->get()
              ->groupBy(function($date) {
              return \Carbon::parse($date->created_at)->format('Y'); // grouping by years
        //return Carbon::parse($date->created_at)->format('m'); // grouping by months
         });

        }else{
          
          $years=Repair::join('spaces','spaces.id','=','repairs.space_id')->where(['provider_id'=>$id,'spaces.property_id'=>$property_id])->orderBy('repairs.created_at','desc')
              ->get()
              ->groupBy(function($date) {
              return \Carbon::parse($date->created_at)->format('Y'); // grouping by years
        //return Carbon::parse($date->created_at)->format('m'); // grouping by months
         });



        }
        


      
        
        $mwaka=array();
        foreach($years as $key){
            foreach($key as $model){
           if(!in_array($model->created_at->year, $mwaka)){
                array_push($mwaka,$model->created_at->year); 
               }
              }
            }

             if(sizeof($mwaka)>0){
              return $mwaka;

             }else{
              return array(date('Y'));
             }

    }


    public function getPropertyRepairStatistics($property_id){
         if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider")){
            $id=Auth::User()->getProvider->id;
            
               try{

                 $property=Property::where(['id'=>$property_id,'provider_id'=>$id])->first();
                    if(!$property){
                   return view("not_found");
                    }

                     $data['page_title']=$property->title." Repair Statistics";
                     $data['detail']=$property;
                     $data['years']=$this->getRepairYears($property->id);
            $months=array('Jan'=>1,'Feb'=>2,'Mar'=>3,'Apri'=>4,'May'=>5,'Jun'=>6,
                'Jul'=>7,'Aug'=>8,'Sept'=>9,'Oct'=>10,'Nov'=>11,'Dec'=>12
             );  
            $data['months']=$months;
            $data['properties']=Property::where(['properties.provider_id'=>Auth::User()->getProvider->id])->get();
             ;
            $data['model']=new Repair();
            $data['mwaka']=date('Y');
              return view('backend::properties.property_repair_statistics',$data);
                 




               }catch(\Exception $e){
                  
                 Helper::sendEmailToSupport($e);


               }



         }else{
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
