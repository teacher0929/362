<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')
            ->paginate(30);

        return view('products.index')
            ->with([
                'products' => $products,
            ]);
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show')
            ->with([
                'product' => $product,
            ]);
    }
}
