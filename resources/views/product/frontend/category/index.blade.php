@extends('homepage.layout.home')
@section('content')
<div class="page-product-category">
    @include('product.frontend.category.data',['module' => $module,'title' => $detail->title])
</div>
@endsection

@push('css')
@endpush