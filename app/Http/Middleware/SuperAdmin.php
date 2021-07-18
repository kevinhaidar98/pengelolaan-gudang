<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdmin
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
        $role = Auth::user()->id_role;
        if($role == 1){
            return $next($request);
        } else {
            Auth::logout();
            return redirect()->to('/')->with('status','Maaf, terdapat keterbatasan akses pada halaman ini');
        }
    }
}
