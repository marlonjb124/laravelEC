<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use Illuminate\Http\Request;
use App\Models\OrdenProducto;

class OrdenProductoController extends Controller
{
    // public function addProductToOrden(Request $request)
    // {
    //     $ordenProductoData = $request->all();

    //     $newOrdenProducto = OrdenProducto::create([
    //         'orden_id' => $ordenProductoData['orden_id'],
    //         'product_id' => $ordenProductoData['product_id'],
    //     ]);

    //     return response()->json($newOrdenProducto, 201);
    // }

    public function searchProductsInOrdenByOrdenId($orden_id)
    {
        $productsInOrden = OrdenProducto::where('orden_id', $orden_id)->get();

        return response()->json($productsInOrden);
    }
    public function removeProductFromOrden($orden_id, $product_id)
    {
        try {
            $orden = Orden::find($orden_id);

            if (!$orden) {
                return response()->json(['error' => 'Orden not found'], 404);
            }

            // Busca y elimina el producto específico de la orden
            $orden->ordenProducto()->where('product_id', $product_id)->delete();

            return response()->json(['message' => 'Product removed from the orden']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

}
