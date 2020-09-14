<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'auth'
], function($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group([
    'middleware' => 'jwt.auth',
], function($router) {
    Route::post('new_inventario', 'InventarioController@newInventario');
    Route::post('edit_inventario', 'InventarioController@editInventario');
    Route::get('get_inventarios', 'InventarioController@getInventarios');
    Route::get('get_customers', 'PedidoController@getCustomers');
    Route::post('register_pedido', 'PedidoController@registerPedido');
    Route::get('get_pedidos', 'PedidoController@getPedidos');
    Route::put('update_pedido', 'PedidoController@updateStatusPedido');
    Route::get('get_stats', 'StatController@getStats');
    Route::get('get_empresa_id', 'AuthController@getEmpresaId');
    Route::post('update_empresa', 'AuthController@updateEmpresa');
});

    // // POST
    // Route::post('inventarios', 'InventarioController@newInventario');
    // Route::post('pedidos', 'PedidoController@registerPedido');

    // // GET UNIC
    
    // Route::get('inventarios', 'InventarioController@getInventarios');
    // Route::get('customers', 'PedidoController@getCustomers');
    // Route::get('pedidos', 'PedidoController@getPedidos');
    // Route::get('stats', 'StatController@getStats');
    // Route::get('empresa', 'AuthController@getEmpresaId');
    
    // // PUT
    // Route::put('inventarios/{id}', 'InventarioController@editInventario');
    // Route::put('update_pedido', 'PedidoController@updateStatusPedido');
    // Route::put('empresas', 'AuthController@editEmpresa');

    // // GET ALL


    // Route::post('new_inventario', 'InventarioController@newInventario');
    // Route::get('get_inventarios', 'InventarioController@getInventarios');