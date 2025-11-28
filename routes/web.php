<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController; // Adicionado
use App\Http\Controllers\ClientController; // Adicionado
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckCurador;

// Rota de Início
Route::get('/', function () {
    return view('auth.login');
});


// ROTAS ESPECÍFICAS PARA CADA TIPO DE USUÁRIO

// 1. Rota para o Dashboard do Usuário Comum (Cliente)
Route::get('/usuario/dashboard', [ClientController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('usuario.dashboard');

// ROTAS DO CLIENTE (Visualização e Compra de Eventos)
Route::middleware(['auth', 'verified'])->group(function () {
    // Ver detalhes de um evento
    Route::get('/eventos/{id}', [ClientController::class, 'showEvent'])->name('client.event.show');
    
    // Formulário de compra
    Route::get('/eventos/{id}/comprar', [ClientController::class, 'purchaseForm'])->name('client.purchase.form');
    
    // Processar compra
    Route::post('/eventos/{id}/comprar', [ClientController::class, 'processPurchase'])->name('client.purchase.process');
    
    // Página de sucesso da compra
    Route::get('/compra/{purchaseId}/sucesso', [ClientController::class, 'purchaseSuccess'])->name('client.purchase.success');
    
    // Meus ingressos
    Route::get('/meus-ingressos', [ClientController::class, 'myTickets'])->name('client.my-tickets');
    
    // Entrar no grupo do WhatsApp
    Route::get('/eventos/{eventId}/grupo-whatsapp', [ClientController::class, 'joinWhatsAppGroup'])->name('client.whatsapp.join');
});


// ROTA DE REDIRECIONAMENTO (O NOVO '/DASHBOARD' DO BREEZE)
// Esta rota intercepta o acesso a '/dashboard' após o login e redireciona
// o usuário para o seu painel específico baseado no 'tipo_usuario'
Route::get('/dashboard', function () {
    $user = auth()->user();

    // Redireciona para o dashboard correto
    if ($user->tipo_usuario === 'curador') {
        // Redireciona para a rota com nome 'curador.dashboard', que agora é o EventController@index
        return redirect()->route('curador.dashboard');
    }
    
    // Default: Redireciona para o dashboard do usuário comum
    return redirect()->route('usuario.dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');



// ROTAS DO CURADOR (Gerenciamento de Eventos)


Route::middleware(['auth', 'verified', CheckCurador::class])->group(function () {
    
    // Rota Principal: Meus Eventos.
    // Substitui a rota baseada em "function ()" e aponta para o Controller.
    Route::get('/curador/dashboard', [EventController::class, 'index'])->name('curador.dashboard'); 
    
    // Rotas de CRUD para Eventos (events.create, events.store, events.edit, events.update, events.destroy)
    Route::resource('events', EventController::class)->except(['index']);

    // IMPORTANTE:
    // O método index() do EventController é acessível via 'curador.dashboard'.
    // Os demais métodos (create, store, edit, update, destroy) usam os nomes padrão: 
    // events.create, events.store, events.edit, events.update, events.destroy.
});


// ROTAS PADRÃO DO BREEZE (Profile)


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Rotas de Autenticação (Login, Register, etc.)
require __DIR__.'/auth.php';