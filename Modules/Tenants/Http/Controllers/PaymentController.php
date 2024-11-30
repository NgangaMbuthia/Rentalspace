<?php

namespace Modules\Tenants\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller ;
use Auth;
use Modules\Backend\Entities\TenantPayment;
use Entrust;
use Modules\Backend\Entities\Tenant;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Modules\Backend\Entities\Invoice;
use Modules\Backend\Entities\Repair;
use Modules\Tenants\Entities\RepairRequest;
use Modules\Backend\Entities\Space;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;
use DB;
use Modules\Tenants\Entities\SubmittedPayment;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Messaging;
use Redirect;
class PaymentController extends Controller
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
        return view('tenants::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request,$id=null)
    {
          if(Entrust::hasRole("Renter"))
            {
                $data['page_title']="Submit Invoice Payment";
                $data['url']=url()->current();
                $data['id']=(isset($_GET['id']))?$_GET['id']:null;
                $data['spaces']=Tenant::where(['user_id'=>auth::user()->id,'current_status'=>'Active'])->get();
                 $data['invoices']=Invoice::where(['issued_to'=>auth::user()->id,'status'=>'Pending'])->get();
                  if($request->isMethod("post"))
                  {
                      $this->validate($request,[
                        'ref_no'=>'required|string|unique:submitted_payments',
                        'amount_paid'=>'required',
                        'space_id'=>'required'


                      ]);
                    $data=$request->all();
                      try{
                        $invoice=Invoice::find($data['invoice_id']);
                        DB::beginTransaction();
                            
                        $model=new SubmittedPayment();
                         $model->user_id=Auth::user()->id;
                         $model->space_id=$invoice->space_id;
                         $model->provider_id=$invoice->provider_id;
                         $model->property_id=$invoice->space->property_id;
                         $model->invoice_amount =doubleval($invoice->amount);
                         $model->method=$data['method'];
                         $model->ref_no=$data['ref_no'];
                         $model->transaction_date=date('Y-m-d',strtotime($data['payment_date']));
                         $model->invoice_id=$invoice->id;
                         $model->amount_paid=doubleval($data['amount_paid']);
                         $model->balance =$model->invoice_amount-$model->amount_paid; 
                         $model->month=date("M");
                         $model->year=date("Y");
                         $model->save();
                          if(($model->method=="Cheque" || $model->method=="BankSlip") &&(isset($data['file_name'])))
                          {

                              $this->uploadSlip($model,$data);
                          }
                          $invoice->status="On Hold";
                          $invoice->save();
                          DB::commit();
                          $provider=$invoice->space->property->getProvider;
                          $name=$provider->name;
                          $messages="Dear ".$name.",".auth::user()->name." has submitted payment for invoice number ".$invoice->invoice_number.".  Kindly act on it";
                          $phone=$provider->telephone;
                          Helper::sendSms($phone,$messages);
                           $message=new Messaging();
                           $message->receiver_id=$provider->user_id;
                           $message->sender_id=Auth::User()->id;
                           $message->subject="New Payment Submitted";
                           $message->content=$messages;
                           $message->flag="notification";
                           $message->key=strtoupper(str_random(8));
                           $message->save();
                           Session::flash('success_msg',"Patment Submitted Successfully for Approval");
                           return redirect('/tenants/payment/submitted');



                        




                      }catch(\Exception $e)
                      {
                         dd($e);
                      }
                    
                  }

              return view('tenants::invoices.pay',$data);

            }else{
               return view("forbidden");
            }
        
    }



    public function uploadSlip($model,$data) {
    $id=Input::get('file_name');
    
    // getting all of the post data
    $file = array('image' => Input::file('file_name'));
    // setting up rules
    $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
    // doing the validation, passing post data, rules and the messages
    $validator = Validator::make($file, $rules);
    if ($validator->fails()) {
      // send back to the page with the input data and errors
      return Redirect::to('tenants/invoice/payment')->withInput()->withErrors($validator);
    }
    else {
      // checking file is valid.
      if (Input::file('file_name')->isValid()) {
        $destinationPath = 'paymentslips/'.auth::user()->id; // upload path
        $extension = Input::file('file_name')->getClientOriginalExtension(); // getting image extension
        $fileName = $model->invoice_id.'-'.date('YmdHis').'.'.$extension; // renameing image
        Input::file('file_name')->move($destinationPath, $fileName); // uploading file to given path
        // sending back with message
        $name= $fileName;
        $model->file_name=$name;
       if($model->save()){
         return true;
       }
          
      }
      else {
        // sending back with error message.
        
        return redirect()->back()->with('msg','File is Not valis');
      }
    }
  }

  public function fetchSubmitted()
  {
      if(Entrust::hasRole("Renter"))
        {
           $models=SubmittedPayment::join('spaces','spaces.id','=','submitted_payments.space_id')
            ->join('properties','properties.id','=','submitted_payments.property_id')
            ->join('invoices','invoices.id','=','submitted_payments.invoice_id')
            ->where(['user_id'=>auth::user()->id])
            ->select('submitted_payments.amount_paid','submitted_payments.id','method','transaction_date','invoice_number','ref_no','number','properties.title','approve_status','invoice_id');

        }
        else{
           $models=SubmittedPayment::join('spaces','spaces.id','=','submitted_payments.space_id')
            ->join('properties','properties.id','=','submitted_payments.property_id')
            ->join('invoices','invoices.id','=','submitted_payments.invoice_id')
            ->where(['submitted_payments.provider_id'=>Auth::User()->getProvider->id])
            ->select('submitted_payments.amount_paid','submitted_payments.id','method','transaction_date','invoice_number','ref_no','number','properties.title','approve_status','invoice_id')
            ;
        }
   

      return Datatables::of($models)
      ->editColumn('invoice_number',function($model){
        $invoice_url=url('/backend/invoice/view/'.$model->invoice_id);
        return '<a href="'.$invoice_url.'">'.$model->invoice_number.'</a>';
      })

      ->editColumn('amount_paid',function($model){
        $invoice_url=url('/tenants/submitted_payements/details/'.$model->id);
        return '<a href="'.$invoice_url.'">'.$model->amount_paid.'</a>';
      })

       ->editColumn('title',function($model){
      
        return str_limit($model->title,14);
      })
       ->editColumn('approve_status',function($model){
         if($model->approve_status=="Rejected")
         {
          return '<label class="label label-danger">'.$model->approve_status.'</label>';
         }
         else if($model->approve_status=="Approved")
         {
        return '<label class="label label-success">'.$model->approve_status.'</label>';
         }else{
         return '<label class="label label-info">'.$model->approve_status.'</label>';
         }

       })



      ->addColumn('action',function($model){
            $approve_url=url('/backend/payments/approve-payment/'.$model->id);
              $reject_url=url('/backend/payment/reject/'.$model->id);
            
          if($model->approve_status=="Pending")
          {
            return ' <ul class="icons-list">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="icon-menu9"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                        
                         
                          <li><a href="'.$approve_url.'"><i class=" icon-library2"></i>Approve</a></li>
                          <li><a   style="cursor:pointer;"  title="Reject Submitted Payments" class="reject-modal"
                                data-title="Reject This Payment"   data-url="'.$reject_url.'"
                                 ><i class="icon-clapboard"></i> Reject</a></li>
                        
                         

                        
                           
                        </ul>
                      </li>
                    </ul>';


          }elseif($model->approve_status=="Rejected"){
            return ' <ul class="icons-list">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="icon-menu9"></i>
                        </a>
                       <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="'.$approve_url.'"><i class=" icon-library2"></i>Re-Approve</a></li>
                        </ul>
                      </li>
                    </ul>';

             }else{
               return ' <ul class="icons-list">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="icon-menu9"></i>
                        </a>
                       <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#"><i class=" icon-library2"></i>No Action For Now</a></li>
                        </ul>
                      </li>
                    </ul>';

             }

              })
          
          


      ->make(true);


  }

  public function viewDetails($id)
  {
       if(Entrust::hasRole("Renter"))
        {
          $model=SubmittedPayment::where(['id'=>$id,'user_id'=>auth::user()->id])->first();
            if($model)
            {
              $data['model']=$model;
              $data['page_title']="Submitted Payments";
              return view('tenants::tenants.paydetails',$data);

            }else{
              return view("not_found");
            }


        }else{
          return view("forbidden");
        }

  }


  public function getMontlySummary()
  {
     if(Entrust::hasRole("Renter"))
      {
        $data['page_title']="Monthly Summary";
         return view('tenants::payments.montly_summary',$data);


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
