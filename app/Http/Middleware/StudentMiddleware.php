<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isStudent()) {
            abort(403, 'Acesso negado. Apenas alunos podem acessar esta área.');
        }

        return $next($request);
    }
}

