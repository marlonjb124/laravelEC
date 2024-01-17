<?php

// OrdenController.php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\OrdenProducto;
use App\Models\Product;
use Illuminate\Support\Facades\App;

class OrdenController extends Controller
{
    public function createNewOrden(Request $request)
    {
        $ordenData = $request->only("user_id","date","estado","direccionEnvio");
        $productsIds = $request->input("products_ids",[]);
        $precioTotal = 0;

        foreach ($productsIds as $productId) {
            $product = Product::find($productId);

            if ($product) {
                $precioTotal += $product->actualPrice;
            }
        }

        // Crear la orden con el precio total
        $newOrden = Orden::create([
            'user_id' => $ordenData['user_id'],
            'date' => now(),
            'estado' => $ordenData['estado'],
            "direccionEnvio"=> $ordenData['direccionEnvio'],
            'precioTotal' => $precioTotal,
        ]);
        // App::call('App\Http\Controllers\CartProductController@removeAllProductsFromCart');
        $cart = Cart::where('user_id', $ordenData["user_id"])->first();      
        CartProduct::where('cart_id', $cart->cart_id)->delete();
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
  
    public function completarOrden($ordenId)
        {
            // Obtener la orden
            $orden = Orden::find($ordenId);
    
            // Verificar si la orden existe
            if (!$orden) {
                return response()->json(['error' => 'Orden no encontrada'], 404);
            }
    
            // Verificar si la orden ya está completada
            if ($orden->estado === 'completada') {
                return response()->json(['error' => 'La orden ya está completada'], 400);
            }
    
            // Realizar las operaciones necesarias para completar la orden
            // (pueden incluir actualización de estado, cálculo de total, etc.)
    
            // Incrementar las ventas para cada producto en la orden
            foreach ($orden->ordenProducto as $ordenProducto) {
                $producto = $ordenProducto->product;
                $producto->increment('cantVentas'); // Incrementar la cantidad de ventas
            }
    
            // Actualizar el estado de la orden
            $orden->estado = 'completada';
    
            // Guardar la orden
            $orden->save();
    
            return response()->json(['message' => 'Orden completada exitosamente'], 200);
        }
        
        public function cancelarOrden($ordenId)
        {
            // Obtener la orden
            $orden = Orden::find($ordenId);
    
            // Verificar si la orden existe
            if (!$orden) {
                return response()->json(['error' => 'Orden no encontrada'], 404);
            }
    
            // Verificar si la orden ya está completada
            if ($orden->estado === 'cancelada') {
                return response()->json(['error' => 'La orden ya está cancelada'], 400);
            }
    
            // Realizar las operaciones necesarias para completar la orden
            // (pueden incluir actualización de estado, cálculo de total, etc.)
    
            // // Incrementar las ventas para cada producto en la orden
            // foreach ($orden->ordenProducto as $ordenProducto) {
            //     $producto = $ordenProducto->product;
            //     $producto->increment('cantVentas'); // Incrementar la cantidad de ventas
            // }
    
            // Actualizar el estado de la orden
            $orden->estado = 'cancelada';
    
            // Guardar la orden
            $orden->save();
    
            return response()->json(['message' => 'Orden cancelada exitosamente'], 200);
        }
        public function getOrders()
        {
            $orden = Orden::all();
            // $perfils = Perfil::all();
            // "perfiles"=> $perfils
    
            return response()->json(['Orden' => $orden,]);
        }
    
}