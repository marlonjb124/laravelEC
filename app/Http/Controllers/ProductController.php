<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
            "favorite" => $product->favorite,
            "stock" => $product->stock,
            "category" => $product->category,
            "image" => $product->image
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

        return response()->json($newProduct);
    }
}

