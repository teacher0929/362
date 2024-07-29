@extends('layouts.app')
@section('title') {{ $product->name }} @endsection
@section('content')
    <div class="py-4">
        <div class="row">
            <div class="col-auto">
                <div class="position-relative bg-white rounded-4 border p-2 p-sm-3">
                    @if($product->isNew())
                        <div class="position-absolute top-0 start-0 py-1 mx-2">
                            <div
                                class="badge bg-success-subtle border border-success-subtle text-success-emphasis rounded-pill">
                                New
                            </div>
                        </div>
                    @endif
                    @if($product->hasDiscount())
                        <div class="position-absolute top-0 end-0 py-1 mx-2">
                            <div
                                class="badge bg-danger-subtle border border-danger-subtle text-danger-emphasis rounded-pill">
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
                </div>
            </div>
            <div class="col">
                <div class="h3">
                    {{ $product->name }}
                </div>
                @if($product->hasDiscount())
                    <div class="h4 text-danger">
                        <i class="bi-fire"></i>
                        {{ number_format($product->price(), 2, '.', ' ') }}
                        <small>TMT</small>
                    </div>
                @else
                    <div class="h4 text-primary">
                        {{ number_format($product->price, 2, '.', ' ') }}
                        <small>TMT</small>
                    </div>
                @endif
                <div class="mb-2">
                    {{ $product->description }}
                </div>
                <div class="row g-2 g-sm-3 mb-3">
                    <div class="col-auto"><i class="bi-box-fill text-secondary"></i> {{ $product->stock }}</div>
                    <div class="col-auto"><i class="bi-eye-fill text-secondary"></i> {{ $product->viewed }}</div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <tbody>
                    <tr>
                        <td>Category</td>
                        <td>
                            <a class="link-dark text-decoration-none"
                               href="{{ route('products.index', ['category' => $product->category->slug]) }}">
                                {{ $product->category->name }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Brand</td>
                        <td>
                            <a class="link-dark text-decoration-none"
                               href="{{ route('products.index', ['brand' => $product->brand->slug]) }}">
                                {{ $product->brand->name }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Serie</td>
                        <td>
                            <a class="link-dark text-decoration-none"
                               href="{{ route('products.index', ['serie' => $product->serie->slug]) }}">
                                {{ $product->serie->name }}
                            </a>
                        </td>
                    </tr>
                    @foreach($product->attributeValues as $attributeValue)
                        <tr>
                            <td>{{ $attributeValue->attribute->name }}</td>
                            <td>{{ $attributeValue->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('home.index.popular')
    @include('home.index.discount')
@endsection
