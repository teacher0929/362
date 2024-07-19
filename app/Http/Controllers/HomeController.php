<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $brands = Brand::with('series')
            ->orderBy('name')
            ->get();

        $popular = Product::where('stock', '>', 0)
            ->orderBy('viewed', 'desc')
            ->take(6)
            ->get();

        $discount = Product::where('discount_percent', '>', 0)
            ->where('discount_start', '<=', now())
            ->where('discount_end', '>=', now())
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('home.index')
            ->with([
                'brands' => $brands,
                'popular' => $popular,
                'discount' => $discount,
            ]);
    }
}
