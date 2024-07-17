@extends('layouts.app')
@section('title') Home @endsection
@section('content')
    <div class="h4">
        Brands
    </div>
    <div class="row">
        @foreach($brands as $brand)
            <div class="col">
                <div>
                    <a href="{{ route('products.index', ['brand' => $brand->id]) }}">
                        {{ $brand->name }}
                    </a>
                </div>
                @foreach($brand->series as $serie)
                    <div class="small">
                        <a href="{{ route('products.index', ['serie' => $serie->id]) }}">
                            {{ $serie->name }}
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
