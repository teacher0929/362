@extends('layouts.app')
@section('title') Products @endsection
@section('content')
    <div class="h4 mb-3">
        Products
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-2 g-3 mb-4">
        @foreach($products as $product)
            <div class="col">
                <div class="bg-white rounded border p-3 h-100">
                    <div>
                        <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                    </div>
                    <div>Price: {{ $product->price }}</div>
                    <div>Stock: {{ $product->stock }}</div>
                    <div>Viewed: {{ $product->viewed }}</div>
                </div>
            </div>
        @endforeach
    </div>
    <div>
        {{ $products->links() }}
    </div>
@endsection
