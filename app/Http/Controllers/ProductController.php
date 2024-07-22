<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
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


    public function compare(Request $request)
    {
        $request->validate([
            'pc1' => 'nullable|integer|min:1',
            'pc2' => 'nullable|integer|min:1',
        ]);
        $f_pc1 = $request->has('pc1') ? $request->pc1 : null;
        $f_pc2 = $request->has('pc2') ? $request->pc2 : null;

        $product1 = isset($f_pc1)
            ? Product::with('category', 'brand', 'serie', 'attributeValues')
                ->findOrFail($f_pc1)
            : null;
        $product2 = isset($f_pc2)
            ? Product::with('category', 'brand', 'serie', 'attributeValues')
                ->findOrFail($f_pc2)
            : null;
        $attributes = Attribute::orderBy('sort_order')
            ->get();

        return view('products.compare')
            ->with([
                'product1' => $product1,
                'product2' => $product2,
                'attributes' => $attributes,
            ]);
    }


    public function show($id)
    {
        $product = Product::with('category', 'brand', 'serie', 'attributeValues.attribute')
            ->findOrFail($id);

        $popular = Product::where('category_id', $product->category_id)
            ->where('brand_id', $product->brand_id)
            ->where('stock', '>', 0)
            ->orderBy('viewed', 'desc')
            ->take(6)
            ->get();

        $discount = Product::where('category_id', $product->category_id)
            ->where('brand_id', $product->brand_id)
            ->where('discount_percent', '>', 0)
            ->where('discount_start', '<=', now())
            ->where('discount_end', '>=', now())
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('products.show')
            ->with([
                'product' => $product,
                'popular' => $popular,
                'discount' => $discount,
            ]);
    }
}
