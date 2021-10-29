<?php

namespace App\Http\Middleware;
use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckAdminRole
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
        $user = \Auth::user();
        $all_routes=CommonHelper::getAdminModules();
        $public_routes=[
            'admin.showProfileForm',
            'admin.updateProfile',
            'admin.updateProfilePic',
            'admin.showPasswordForm',
            'admin.updatePassword',
        ];
        if($user->role == 'Admin'){
            return $next($request);
        }else{
            $allowed_routes=["admin.dashboard.index"];
            /*Explode via $ and get the modules wise allow routes*/
            $modules_route= @explode('$',$user->modules);
            //dd($modules_route);
            $route_permissions=array();
            foreach($modules_route as $key =>$module_route){
                $route_permissions=array_merge($route_permissions,@explode('|',$module_route));
            }
            $route_permissions=array_unique($route_permissions);
            $allowed_routes = array_merge($allowed_routes,$public_routes);
            $allowed_routes = array_merge($allowed_routes,$route_permissions);
            $current_route =$request->route()->getName();
            if(in_array($current_route,$allowed_routes)){
                return $next($request);
            }
            $request->session()->flash('error',"You are not authorized to access this.");
        }
        return \Redirect::back();
    }
}
