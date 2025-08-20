@extends('layouts.app')

@section('title', 'Adicionar Módulo')

@section('content')
<div class="space-y-6">
	<div class="flex justify-between items-center">
		<h1 class="text-3xl font-bold text-gray-900">Adicionar Novo Módulo</h1>
		<a href="{{ route('admin.modules') }}" class="btn btn-secondary">
			<i class="fas fa-arrow-left mr-2"></i>Voltar
		</a>
	</div>

	<div class="card">
		<form method="POST" action="{{ route('admin.modules.store') }}" class="space-y-6">
			@csrf

			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
				<div>
					<label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nome *</label>
					<input type="text" id="name" name="name" value="{{ old('name') }}" class="form-input w-full @error('name') border-red-500 @enderror" placeholder="Nome do módulo" required>
					@error('name')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label for="order" class="block text-sm font-medium text-gray-700 mb-2">Ordem *</label>
					<input type="number" min="1" id="order" name="order" value="{{ old('order', 1) }}" class="form-input w-full @error('order') border-red-500 @enderror" placeholder="1" required>
					@error('order')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				<div class="md:col-span-2">
					<label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição *</label>
					<textarea id="description" name="description" rows="4" class="form-input w-full @error('description') border-red-500 @enderror" placeholder="Descrição do conteúdo do módulo" required>{{ old('description') }}</textarea>
					@error('description')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				<div class="md:col-span-2">
					<label for="apostila_url" class="block text-sm font-medium text-gray-700 mb-2">URL da Apostila (opcional)</label>
					<input type="url" id="apostila_url" name="apostila_url" value="{{ old('apostila_url') }}" class="form-input w-full @error('apostila_url') border-red-500 @enderror" placeholder="https://...">
					@error('apostila_url')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>
			</div>

			<div class="flex items-center">
				<input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="form-checkbox h-4 w-4 text-blue-600">
				<label for="is_active" class="ml-2 block text-sm text-gray-900">Módulo ativo</label>
			</div>

			<div class="flex justify-end space-x-4">
				<a href="{{ route('admin.modules') }}" class="btn btn-secondary">Cancelar</a>
				<button type="submit" class="btn btn-primary">
					<i class="fas fa-save mr-2"></i>Salvar Módulo
				</button>
			</div>
		</form>
	</div>
</div>
@endsection
