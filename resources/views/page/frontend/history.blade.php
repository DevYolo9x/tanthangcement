@extends('homepage.layout.home')
@section('content')
    <main class="page-history">
        {!! htmlBreadcrumb(0) !!}

        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 wow fadeInLeft">
                        <h1 class="page-title">{{ $page->title }}</h1>
                        <div class="content-content">{!! $page->description !!}</div>
                    </div>
                    @include('homepage.common.aside')
                </div>
            </div>
        </div>
    </main>
@endsection


@push('css')
    <style>
        .page-history .main-content {
            background-repeat: no-repeat;
            background-position: center top 70px;
            background-image: url(https://medlatec.vn/med/images/style/main-blog.png);
            margin-top: 120px;
        }

        main.page-history .page-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }
    </style>
@endpush

@push('javascript')
@endpush
