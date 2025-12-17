@extends('layouts.app')

@section('title', 'Dashboard - Admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Administrativo</h1>
        <div class="flex space-x-4">
            <a href="{{ route('admin.users') }}" class="btn btn-primary">
                <i class="fas fa-users mr-2"></i>Gerenciar Usuários
            </a>
            <a href="{{ route('admin.modules.index') }}" class="btn btn-secondary">
                <i class="fas fa-book mr-2"></i>Gerenciar Módulos
            </a>
        </div>
    </div>

    <!-- Estatísticas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="card">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total de Alunos</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_users'] }}</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-book text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total de Módulos</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_modules'] }}</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-check-circle text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Módulos Ativos</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['active_modules'] }}</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-music text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total de Pontos</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_pontos'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Ações Rápidas -->
    <div class="card">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Ações Rápidas</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('admin.users.create') }}" class="p-4 border-2 border-dashed border-gray-300 rounded-lg text-center hover:border-blue-400 hover:bg-blue-50 transition-colors">
                <i class="fas fa-user-plus text-3xl text-gray-400 mb-2"></i>
                <p class="text-sm font-medium text-gray-600">Adicionar Aluno</p>
            </a>
            
            <a href="{{ route('admin.modules.create') }}" class="p-4 border-2 border-dashed border-gray-300 rounded-lg text-center hover:border-green-400 hover:bg-green-50 transition-colors">
                <i class="fas fa-plus-circle text-3xl text-gray-400 mb-2"></i>
                <p class="text-sm font-medium text-gray-600">Criar Módulo</p>
            </a>
            
            <a href="{{ route('admin.users') }}" class="p-4 border-2 border-dashed border-gray-300 rounded-lg text-center hover:border-purple-400 hover:bg-purple-50 transition-colors">
                <i class="fas fa-cog text-3xl text-gray-400 mb-2"></i>
                <p class="text-sm font-medium text-gray-600">Configurações</p>
            </a>
        </div>
    </div>
</div>
@endsection

