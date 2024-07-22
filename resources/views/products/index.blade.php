@extends('layouts.app')
@section('title') Products @endsection
@section('content')
    <div class="py-4">
        <div class="row g-2 g-sm-3 mb-3">
            <div class="col">
                <div class="h3 mb-0">
                    @if(isset($brand)) {{ $brand->name }} @endif
                    @if(isset($serie)) {{ $serie->name }} @endif
                    @if(isset($category)) {{ $category->name }} @endif
                    @if(!(isset($brand) or isset($serie) or isset($category))) Search @endif
                </div>
            </div>
            <div class="col-auto">
                <form action="{{ url()->current() }}" method="get">
                    <input type="hidden" name="category" value="{{ $f_category }}">
                    <input type="hidden" name="brand" value="{{ $f_brand }}">
                    <input type="hidden" name="serie" value="{{ $f_serie }}">
                    <input type="search" class="form-control" name="q" value="{{ $f_q ?: '' }}" autofocus>
                </form>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-2 g-sm-3 mb-4">
            @forelse($products as $product)
                <div class="col">
                    @include('app.product')
                </div>
            @empty
                <div class="col">
                    <div class="bg-white rounded-4 border p-3 h-100">
                        Not found
                    </div>
                </div>
            @endforelse
        </div>
        {{ $products->links() }}
    </div>
@endsection
