<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Session;
use Modules\Backend\Entities\Agent;
use Modules\Backend\Entities\Property;
use Modules\Backend\Entities\Space;
use Modules\Backend\Entities\Amentity;
use Auth;
use Illuminate\Support\Facades\Input;
use Modules\Backend\Entities\Plot;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\SubCategory;
use Modules\Site\Entities\ServiceProvider;
use Modules\Hotels\Entities\HotelRoom;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
         $data['models']=Property::orderBy('created_at','desc')->take(8)->get();
         $data['plots']=Plot::where(['plot_status'=>'On Sale'])->take(4)->inRandomOrder()->get();
         $data['plot_count']=Plot::where(['plot_status'=>'On Sale'])->count();
         $data['spaces']=Space::where(['status'=>'Free'])->count();
         $data['on_sale_properties']=Property::where(['type'=>'For Sale'])->count();
         $data['categories']=Category::all();
         $data['sub_categories']=SubCategory::orderBy('name')->get();
         $data['service_provider_count']=ServiceProvider::count();
         $data['service_providers']=ServiceProvider::take(3)->get();
         $data['room_count']=HotelRoom::count();
         $data['featured_product']=Plot::where(['plot_status'=>'On Sale'])->inRandomOrder()->first();
        return view('site::index',$data);
    }

    public function grid_view(){
          $query=Property::orderBy('created_at','desc');

          if (Input::has('town')) 
            {
                $query=$query->where('town',Input::get('town'));
            }
            if (Input::has('type')) 
            {
                $query=$query->where('type',Input::get('type'));
            }

            if (Input::has('price')) 
            {
                $query=$query->where('unit_price','=<',Input::get('price'));
            }
            $data['models']=$query->paginate(9);
        return view('site::grid_view',$data);

    }

    public function view_details($id)
    {
        $data['model']=Plot::find($id);
         return view('site::detail_view',$data);


    }

    public function search(){
         $query=Property::where(['status'=>'Approved']);
        if(Input::has('location')){
            $query=$query->where('location', 'like', '%' . Input::get('location') . '%')
                 ->orwhere('town', 'like', '%' . Input::get('location') . '%');
             }
        if(Input::has('category_id')){
            $query=$query->where(['category_id'=>Input::get('category_id')]);
        }
         if(Input::has('price')){

             
             list($min,$max)=explode(';',Input::get('price'));
             $query=$query->whereBetween('system_price', array($min, $max));
             
        }

        if(Input::has('sub_category')){
            $query=$query->where(['subcategory_id'=>Input::get('sub_category')]);
        }
        $query=$query->get();
        $data['models']=$query;
        $data['plots']=Plot::where(['plot_status'=>'On Sale'])->take(4)->get();
        $data['categories']=Category::all();
        
        return view('site::properties.search',$data);
          }


          public function searchLand(){
            $query=Plot::where(['plot_status'=>'On Sale']);

            if(Input::has('location')){
            $query=$query->where('location', 'like', '%' . Input::get('location') . '%')
                 ->orwhere('town', 'like', '%' . Input::get('location') . '%');
             }
       
           if(Input::has('price'))
             {
             
             list($min,$max)=explode(',',Input::get('price'));
             $query=$query->whereBetween('plot_price', array($min, $max));
             
            }
            $query=$query->get();
            $data['models']=$query;
              $data['plots']=Plot::where(['plot_status'=>'On Sale'])->take(4)->get();
        
        $data['properties']=Property::where(['status'=>'Approved'])->take(4)->get();
         $data['plot_count']=Plot::where(['plot_status'=>'On Sale'])->count();
         $data['spaces']=Space::where(['status'=>'Free'])->count();
         $data['on_sale_properties']=Property::where(['type'=>'For Sale'])->count();
         $data['categories']=Category::all();
         $data['service_provider_count']=ServiceProvider::count();
          $data['service_providers']=ServiceProvider::take(3)->get();
         $data['room_count']=HotelRoom::count();

         return view('site::properties.search_land',$data);
          


          }

public function getCategories($id){
     $models=SubCategory::where(['category_id'=>$id])->get();
       echo '<option value="" >any</option>';

       foreach($models as $model){
        echo '<option value="'.$model->id.'" >'.$model->name.'</option>';
       }
  }

  public function ViewProvider($id){
    $model=ServiceProvider::find($id);
    $data['model']=$model;
     


     return view('site::providers.details',$data);

  }


 










    public function terms()
    {
     return view('site::terms');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('site::create');
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
        return view('site::edit');
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
