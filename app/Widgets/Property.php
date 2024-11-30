<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Session;
use Modules\Backend\Entities\Agent;
use Modules\Backend\Entities\Property as MyProprety;
use Modules\Backend\Entities\Space;
use Modules\Backend\Entities\Amentity;
use Auth;
use Illuminate\Support\Facades\Input;
use Modules\Backend\Entities\Plot;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\SubCategory;
use Modules\Site\Entities\ServiceProvider;
use Modules\Hotels\Entities\HotelRoom;

class Property extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        $data['properties']=MyProprety::where(['status'=>'Approved'])->take(4)->get();
         $data['plot_count']=Plot::where(['plot_status'=>'On Sale'])->count();
         $data['spaces']=Space::where(['status'=>'Free'])->count();
         $data['on_sale_properties']=MyProprety::where(['type'=>'For Sale'])->count();
         $data['categories']=Category::all();
         $data['service_provider_count']=ServiceProvider::count();
         $data['service_providers']=ServiceProvider::take(3)->get();
         $data['room_count']=HotelRoom::count();
         $data['config']=$this->config;
         

        return view('widgets.property',$data);
    }
}
