<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use App\Models\User;

class FirebaseAuthMiddleware
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuth $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken() ?? $request->header('Authorization');
        
        if (!$token) {
            return response()->json(['error' => 'Token não fornecido'], 401);
        }

        try {
            // Remove 'Bearer ' se presente
            $token = str_replace('Bearer ', '', $token);
            
            // Verifica o token no Firebase
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($token);
            $uid = $verifiedIdToken->claims()->get('sub');
            
            // Busca o usuário no banco local
            $user = User::where('firebase_uid', $uid)->first();
            
            if (!$user) {
                return response()->json(['error' => 'Usuário não encontrado'], 404);
            }
            
            if (!$user->is_active) {
                return response()->json(['error' => 'Usuário inativo'], 403);
            }
            
            // Adiciona o usuário à request
            $request->merge(['firebase_user' => $user]);
            $request->setUserResolver(function () use ($user) {
                return $user;
            });
            
            return $next($request);
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido: ' . $e->getMessage()], 401);
        }
    }
}

