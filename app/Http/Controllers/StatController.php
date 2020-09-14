<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Inventario;
use App\PedidosCustomer;

class StatController extends Controller
{
    public function getStats(Request $request) {
        $nro_clientes = Customer::where('user_id', $request->user()->id)->count();
        $nro_pedidos = PedidosCustomer::where('user_id', $request->user()->id)->count();
        $cantidad = PedidosCustomer::where('user_id', $request->user()->id)->select('cantidad')->get();
        $inventarios = PedidosCustomer::where('user_id', $request->user()->id)->with('inventario')->get();
        $total_venta = 0;
        for ($i=0; $i < $nro_pedidos; $i++) { 
            $total_venta = $cantidad[$i]->cantidad * $inventarios[$i]->inventario->precio + $total_venta;
        }

        return response()->json([
            "data" => [
                'nro_clientes' => $nro_clientes,
                'nro_pedidos' => $nro_pedidos,
                'total_venta' => $total_venta
            ]
        ]);
    }
}
