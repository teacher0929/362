<div class="position-relative bg-white rounded-4 border p-2 p-sm-3 h-100">
    @if($product->isNew())
        <div class="position-absolute top-0 start-0 py-1 mx-2">
            <div class="badge bg-success-subtle border border-success-subtle text-success-emphasis rounded-pill">
                New
            </div>
        </div>
    @endif
    @if($product->hasDiscount())
        <div class="position-absolute top-0 end-0 py-1 mx-2">
            <div class="badge bg-danger-subtle border border-danger-subtle text-danger-emphasis rounded-pill">
                Discount {{ $product->discount_percent }}<small>%</small>
            </div>
        </div>
    @endif
    <div class="rounded-4 overflow-hidden">
        <a href="{{ asset('img/product.jpg') }}" data-fancybox="gallery"
           data-caption="{{ $product->name }} #1">
            <img src="{{ asset('img/product.jpg') }}" alt="" class="img-fluid">
        </a>
    </div>
    <div class="position-relative">
        @if($product->hasDiscount())
            <div class="h5 text-danger">
                <i class="bi-fire"></i>
                {{ number_format($product->price(), 2, '.', ' ') }}
                <small>TMT</small>
            </div>
        @else
            <div class="h5 text-primary">
                {{ number_format($product->price, 2, '.', ' ') }}
                <small>TMT</small>
            </div>
        @endif
        <div>
            <a class="h6 link-dark text-decoration-none stretched-link"
               href="{{ route('products.show', $product->id) }}">
                {{ $product->name }}
            </a>
        </div>
        <div class="row g-2 g-sm-3">
            <div class="col-auto"><i class="bi-box-fill text-secondary"></i> {{ $product->stock }}</div>
            <div class="col-auto"><i class="bi-eye-fill text-secondary"></i> {{ $product->viewed }}</div>
        </div>
    </div>
</div>
