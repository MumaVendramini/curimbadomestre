@extends('layouts.app')

@section('title', 'Editar Módulo')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Editar Módulo</h1>
        <a href="{{ route('admin.modules.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i>Voltar
        </a>
    </div>
    
    <div class="card">
        <form method="POST" action="{{ route('admin.modules.update', $module) }}" enctype="multipart/form-data" class="space-y-6" onsubmit="alert('Formulário sendo enviado!'); return true;">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Campos principais do módulo -->
                <div class="col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nome do Módulo *
                    </label>
                    <input type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $module->name) }}"
                    class="form-input w-full @error('name') border-red-500 @enderror"
                    required>
                    @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Descrição
                    </label>
                    <textarea name="description" 
                    id="description" 
                    rows="3"
                    class="form-textarea w-full @error('description') border-red-500 @enderror"
                    placeholder="Descreva o módulo">{{ old('description', $module->description) }}</textarea>
                    @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="toque_type" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de Toque *
                    </label>
                    <select name="toque_type" 
                    id="toque_type" 
                    class="form-select w-full @error('toque_type') border-red-500 @enderror"
                    required>
                        <option value="">Selecione o tipo de toque</option>
                        <option value="ijexa" {{ old('toque_type', $module->toque_type) == 'ijexa' ? 'selected' : '' }}>Ijexá</option>
                        <option value="nago" {{ old('toque_type', $module->toque_type) == 'nago' ? 'selected' : '' }}>Nagô</option>
                        <option value="samba_angola" {{ old('toque_type', $module->toque_type) == 'samba_angola' ? 'selected' : '' }}>Samba de Angola</option>
                        <option value="congo" {{ old('toque_type', $module->toque_type) == 'congo' ? 'selected' : '' }}>Congo</option>
                        <option value="barravento" {{ old('toque_type', $module->toque_type) == 'barravento' ? 'selected' : '' }}>Barravento</option>
                    </select>
                    @error('toque_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                        Ordem de Exibição *
                    </label>
                    <input type="number" 
                    name="order" 
                    id="order" 
                    value="{{ old('order', $module->order) }}"
                    min="1"
                    class="form-input w-full @error('order') border-red-500 @enderror"
                    required>
                    @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="toque_origin" class="block text-sm font-medium text-gray-700 mb-2">
                        Origem do Toque
                    </label>
                    <textarea name="toque_origin" 
                    id="toque_origin" 
                    rows="3"
                    class="form-textarea w-full @error('toque_origin') border-red-500 @enderror">{{ old('toque_origin', $module->toque_origin) }}</textarea>
                    @error('toque_origin')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="toque_characteristics" class="block text-sm font-medium text-gray-700 mb-2">
                        Características do Toque
                    </label>
                    <textarea name="toque_characteristics" 
                    id="toque_characteristics" 
                    rows="3"
                    class="form-textarea w-full @error('toque_characteristics') border-red-500 @enderror">{{ old('toque_characteristics', $module->toque_characteristics) }}</textarea>
                    @error('toque_characteristics')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-2">
                    <label for="toque_application" class="block text-sm font-medium text-gray-700 mb-2">
                        Aplicação do Toque
                    </label>
                    <textarea name="toque_application" 
                    id="toque_application" 
                    rows="3"
                    class="form-textarea w-full @error('toque_application') border-red-500 @enderror">{{ old('toque_application', $module->toque_application) }}</textarea>
                    @error('toque_application')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="apostila_url" class="block text-sm font-medium text-gray-700 mb-2">
                        URL da Apostila
                    </label>
                    <input type="url" 
                    name="apostila_url" 
                    id="apostila_url" 
                    value="{{ old('apostila_url', $module->apostila_url) }}"
                    class="form-input w-full @error('apostila_url') border-red-500 @enderror"
                    placeholder="https://...">
                    @error('apostila_url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center">
                    <input type="checkbox" 
                    name="is_active" 
                    id="is_active" 
                    value="1"
                    {{ old('is_active', $module->is_active) ? 'checked' : '' }}
                    class="form-checkbox h-4 w-4 text-blue-600">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Módulo ativo
                    </label>
                </div>
            </div>
            
            <hr class="my-6">
            <h2 class="text-xl font-semibold mb-2">Áudios do Módulo</h2>
            <div class="space-y-2">
                @foreach($module->audios as $audio)
                <div class="flex items-center space-x-2 p-2 border rounded">
                    <div class="flex flex-col">
                        <audio controls src="{{ asset('storage/' . $audio->file_path) }}" class="w-64">
                            Seu navegador não suporta o elemento de áudio.
                        </audio>
                        <small class="text-gray-500 mt-1">
                            Arquivo: {{ $audio->file_path }}<br>
                            URL: {{ asset('storage/' . $audio->file_path) }}
                        </small>
                    </div>
                    <div class="flex flex-col ml-4">
                        <span class="font-medium">{{ $audio->title ?: 'Sem título' }}</span>
                        <a href="{{ route('admin.modules.audio.delete', [$module, $audio]) }}" 
                           class="btn btn-sm btn-danger mt-2" 
                           onclick="return confirm('Remover este áudio?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
                @endforeach
                <div id="audio-upload-list"></div>
                <button type="button" class="btn btn-sm btn-primary" onclick="addAudioInput()">Adicionar Áudio</button>
            </div>
            
            <hr class="my-6">
            <h2 class="text-xl font-semibold mb-2">Vídeos do Módulo</h2>
            <div class="space-y-2">
                @foreach($module->moduleVideos as $video)
                <div class="flex items-center space-x-2">
                    <a href="{{ $video->url }}" target="_blank" class="text-blue-600 underline">{{ $video->title ?? $video->url }}</a>
                    <a href="{{ route('admin.modules.video.delete', [$module, $video]) }}" 
                       class="btn btn-sm btn-danger" 
                       onclick="return confirm('Remover este vídeo?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
                @endforeach
                <div id="video-link-list"></div>
                <button type="button" class="btn btn-sm btn-primary" onclick="addVideoInput()">Adicionar Vídeo</button>
            </div>
            
            <hr class="my-6">
            <h2 class="text-xl font-semibold mb-2">Imagens do Módulo</h2>
            <div class="space-y-2">
                @foreach($module->images as $image)
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('storage/' . $image->file_path) }}" alt="Imagem" class="h-16 w-16 object-cover rounded">
                    <span>{{ $image->title }}</span>
                    <a href="{{ route('admin.modules.image.delete', [$module, $image]) }}" 
                       class="btn btn-sm btn-danger" 
                       onclick="return confirm('Remover esta imagem?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
                @endforeach
                <div id="image-upload-list"></div>
                <button type="button" class="btn btn-sm btn-primary" onclick="addImageInput()">Adicionar Imagem</button>
            </div>
            
            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('admin.modules.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary" onclick="alert('Botão clicado!');">
                    <i class="fas fa-save mr-2"></i>Salvar Alterações
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function addAudioInput() {
        const list = document.getElementById('audio-upload-list');
        const idx = list.children.length;
        const div = document.createElement('div');
        div.className = 'flex items-center space-x-2 my-2';
        div.innerHTML = `<input type="text" name="audio_names[${idx}]" placeholder="Título do áudio" class="form-input" required> <input type="file" name="audio_files[${idx}]" accept="audio/*" class="form-input" required>`;
        list.appendChild(div);
    }
    function addVideoInput() {
        const list = document.getElementById('video-link-list');
        const idx = list.children.length;
        const div = document.createElement('div');
        div.className = 'flex items-center space-x-2 my-2';
        div.innerHTML = `<input type="url" name="video_urls[${idx}]" placeholder="URL do vídeo" class="form-input" required> <input type="text" name="video_titles[${idx}]" placeholder="Título do vídeo" class="form-input" required>`;
        list.appendChild(div);
    }
    function addImageInput() {
        const list = document.getElementById('image-upload-list');
        const idx = list.children.length;
        const div = document.createElement('div');
        div.className = 'flex items-center space-x-2 my-2';
        div.innerHTML = `<input type="text" name="image_titles[${idx}]" placeholder="Título da imagem" class="form-input" required> <input type="file" name="image_files[${idx}]" accept="image/*" class="form-input" required>`;
        list.appendChild(div);
    }
</script>
@endpush

@endsection