<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdemDeServicoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\RegisteredUserController;

Route::middleware(['auth', 'verified'])->group(function () {
    // Rota de busca única para ordens de serviço
    Route::get('/search-orders', [OrdemDeServicoController::class, 'search'])->name('OrdemDeServicoSearch.orders');

    // routes/loginRealizado
    Route::get('/', [OrdemDeServicoController::class, 'index'])->name('adminOrdemDeServico.index');
    Route::get('/admin', [OrdemDeServicoController::class, 'index'])->name('adminOrdemDeServico.index');
    Route::get('/admin/ordemdeservico', [OrdemDeServicoController::class, 'index'])->name('adminOrdemDeServico.index');
    Route::get('/admin/ordemdeservico/Impressao', [OrdemDeServicoController::class, 'Impressao'])->name('adminOrdemDeServico.Impressao');
    Route::get('/admin/ordemdeservico/producao', [OrdemDeServicoController::class, 'producao'])->name('adminOrdemDeServico.producao');
    Route::get('/admin/ordemdeservico/entregues', [OrdemDeServicoController::class, 'entregues'])->name('adminOrdemDeServico.entregues');
    Route::get('/admin/ordemdeservico/concluidas', [OrdemDeServicoController::class, 'concluidas'])->name('adminOrdemDeServico.concluidas');
    Route::get('/admin/ordemdeservico/laser', [OrdemDeServicoController::class, 'laser'])->name('adminOrdemDeServico.laser');

    // routes/Ordens    
    Route::get('/admin/ordemdeservico/create', [OrdemDeServicoController::class, 'create'])->name('adminOrdemDeServico.create');
    Route::post('/admin/ordemdeservico/', [OrdemDeServicoController::class, 'store'])->name('adminOrdemDeServico.store');
    Route::get('/admin/ordemdeservico{id}', [OrdemDeServicoController::class, 'show'])->name('adminOrdemDeServico.show');
    Route::get('/admin/ordemdeservico/edit/{id}', [OrdemDeServicoController::class, 'edit'])->name('adminOrdemDeServico.edit');
    Route::put('/admin/ordemdeservico/{id}', [OrdemDeServicoController::class, 'update'])->name('adminOrdemDeServico.update');
    Route::get('/admin/ordemdeservico/{id}', [OrdemDeServicoController::class, 'destroy'])->name('adminOrdemDeServico.destroy');
    Route::get('/admin/ordemdeservico/createduplicar/{id}', [OrdemDeServicoController::class, 'duplicar'])->name('adminOrdemDeServico.duplicar');
    Route::get('/admin/ordemdeservico/{id}/entregar', [OrdemDeServicoController::class, 'entregar'])->name('adminOrdemDeServico.entregar'); // Adicionada


    // Rota para deletar ordens entregues antigas
    Route::delete('/service-orders/delete-old', [OrdemDeServicoController::class, 'deleteOldDeliveredOrders'])->name('adminOrdemDeServico.service-orders.delete-old');
});


Route::middleware(['auth', 'admin'])->group(function () {
    // routes/funcionarios
    Route::get('/search-funcionarios', [FuncionarioController::class, 'search']);
    Route::get('/admin/funcionario', [RegisteredUserController::class, 'index'])->name('adminFuncionario.index');
    Route::get('/admin/funcionario', [FuncionarioController::class, 'index'])->name('adminFuncionario.home');
    Route::get('/admin/funcionario/edit/{id}', [FuncionarioController::class, 'edit'])->name('adminFuncionario.edit');
    Route::put('/admin/funcionario/{id}', [FuncionarioController::class, 'update'])->name('adminFuncionario.update');
    Route::get('/admin/funcionario/{id}', [FuncionarioController::class, 'destroy'])->name('adminFuncionario.destroy');
});

require __DIR__.'/auth.php';
