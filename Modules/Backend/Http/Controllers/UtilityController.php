<?php

namespace Modules\Backend\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller ;
use Modules\Backend\Entities\Property;
use Auth;
use Entrust;
use Modules\Backend\Entities\Space;
use DB;
use Modules\Backend\Entities\Repair;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\RepairItem;
use Session;
use Modules\Backend\Entities\Invoice;
use Modules\Backend\Entities\Tenant;
use Modules\Supplier\Entities\Supplier;
use Modules\Supplier\Entities\ProviderSupplier;
use Modules\Tenants\Entities\RepairRequest;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;
use Modules\Backend\Entities\UtitlityBill;
use Modules\Backend\Entities\Agent;
use App\Http\Middleware\AccountSetUp;


class UtilityController extends Controller
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
        return view('backend::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
         if(Entrust::hasRole("Admin")|| Entrust::hasRole("Provider")|| Entrust::hasRole("Agent"))
            {
                $data['page_title']="Utility Bills Management";
                $data['url']=url()->current();
                $data['properties']=Property::where(['provider_id'=>auth::user()->getProvider->id])->get();
                 if($request->isMethod("post"))
                 {
                    $data=$request->all();
                    $spaces=$data['spaceid'];
                     $water=$data['water'];
                     $electricity=$data['electricity'];
                     DB::beginTransaction();
                       

                     foreach($spaces as $key=>$value)
                     {
                        $space_id=$spaces[$key];
                         $space=Space::find($space_id);
                          if($space)
                          {
                          $new_wwater_reading=$water[$key];
                          $new_elec_reading=$electricity[$key];
                          $month=date('M',strtotime($data['reading-date']));
                          $year=date('Y',strtotime($data['reading-date']));
                           $tenant=Tenant::where(['space_id'=>$space->id,'current_status'=>'Active'])->first();
                          

                          $bill=UtitlityBill::where(['space_id'=>$space->id,'month'=>$month,'year'=>$year])->first();
                           if(!$bill)
                           {
                            $bill=new UtitlityBill();
                            $bill->space_id=$space->id;
                            $bill->month=$month;
                            $bill->year=$year;
                            $bill->w_payment_status="Pending";
                            $bill->e_payment_status="Pending";
                            $bill->tenant_id=$tenant->id;
                            $bill->tenant_user_id=$tenant->user_id;
                            $bill->reading_date=date("Y-m-d",strtotime($data['reading-date']));
                            $bill->current_w_reading =doubleval($new_wwater_reading);
                            $bill->old_w_reading=$this->getOldWater($space);
                            $bill->water_meter_number=$space->water_meter_number;
                            $bill->property_id=$space->property_id;
                            $bill->provider_id=$space->property->provider_id;
                            $bill->electricity_meter_number=$space->electricity_meter_number;
                            $bill->old_e_reading=$this->getOldElectricity($space);
                            $bill->current_e_reading=doubleval($new_elec_reading);
                            $bill->save();
                            }

                            

                          }
                        


                     }
                     DB::commit();


                     Session::flash("success_msg","Utill Readings Recorded Succesfully");
                     return redirect()->back();

                 }



              return view('backend::utilities.create',$data);

            }else{
             return view("forbidden");
            }
        
    }


    public function getUnitsReading($id)
    {
      if(Entrust::hasRole("Admin")|| Entrust::hasRole("Provider")|| Entrust::hasRole("Agent"))
            {
                $models=Space::where(['property_id'=>$id,'status'=>'Occupied'])->get();

                 foreach($models as $model)
                 {
                    $water_meter=(isset($model->water_meter_number))?$model->water_meter_number:"Not Set";
                    $elec_meter=(isset($model->electricity_meter_number))?$model->electricity_meter_number:"Not Set";
                    $old_water=$this->getOldWater($model);
                    $old_elec=$this->getOldElectricity($model);

                    echo '<tr>
                            <td>'.$model->number.'</td>
                            <td>'.$water_meter.'</td>
                            <td>'.$elec_meter.'</td>
                            <td>'.$old_water.'</td>
                            <td><Input type="text"  class="number" name="water[]" required=true></td>
                            <td>'.$old_elec.'</td>
                               <td class="hidden"><Input type="hidden"  name="spaceid[]" required=true value="'.$model->id.'"></td>
                            <td><Input type="text"  class="number" name="electricity[]" required=true></td>



                    </tr>';
                 }

            }else{
             return "Access Denied.You do not have permission to perform this function.";
            }
    }

    public function getUtilityBills()
    {
        if(Entrust::hasRole("Admin")|| Entrust::hasRole("Provider") || Entrust::hasRole("Agent"))
            {
                $data['page_title']="Utility Bills Center";
                return view('backend::utilities.index',$data);
       }else{
                return view("forbidden");
            }
    }

    public function fetchBills()
    {
         if(Entrust::hasRole("Renter"))
            {
                $models=UtitlityBill::join('users','users.id','=','utility_bills.tenant_user_id')
               ->join('spaces','spaces.id','=','utility_bills.space_id')
               ->where(['utility_bills.tenant_user_id'=>auth::user()->id])
               ->select('users.name','spaces.number','utility_bills.created_at','reading_date','current_w_reading','water_used_units','w_payment_amount','current_e_reading','electricity_used_units','e_payment_amount','utility_bills.id')
               ->orderBy('utility_bills.created_at','desc');

            }
    else if(Entrust::hasRole("Admin"))
        {
            $models=UtitlityBill::join('users','users.id','=','utility_bills.tenant_user_id')
               ->join('spaces','spaces.id','=','utility_bills.space_id')
             
               ->select('users.name','spaces.number','utility_bills.created_at','reading_date','current_w_reading','water_used_units','w_payment_amount','current_e_reading','electricity_used_units','e_payment_amount','utility_bills.id')
               ->orderBy('utility_bills.created_at','desc');


        }else{
       $models=UtitlityBill::join('users','users.id','=','utility_bills.tenant_user_id')
               ->join('spaces','spaces.id','=','utility_bills.space_id')
               ->where(['utility_bills.provider_id'=>auth::user()->getProvider->id])
               ->select('users.name','spaces.number','utility_bills.created_at','reading_date','current_w_reading','water_used_units','w_payment_amount','current_e_reading','electricity_used_units','e_payment_amount','utility_bills.id')
               ->orderBy('utility_bills.created_at','desc');
        }
        

               

        return Datatables::of($models)
        ->editColumn('w_payment_amount',function($model){
            $url=url('/backend/utility-bill/water/'.$model->id);
            return '<a class="reject-modal" data-title="View More  Water Usage Details" data-url="'.$url.'">'.number_format($model->w_payment_amount,2).'</a>';

        })

         ->editColumn('e_payment_amount',function($model){
            $url=url('/backend/utility-bill/power/'.$model->id);
            return '<a class="reject-modal" data-title="View More Electricity Usage Details" data-url="'.$url.'">'.number_format($model->e_payment_amount,2).'</a>';

        })
        ->addColumn('action',function($model){
           
                     $url=url('/backend/utility-bill/view/'.$model->id);
                      $edit_url=url('/backend/utility-bill/edit/'.$model->id);
                    
                      return '
                                <div class="dropdown">
                              <button class="btn btn-info btn-xs  dropdown-toggle" type="button" data-toggle="dropdown">Actions
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                <li><a class="reject-modal"  data-url="'.$url.'" data-title="View Record Details" >Detailed View</a></li>
                                <li><a title="Edit Details" class="reject-modal"  data-url="'.$edit_url.'" data-title="Edit  Details" >Edit Details</a></li>
                               
                              </ul>
                            </div> 
                                ';
        })
        ->make(true);

    }

    public function getWaterDetails($id)
    {
        $model=UtitlityBill::find($id);
         if($model)
         {
        
           $data['model']=$model;
           $data['agent']=Agent::find($model->provider_id);
                return view('backend::utilities.water_view',$data);
            }
         else{
            return "Resource Not Found";
         }

    }

    public function editDetails($id,Request $request)
    {
         
           if(Entrust::hasRole("Provider")|| Entrust::hasRole("Agent") || Entrust::hasRole("Admin"))
            {
                $model=UtitlityBill::find($id);
                 if(!$model)
                 {
                    return "Resource Not Found";
                 }

                  if($request->isMethod("post"))
                  {
                     $data=$request->all();
                      if($model->utility_status=="Pending")
                      {

                        $model->current_w_reading=doubleval($data['water_reading']);
                        $model->current_e_reading=doubleval($data['power_reading']);
                        $model->reading_date=date('Y-m-d',strtotime($data['reading_date']));
                        $model->save();
                        Session::flash("success_msg",'Utility Bill Details updated Successfully since it was still in Pending State');
                        return redirect()->back();

                      }
                    dd($model);
                  }





                 $data['model']=$model;
                 $data['url']=url()->current();
                  return view('backend::utilities._edit',$data);


            }else{
                return "Access Denied";
            }

    }

    public function viewDetails($id)
    {
         $model=UtitlityBill::find($id);
         if($model)
         {
           $data['model']=$model;
           $data['agent']=Agent::find($model->provider_id);
                return view('backend::utilities.view',$data);
            }
         else{
            return "Resource Not Found";
         }


    }

    public function getPowerDetails($id)
    {
         $model=UtitlityBill::find($id);
         if($model)
         {
        
           $data['model']=$model;
           $data['agent']=Agent::find($model->provider_id);
                return view('backend::utilities.power_view',$data);
            }
         else{
            return "Resource Not Found";
         }

    }

    public function getOldWater($token)
    {
        $model=UtitlityBill::where(['space_id'=>$token->id])->latest('id')->first();
         return ($model)?number_format($model->current_w_reading,2):"0.00";
    }

     public function getOldElectricity($token)
    {

        //ALTER TABLE `agents` ADD `unit_price_water` DOUBLE NULL AFTER `method`, ADD `unit_price_gabbage` DOUBLE NULL AFTER `unit_price_water`;
        $model=UtitlityBill::where(['space_id'=>$token->id])->latest('id')->first();
         return ($model)?number_format($model->current_e_reading,2):"0.00";
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
