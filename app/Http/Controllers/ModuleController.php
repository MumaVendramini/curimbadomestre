<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::orderBy('order')->get();
        return view('admin.modules.index', compact('modules'));
    }

    public function create()
    {
        return view('admin.modules.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'toque_type' => 'required|string|max:255',
            'toque_origin' => 'nullable|string',
            'toque_characteristics' => 'nullable|string',
            'toque_application' => 'nullable|string',
            'order' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'apostila_url' => 'nullable|string|url',
            'audio_url' => 'nullable|string|url',
            'image_url' => 'nullable|string|url',
        ]);

        $module = Module::create($validated);

        return redirect()
            ->route('admin.modules.index')
            ->with('success', 'Módulo criado com sucesso!');
    }

    public function edit(Module $module)
    {
        return view('admin.modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'toque_type' => 'required|string|max:255',
            'toque_origin' => 'nullable|string',
            'toque_characteristics' => 'nullable|string',
            'toque_application' => 'nullable|string',
            'order' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'apostila_url' => 'nullable|string|url',
            'audio_url' => 'nullable|string|url',
            'image_url' => 'nullable|string|url',
        ]);

        $module->update($validated);

        return redirect()
            ->route('admin.modules.index')
            ->with('success', 'Módulo atualizado com sucesso!');
    }

    public function destroy(Module $module)
    {
        // Verifica se há usuários vinculados
        if ($module->users()->count() > 0) {
            return redirect()
                ->route('admin.modules.index')
                ->with('error', 'Não é possível excluir este módulo pois existem usuários vinculados a ele.');
        }

        // Verifica se há pontos ou vídeos vinculados
        if ($module->pontos()->count() > 0 || $module->videos()->count() > 0) {
            return redirect()
                ->route('admin.modules.index')
                ->with('error', 'Não é possível excluir este módulo pois existem pontos ou vídeos vinculados a ele.');
        }

        $module->delete();

        return redirect()
            ->route('admin.modules.index')
            ->with('success', 'Módulo excluído com sucesso!');
    }
}