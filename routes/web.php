<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FirebaseAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* // Login via Firebase (sessão web)
Route::post('/firebase/login', [FirebaseAuthController::class, 'login'])->name('firebase.login'); */

// Rota raiz - redireciona para login se não autenticado
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('student.dashboard');
        }
    }
    return redirect()->route('login');
});

// Rotas do Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Gerenciamento de usuários
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Gerenciamento de módulos
    Route::get('/modules', [AdminController::class, 'modules'])->name('modules');
    Route::get('/modules/create', [AdminController::class, 'createModule'])->name('modules.create');
    Route::post('/modules', [AdminController::class, 'storeModule'])->name('modules.store');
    Route::get('/modules/{module}/edit', [AdminController::class, 'editModule'])->name('modules.edit');
    Route::put('/modules/{module}', [AdminController::class, 'updateModule'])->name('modules.update');
    Route::delete('/modules/{module}', [AdminController::class, 'deleteModule'])->name('modules.delete');
});

// Rotas do Aluno
Route::prefix('student')->name('student.')->middleware(['auth', 'student'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/modules/{module}', [StudentController::class, 'showModule'])->name('module');
    Route::get('/modules/{module}/apostila', [StudentController::class, 'downloadApostila'])->name('apostila.download');
});
