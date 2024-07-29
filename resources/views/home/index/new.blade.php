<div class="border-top py-4">
    <div class="h3 mb-3">
        <a href="{{ route('products.index', ['isNew' => 1]) }}" class="text-decoration-none">
            New
        </a>
    </div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-2 g-sm-3">
        @foreach($new as $product)
            <div class="col">
                @include('app.product')
            </div>
        @endforeach
    </div>
</div>
