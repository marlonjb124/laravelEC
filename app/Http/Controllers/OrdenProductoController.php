<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\OrdenProducto;

class OrdenProductoController extends Controller
{
    public function addProductToOrden(Request $request)
    {
        $ordenProductoData = $request->all();

        $newOrdenProducto = OrdenProducto::create([
            'orden_id' => $ordenProductoData['orden_id'],
            'product_id' => $ordenProductoData['product_id'],
        ]);

        return response()->json($newOrdenProducto, 201);
    }

    public function searchProductsInOrdenByOrdenId($orden_id)
    {
        $productsInOrden = OrdenProducto::where('orden_id', $orden_id)->get();

        return response()->json($productsInOrden);
    }
}
