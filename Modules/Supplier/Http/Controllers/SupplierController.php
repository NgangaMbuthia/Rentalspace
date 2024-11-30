<?php

namespace Modules\Supplier\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller ;
use Entrust;
use Auth;
use Modules\Supplier\Entities\Director;
use Modules\Supplier\Entities\Supplier;
use Modules\Supplier\Entities\ProviderSupplier;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Http\Middleware\AccountSetUp;
class SupplierController extends Controller
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
        return view('supplier::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function createNewSupplier(Request $request)
    {
         if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider")){
            $model=new Supplier();

             if($request->isMethod('post')){

                  $this->validate($request,[
                    'legal_name'=>'required|unique:suppliers',
                    'reg_number'=>'required|unique:suppliers',
                    'vat'=>'required|unique:suppliers',
                    'service_type'=>'required',
                    'account_number'=>'required|unique:suppliers'


                    ]);
                 $data=$request->all();
                  DB::beginTransaction();
                  $director_country=$data['country'];
                  $director_identification=$data['identification'];
                  $director_numbers=$data['identification_number'];
                  $director_name=$data['direct_name'];

                   unset($data['country']);
                   unset($data['identification']);
                   unset($data['identification_number']);
                   unset($data['direct_name']);
                   $model=Supplier::create($data);

                    if($model){
                        $provider_id=Auth::User()->getProvider->id;
                          $supplier=new ProviderSupplier();
                          $supplier->supplier_id=$model->id;
                          $supplier->provider_id=$provider_id;
                          $supplier->save();

                    foreach($director_country as $key=>$value){
                        
                           
                             $director=new Director();
                             $director->supplier_id=$model->id;
                             $director->name=$director_name[$key];
                             $director->identification=$director_identification[$key];
                             $director->identifaction_number=$director_numbers[$key];
                             $director->country=$director_country[$key];
                             $director->save();
                         

                     }

                      
                     DB::commit();
                     Session::flash('success_msg','Supplier Added Succesfully');
                     return redirect()->back();

                    }
                     

                   
             }



            $data['page_title']="Supplier Module";
            $data['model']=$model;;
            $data['url']=url('/supplier/supplier/add_new');
          return view('supplier::suppliers.create',$data);  
      }else{
        return view('forbidden');
      }
        
    }

    public function getSuppliers(){
        if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider")){
            $data['page_title']="Supplier Module";
            return view('supplier::suppliers.index',$data); 


        }else{
            return view('forbidden');
        }
    }


    public function fetch_list(){
         if(Entrust::hasRole("Admin")){
             $models=ProviderSupplier::join('suppliers','suppliers.id','=','provider_suppliers.supplier_id')->get();

         }elseif(Entrust::hasRole("Provider")){
            $provider_id=Auth::User()->getProvider->id;
             $models=ProviderSupplier::join('suppliers','suppliers.id','=','provider_suppliers.supplier_id')
             ->where(['provider_id'=>$provider_id])->get();
             
              return Datatables::of($models)
              ->editColumn('legal_name',function($model){
                $view_url=url('/supplier/supplier/view/'.$model->id);
                 return '<a href="'.$view_url.'">'.$model->legal_name.'</a>';
              })
              ->addColumn('action', function ($model) {
                     $view_url=url('/supplier/supplier/view/'.$model->id);
                     $url=url('/supplier/supplier/update/'.$model->id);
                     $url_to=url('/backend/notices/create/'.$model->tenant_id);
                      return '

                      <a   title="Edit Supplier Details" href="'.$view_url.'" class="glyphicon glyphicon-eye-open "
                               d
                              ></a>

                      <a style="margin-left:4%"    title="Edit Supplier Details" href="'.$url.'" class="glyphicon glyphicon-pencil "
                               d
                              ></a>


                      
                              


                              <a  style="margin-left:5%" title="Extend The Lease Period" data-url="'.$url.'" class="icon-mouse reject-modal"
                               data-title="Extend The Lease Period"
                              ></a>
                                ';

                    
                    })->make(true);


         }else{
            return view('forbidden');
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
    public function show($id)
    {
      if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider")){
         $model=Supplier::find($id);
          if(!$model){
            return view('not_found');
          }
          $data['model']=$model;
          $data['directors']=$model->directors;
          $data['page_title']="Supplier Module";
          return view('supplier::suppliers.view',$data); 

      }else{
        return view('forbidde');
      }
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('supplier::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {
     if(Entrust::hasRole("Admin") || Entrust::hasRole("Provider")){
        $model=Supplier::find($id);
         if(!$model){
          return view("not_found");
         }
          if($request->isMethod('post')){
            $data=$request->all();
            $director_country=$data['country'];
                  $director_identification=$data['identification'];
                  $director_numbers=$data['identification_number'];
                  $director_name=$data['direct_name'];

                   unset($data['country']);
                   unset($data['identification']);
                   unset($data['identification_number']);
                   unset($data['direct_name']);
               $model->update($data);
                 $models=Director::where(['supplier_id'=>$model->id])->get();
                   foreach($models as $mod){
                    $mod->delete();
                   }

                    foreach($director_country as $key=>$value){
                        
                          if(isset($director_name[$key]) && !empty($director_name[$key])) {
                            $director=new Director();
                             $director->supplier_id=$model->id;
                             $director->name=$director_name[$key];
                             $director->identification=$director_identification[$key];
                             $director->identifaction_number=$director_numbers[$key];
                             $director->country=$director_country[$key];
                             $director->save();
                          }
                        }
                Session::flash('success_msg','Supplier Details updated successfully');
                return redirect('/supplier/supplier/index');
          }
         $data['page_title']="Supplier Module";
         $data['model']=$model;
         $data['url']=url('supplier/supplier/update/'.$model->id);
          return view('supplier::suppliers.create',$data);


     }else{
        return view('forbidden');
     }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }


    public function getSupplierDetails(){
         $q=  Input::get('q');
         
        if(strlen($q)>3){
        $models=Supplier::where('legal_name','like','%'.$q.'%')->get();
       $data=array();
       foreach($models as $model){
        $sub_data=array('id'=>$model->id,'name'=>$model->legal_name);
         array_push($data,$sub_data);
       }
      
    $out = ['results' => $data,'more'=>false];
   $data=json_encode($out);
   return $data;

        }

    }

    public function getSupplierList($name=null){
       $models=Supplier::where(['core_commodity'=>$name])->get();


       $html="";
         foreach($models as $model):
          $html.='<tr>
                   <td><input type="checkbox" value="'.$model->id.'"  class="my-checklist" name="supplier_id[]"></td>
                   <td>'.$model->legal_name.'</td>
                   <td>'.$model->core_commodity.'</td>
                   <td>'.$model->telephone.'</td>
                   <td>'.$model->city.'</td>
                   <td>'.$model->country_of_origin.'</td>
                   <td>'.$model->vat.'</td>
                     
                   </tr>';



          endforeach;

          return $html;
       

    }
}
