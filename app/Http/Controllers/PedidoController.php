<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\PedidosCustomer;

class PedidoController extends Controller
{
    public function getCustomers() {
        $customers = Customer::get();
        return response()->json([
            'customers' => $customers
        ]);
    }

    public function registerPedido(Request $request) {
        $pedidos = $request->pedidos;
        if ($request->customer_id == 0) {
            $cliente = new Customer;
            $cliente->name_user = $request->name_user;
            $cliente->email = $request->email;
            $cliente->user_id = $request->user()->id;
            $cliente->save();

            $customer_id = Customer::where('name_user', $request->name_user)->first()->id;

            foreach($pedidos as $pedido) {
                $pedid = new PedidosCustomer;
                $pedid->customer_id = $customer_id;
                $pedid->inventario_id = $pedido['id'];
                $pedid->cantidad = $pedido['cantidad'];
                $pedid->status = 'pedido';
                $pedid->user_id = $request->user()->id;
                $pedid->save();
            }

        } else {
            foreach($pedidos as $pedido) {
                $pedid = new PedidosCustomer;
                $pedid->customer_id = $request->customer_id;
                $pedid->inventario_id = $pedido['id'];
                $pedid->cantidad = $pedido['cantidad'];
                $pedid->status = 'pedido';
                $pedid->user_id = $request->user()->id;
                $pedid->save();
            }
        }

        return response()->json([
            'registered' => true
        ]);
    }

    public function getPedidos(Request $request) {
        $pedidos = PedidosCustomer::where('user_id', $request->user()->id)->where('status', 'pedido')->with('customer')->with('inventario')->get();

        return response()->json([
            'pedidos' => $pedidos
        ]);
    }

    public function updateStatusPedido(Request $request) {
        $pedido = PedidosCustomer::where('id', $request->id)->first();
        $pedido->status = 'atendido';
        $pedido->update();

        return response()->json([
            'updated' => true
        ]);
    }
}
