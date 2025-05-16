@extends('homepage.layout.home')
@section('content')
<div id="main" class="sitemap main-info pb-[50px]">
    {!!htmlBreadcrumb($page->title, [])!!}
    <div class="main-content pt-[20px] md:pt-[50px]">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-between mx-[-15px]">
                <div class="w-full md:w-3/4 px-[15px]">
                    <div class="content-content">
                        <h1 class="text-f20 md:text-f25 font-bold">
                            {{ $page->title }}
                        </h1>
                        <p class="date text-gray-500 mt-[10px]">

                        </p>
                        <div class="nav-content-content">
                            {!!$page->description!!}
                        </div>
                    </div>
                </div>
                @include('homepage.common.aside')
            </div>
        </div>
    </div>
</div>
@endsection