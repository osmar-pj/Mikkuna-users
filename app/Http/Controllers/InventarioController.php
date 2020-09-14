<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\ItemCarateristica;

class InventarioController extends Controller
{
    public function newInventario(Request $request) {
        $datas = json_decode($request->datas, true);
        $i = 1;
        $empresa = $request->user()->empresa;
        foreach ($datas as $data) {
            foreach($data['item'] as $item) {
                $inventario_id = Inventario::count() + 1;
                $new_caracteristica = new ItemCarateristica($item);
                $new_caracteristica->precio = floatval($item['precio']);
                $new_caracteristica->descuento = floatval($item['descuento']);
                $new_caracteristica->inventario_id = $inventario_id;
                $new_caracteristica->save();
            }
            $image = $request['images'.$i];
            $path_public = $image->store('public');
           $data->image = explode('/', $path_public)[1];
            

            // $image->storeAs('image_inventario', $empresa.'-'.$image->getClientOriginalName());
            // $image->storeAs('image_inventario', $empresa.'-'.$path);

            unset($data['item']);
            $inventario = new Inventario($data);
            $inventario->categoria = $data['categoria'];
            $inventario->titulo = $data['titulo'];
            $inventario->image = $data['image'];
            $inventario->user_id = $request->user()->id;
            $inventario->save();
            $i = $i + 1;
        }

        return response()->json([
            'registered' => true
        ]);
    }

    public function editInventario(Request $request, $id) {
        $data = json_decode($request->data);
        
        $data->precio = floatval($data->precio);
        $data->descuento = floatval($data->descuento);
        $inventario = Inventario::where('id', $id)->first();
        $inventario->categoria = $data->categoria;
        $inventario->titulo = $data->titulo;
        $inventario->descripcion = $data->descripcion;
        $inventario->precio = $data->precio;
        $inventario->cantidad = $data->cantidad;
        $inventario->descuento = $data->descuento;
        if ($request->image) {
            $path_public = $request->image->store('public');
            $inventario->image = explode('/', $path_public)[1];
        }
        $inventario->update();


        return response()->json([
            'updated' => true
        ]);
    }

    public function getInventarios(Request $request) {
        $inventarios = Inventario::where('user_id', $request->user()->id)->with('item')->get();

        return response()->json([
            'inventarios' => $inventarios
        ]);
    }
}
