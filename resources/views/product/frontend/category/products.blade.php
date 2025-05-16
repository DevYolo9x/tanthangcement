@extends('homepage.layout.home')
@section('content')
@include('product.frontend.category.data',['module' => 'products','title' => $page->title])
@endsection