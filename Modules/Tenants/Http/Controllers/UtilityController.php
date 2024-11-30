<?php

namespace Modules\Tenants\Http\Controllers;


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

class UtilityController extends Controller
{

       public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
         if(Entrust::hasRole("Renter"))
            {
                $data['page_title']="Utility Bills";

                return view('tenants::utilities.index',$data);
            }else{
                return view("forbidden");
            }
        
    }

    public function getStatistics()
    {
         if(Entrust::hasRole("Renter"))
            {
                $data['page_title']="Utility Bills Payment Statistics";
                $data['months']=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                $data['year']=(isset($_GET['year']))?$_GET['year']:date('Y');
                $data['model']=new UtitlityBill();
                

                return view('tenants::utilities.statistics',$data);
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
        return view('tenants::create');
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
        return view('tenants::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('tenants::edit');
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
