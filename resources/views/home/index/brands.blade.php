<div class="py-4">
    <div class="h3 mb-3">Brands</div>
    <div class="row">
        @foreach($brands as $brand)
            <div class="col">
                <a class="btn btn-danger d-block text-center my-1" href="{{ route('products.index', ['brand' => $brand->id]) }}">
                    {{ $brand->name }}
                </a>
                @foreach($brand->series as $serie)
                    <a class="btn btn-light d-block text-center my-1" href="{{ route('products.index', ['serie' => $serie->id]) }}">
                        {{ $serie->name }}
                    </a>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
