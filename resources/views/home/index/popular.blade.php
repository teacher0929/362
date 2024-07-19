<div class="border-top py-4">
    <div class="h3 mb-3">Popular</div>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 g-2 g-3">
        @foreach($popular as $product)
            <div class="col">
                @include('app.product')
            </div>
        @endforeach
    </div>
</div>
