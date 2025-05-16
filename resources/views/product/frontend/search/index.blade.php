@extends('homepage.layout.home')
@section('content')
@include('product.frontend.category.data',['module' => 'search','title' => $seo['meta_title']])
@endsection