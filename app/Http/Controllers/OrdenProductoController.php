<?php

namespace App\Http\Controllers;

use App\Models\OrdenProducto;
use Illuminate\Http\Request;

class OrdenProductoController extends Controller
{
    public function addProductToOrden(Request $request)
    {
        $ordenProductoData = $request->all();

        $newProductToOrden = OrdenProducto::create([
            'product_id' => $ordenProductoData['product_id'],
            'orden_id' => $ordenProductoData['orden_id'],
        ]);

        return response()->json($newProductToOrden);
    }

    public function searchProductsInOrdenByOrdenId($orden_id)
    {
        $productsInOrden = OrdenProducto::where('orden_id', $orden_id)->get();

        return response()->json($productsInOrden);
    }
}

