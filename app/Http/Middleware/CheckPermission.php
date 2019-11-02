<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class CheckPermission
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
        $current_url = $request->route()->uri();
        if ($current_url == '/' || $current_url == 'login') {
            return $next($request);
        }
        $current_route = $request->route()->action['as'];

        $permission = Permission::where('name', $current_route)->first();

        if (!$permission) {
            return $next($request);
        }
        if (auth()->user()->hasPermissionTo($permission->id)) {
            return $next($request);
        } else {
            Session::flash('message', 'Insufficient Permission');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/');
        }
    }
}
