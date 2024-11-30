<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Entrust;
use Auth;
use DB;
use Modules\Backend\Entities\Category;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller ;
use Modules\Backend\Entities\SubCategory;
use App\Http\Middleware\AccountSetUp;
class CategoryController extends Controller
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
         if(Entrust::hasRole("Admin")){
            $data['page_title']="Category Management";
            $data['categories']=Category::orderBy('created_at','desc')->get();


            return view('backend::category.index',$data);
        }else{
            return view("forbidden");
        }
        
    }


    public function indexsub(){
         if(Entrust::hasRole("Admin")){
            $data['page_title']="Category Management";
            $data['categories']=SubCategory::orderBy('created_at','desc')->get();


            return view('backend::category._index',$data);
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
        if(Entrust::hasRole("Admin")){
     $data['page_title']="Create Category";

        $method = $request->method();
       if($request->isMethod('post')) {
                $this->validate($request,
                    ['name'=>'required|unique:categories',
                      'description'=>'required']);

                $data=$request->all();
                $model=new Category();
                $model::create($data);
                Session::flash("success_msg","Category Created Successfully");
                return redirect('/backend/category/management/index');
            
            }

        return view('backend::category.create',$data);
        }
        else{
            return view("forbidden");
        }
        
    }


    public function create_subcategory(Request $request){

        if(Entrust::hasRole("Admin")){
     $data['page_title']="Create Sub Category";

        $method = $request->method();
       if($request->isMethod('post')) {
                $this->validate($request,
                    ['name'=>'required|unique:categories',
                      'description'=>'required']);

                $data=$request->all();
                $model=new SubCategory();
                $model::create($data);
                Session::flash("success_msg","Sub Category Created Successfully");
                return redirect('/backend/category/management/sub_index');
            
            }
             $data['categories']=Category::orderBy('name')->get();

        return view('backend::category.sub_create',$data);
        }
        else{
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
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id,Request $request)
    {
        if(Entrust::hasRole("Admin")){
            $model=Category::find($id);
             if(!$model){
                return view("not_found");
             }else{

                  if(isset($_POST['name']) && $_POST['description']){
                     $data=$request->all();
                     $model->update($data);
                     Session::flash("success_msg","Category Updated successfully");

                  }
                $data['model']=$model;
                $data['page_title']="Edit Category";
                return view('backend::category.edit',$data); 
             }

           
       }else{
        return view("forbidden");
       }
        
    }

    public function updatesubcategory($id,Request $request){
        if(Entrust::hasRole("Admin")){
            $model=SubCategory::find($id);
           
             if(!$model){
                return view("not_found");
             }else{

               if($request->isMethod('post')) {
                $data=$request->all();
                $model->update($data);
                Session::flash("success_msg","Category Updated successfully");


               }

                 
                $data['model']=$model;
                $data['categories']=Category::orderBy('name')->get();
                $data['page_title']="Edit Category";
                return view('backend::category.sub_edit',$data); 
             }

           
       }else{
        return view("forbidden");
       }
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

    public function getsubcategories($id){
         if(Entrust::hasRole("Provider")){
            $models=SubCategory::where(['category_id'=>$id])->get();
            if(!$models){
                echo "<option value='0'>--No Types Found Under The selected Category</option>";
            }else{
                echo "<option>---Select Option--</option>";
                foreach($models as $model){
                    echo '<option value="'.$model->name.'">'.$model->name.'</option>';
                }

            }
            echo '<option value="Add">Add New Subcategory</option>';

         }
    }


    public function addSubcat(Request $request,$id){
        if(Entrust::hasRole("Provider") || Entrust::hasRole("Admin")){
          $p_id=Auth::User()->getProvider->id;

           if($request->isMethod('post')){
             $data=$request->all();
             $subcategory=new Subcategory();
             $subcategory->category_id=$data['category_id'];
             $subcategory->name=$data['name'];
             $subcategory->save();
             return redirect()->back();
           }



          $locals=Category::where(['scope'=>'local','provider_id'=>$p_id])->get();
          $data['categories']=$locals;

          $data['id']=$id;
          $data['url']=url('backend/category/addsub/'.$id);
          return view('backend::category.sub_p_add',$data); 

        }else{
            return "<h3 style='color:red;'>Access Denied.<h3>";
         
    }
        }
}
