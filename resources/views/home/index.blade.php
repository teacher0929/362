@extends('layouts.app')
@section('title') Home @endsection
@section('content')
    @include('home.index.brands')
    @include('home.index.popular')
    @include('home.index.discount')
@endsection
