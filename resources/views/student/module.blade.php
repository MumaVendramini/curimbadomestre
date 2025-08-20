@extends('layouts.app')

@section('title', $module->name)

@section('content')
<div class="space-y-6">
    <!-- Cabeçalho do Módulo -->
    <div class="card">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $module->name }}</h1>
                <p class="text-gray-600 mt-2">{{ $module->description }}</p>
            </div>
            
            @if($module->apostila_url)
                <a href="{{ route('student.apostila.download', $module) }}" class="btn btn-secondary">
                    <i class="fas fa-download mr-2"></i>Baixar Apostila
                </a>
            @endif
        </div>
    </div>

    <!-- Pontos -->
    @if($module->pontos->count() > 0)
        <div class="card">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">
                <i class="fas fa-music mr-2"></i>Pontos
            </h2>
            
            <div class="space-y-4">
                @foreach($module->pontos as $ponto)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-medium text-gray-900">{{ $ponto->title }}</h3>
                            <span class="text-sm text-gray-500">#{{ $ponto->order }}</span>
                        </div>
                        
                        <p class="text-gray-600 mb-4">{{ $ponto->lyrics_preview }}</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Áudio -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Áudio</h4>
                                <audio controls class="w-full">
                                    <source src="{{ $ponto->audio_url }}" type="audio/mpeg">
                                    Seu navegador não suporta o elemento de áudio.
                                </audio>
                            </div>
                            
                            <!-- Imagem do Toque -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Desenho do Toque</h4>
                                <img src="{{ $ponto->toque_image_url }}" alt="Toque do {{ $ponto->title }}" 
                                     class="w-full h-32 object-cover rounded-lg">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Vídeos -->
    @if($module->videos->count() > 0)
        <div class="card">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">
                <i class="fas fa-video mr-2"></i>Vídeos de Ensino
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($module->videos as $video)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $video->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $video->description }}</p>
                        
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe src="{{ $video->embed_url }}" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen
                                    class="w-full h-48 rounded-lg">
                            </iframe>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

