<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Site\Entities\ServiceProvider as SProvider;

class Serviceprovider extends AbstractWidget
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
    
     $service_providers=SProvider::take(3)->inRandomOrder()->get();

        return view('widgets.serviceprovider', [
            'config' => $this->config,
            'service_providers'=>$service_providers,
        ]);
    }
}
