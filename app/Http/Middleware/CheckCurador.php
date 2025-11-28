<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCurador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está autenticado E se o tipo_usuario é 'curador'
        if (Auth::check() && Auth::user()->tipo_usuario === 'curador') {
            return $next($request);
        }

        // Se não for curador, redireciona para a dashboard padrão (ou para uma página de erro 403)
        return redirect('/dashboard')->with('error', 'Acesso negado. Você não tem permissão de Curador.');
        
        // Alternativamente, para um erro 403 (Forbidden):
        // abort(403, 'Acesso não autorizado.');
    }
}