@extends('layouts.app')
@section('title') {{ $product->name }} @endsection
@section('content')
    <div class="h4">
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
@endsection
