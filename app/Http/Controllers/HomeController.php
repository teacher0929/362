<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return [
            'status' => 1,
            'data' => [
                'categories' => Category::orderBy('name')
                    ->get(),

                'popular' => Product::where('stock', '>', 0)
                    ->with('brand', 'serie')
                    ->orderBy('viewed', 'desc')
                    ->take(10)
                    ->get(['id', 'brand_id', 'serie_id', 'name', 'price'])
                    ->transform(function ($obj) {
                        return [
                            'id' => $obj->id,
                            'brand' => $obj->brand->name,
                            'serie' => $obj->serie_id ? $obj->serie->name : null,
                            'name' => $obj->name,
                            'price' => round($obj->price, 1),
                        ];
                    }),

                'discount' => Product::where('discount_percent', '>', 0)
                    ->where('discount_start', '<=', now())
                    ->where('discount_end', '>=', now())
                    ->where('stock', '>', 0)
                    ->with('brand', 'serie')
                    ->inRandomOrder()
                    ->take(10)
                    ->get(['id', 'brand_id', 'serie_id', 'name', 'price'])
                    ->transform(function ($obj) {
                        return [
                            'id' => $obj->id,
                            'brand' => $obj->brand->name,
                            'serie' => $obj->serie_id ? $obj->serie->name : null,
                            'name' => $obj->name,
                            'price' => round($obj->price, 1),
                        ];
                    }),
            ],
        ];
    }
}
