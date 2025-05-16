@extends('homepage.layout.home')
@section('content')
    <?php
    $albums = getDataJson($page->fields, 'config_colums_json_page_albums');
    $partner = getPartner();
    $slidePartner1 = getSlider('partner-1');
    $slidePartner2 = getSlider('partner-2');
    ?>
    <main class="main-page page-partner wow fadeInUp">
        <div class="main-content">
            <div class="container">
                <div class="logo-page section-title-box">
                    <img src="{{ asset($fcSystem['homepage_logo']) }}" style="max-width: 100%;"
                        alt="{{ $fcSystem['homepage_brandname'] }}">
                    <h2 class="text-center">{{ $page->title }}</h2>
                    <hr>
                    <div class="desc">{!! $page->description !!}</div>
                    <div class="box-action text-center">
                        <a href="{{ route('customer.login') }}">Đăng nhập</a>
                    </div>
                </div>
                @if( isset($slidePartner1) && isset($slidePartner1->slides) )
                    <section class="home-partner @if(empty($slidePrivilege->slug)) has-bottom @endif wow fadeInUp">
                        <div class="container">
                            {!! htmlTitleMain($slidePartner1->title, $slidePartner1->description) !!}
                            <div class="list-albums">
                                <div class="row">
                                    @foreach( $slidePartner1->slides as $slide )
                                        <div class="col-lg-3">
                                            <a href="{{ asset($slide->src) }}" class="item hover-zoom" data-fancybox="partner1">
                                                <img src="{{ asset($slide->src) }}" style="width: 100%;" alt="{{ $slide->title }}">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                @if( !empty($slidePartner1->slug) )
                                    <div class="box-action text-center" style="display: none">
                                        <a href="{{ $slidePartner1->slug }}">Xem chi tiết</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>
                @endif

                @if( isset($slidePartner2) && isset($slidePartner2->slides) )
                    <section class="home-partner @if(empty($slidePrivilege->slug)) has-bottom @endif wow fadeInUp">
                        <div class="container">
                            {!! htmlTitleMain($slidePartner2->title, $slidePartner2->description) !!}
                            <div class="list-albums">
                                <div class="row">
                                    @foreach( $slidePartner2->slides as $slide )
                                        <div class="col-lg-3">
                                            <a href="{{ asset($slide->src) }}" class="item hover-zoom" data-fancybox="partner2">
                                                <img src="{{ asset($slide->src) }}" style="width: 100%;" alt="{{ $slide->title }}">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                @if( !empty($slidePartner2->slug) )
                                    <div class="box-action text-center" style="display: none">
                                        <a href="{{ $slidePartner2->slug }}">Xem chi tiết</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </main>
@endsection

@push('css')
    <style>
        .page-partner .logo-page img {
            height: 100px;
            display: inline-block;
        }

        .page-partner .logo-page {
            text-align: center;
            margin-top: 35px;
        }

        .page-partner .logo-page h2 {
            margin-top: 20px;
            /* border-bottom: 1px solid #333; */
            padding-bottom: 15px;
        }
    </style>
@endpush

@push('javascript')
@endpush
