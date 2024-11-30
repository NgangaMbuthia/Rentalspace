<?php

namespace Modules\ServiceProviders\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Entrust;
use Auth;

class ApprovalMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
         if(Entrust::hasRole("serviceProvider")){
            $provider=@auth::user()->sprovider;
             $status=$provider->status;
               if($status!="Approved"){
                 return redirect('/serviceproviders/home');
               }
         }
        return $next($request);
    }
}
