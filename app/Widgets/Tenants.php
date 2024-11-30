<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Backend\Entities\Tenant;
use Auth;

class Tenants extends AbstractWidget
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
        $models=Tenant::where(['provider_id'=>\Auth::User()->getprovider->id])->take(5)->get();
        return view("widgets.tenants", [
            'config' => $this->config,
            'models'=>$models
        ]);
    }
}