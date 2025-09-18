<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class FirebaseAuthController extends Controller
{
    protected $firebaseAuth;

    public function __construct(FirebaseAuth $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    }

    public function login(Request $request)
    {
        $request->validate([
            'id_token' => 'required|string',
        ]);

        try {
            // Verifica o token do Firebase
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($request->id_token);
            $uid = $verifiedIdToken->claims()->get('sub');
            $email = $verifiedIdToken->claims()->get('email');
            $name = $verifiedIdToken->claims()->get('name', 'Usuário Firebase');

            // Busca o usuário no banco local
            $user = User::where('firebase_uid', $uid)->first();

            if (!$user) {
                // Cria um novo usuário se não existir
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'firebase_uid' => $uid,
                    'role' => 'student', // Role padrão
                    'is_active' => true,
                    'password' => Hash::make(Str::random(16)), // Senha aleatória
                ]);
            }

            if (!$user->is_active) {
                return response()->json(['error' => 'Usuário inativo'], 403);
            }

            // Autentica o usuário na sessão web para rotas protegidas por 'auth'
            Auth::login($user, true);

            // Opcional: Gera um token (Sanctum) para chamadas API se necessário
            $token = method_exists($user, 'createToken') ? $user->createToken('firebase-token')->plainTextToken : null;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'firebase_uid' => $uid,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido: ' . $e->getMessage()], 401);
        }
    }

    public function verifyToken(Request $request)
    {
        $request->validate([
            'id_token' => 'required|string',
        ]);

        try {
            $verifiedIdToken = $this->firebaseAuth->verifyIdToken($request->id_token);
            $uid = $verifiedIdToken->claims()->get('sub');
            
            $user = User::where('firebase_uid', $uid)->first();
            
            if (!$user) {
                return response()->json(['error' => 'Usuário não encontrado'], 404);
            }

            return response()->json([
                'valid' => true,
                'user' => $user,
                'firebase_uid' => $uid,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido: ' . $e->getMessage()], 401);
        }
    }

    public function logout(Request $request)
    {
        // Revoga o token do Sanctum
        $request->user()->currentAccessToken()->delete();
        
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
