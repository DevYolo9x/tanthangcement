@extends('homepage.layout.home')
@section('content')

{{-- Article --}}
<div id="main" class="sitemap main-new">
    {!!htmlBreadcrumb($detail->title, $breadcrumb)!!}
    <div class="content-new-page py-[30px] md:py-[50px] main">
        <div class="container mx-auto px-3">
            <div class="section-title text-center">
                <h1 class="title-primary uppercase text-green text-f20 md:text-f30 font-bold text-center leading-[30px] md:leading-[40px] relative pb-[20px]">
                    {{ $detail->title }}
                </h1>
            </div>
            @include('article.frontend.category.data')
        </div>
    </div>
</div>
@endsection