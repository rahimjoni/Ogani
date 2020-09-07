<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if(Auth::check()){
            $roleId=$request->user()->role_id;
            $userId=$request->user()->id;

            switch($roleId){

                case 1:
                    return $next($request);
                    break;
                default :
                    return redirect('/error-page');

            }
        }
    }
}
