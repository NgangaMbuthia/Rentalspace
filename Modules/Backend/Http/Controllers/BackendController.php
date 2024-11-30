<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Modules\Backend\Entities\Upload;
use Auth;
use App\Http\Controllers\Controller ;
use Modules\Backend\Entities\SubCategory;
use Modules\Backend\Entities\Category;
use Entrust;
use Modules\Backend\Entities\ContactGroup;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\Invoice;
use Modules\Backend\Entities\Property;
use Modules\Backend\Entities\InvoiceComponent;
use Modules\Backend\Entities\ProviderAmentity;
use App\Helpers\InvoiceSender;
use App\Http\Middleware\AccountSetUp;

use Image;
use Illuminate\Support\Facades\File;
use App\ImageResize;


class BackendController extends Controller
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

    public function ProviderAmentities()
    {

        if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent")){
            $data['page_title']="Amentities List";
             
              return view('backend::amentities',$data);


        }else{
            return view("forbidden");
        }
    }

    public function importProperty(Request $request)
    {
        if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent")){
            $data['page_title']="Amentities List";
            $data['url']=url()->current();
              if($request->isMethod("post"))
              {
                 $data=$request->all();
                    $file = $request->file('file');
                $filePath = $file->getPathName();
                 $array=[]; 
                 ;
                    \Excel::load($filePath, function($reader) {
          $results = $reader->get()->toArray();
            $numbers=array();
             foreach($results as $result)
             {\DB::beginTransaction();
               
               $property=new Property();
               $p_id=\Auth::User()->getprovider->id;
               $property->title=$result['property_names']  ;
               $property->provider_id= $p_id;
               $property->unit_price=0;
               $property->system_price=0;
               $property->currency="KES";
               $property->town="Nairobi";
               $property->location=$result['location'];
               $property->garbage_fee=$result['gabbage'];
               $property->water_unit_price=$result['water'];
               $property->agent_commission_percentage=$result['commision'];
               $property->cover_image=13;
               $property->category_id=2;
               $property->subcategory_id=3;
               $property->save();

              \DB::commit();
                

             };
              });

                    Session::flash("success_msg","Property Added Successfully");
                    return redirect('/backend/property/index');


              }




             
              return view('backend::import_properties',$data);


        }else{
            return view("forbidden");
        }

    }



    public function getCurrencies(){

        if(Entrust::hasRole("Admin")){
            $data['page_title']="Set System Currencies";
             $data['system_currency']=config('app.system_currency');
              return view('backend::system_currency',$data);


        }else{
            return view("forbidden");
        }
    }

    public function addUtility(Request $request)
    {
        if(Entrust::hasRole("Admin"))
        {
            $data['url']=url()->current();
            $data['model']=new InvoiceComponent();
             if($request->isMethod("post"))
             {
                $this->validate($request,[
                    'name'=>'required|unique:invoice_componets',
                    'code'=>'required|unique:invoice_componets',
                ]);
                $data=$request->all();
                $model=new InvoiceComponent();
                $model->name=$data['name'];
                $model->code=$data['code'];
                $model->save();
                Session::flash("success_msg","Charge Added Successfully");
                return redirect()->back();
                

             }




            return view('backend::_systemcharge',$data);


        }else{
            return "Access Denied";
        }

    }




    public function getUtilist()
    {
         if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent")){
            $data['page_title']="Utility Settings";
             $data['system_currency']=config('app.system_currency');
              return view('backend::system_charges',$data);


        }else{
            return view("forbidden");
        }

    }

    public function addAmentity(Request $request)
    {
        if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent")){
            $data['url']=url()->current();
            $data['model']=new ProviderAmentity();
             if($request->isMethod("post"))
            {
                $data=$request->all();
                $model=ProviderAmentity::where(['provider_id'=>Auth::User()->getProvider->id,'name'=>$data['name']])->first();
                 if($model)
                 {
                    Session::flash("danger_msg","Amentity Already in your List.Kindly Update it");

                 }
                else{
                    $model=new ProviderAmentity();

                $model->name=$data['name'];
                $model->description=$data['description'];
                $model->provider_id=Auth::User()->getProvider->id;
                $model->save();
                Session::flash("success_msg","Amentity Added Successfully");
                }
                
                return redirect()->back();
                
            }
        return view('backend::addAmentity',$data);


        }else{
            return view("forbidden");
        }

    }

    public function fetchAmentities()
    {
        $provider_id=Auth::User()->getProvider->id;
      $models=ProviderAmentity::where(['provider_id'=>$provider_id]);
      return Datatables::of($models)
      ->addColumn('action',function($model){
        $url=url('/backend/provider/amentitiesEdit/'.$model->id);
        return '<a  data-url="'.$url.'"class="reject-modal" data-title="Edit Amentities Details"><span class="glyphicon glyphicon-pencil"></span></a>';
      })
      ->make(true);
    }
    public function fetchChargeList()
    {
        $models=InvoiceComponent::all();
        return Datatables::of($models)->make(true);
    }

    public function editAmentity($id,Request $request)
    {
         if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent")){
            $data['url']=url()->current();
            $data['model']=$model=ProviderAmentity::find($id);
             if($request->isMethod("post"))
            {
                $data=$request->all();
                 $model->name=$data['name'];
                $model->description=$data['description'];
                $model->provider_id=Auth::User()->getProvider->id;
                $model->save();
                Session::flash("success_msg","Amentity updated  Successfully");
                return redirect()->back();
                
            }
        return view('backend::addAmentity',$data);


        }else{
            return "Access Denied";
        }

    }

    public function sendReminder()
    {
         if(Entrust::hasRole("Provider"))
       {
        return true;
          $provider_id=Auth::User()->getProvider->id;
           $models=Tenant::where(['current_status'=>"Active",'provider_id'=>$provider_id])->get();
         foreach($models as $model){
          $invoice=Invoice::where(['issued_to'=>$model->user_id])->latest('id')->first();
           $status=$invoice->status;
            if($status=="Pending")
            {
                $user=$model->user;
                
                 $message="Dear ".$user->name.",you are kindly requested to pay your pending invoice with number ".$invoice->invoice_number ." of Kes ".$invoice->amount." . Thanks ";
                   $phone=$model->user->profile->telephone;
                
                InvoiceSender::sendEmail($invoice,"Payment Reminder");
                 InvoiceSender::sendGeeckoSMS($phone,$message);
                  
            }
           }
           Session::flash("success_msg","Reminder Send Successfully");
           return redirect()->back();
         }else
     {
        return view("forbidden");
     }
    }

    public function fetchCurrency(){
        $models=\App\SystemCurrency::all();
        return Datatables::of($models)
        
         ->addColumn('action',function($model){
            $edit_url=url("/backend/system/update/".$model->id);
           return '
            <a  data-url="'.$edit_url.'"   class="reject-modal icon-pencil4" data-title="Edit Conversion Rate" >
            </a>';
           })->make(true);

    }

    public function editCurrency(Request $request,$id){
         if(Entrust::hasRole("Admin")){
             $model=\App\SystemCurrency::find($id);
               if(!$model){
                return '<h4 style="color:red;font-weight:bold;">Resource Not Found on This Server</h4>';
               }
                if($request->isMethod("post")){
                    $data=$request->all();
                    $model->currency=$data['currency'];
                    $model->kes_equivalent=$data['kes_equivalent'];
                    $model->last_update_date=date('Y-m-d');
                    $model->save();
                    Session::flash("success_msg","Currency Updated Succesfully");
                    return redirect()->back();


                }
               $data['url']=url()->current();
               $data['model']=$model;
               $data['currencies']=config('app.system_currency');
               return view('backend::currency_form',$data);
          }else{
            return '<h4 style="color:red;font-weight:bold;">Access Denied</h4>';
         }

    }

    public function createCurrency(Request $request){
         if(Entrust::hasRole("Admin")){
             $model=new \App\SystemCurrency();
               
                if($request->isMethod("post")){
                    $this->validate($request,[
                      'currency'=>'unique:system_currencies|required',
                        ]);
                    $data=$request->all();
                    $model->currency=$data['currency'];
                    $model->kes_equivalent=$data['kes_equivalent'];
                    $model->last_update_date=date('Y-m-d');
                    $model->save();
                    Session::flash("success_msg","Currency Created Succesfully");
                    return redirect()->back();


                }
               $data['url']=url()->current();
               $data['model']=$model;
               $data['currencies']=config('app.system_currency');
               return view('backend::currency_form',$data);
          }else{
            return '<h4 style="color:red;font-weight:bold;">Access Denied</h4>';
         }

    }
    

    public static function uploadFile()
    {
        $files=Input::file('files');
        //dd($files);
        $fileuploads=[];

        foreach ($files as $file) {
            $path="uploads";
            $extention=$file->getClientOriginalExtension();
            $filename=date('UNIX').".".$extention;
            $file->move($path,$filename);
            $upload=new Upload;
            $upload->filename=$filename;
            $upload->extention=$extention;
            $upload->user_id=Auth::user()->id;
            $upload->save();


            $url=url('/uploads/'.$filename);
            $deleteurl=url('/uploads/delete/'.$filename);



            $img = Image::make($path.'/'.$filename);

            $img->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save(public_path($path.'/resize/100'.$filename));

            $imageresize=new ImageResize;
            $imageresize->ext=$extention;
            $imageresize->name='300200'.$filename;
            $imageresize->image_id=$upload->id;
            $imageresize->save();

            $img = Image::make($path.'/'.$filename);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save(public_path($path.'/resize/300'.$filename));

            $imageresize=new ImageResize;
            $imageresize->ext=$extention;
            $imageresize->name='300'.$filename;
            $imageresize->image_id=$upload->id;
            $imageresize->save();


            $img = Image::make($path.'/'.$filename);
            $img->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->save(public_path($path.'/resize/500'.$filename));

            $imageresize=new ImageResize;
            $imageresize->ext=$extention;
            $imageresize->name='500'.$filename;
            $imageresize->image_id=$upload->id;
            $imageresize->save();           
            
     

     
            $fileuploads[]=['name'=>$filename,'size'=>2343456,'url'=>$url,'thumbnailUrl'=>$url,'deleteUrl'=>$deleteurl,'deleteType'=>'DELETE','id'=>$upload->id];

        }
        return response()->json(['files'=>$fileuploads]);
        exit;
    }

    public static function fetchFiles()
    {
        $images=Upload::where('user_id',Auth::user()->id)->orderBy('id','DESC')->take(12)->get();
        return json_encode($images);
    }

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

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
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
    public function getAddProperty()
    {
         $data['page_title']="Add Property";
         $categories=array();
         $p_id=Auth::User()->getProvider->id;
         $global=Category::where(['scope'=>'global'])->get();
          foreach($global as $glop){
            $categories[]=array('id'=>$glop->id,'name'=>$glop->name,'display_name'=>$glop->display_name);
          }
           
         $locals=Category::where(['scope'=>'local','provider_id'=>$p_id])->get();
         foreach($locals as $glop){
            $categories[]=array('id'=>$glop->id,'name'=>$glop->name,'display_name'=>$glop->display_name);
          }
          
         $data['categories']=$categories;
         $data['amentities']=ProviderAmentity::orderBy('name')->get();
         $data['utilities']=InvoiceComponent::orderBy('name')->get();
        
         
          
        return view('backend::properties.add',$data);
    }



}
