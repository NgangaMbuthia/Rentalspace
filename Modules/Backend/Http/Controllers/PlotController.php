<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Entrust;
use Modules\Backend\Entities\Plot;
use Modules\Backend\Entities\PlotImage;
use Illuminate\Support\Facades\Session;
use DB;
use App\Http\Controllers\Controller ;
use App\Helpers\Helper;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Http\Middleware\AccountSetUp;

class PlotController extends Controller
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
         if(Entrust::hasRole("Provider")){
            $data['page_title']="Manage Plots";
            $data['status']=(isset($_GET['status']))? $_GET['status']:'All';
            return view('backend::plots.index',$data); 
         }else{
            return view("forbidden");
         }
       
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        if(Entrust::hasRole("Provider")){

            if($request->isMethod("post")){

                $this->validate($request,[
                    'plot_size'=>'required',
                    'plot_price'=>'required',
                    'name'=>'required',
                    'city'=>'required',
                    'contact_phone'=>'required',
                    'contact_email'=>'required'
                  ]);
                 $data=$request->all();
                 $model=new Plot();
                 $model->name=$data['name'];
                 $model->city=$data['city'];
                 $model->country=$data['country'];
                 $model->state=$data['state'];
                 $model->area=$data['location'];
                 $model->plot_size=$data['plot_size'];
                 $model->plot_price=$data['plot_price'];
                 $model->added_valeu=json_encode($data['amenities']);
                 $model->contact_phone=$data['contact_phone'];
                 $model->contact_email=$data['contact_email'];
                 $model->contact_phone_two=$data['contact_phone_two'];
                 $model->contact_email_two=$data['contact_email_two'];
                 $model->bank_name=$data['bank_name'];
                 $model->branch=$data['branch'];
                 $model->account_number=$data['account_number'];
                 $model->account_name=$data['account_name'];
                 $model->description=$data['description'];
                 $model->provider_id=Auth::User()->getProvider->id;
                 $model->plot_status="On Sale";
                 $images=$data['images'];
                 $model->plot_id=str_random(6);



                 $model->save();
                  if($model){
                     $images=explode(',', $images);
                    foreach($images as $key){
                        if(strlen($key)>0){
                    $imageModel=new PlotImage();
                    $imageModel->plot_id=$model->id;
                    $imageModel->image_id=$key;
                    $imageModel->save();

                        }

                  
                 }

                  }
                 
                Session::flash("success_msg","Plot Added Successfully");
                return redirect('/backend/plots/index');

              
                 



            }





            $data['page_title']="Plots Managements";
            $data['url']=url('/backend/plots/create');
      return view('backend::plots.create',$data);


        }else{
            return view("forbidden");
        }
        }

  public function fetchPlots($status){
    
    $id=Auth::User()->getProvider->id;

    if($status=="All"){
        $models=Plot::where(['provider_id'=>$id]);
    }else{
         
        $models=Plot::where(['provider_id'=>$id,'plot_status'=>$status]);
    }
    
    return Datatables::of($models)
    ->editColumn('plot_status',function($model){
        if($model->plot_status=="Sold"){
            return '<label class="label label-success">'.$model->plot_status.'</label>';

        }else{
            return '<label class="label label-info">'.$model->plot_status.'</label>';
        }

    })
    ->addColumn('action',function($model){
        $update_url=url('/backend/plots/update/'.$model->id);
       return  '<a href="'.$update_url.'"><span class="glyphicon glyphicon-pencil"></span></a>
             <a href="" style="margin-left:15%;"><span class="glyphicon glyphicon-trash"></span></a>



       ';

    })->make(true);

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
            $data['page_title']="Update Land/Plot Details";
            $p_id=Auth::User()->getProvider->id;
            $model=Plot::where(['provider_id'=>$p_id,'id'=>$id])->first();
             if(!$model){
                return view("not_found");
             }

             if($request->isMethod("post")){
                $this->validate($request,[
                    'plot_price'=>'required',
                    'plot_size'=>'required',
                    'name'=>'required',
                    'location'=>'required',
                    'city'=>'required',
                    ]);

                $data=$request->all();
                 $model->name=$data['name'];
                 $model->city=$data['city'];
                 $model->country=$data['country'];
                 $model->state=$data['state'];
                 $model->area=$data['location'];
                 $model->plot_size=$data['plot_size'];
                 $model->plot_price=$data['plot_price'];
                 $model->added_valeu=json_encode($data['amenities']);
                 $model->contact_phone=$data['contact_phone'];
                 $model->contact_email=$data['contact_email'];
                 $model->contact_phone_two=$data['contact_phone_two'];
                 $model->contact_email_two=$data['contact_email_two'];
                 $model->bank_name=$data['bank_name'];
                 $model->branch=$data['branch'];
                 $model->account_number=$data['account_number'];
                 $model->account_name=$data['account_name'];
                 $model->description=$data['description'];
                 $model->provider_id=Auth::User()->getProvider->id;
                 $model->plot_status=$data['plot_status'];
                 $images=$data['images'];
                 $model->save();
                  if($model){
                    $old_images=PlotImage::where(['plot_id'=>$model->id])->get();
                    foreach($old_images as $deletekye){
                         $deletekye->delete();
                    }
                     $images=explode(',', $images);
                    
                    foreach($images as $key){
                        if(strlen($key)>0){
                    $imageModel=new PlotImage();
                    $imageModel->plot_id=$model->id;
                    $imageModel->image_id=$key;
                    $imageModel->save();

                        }

                  
                 }

                  }


                   Session::flash("success_msg","Plot updated Successfully");
                return redirect('/backend/plots/index');

             }






             $data['model']=$model;
             $data['available_ammentities']=json_decode($model->added_valeu);
             $data['url']=url('/backend/plots/update/'.$model->id);
              return view('backend::plots.update',$data); 




        }else{
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
