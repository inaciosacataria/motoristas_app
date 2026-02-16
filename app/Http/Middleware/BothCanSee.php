<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BothCanSee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Você precisa estar autenticado para acessar esta página.');
        }

        $user = Auth::user();

        // Permitir acesso para admin e empregador
        if ($user->privilegio === 'admin' || $user->privilegio === 'empregador') {
            return $next($request);
        }

        return redirect('/')->with('error', 'Acesso não autorizado. Você não tem permissão para acessar esta página.');
    }
}

