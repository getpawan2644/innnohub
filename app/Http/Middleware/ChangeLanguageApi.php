<?php

namespace App\Http\Middleware;

use Closure;

class ChangeLanguageApi
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
        if(!empty($request->header('Content-Language'))){ // This is optional as Laravel will automatically set the fallback language if there is none specified
            \App::setLocale($request->header('Content-Language'));
        }else{
            \App::setLocale("en");
        }
        return $next($request);
    }
}
