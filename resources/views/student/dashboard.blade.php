@extends('layouts.app')

@section('title', 'Dashboard - Aluno')

@section('content')
<div class="space-y-6">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-900">Bem-vindo, {{ auth()->user()->name }}!</h1>
        <p class="text-lg text-gray-600 mt-2">Acesse seus módulos disponíveis</p>
    </div>

    @if($enabledModules->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($enabledModules as $module)
                <div class="card hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $module->name }}</h3>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Ativo
                        </span>
                    </div>
                    
                    <p class="text-gray-600 mb-4">{{ Str::limit($module->description, 100) }}</p>
                    
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <span>
                            <i class="fas fa-music mr-1"></i>
                            {{ $module->pontos->count() }} pontos
                        </span>
                        <span>
                            <i class="fas fa-video mr-1"></i>
                            {{ $module->videos->count() }} vídeos
                        </span>
                    </div>
                    
                    <div class="flex space-x-2">
                        <a href="{{ route('student.module', $module) }}" class="btn btn-primary flex-1">
                            <i class="fas fa-play mr-2"></i>Acessar
                        </a>
                        
                        @if($module->apostila_url)
                            <a href="{{ route('student.apostila.download', $module) }}" class="btn btn-secondary">
                                <i class="fas fa-download"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-book-open text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum módulo disponível</h3>
            <p class="text-gray-600">Entre em contato com o administrador para ter acesso aos módulos do curso.</p>
        </div>
    @endif
</div>
@endsection

