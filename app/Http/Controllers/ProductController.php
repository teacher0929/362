<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:30'],
            'category' => ['nullable', 'string', 'max:50'],
            'brand' => ['nullable', 'string', 'max:50'],
            'serie' => ['nullable', 'string', 'max:50'],
            'hasDiscount' => ['nullable', 'boolean'],
            'isNew' => ['nullable', 'boolean'],
        ]);
        $f_q = $request->has('q') ? $request->q : null;
        $f_category = $request->has('category') ? $request->category : null;
        $f_brand = $request->has('brand') ? $request->brand : null;
        $f_serie = $request->has('serie') ? $request->serie : null;
        $f_hasDiscount = $request->has('hasDiscount') ? $request->hasDiscount : 0;
        $f_isNew = $request->has('isNew') ? $request->isNew : 0;

        $category = isset($f_category)
            ? Category::where('slug', $f_category)
                ->firstOrFail()
            : null;
        $brand = isset($f_brand)
            ? Brand::where('slug', $f_brand)
                ->firstOrFail()
            : null;
        $serie = isset($f_serie)
            ? Serie::where('slug', $f_serie)
                ->firstOrFail()
            : null;

        $products = Product::when(isset($f_q), function ($query) use ($f_q) {
            return $query->where('name', 'like', '%' . $f_q . '%');
        })
            ->when(isset($category), function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            })
            ->when(isset($brand), function ($query) use ($brand) {
                return $query->where('brand_id', $brand->id);
            })
            ->when(isset($serie), function ($query) use ($serie) {
                return $query->where('serie_id', $serie->id);
            })
            ->when($f_hasDiscount, function ($query) {
                return $query->where('discount_percent', '>', 0)
                    ->where('discount_start', '<=', now())
                    ->where('discount_end', '>=', now());
            })
            ->when($f_isNew, function ($query) {
                return $query->where('created_at', '>=', now()->subMonth());
            })
            ->orderBy('id', 'desc')
            ->paginate(30);

        return view('products.index')
            ->with([
                'products' => $products,
                'category' => $category,
                'brand' => $brand,
                'serie' => $serie,
                'f_q' => $f_q,
                'f_category' => $f_category,
                'f_brand' => $f_brand,
                'f_serie' => $f_serie,
            ]);
    }


    public function compare(Request $request)
    {
        $request->validate([
            'pc1' => 'nullable|string|max:255',
            'pc2' => 'nullable|string|max:255',
        ]);
        $f_pc1 = $request->has('pc1') ? $request->pc1 : null;
        $f_pc2 = $request->has('pc2') ? $request->pc2 : null;

        $product1 = isset($f_pc1)
            ? Product::where('slug', $f_pc1)
                ->with('category', 'brand', 'serie', 'attributeValues')
                ->firstOrFail()
            : null;
        $product2 = isset($f_pc2)
            ? Product::where('slug', $f_pc2)
                ->with('category', 'brand', 'serie', 'attributeValues')
                ->firstOrFail()
            : null;
        $attributes = Attribute::orderBy('sort_order')
            ->get();

        return view('products.compare')
            ->with([
                'product1' => $product1,
                'product2' => $product2,
                'attributes' => $attributes,
                'f_pc1' => $f_pc1,
                'f_pc2' => $f_pc2,
            ]);
    }


    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with([
                'category', 'brand', 'serie', 'attributeValues.attribute',
                'reviews' => function ($query) {
                    $query->where('status', 1);
                    $query->orWhere('user_id', auth()->id());
                    $query->with('user');
                }
            ])
            ->firstOrFail();

        if (Cookie::has('product_views')) {
            $cookieIds = Cookie::get('product_views');
            $productIds = explode(',', $cookieIds);
            if (!in_array($product->id, $productIds)) {
                $product->increment('viewed');
                $productIds[] = $product->id;
                Cookie::queue('product_views', implode(',', $productIds), 8 * 60);
            }
        } else {
            Cookie::queue('product_views', $product->id, 8 * 60);
        }

        $popular = Product::where('category_id', $product->category_id)
            ->where('brand_id', $product->brand_id)
            ->where('stock', '>', 0)
            ->orderBy('viewed', 'desc')
            ->take(5)
            ->get();

        $discount = Product::where('category_id', $product->category_id)
            ->where('brand_id', $product->brand_id)
            ->where('discount_percent', '>', 0)
            ->where('discount_start', '<=', now())
            ->where('discount_end', '>=', now())
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->take(5)
            ->get();

        return view('products.show')
            ->with([
                'product' => $product,
                'popular' => $popular,
                'discount' => $discount,
            ]);
    }
}
