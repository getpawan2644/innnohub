<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;

class ChangeLanguage
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
        //dd($request);
        if (!empty(Session::has('locale')) ) {
            \App::setLocale(Session::get('locale'));
        } else{
            \App::setLocale("en");
        }
        return $next($request);
    }
}
