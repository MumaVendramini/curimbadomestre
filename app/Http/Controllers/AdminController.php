<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Module;
use App\Models\Ponto;
use App\Models\Video;
use App\Models\ModuleAudio;
use App\Models\ModuleVideo;
use App\Models\ModuleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            // firebase_uid is optional now: nullable and unique when present
            'firebase_uid' => 'nullable|string|unique:users',
            'role' => 'required|in:admin,student',
            'password' => 'required|string|min:6',
            'modules' => 'nullable|array',
            'modules.*' => 'exists:modules,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'firebase_uid' => $request->firebase_uid ?: null,
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

        return redirect()->route('admin.modules.index')->with('success', 'Módulo criado com sucesso!');
    }

    public function editModule(Module $module)
    {
        $module->load(['audios', 'moduleVideos', 'images']);
        return view('admin.modules.edit', compact('module'));
    }

    public function updateModule(Request $request, Module $module)
    {
        \Log::info('Iniciando update do módulo', [
            'module_id' => $module->id,
            'request_data' => $request->all()
        ]);
        
        // Validação mais simples para teste
        $request->validate([
            'name' => 'required|string|max:255',
            'toque_type' => 'required|in:ijexa,nago,samba_angola,congo,barravento',
            'order' => 'required|integer|min:1',
        ]);

        \Log::info('Validação passou, atualizando módulo');

        $module->update([
            'name' => $request->name,
            'description' => $request->description,
            'toque_type' => $request->toque_type,
            'toque_origin' => $request->toque_origin,
            'toque_characteristics' => $request->toque_characteristics,
            'toque_application' => $request->toque_application,
            'order' => $request->order,
            'is_active' => $request->has('is_active'),
            'apostila_url' => $request->apostila_url,
        ]);

        // Processar novos áudios
        if ($request->has('audio_names') && is_array($request->audio_names)) {
            foreach ($request->audio_names as $index => $audioName) {
                if (!empty($audioName)) {
                    $audioFile = $request->file('audio_files.' . $index);
                    $filePath = null;
                    
                    if ($audioFile) {
                        $filePath = $audioFile->store('audios', 'public');
                    }
                    
                    ModuleAudio::create([
                        'module_id' => $module->id,
                        'title' => $audioName,
                        'file_path' => $filePath,
                    ]);
                }
            }
        }

        // Processar novos vídeos (YouTube URLs)
        if ($request->has('video_titles') && is_array($request->video_titles)) {
            foreach ($request->video_titles as $index => $videoTitle) {
                $videoUrl = $request->input('video_urls.' . $index);
                
                if (!empty($videoTitle) && !empty($videoUrl)) {
                    ModuleVideo::create([
                        'module_id' => $module->id,
                        'title' => $videoTitle,
                        'url' => $videoUrl,
                    ]);
                }
            }
        }

        // Processar novas imagens
        if ($request->has('image_titles') && is_array($request->image_titles)) {
            foreach ($request->image_titles as $index => $imageTitle) {
                if (!empty($imageTitle)) {
                    $imageFile = $request->file('image_files.' . $index);
                    $filePath = null;
                    
                    if ($imageFile) {
                        $filePath = $imageFile->store('images', 'public');
                    }
                    
                    ModuleImage::create([
                        'module_id' => $module->id,
                        'title' => $imageTitle,
                        'file_path' => $filePath,
                    ]);
                }
            }
        }

        \Log::info('Módulo atualizado com sucesso');

        return redirect()->route('admin.modules.edit', $module)->with('success', 'Módulo atualizado com sucesso!');
    }

    public function deleteModule(Module $module)
    {
        $module->delete();
        return redirect()->route('admin.modules.index')->with('success', 'Módulo removido com sucesso!');
    }

    public function deleteModuleAudio(Request $request, Module $module)
    {
        try {
            $audioId = $request->route('audioId');
            
            $moduleAudio = ModuleAudio::where('id', $audioId)->where('module_id', $module->id)->first();
            
            if (!$moduleAudio) {
                abort(404, 'Áudio não encontrado');
            }
            
            if ($moduleAudio->file_path) {
                Storage::disk('public')->delete($moduleAudio->file_path);
            }
            
            $moduleAudio->delete();
            return redirect()->back()->with('success', 'Áudio removido com sucesso!');
            
        } catch (\Exception $e) {
            \Log::error('Erro ao deletar áudio', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Erro ao remover áudio: ' . $e->getMessage());
        }
    }

    public function deleteModuleVideo(Request $request, Module $module)
    {
        $videoId = $request->route('videoId');
        $moduleVideo = ModuleVideo::where('id', $videoId)->where('module_id', $module->id)->first();
        
        if (!$moduleVideo) {
            abort(404, 'Vídeo não encontrado');
        }
        
        $moduleVideo->delete();
        return redirect()->back()->with('success', 'Vídeo removido com sucesso!');
    }

    public function deleteModuleImage(Request $request, Module $module)
    {
        $imageId = $request->route('imageId');
        $moduleImage = ModuleImage::where('id', $imageId)->where('module_id', $module->id)->first();
        
        if (!$moduleImage) {
            abort(404, 'Imagem não encontrada');
        }
        
        if ($moduleImage->file_path) {
            Storage::disk('public')->delete($moduleImage->file_path);
        }
        
        $moduleImage->delete();
        return redirect()->back()->with('success', 'Imagem removida com sucesso!');
    }
}

