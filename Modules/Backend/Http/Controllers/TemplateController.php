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
use Modules\Backend\Entities\SpaceTemplate;
use Modules\Backend\Entities\TemplateAttribute;
use Modules\Backend\Entities\TemplateImage;
use App\Http\Middleware\AccountSetUp;

class TemplateController extends Controller
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
         if(Entrust::hasRole("Provider")|| Entrust::hasRole("Agent"))
            {
                $data['page_title']="Space Addition Templates";
              return view('backend::templates.index',$data);
            }else{
                return view("forbidden");
            }
       
    }

    public function fetchTemplates()
    {
        $models=SpaceTemplate::where(['provider_id'=>auth::user()->getProvider->id])
                ->orderBy('created_at','desc');
        return Datatables::of($models)
        ->editColumn('name',function($model){
            $view_url=url('/backend/templates/view/'.$model->id);
            return '<a href="'.$view_url.'">'.str_limit($model->name,30).'</a>';

        })
         ->editColumn('description',function($model){
            return  str_limit($model->description,100);

        })
        ->addColumn('action',function($model){
            $edit_url=url('/backend/template/edit/'.$model->id);
          return '<a href="'.$edit_url.'"><span class="icon-pencil"></span></a>';
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
         if(Entrust::hasRole("Provider")|| Entrust::hasRole("Agent"))
            {
                $data['page_title']="Space Templates";
                 $data['url']=url()->current();

                  if($request->isMethod("post"))
                  {
                   
                      try{
                        DB::beginTransaction();
                         $data=$request->all();
                          $model=new SpaceTemplate();
                          $model->name=$data['name'];
                          $model->provider_id=auth::user()->getProvider->id;
                          $model->description=$data['description'];
                          $model->save();
                           if(isset($data['key']) && isset($data['value']))
                           {
                             $keys=$data['key'];
                             $values=$data['value'];
                              foreach($keys as $key=>$value)
                              {
                                $keyName=strtoupper($keys[$key]);
                                $valueName=$values[$key];
                                $a=$this->createAttribute($model,$keyName,$valueName);
                                }
                             
                           }
                           if(isset($data['images']))
                           {
                            $images_array=explode(',', $data['images']);
                             $this->createTemplateImages($model,$images_array);
                             
                           }

                           DB::commit();
                           Session::flash('success_msg',"Templated Created Successfully");
                           return redirect('/backend/templates/index');
                       }catch(\Exception $e)
                       {
                         dd($e);
                       }
                  }




                return view('backend::templates.create',$data); 
            }
            else{
                return view("forbidden");
            }
       
    }


    public function createAttribute($model,$keyName,$valueName)
    {
        try{
            $attribute=TemplateAttribute::where(['template_id'=>$model->id,'key'=>$keyName])->first();
             if(!$attribute)
             {
                $attribute=new TemplateAttribute();
                $attribute->template_id=$model->id;
              }
             $attribute->key=$keyName;
             $attribute->value=$valueName;
             $attribute->save();
             return true;
         }catch(\Exception $e)
        {
            Helper::sendEmailToSupport($e);
            return false;
        }

    }

    public function viewTemplate($id)
    {
         if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent"))
            {
                $model=SpaceTemplate::where(['provider_id'=>auth::user()->getProvider->id,'id'=>$id])->first();
                 if(!$model)
                 {
                    return view("not_found");
                 }else{
                    $data['model']=$model;
                    $data['page_title']="Template Details";
                      return view('backend::templates.view',$data); 

                 }}else{
                return view("forbidden");
            }

    }


    public function editTemplate($id,Request $request)
    {
         if(Entrust::hasRole("Provider")|| Entrust::hasRole("Agent"))
            {
                 $model=SpaceTemplate::where(['provider_id'=>auth::user()->getProvider->id,'id'=>$id])->first();
                   if(!$model)
                   {
                     $data['page_title']="Resource Not Found";
                    return view("not_found");
                   }
                $data['page_title']="Edit Template";
                $data['url']=url()->current();
                $data['model']=$model;
                 if($request->isMethod("post"))
                 {
                    $data=$request->all();
                    try{
                        DB::beginTransaction();
                         $data=$request->all();
                        
                          $model->name=$data['name'];
                          $model->provider_id=auth::user()->getProvider->id;
                          $model->description=$data['description'];
                          $model->save();

                           if(isset($data['key']) && isset($data['value']))
                           {
                             $keys=$data['key'];
                             $values=$data['value'];
                             $this->deleteCurrentAttributes($model);

                              foreach($keys as $key=>$value)
                              {
                                $keyName=strtoupper($keys[$key]);
                                $valueName=$values[$key];
                                 $attribute=new TemplateAttribute();
                                 $attribute->template_id=$model->id;
                                 $attribute->key=$keyName;
                                 $attribute->value=$valueName;
                                 $attribute->save();
                             }
                             
                           }
                           if(isset($data['images']))
                           {
                            $images_array=explode(',', $data['images']);
                             $this->editTemplateImages($model,$images_array);
                             
                           }

                           DB::commit();
                           Session::flash('success_msg',"Templated updated Successfully");
                           return redirect('/backend/templates/index');
                       }catch(\Exception $e)
                       {
                         Helper::sendEmailToSupport($e);
                         Session::flash("danger_msg","Error occured while processing your request.System Administrator notified about the error ");
                         return redirect()->back();
                       }




                 }




                return view('backend::templates.edit',$data); 


            }else{
                return view("forbidden");
            }

    }

    public function createTemplateImages($model,$images)
    { if(is_array($images)):
             foreach ($images as $key) {
                 if(isset($key) && strlen($key)>0)
                 {
                    $image=TemplateImage::where(['template_id'=>$model->id,'image_id'=>$key])->first();
                     if(!$image)
                     {

                        $image=new TemplateImage();
                        $image->image_id=$key;
                        $image->template_id=$model->id;
                        $image->save();
                         
                     }
                 }
                
             }
             return true;
         endif;
    }

    public function editTemplateImages($model,$images)
    {   $this->deleteCurrentImages($model);
        if(is_array($images)):
             foreach ($images as $key) {
                 if(isset($key) && strlen($key)>0)
                 {
                    $image=TemplateImage::where(['template_id'=>$model->id,'image_id'=>$key])->first();
                     if(!$image)
                     {

                        $image=new TemplateImage();
                        $image->image_id=$key;
                        $image->template_id=$model->id;
                        $image->save();
                         
                     }
                 }
                
             }
             return true;
         endif;
    }





    public function EditAttributess($model,$keyName,$valueName)
    {
        try{

          $testDelete=$this->deleteCurrentAttributes($model);
           if($testDelete)
            {
             $attribute=TemplateAttribute::where(['template_id'=>$model->id,'key'=>$keyName])->first();
             if(!$attribute)
             {
                $attribute=new TemplateAttribute();
                $attribute->template_id=$model->id;
              }
             $attribute->key=$keyName;
             $attribute->value=$valueName;
             $attribute->save();
             return true;

           }else{
            return false;
           }
            
         }catch(\Exception $e)
        { 
            Helper::sendEmailToSupport($e);
            return false;
        }

    }

    public function deleteCurrentAttributes($model)
    {  
        try{
          $model->attributes()->forceDelete();
        }catch(\Exception $e)
        {
        Helper::sendEmailToSupport($e);
            return false;
        }
    }

    public function deleteCurrentImages($model)
    {
        try{
          $model->images()->forceDelete();
        }catch(\Exception $e)
        {
        Helper::sendEmailToSupport($e);
            return false;
        }

    }

    public function editAttribute($id,Request $request)
    {
         if(Entrust::hasRole("Provider") || Entrust::hasRole("Agent"))
            {
                 $model=TemplateAttribute::find($id);
                 $data['page_title']="Template Details";
                 $data['url']=url()->current();
                 $data['model']=$model;
                  if($request->isMethod("post"))
                  {
                    $data=$request->all();
                    $model->key=strtoupper($data['key']);
                    $model->value=$data['value'];
                    $model->save();
                    Session::flash("success_msg","Template Attribute updated Successfully");
                    return redirect()->back();
                  }



                return view('backend::templates._edit',$data); 

            }else{
                return "Access Denied";
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
