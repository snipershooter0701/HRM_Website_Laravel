<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $prefixUrl)
    {
        $permissions = Auth::user()->employee->role->permissions;

        foreach ($permissions as $permission) {
            if ($permission->module['url'] == $prefixUrl)
                return $next($request);
        }

        return redirect()->route("home");
    }
}