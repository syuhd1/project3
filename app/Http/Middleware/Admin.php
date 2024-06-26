<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //for non admin role detection from accessing admin dashboard , 28/5
        if(Auth::user()->usertype !='admin'){
        // if(Auth::user()->usertype =='user'){

            return redirect('/');
        }
        return $next($request);
    }
}
