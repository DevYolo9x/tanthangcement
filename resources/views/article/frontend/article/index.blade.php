@extends('homepage.layout.home')
@section('content')
    <main class="main-page page-detail-article">
        <div class="main-content">
            {!! htmlBreadcrumb($detail->title, $breadcrumb) !!}
            <div class="container px-[15px] mx-auto pb-10">
                <div class="grid grid-cols-12 gap-6 mt-7">
                    <div class="w-full col-span-12 lg:col-span-9 list-post wow fadeInLeft">
                        {!! htmlTitleMain($detail->title, '', 'h1') !!}
                        <a class="content-view-count mt-1" style="margin-bottom: 10px;display: inline-block;"><i>Lượt xem: {{ $detail->viewed }}</i></a>
                        <div class="content-content description">{!! $detail->content !!}</div>
                    </div>
                    <div class="w-full col-span-12 lg:col-span-3 wow fadeInRight">
                        @include('homepage.common.aside')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('css')
    <style>
        @media (max-width: 991px) and (min-width: 768px) {
            aside img {
                width: 100% !important;
                height: 300px !important;
            }
        }
    </style>
@endpush

@push('javascript')
@endpush
