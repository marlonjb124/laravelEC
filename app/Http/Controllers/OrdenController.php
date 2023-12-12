<?php

// OrdenController.php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\OrdenProducto;

class OrdenController extends Controller
{
    public function createNewOrden(Request $request)
    {
        $ordenData = $request->only("user_id","date","estado");
        $productsIds = $request->input("products_ids",[]);

        $newOrden = Orden::create([
            // 
            // 'orden_id' => $ordenData['orden_id'],
            'user_id' => $ordenData['user_id'],
            'date' => now(),
            'estado' => $ordenData['estado'],
        ]);

        foreach ($productsIds as $productId) {
            OrdenProducto::create([
                'orden_id' => $newOrden['orden_id'],
                'product_id' => $productId,
            ]);
        }

        return response()->json($newOrden, 201);
    }

    public function searchOrderByUser($user_id)
    {
        $orders = Orden::where('user_id', $user_id)->get();

        $orderList = [];

        foreach ($orders as $orden) {
            $orderList[] = [
                'orden_id' => $orden->orden_id,
                'user_id' => $orden->user_id,
                'date' => $orden->date,
                'estado' => $orden->estado,
            ];
        }

        return response()->json($orderList);
    }
    public function deleteOrden($orden_id)
    {
        $orden = Orden::find($orden_id);

        if (!$orden) {
            return response()->json(['message' => 'Orden not found'], 404);
        }

        // Eliminar los productos asociados a la orden
        $orden->ordenProducto()->delete();

        // Eliminar la orden
        $orden->delete();

        return response()->json(['message' => 'Orden deleted successfully']);
    }

}