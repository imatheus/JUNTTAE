<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController; // Adicionado
use App\Http\Controllers\ClientController; // Adicionado
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckCurador;

// Rota de Início - Eventos Disponíveis (acessível para todos)
Route::get('/', [ClientController::class, 'dashboard'])->name('home');

// Alias para compatibilidade (redireciona usuario.dashboard para home)
Route::redirect('/usuario/dashboard', '/', 301)->name('usuario.dashboard');

// Ver detalhes de um evento (acessível para todos)
Route::get('/eventos/{id}', [ClientController::class, 'showEvent'])->name('client.event.show');

// ROTA TEMPORÁRIA: Criar link simbólico do storage
// Acesse: http://127.0.0.1:8000/create-storage-link
// IMPORTANTE: Remova esta rota após criar o link!
Route::get('/create-storage-link', function () {
    try {
        // Cria o link simbólico
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        
        return '<div style="font-family: Arial; padding: 20px; max-width: 600px; margin: 50px auto; border: 2px solid #10b981; border-radius: 8px; background: #f0fdf4;">' .
               '<h2 style="color: #059669; margin-top: 0;">✅ Link Simbólico Criado com Sucesso!</h2>' .
               '<p>O link <code>public/storage</code> foi conectado a <code>storage/app/public</code>.</p>' .
               '<p><strong>Agora as imagens dos eventos devem aparecer corretamente!</strong></p>' .
               '<hr style="border: 1px solid #10b981; margin: 20px 0;">' .
               '<p style="color: #dc2626;"><strong>IMPORTANTE:</strong> Por segurança, remova a rota <code>/create-storage-link</code> do arquivo <code>routes/web.php</code> após criar o link.</p>' .
               '<p><a href="/" style="display: inline-block; margin-top: 10px; padding: 10px 20px; background: #3b82f6; color: white; text-decoration: none; border-radius: 5px;">Voltar para Eventos</a></p>' .
               '</div>';
    } catch (\Exception $e) {
        return '<div style="font-family: Arial; padding: 20px; max-width: 600px; margin: 50px auto; border: 2px solid #ef4444; border-radius: 8px; background: #fef2f2;">' .
               '<h2 style="color: #dc2626; margin-top: 0;">❌ Erro ao Criar Link Simbólico</h2>' .
               '<p><strong>Erro:</strong> ' . $e->getMessage() . '</p>' .
               '<hr style="border: 1px solid #ef4444; margin: 20px 0;">' .
               '<h3>Soluções Alternativas:</h3>' .
               '<ol>' .
               '<li>Execute no terminal: <code>php artisan storage:link</code></li>' .
               '<li>No Windows (como Administrador): <code>mklink /D "public\\storage" "..\\storage\\app\\public"</code></li>' .
               '</ol>' .
               '<p><a href="/" style="display: inline-block; margin-top: 10px; padding: 10px 20px; background: #3b82f6; color: white; text-decoration: none; border-radius: 5px;">Voltar para Eventos</a></p>' .
               '</div>';
    }
});


// ROTAS ESPECÍFICAS PARA CADA TIPO DE USUÁRIO

// Removido: Dashboard do usuário agora é a página inicial (/)

// ROTAS DO CLIENTE (Visualização e Compra de Eventos)
Route::middleware(['auth', 'verified'])->group(function () {
    
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
    
    // Default: Redireciona para a home (eventos disponíveis)
    return redirect()->route('home');

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