<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use DB;
use App\Http\Controllers\Controller ;
use Entrust;
use App\User;
use Modules\Backend\Entities\Space;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\Property;
use Modules\Backend\Base\TenantPdf;
use Modules\Backend\Base\TenantInvoice;
use Auth;
use Modules\UserManagement\Entities\Role;
use Modules\UserManagement\Entities\Profile;
use App\Messaging;
use App\Events\UserRegisterEvent;
use Session;
use App\Helpers\Helper;
use Modules\Backend\Entities\Agent;
use Modules\Backend\Entities\Deposit;
use Modules\Backend\Entities\EmergencyContact;
use Modules\Backend\Entities\TenantsOccupant;
use Modules\Backend\Entities\Student;
use Modules\Backend\Entities\Employer;
use Modules\Backend\Entities\Possession;
use Modules\Backend\Entities\TenantCharges;
use Modules\Backend\Entities\Invoice;
use Illuminate\Support\Facades\Input;
use Modules\Backend\Entities\Repair;
use Modules\Backend\Reports\Receipt;
use Redirect;
use Excel;
use Modules\Backend\Reports\InvoicePDf;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Modules\Supplier\Entities\Supplier;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\AdditionCharge;
use Modules\Tenants\Entities\SubmittedPayment;
use App\Http\Middleware\AccountSetUp;
use Modules\Backend\Entities\InvoiceComponent;
use Modules\Backend\Entities\InvoiceItem;
use Modules\Backend\Entities\TenantSummary;
use Modules\Backend\Entities\Payment;
use Modules\Backend\Base\Import;
use Modules\Backend\Entities\PropertyAccount;
use Modules\Backend\Entities\PropertyExpense;
use Modules\Backend\Entities\PropertyTransaction;
use Modules\Backend\Entities\ProviderTransaction;
class LandlordController extends Controller
{
   protected $orgID;
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AccountSetUp::class);
        $this->middleware(function ($request, $next) {
             
               if(strlen(Auth::user()->organization_id))
               {
                 $this->orgID = Auth::user()->organization_id;
             }else{
                $this->orgID=Auth::User()->getprovider->id;
             }

           


            return $next($request);
        });

    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
         $data['page_title']="Landlords";
        return view('backend::landlords.index',$data);
    }

    public function getMyProperies($id)
    {
        $models2=\DB::select(\DB::raw("call getLandloadProperties($id)"));
          $models=collect($models2);

          return Datatables::of($models)->make(true);


    }

    public function fetchList()
    {
           $models2=\DB::select(\DB::raw("call getLandlords($this->orgID)"));
          $models2=collect($models2);

          return Datatables::of($models2)
              ->addColumn('details_url', function($user) {
            return url('backend/Landload/getProperties/' . $user->id);
        })
           ->addColumn('action', function($model) {
           $view_url=url('/backend/Landload/ViewProperies/'.$model->id);
           $edit_url=url('/backend/Landload/Edit/'.$model->id);
            $remote_url=url('/backend/provider/remoteLogin/'.$model->id);
        $password_url=url('/backend/Provider/PasswordReset/'.$model->id);
            return '<div class="dropdown">
                  <button class="btn btn-info btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Actions
                   <span class="caret"></span></button>
                   <ul class="dropdown-menu">
                    <li><a href="'.$view_url.'">View Properies</a></li>
                    <li><a data-title="Edit Details"   class="reject-modal"  data-url="'.$edit_url.'">Edit</a></li>
                     <li><a data-title="Password Reset"   class="reject-modal"  data-url="'.$password_url.'">Reset Password</a></li>

                     <li><a href="'.$remote_url.'">Remote LogIn</a></li>
                   </ul>
                   </div>';
        })
          ->make(true);

    }
    public function EditDetails($id,Request $request)
    {
         $model=User::find($id);
          $data['model']=$model;
          $data['profile']=$profile=$model->profile;
          $data['url']=url()->current();
             if($request->isMethod("post"))
             {
                 $data=$request->all();
                   $model->name=$data['name'];
                   $model->email=$data['email'];
                   $model->save();
                   $profile->telephone=$data['telephone'];
                   $profile->postal_address=$data['postal_address'];
                   $profile->gender=$data['gender'];
                   $profile->city=$data['city'];
                   $profile->save();
                   Session::flash("success_msg","Details Updated Successfully");
                   return redirect()->back();
             }


          return view('backend::landlords._create',$data);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

         
         /*$models = DB::select('select distinct(substring_index(title, " ", 1)) as landlord from properties where provider_id = :provider_id', ['provider_id' => 5]);
          foreach($models as $model)
          {
            DB::beginTransaction();

            $properties=DB::select('sELECT * FROM properties WHERE substring_index(title, " ", 1) = :name', ['name' => $model->landlord]);

                foreach($properties as $prop)
                {
                     $property=Property::find($prop->id);

                     $user=User::where(['username'=>$model->landlord])->first();
                       if($user)
                       {
                        $property->landlord_user_id=$user->id;
                        $property->save();


                       }
                      

                }
             DB::commit();

           
            
           
          }*/
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
