<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Session;
use Route;
use Closure;
use Illuminate\Auth\AuthenticationException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {

        if (! $request->expectsJson()) {
            if (Route::is('admin.*')) {
                return route('admin.login');
            }
            //$request->session()->flash('title', trans('messages.not_logged_in_title'));
          //  $request->session()->flash('error', trans('messages.not_logged_in'));
            //dd("fkl");
            return route('home');
            //return route('home');
            //return redirect()->action('HomeController@index');
        }
        //dd("fg");
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {

        if($this->authenticate($request, $guards) === false){
            if (! $request->expectsJson()) {
                if (Route::is('admin.*')) {
                    return redirect()->route('admin.login');
                }
                if (!empty(Session::has('locale')) ) {
                    \App::setLocale(Session::get('locale'));
                } else{
                    \App::setLocale("en");
                }
                $request->session()->flash('title', __('messages.not_logged_in_title'));
                $request->session()->flash('error', __('messages.not_logged_in'));
                return redirect()->route('home');
            }
        };

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        return false;

        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request)
        );
    }
}
