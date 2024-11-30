<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Messaging;
use Auth;
class Notification extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
    'count'=>19,
    'type'=>'notification'
    


    ];
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */

     public function run()
    {
        //
    $models=Messaging::where(['flag'=>$this->config['type'],'receiver_id'=>Auth::User()->id,'status'=>'Unread'])->take($this->config['count'])->orderBy('created_at','DESC')->get();
   $counts=Messaging::where(['flag'=>$this->config['type'],'receiver_id'=>Auth::User()->id,'status'=>'Unread'])->count();

        return view("widgets.notification", [
            'config' => $this->config,
            'models'=>$models,
            'count'=>$counts,
            'type'=>$this->config['type']
        ]);
    }
}
