<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado y tiene el rpe con valor "ADMIN"
        if (Auth::check() && Auth::user()->rpe === 'ADMIN') {
            return $next($request);
        }

        return redirect('/')->with('error', 'No tienes permiso para acceder a esta sección.');
    }
}