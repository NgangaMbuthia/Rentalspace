<?php

namespace App\Listeners;

use App\Events\UserRegisterEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\UserManagement\Entities\Profile;
use Mail;
use App\Messaging;
use App\User;

class UserRegisterListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegisterEvent  $event
     * @return void
     */
      public function handle(UserRegisterEvent $event,$data)
    {
         
         dd($data);
        $profile=new Profile();
        $profile->user_id=$event->user->id;
        $profile->save();
        return false;
    }
}
