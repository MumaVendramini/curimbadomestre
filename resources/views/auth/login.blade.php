<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Curimba do Mestre</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Curimba do Mestre
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Faça login para acessar o curso
            </p>
        </div>
        
        <div class="bg-white py-8 px-6 shadow rounded-lg">
            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="email" required 
                           class="form-input" placeholder="seu@email.com">
                </div>

                <div>
                    <label for="password" class="form-label">Senha</label>
                    <input id="password" name="password" type="password" required 
                           class="form-input" placeholder="Sua senha">
                </div>

                <div>
                    <button type="submit" class="">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Entrar
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Ou continue com</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-3">
                    <button type="button" onclick="FirebaseAuth.signInWithGoogle()" 
                            class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fab fa-google text-red-600 mr-2"></i>
                        Google
                    </button>
                </div>
            </div>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Para fins de demonstração, use:
                </p>
                <p class="text-sm text-gray-800 font-medium mt-1">
                    Admin: admin@curimbadomestre.com<br>
                    Aluno: aluno@exemplo.com
                </p>
            </div>
        </div>
    </div>

    <!-- Firebase SDK -->
    {{-- <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.0.0/firebase-auth-compat.js"></script> --}}
    
    <!-- Firebase Auth Script -->
    {{-- <script src="{{ asset('js/firebase-auth.js') }}"></script> --}}
    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
