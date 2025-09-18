@extends('layouts.app')

@section('title', 'Adicionar Usuário')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Adicionar Novo Usuário</h1>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i>Voltar
        </a>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nome Completo *
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           class="form-input w-full @error('name') border-red-500 @enderror"
                           placeholder="Digite o nome completo"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email *
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email') }}"
                           class="form-input w-full @error('email') border-red-500 @enderror"
                           placeholder="usuario@exemplo.com"
                           required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="firebase_uid" class="block text-sm font-medium text-gray-700 mb-2">
                        Firebase UID *
                    </label>
                    <input type="text" 
                           name="firebase_uid" 
                           id="firebase_uid" 
                           value="{{ old('firebase_uid') }}"
                           class="form-input w-full @error('firebase_uid') border-red-500 @enderror"
                           placeholder="Digite o Firebase UID"
                           required>
                    @error('firebase_uid')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de Usuário *
                    </label>
                    <select name="role" 
                            id="role" 
                            class="form-select w-full @error('role') border-red-500 @enderror"
                            required>
                        <option value="">Selecione o tipo</option>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Aluno</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrador</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Senha *
                    </label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="form-input w-full @error('password') border-red-500 @enderror"
                           placeholder="Mínimo 6 caracteres"
                           required>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" 
                       name="is_active" 
                       id="is_active" 
                       value="1"
                       {{ old('is_active', true) ? 'checked' : '' }}
                       class="form-checkbox h-4 w-4 text-blue-600">
                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                    Usuário ativo
                </label>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.users') }}" class="btn btn-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i>Salvar Usuário
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
