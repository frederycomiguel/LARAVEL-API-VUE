<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Listar Cadastros
 *
 * @method GET
 * @url ('/cadastros')
 */
Route::get('cadastros', [CadastroController::class, 'index']);

/**
 * Pegar um Cadastro
 *
 * @method GET
 * @url ('/cadastro/{id})
 */
Route::get('cadastro/{id}', [CadastroController::class, 'show']);

/**
 * Criar Cadastro
 *
 * @method POST
 * @url ('/cadastro')
 */
Route::post('cadastro', [CadastroController::class, 'store']);

/**
 * Atualizar Cadastro
 *
 * @method PUT
 * @url ('/cadastro')
 */
Route::put('cadastro', [CadastroController::class, 'store']);

/**
 * Deletar Cadastro
 *
 * @method DELETE
 * @url ('/cadastro/{id}')
 */
Route::delete('cadastro/{id}', [CadastroController::class, 'destroy']);
