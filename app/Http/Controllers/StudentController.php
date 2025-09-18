<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
    }

    public function dashboard()
    {
        $enabledModules = auth()->user()->enabledModules()
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('student.dashboard', compact('enabledModules'));
    }

    public function showModule(Module $module)
    {
        // Verificar se o módulo está habilitado para o usuário
        if (!auth()->user()->enabledModules()->where('module_id', $module->id)->exists()) {
            abort(403, 'Módulo não habilitado para este usuário.');
        }

        $module->load(['pontos' => function ($query) {
            $query->orderBy('order');
        }, 'videos' => function ($query) {
            $query->orderBy('order');
        }]);

        return view('student.module', compact('module'));
    }

    public function downloadApostila(Module $module)
    {
        // Verificar se o módulo está habilitado para o usuário
        if (!auth()->user()->enabledModules()->where('module_id', $module->id)->exists()) {
            abort(403, 'Módulo não habilitado para este usuário.');
        }

        if (!$module->apostila_url) {
            abort(404, 'Apostila não disponível.');
        }

        // Em produção, você pode querer registrar o download
        return redirect($module->apostila_url);
    }
}

