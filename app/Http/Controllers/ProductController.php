<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function getProducts()
{
    $products = Product::all();

    $productList = []; // Agrega esta línea

    // Transformar $products según necesites
    foreach ($products as $product) {
        $productDict = [
            "product_id" => $product->product_id,
            "name" => $product->name,
            "price" => $product->price,
            "description" => $product->description,
            "descuento"=>$product->descuento,
            "stock" => $product->stock,
            "category" => $product->category,
            "image" => $product->image,
            "actualPrice"=> $product->actualPrice,
            "habilitado"=> $product->habilitado,
            "cantVentas"=> $product->cantVentas,
        ];

        $productList[] = $productDict;
    }

    return response()->json($productList);
}

    public function getProductByCategory($category)
    {
        $products = Product::where('category', $category)->get();

        // Transformar $products según necesites

        return response()->json($products);
    }

    public function getProductByName($name)
    {
        $products = Product::where('name', 'like', '%' . $name . '%')->get();

        // Transformar $products según necesites

        return response()->json($products);
    }

    public function getProductById($product_id)
    {
        $product = Product::find($product_id);

        // Transformar $product según necesites

        return response()->json($product);
    }

    public function newProduct(Request $request)
    {
        $productData = $request->all();

        $newProduct = Product::create($productData);

        // Transformar $newProduct según necesites

        $newProduct->save();

        return response()->json($newProduct); 
    }

    public function addToFavorites(Request $request)
    {
    // $product = Product::findOrFail($productId);
    $user = $request->user();
    $user->favoriteProducts()->syncWithoutDetaching([$request->product_id]);

    return response()->json(['message' => 'Product added to favorites']);
    }

    public function removeFromFavorites(Request $request)
    {
    // $product = Product::findOrFail($productId);
    $user = $request->user();
    $user->favoriteProducts()->detach($request->product_id);

    return response()->json(['message' => 'Product removed from favorites']);
}
public function editarProducto(Request $request, $productId)
{
    // Obtener el producto
    $producto = Product::find($productId);

    // Verificar si el producto existe
    if (!$producto) {
        return response()->json(['error' => 'Producto no encontrado'], 404);
    }

    // Validar los datos del formulario
    $request->validate([
        'name' => 'string|max:255',
        'price' => 'numeric|min:0',
        'description' => 'string|max:255',
        'stock' => 'integer|min:0',
        'category' => 'string|max:255',
        'image' => 'string|max:255',
        'descuento' => 'numeric|min:0|max:100',
        'habilitado' => 'boolean',
        'cantVentas' => 'integer|min:0',
    ]);

    // Actualizar los atributos del producto con los datos del formulario
    $producto->fill($request->all());

    // Recalcular el actualPrice basado en el descuento y el precio
    // $producto->actualPrice = ($producto->descuento / 100) * $producto->price;

    // Guardar los cambios en el producto
    $producto->save();

    return response()->json(['message' => 'Producto editado exitosamente'], 200);
}




    public function obtenerFavoritosUsuario($userId)
    {
        // Obtener el usuario
        $usuario = User::find($userId);

        // Verificar si el usuario existe
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Obtener los productos favoritos del usuario
        $favoritos = $usuario->favoriteProducts;

        return response()->json($favoritos, 200);
    }
}

