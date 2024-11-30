<?php

namespace App\Http\Middleware;

use Closure;
use Entrust;
use Auth;

class AccountSetUp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if(Entrust::hasRole("Provider")|| Entrust::hasRole("Agent"))
            {
            $details=Auth::user()->getProvider;
            $is_firstLogin=($details)?$details->is_first_time_login:"No";
              
            ;
             if($is_firstLogin=="Yes")
             {
              return redirect('/backend/provideraccount/setup');
             }
              if($details->status=="Rejected" || $details->status=="Suspended")
              {
                 return redirect('/backend/provideraccount/blocked');
              }
         }
         else if(Entrust::hasRole("Renter"))
            {
                 $user=Auth::user();
                   if(strlen($user->email)<1 || strlen($user->username)<1)
                  {
                    return redirect('/backend/RenterAccount/setup');

                  }
            }
        return $next($request);
    }
}
