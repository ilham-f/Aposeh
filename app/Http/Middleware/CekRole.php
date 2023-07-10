<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekRole
{
    
    public function handle(Request $request, Closure $next, ...$roles)
    {

        $user = Auth::user();

        foreach($roles as $role) {
            // Check user role
            if($user->role == $role)
                return $next($request);
        }
        // dd($user->role);
        return redirect('/');
        // dd($roles);
        // if ($request->user()->role == $roles) {
        //     return $next($request);
        // }

        // abort(403, 'Access denied. You must have ' . $roles . ' privileges.');
    }
}
