<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Serie;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'category' => 'nullable|integer|min:1',
            'brand' => 'nullable|integer|min:1',
            'serie' => 'nullable|integer|min:1',
        ]);
        $f_category = $request->has('category') ? $request->category : null;
        $f_brand = $request->has('brand') ? $request->brand : null;
        $f_serie = $request->has('serie') ? $request->serie : null;

        $category = isset($f_category)
            ? Category::findOrFail($f_category)
            : null;
        $brand = isset($f_brand)
            ? Brand::findOrFail($f_brand)
            : null;
        $serie = isset($f_serie)
            ? Serie::findOrFail($f_serie)
            : null;

        $products = Product::when(isset($f_category), function ($query) use ($f_category) {
            return $query->where('category_id', $f_category);
        })
            ->when(isset($f_brand), function ($query) use ($f_brand) {
                return $query->where('brand_id', $f_brand);
            })
            ->when(isset($f_serie), function ($query) use ($f_serie) {
                return $query->where('serie_id', $f_serie);
            })
            ->orderBy('id', 'desc')
            ->paginate(30);

        return view('products.index')
            ->with([
                'products' => $products,
                'category' => $category,
                'brand' => $brand,
                'serie' => $serie,
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