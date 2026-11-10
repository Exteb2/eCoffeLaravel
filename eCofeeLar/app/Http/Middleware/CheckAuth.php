<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Si l'utilisateur n'est pas connecté, retour à la page de connexion
        if (!session('connecte')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}