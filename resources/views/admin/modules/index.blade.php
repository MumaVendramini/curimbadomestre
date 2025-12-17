@extends('layouts.app')

@section('title', 'Gerenciar Módulos')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Gerenciar Módulos</h1>
        <a href="{{ route('admin.modules.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Novo Módulo
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Ordem</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de Toque</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Recursos</th>
                        <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($modules as $module)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                {{ $module->order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $module->name }}</div>
                                @if($module->description)
                                    <div class="text-sm text-gray-500">{{ Str::limit($module->description, 50) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                {{ ucfirst(str_replace('_', ' ', $module->toque_type)) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $module->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $module->is_active ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    @if($module->apostila_url)
                                        <span class="text-green-600" title="Tem apostila"><i class="fas fa-file-pdf"></i></span>
                                    @endif
                                    @if($module->audio_url)
                                        <span class="text-blue-600" title="Tem áudio"><i class="fas fa-music"></i></span>
                                    @endif
                                    @if($module->image_url)
                                        <span class="text-purple-600" title="Tem imagem"><i class="fas fa-image"></i></span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('admin.modules.edit', $module) }}" 
                                       class="btn btn-sm btn-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.modules.delete', $module) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Tem certeza que deseja excluir este módulo?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Nenhum módulo encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection