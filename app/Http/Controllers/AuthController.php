<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            // Tentar autenticar com as credenciais fornecidas
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                
                if (!$user->is_active) {
                    Auth::logout();
                    return back()->withErrors(['email' => 'Usuário desativado.']);
                }
                
                if ($user->isAdmin()) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('student.dashboard');
                }
            } else {
                return back()->withErrors(['email' => 'Credenciais inválidas.']);
            }
            
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Erro na autenticação: ' . $e->getMessage()]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
