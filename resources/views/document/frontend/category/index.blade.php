@extends('homepage.layout.home')
@section('content')
{{-- Article --}}
<div id="main" class="sitemap main-new">
    {!!htmlBreadcrumb($detail->title, $breadcrumb)!!}
    <div class="content-new-page py-[30px] md:py-[50px]">
        <div class="container mx-auto px-3">
            @include('article.frontend.category.data')
        </div>
    </div>
</div>
@endsection