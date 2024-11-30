<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Backend\Entities\Agent;

class Frontsiderbar extends AbstractWidget
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
        $models=Agent::orderBy('created_at','desc')->get();

        return view("widgets.frontsiderbar", [
            'config' => $this->config,
            'models'=>$models
        ]);
    }
}