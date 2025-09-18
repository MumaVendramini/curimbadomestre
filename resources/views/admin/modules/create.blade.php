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
					<label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nome do Módulo *</label>
					<input type="text" id="name" name="name" value="{{ old('name') }}" class="form-input w-full @error('name') border-red-500 @enderror" placeholder="Ex: Módulo 1 - Ijexá" required>
					@error('name')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label for="toque_type" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Toque</label>
					<select id="toque_type" name="toque_type" class="form-select w-full @error('toque_type') border-red-500 @enderror">
						<option value="">Selecione o toque (opcional)</option>
						<option value="ijexa" {{ old('toque_type') == 'ijexa' ? 'selected' : '' }}>Ijexá</option>
						<option value="nago" {{ old('toque_type') == 'nago' ? 'selected' : '' }}>Nagô</option>
						<option value="samba_angola" {{ old('toque_type') == 'samba_angola' ? 'selected' : '' }}>Samba de Angola</option>
						<option value="congo" {{ old('toque_type') == 'congo' ? 'selected' : '' }}>Congo</option>
						<option value="barravento" {{ old('toque_type') == 'barravento' ? 'selected' : '' }}>Barravento</option>
					</select>
					@error('toque_type')
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
					<label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descrição Geral *</label>
					<textarea id="description" name="description" rows="3" class="form-input w-full @error('description') border-red-500 @enderror" placeholder="Descrição geral do módulo e o que será ensinado" required>{{ old('description') }}</textarea>
					@error('description')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				<div class="md:col-span-2">
					<label for="toque_origin" class="block text-sm font-medium text-gray-700 mb-2">Origem do Toque</label>
					<textarea id="toque_origin" name="toque_origin" rows="3" class="form-input w-full @error('toque_origin') border-red-500 @enderror" placeholder="História e origem deste toque específico">{{ old('toque_origin') }}</textarea>
					@error('toque_origin')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				<div class="md:col-span-2">
					<label for="toque_characteristics" class="block text-sm font-medium text-gray-700 mb-2">Características do Toque</label>
					<textarea id="toque_characteristics" name="toque_characteristics" rows="3" class="form-input w-full @error('toque_characteristics') border-red-500 @enderror" placeholder="Como é o ritmo, cadência, andamento e características técnicas">{{ old('toque_characteristics') }}</textarea>
					@error('toque_characteristics')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				<div class="md:col-span-2">
					<label for="toque_application" class="block text-sm font-medium text-gray-700 mb-2">Aplicação e Uso</label>
					<textarea id="toque_application" name="toque_application" rows="3" class="form-input w-full @error('toque_application') border-red-500 @enderror" placeholder="Quando e como usar este toque, para quais entidades e momentos">{{ old('toque_application') }}</textarea>
					@error('toque_application')
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

				<div>
					<label for="audio_url" class="block text-sm font-medium text-gray-700 mb-2">URL do Áudio (opcional)</label>
					<input type="url" id="audio_url" name="audio_url" value="{{ old('audio_url') }}" class="form-input w-full @error('audio_url') border-red-500 @enderror" placeholder="https://...">
					@error('audio_url')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">URL da Imagem (opcional)</label>
					<input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}" class="form-input w-full @error('image_url') border-red-500 @enderror" placeholder="https://...">
					@error('image_url')
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
