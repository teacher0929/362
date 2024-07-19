@extends('layouts.app')
@section('title') {{ $product->name }} @endsection
@section('content')
    <div class="py-4">
        <div class="h3">
            {{ $product->name }}
        </div>
        <div>
            {{ $product->description }}
        </div>
        <div>
            {{ $product->price }}
        </div>
        <div>
            {{ $product->stock }}
        </div>
    </div>
    @include('home.index.popular')
    @include('home.index.discount')
@endsection
