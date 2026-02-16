<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpregadorMiddleware
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
        // Verificar se o usuário está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa fazer login para acessar esta área.');
        }

        // Verificar se o usuário é empregador ou admin
        if (Auth::user()->privilegio !== 'empregador' && Auth::user()->privilegio !== 'admin') {
            return redirect()->back()->with('error', 'Acesso negado. Esta área é exclusiva para empregadores.');
        }

        return $next($request);
    }
}
