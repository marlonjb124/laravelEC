<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    public function createNewOrden(Request $request)
    {
        $ordenData = $request->input('orden');
        $productsIds = $request->input('products_ids');

        $newOrden = Orden::create([
            'orden_id' => $ordenData['orden_id'],
            'user_id' => $ordenData['user_id'],
            'date' => now(), // Utilizando la función now() para obtener la fecha actual
            'estado' => $ordenData['estado'],
        ]);

        foreach ($productsIds as $product_id) {
            // Lógica para agregar productos a la orden (no proporcionada en el código original)
        }

        return response()->json(['orden' => $newOrden]);
    }

    public function searchOrderByUser($user_id)
    {
        $orders = Orden::where('user_id', $user_id)->get();

        $orderList = $orders->map(function ($orden) {
            return [
                "orden_id" => $orden->orden_id,
                "user_id" => $orden->user_id,
                "date" => $orden->date,
                "estado" => $orden->estado,
            ];
        });

        return response()->json(['orders' => $orderList]);
    }
}
