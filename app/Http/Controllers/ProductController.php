<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'string|max:255',
            'stock' => 'required|integer|min:0',
            'category' => 'string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajusta las reglas según tus necesidades
            'descuento' => 'numeric|min:0|max:100',
            'habilitado' => 'boolean',
            'cantVentas' => 'integer|min:0',
        ]);
    
        // Obtener la imagen de la solicitud
        $imagen = $request->file('image');
    
        // Llamar al método para manejar la nueva imagen
        $rutaNuevaImagen = $this->guardarImagen($imagen);
    
        // Crear un nuevo producto con los datos del formulario y la URL de la imagen
        $producto = new Product([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'stock' => $request->input('stock'),
            'category' => $request->input('category'),
            'image' => $rutaNuevaImagen,
            'descuento' => $request->input('descuento'),
            'habilitado' => $request->input('habilitado', false),
            'cantVentas' => $request->input('cantVentas', 0),
        ]);
    
        // Guardar el nuevo producto en la base de datos
        $producto->save();
    
        // Respuesta con el nuevo producto creado
        return response()->json(['mensaje' => 'Producto creado correctamente', 'producto' => $producto]);
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
    Log::info('Solicitud recibida:', ['todo' => $request->all()]);
    $producto = Product::find($productId);
    
    // Verificar si el producto existe
    if (!$producto) {
        return response()->json(['error' => 'Producto no encontrado'], 404);
    }

    // Validar los datos del formulario
    // $request->validate([
    //     'name' => 'string|max:255',
    //     'price' => 'numeric|min:0',
    //     'description' => 'string|max:255',
    //     'stock' => 'integer|min:0',
    //     'category' => 'string|max:255',
    //     'image' => 'string|max:255',
    //     'descuento' => 'numeric|min:0|max:100',
    //     'habilitado' => 'boolean',
    //     'cantVentas' => 'integer|min:0',
    // ]);
    if ($request->file("image")!= null) {
        $image =$request->file("image");
        // Llamar directamente a la función guardarNuevaImagen
        $rutaNuevaImagen = $this->guardarimagen($image);

        // Actualizar la ruta de la imagen en el modelo del producto
        $producto->image = $rutaNuevaImagen;
    }
    if ($producto) {
        $productData = $request->except("image");

        foreach ($productData as $field => $value) {
            $producto->$field = $value;
        }
    }
    echo($producto);
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
    public function guardarimagen($image){
        if ($image!= null) {
            
            
            // Obtener el archivo de la solicitud
            $imagen = $image;
    
            // Definir la ubicación de destino
            $ubicacion = 'D:\marlon\Informatica\web\laravel\PracticaEC\public\images';
    
            // Guardar la imagen en la ubicación especificada
            $imagen->move($ubicacion, $imagen->getClientOriginalName());
    
            // Obtener la ruta completa de la imagen guardada
            $rutaImagen = $ubicacion . '\\' . $imagen->getClientOriginalName();
            return $rutaImagen;
            
        }
        else{ 
            echo("cachibum en la image");
        }
    
    }


public function toggleHabilitar(Request $request, $productId)
{
    // Obtener el producto
    $producto = Product::findOrFail($productId);

    // Verificar si el producto existe
    if (!$producto) {
        return response()->json(['error' => 'Producto no encontrado'], 404);
    }

    // Cambiar el estado de habilitación/deshabilitación
    $producto->habilitado = !$producto->habilitado;

    // Guardar los cambios en el producto
    $producto->save();

    // Respuesta con el nuevo estado del producto
    return response()->json(['mensaje' => 'Estado cambiado correctamente', 'habilitado' => $producto->habilitado]);
}


}
    