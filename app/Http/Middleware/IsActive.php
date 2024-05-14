<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsActive
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
        if (Auth::user()->is_active == true) {
            return $next($request);
        } else {
            // Si l'utilisateur n'est pas actif, retournez une réponse indiquant que l'utilisateur est bloqué
          //  $message = "<p style='color: red; font-weight: bold;'>Utilisateur Bloqué</p>";
           // return new Response($message, 403);
           return redirect('/client/bloquerMessage');
        }
    }
}
