@extends('layouts.app')
@section('title') Compare @endsection
@section('content')
    <div class="py-4">
        <table class="table table-striped table-hover table-bordered">
            <tbody class="text-center">
            <tr>
                <td>Compare</td>
                <td style="width:35%;">
                    <form action="{{ url()->current() }}" method="get">
                        <input type="search" class="form-control" name="pc1" value="{{ $f_pc1 }}">
                        <input type="hidden" name="pc2" value="{{ $f_pc2 }}">
                    </form>
                </td>
                <td style="width:35%;">
                    <form action="{{ url()->current() }}" method="get">
                        <input type="hidden" name="pc1" value="{{ $f_pc1 }}">
                        <input type="search" class="form-control" name="pc2" value="{{ $f_pc2 }}">
                    </form>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    @if(isset($product1))
                        <div class="position-relative bg-white rounded-4 border p-2 p-sm-3">
                            @if($product1->isNew())
                                <div class="position-absolute top-0 start-0 py-1 mx-2">
                                    <div
                                        class="badge bg-success-subtle border border-success-subtle text-success-emphasis rounded-pill">
                                        New
                                    </div>
                                </div>
                            @endif
                            @if($product1->hasDiscount())
                                <div class="position-absolute top-0 end-0 py-1 mx-2">
                                    <div
                                        class="badge bg-danger-subtle border border-danger-subtle text-danger-emphasis rounded-pill">
                                        Discount {{ $product1->discount_percent }}<small>%</small>
                                    </div>
                                </div>
                            @endif
                            <div class="rounded-4 overflow-hidden">
                                <a href="{{ asset('img/product.jpg') }}" data-fancybox="gallery"
                                   data-caption="{{ $product1->name }} #1">
                                    <img src="{{ asset('img/product.jpg') }}" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    @endif
                </td>
                <td>
                    @if(isset($product2))
                        <div class="position-relative bg-white rounded-4 border p-2 p-sm-3">
                            @if($product2->isNew())
                                <div class="position-absolute top-0 start-0 py-1 mx-2">
                                    <div
                                        class="badge bg-success-subtle border border-success-subtle text-success-emphasis rounded-pill">
                                        New
                                    </div>
                                </div>
                            @endif
                            @if($product2->hasDiscount())
                                <div class="position-absolute top-0 end-0 py-1 mx-2">
                                    <div
                                        class="badge bg-danger-subtle border border-danger-subtle text-danger-emphasis rounded-pill">
                                        Discount {{ $product2->discount_percent }}<small>%</small>
                                    </div>
                                </div>
                            @endif
                            <div class="rounded-4 overflow-hidden">
                                <a href="{{ asset('img/product.jpg') }}" data-fancybox="gallery"
                                   data-caption="{{ $product2->name }} #1">
                                    <img src="{{ asset('img/product.jpg') }}" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Category</td>
                <td>
                    @if(isset($product1))
                        <a class="link-dark text-decoration-none"
                           href="{{ route('products.index', ['category' => $product1->category->slug]) }}">
                            {{ $product1->category->name }}
                        </a>
                    @endif
                </td>
                <td>
                    @if(isset($product2))
                        <a class="link-dark text-decoration-none"
                           href="{{ route('products.index', ['category' => $product2->category->slug]) }}">
                            {{ $product2->category->name }}
                        </a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Brand</td>
                <td>
                    @if(isset($product1))
                        <a class="link-dark text-decoration-none"
                           href="{{ route('products.index', ['brand' => $product1->brand->slug]) }}">
                            {{ $product1->brand->name }}
                        </a>
                    @endif
                </td>
                <td>
                    @if(isset($product2))
                        <a class="link-dark text-decoration-none"
                           href="{{ route('products.index', ['brand' => $product2->brand->slug]) }}">
                            {{ $product2->brand->name }}
                        </a>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Serie</td>
                <td>
                    @if(isset($product1))
                        <a class="link-dark text-decoration-none"
                           href="{{ route('products.index', ['serie' => $product1->serie->slug]) }}">
                            {{ $product1->serie->name }}
                        </a>
                    @endif
                </td>
                <td>
                    @if(isset($product2))
                        <a class="link-dark text-decoration-none"
                           href="{{ route('products.index', ['serie' => $product2->serie->slug]) }}">
                            {{ $product2->serie->name }}
                        </a>
                    @endif
                </td>
            </tr>
            @foreach($attributes as $attribute)
                <tr>
                    <td>{{ $attribute->name }}</td>
                    <td>
                        @if(isset($product1))
                            {{ $product1->attributeValues->where('attribute_id', $attribute->id)->first()->name }}
                        @endif
                    </td>
                    <td>
                        @if(isset($product2))
                            {{ $product2->attributeValues->where('attribute_id', $attribute->id)->first()->name }}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
