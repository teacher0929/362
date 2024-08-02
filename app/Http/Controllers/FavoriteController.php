<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $products = Product::whereHas('favorites', function ($query) {
            return $query->where('id', auth()->id());
        })
            ->orderBy('id', 'desc')
            ->paginate(30);

        return view('favorites.index')
            ->with([
                'products' => $products,
            ]);
    }

    public function add($slug)
    {
        $product = Product::where('slug', $slug)
            ->firstOrFail();

        $user = auth()->user();
        $user->favorites()->toggle($product->id);
        if ($user->favorites()->where('id', $product->id)->count() > 0) {
            $product->increment('favorites');
            $success = 'Added to favorites!';
        } else {
            $product->decrement('favorites');
            $success = 'Removed from favorites!';
        }

        return redirect()->back()
            ->with([
                'success' => $success,
            ]);
    }
}
