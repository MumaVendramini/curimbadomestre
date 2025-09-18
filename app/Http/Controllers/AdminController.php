<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Module;
use App\Models\Ponto;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('role', 'student')->count(),
            'total_modules' => Module::count(),
            'active_modules' => Module::where('is_active', true)->count(),
            'total_pontos' => Ponto::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::where('role', 'student')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        $modules = Module::where('is_active', true)->orderBy('order')->get();
        return view('admin.users.create', compact('modules'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'firebase_uid' => 'required|string|unique:users',
            'role' => 'required|in:admin,student',
            'password' => 'required|string|min:6',
            'modules' => 'nullable|array',
            'modules.*' => 'exists:modules,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'firebase_uid' => $request->firebase_uid,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'is_active' => $request->has('is_active'),
        ]);

        // Salvar módulos habilitados para o usuário
        if ($request->has('modules') && is_array($request->modules)) {
            $user->enabledModules()->sync($request->modules);
        }

        return redirect()->route('admin.users')->with('success', 'Usuário criado com sucesso!');
    }

    public function editUser(User $user)
    {
        $modules = Module::all();
        return view('admin.users.edit', compact('user', 'modules'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_active' => 'boolean',
        ]);

        $user->update($request->only(['name', 'email', 'is_active']));

        // Atualizar módulos habilitados
        if ($request->has('modules')) {
            $user->enabledModules()->sync($request->modules);
        }

        return redirect()->route('admin.users')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Usuário removido com sucesso!');
    }

    public function modules()
    {
        $modules = Module::withCount(['pontos', 'videos'])->orderBy('order')->paginate(15);
        return view('admin.modules.index', compact('modules'));
    }

    public function createModule()
    {
        return view('admin.modules.create');
    }

    public function storeModule(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'toque_type' => 'nullable|in:ijexa,nago,samba_angola,congo,barravento',
            'toque_origin' => 'nullable|string',
            'toque_characteristics' => 'nullable|string',
            'toque_application' => 'nullable|string',
            'order' => 'required|integer|min:1',
            'apostila_url' => 'nullable|url',
            'audio_url' => 'nullable|url',
            'image_url' => 'nullable|url',
        ]);

        Module::create($request->all());

        return redirect()->route('admin.modules')->with('success', 'Módulo criado com sucesso!');
    }

    public function editModule(Module $module)
    {
        return view('admin.modules.edit', compact('module'));
    }

    public function updateModule(Request $request, Module $module)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'required|integer|min:1',
            'apostila_url' => 'nullable|url',
        ]);

        $module->update($request->all());

        return redirect()->route('admin.modules')->with('success', 'Módulo atualizado com sucesso!');
    }

    public function deleteModule(Module $module)
    {
        $module->delete();
        return redirect()->route('admin.modules')->with('success', 'Módulo removido com sucesso!');
    }
}

