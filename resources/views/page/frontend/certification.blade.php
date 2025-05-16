@extends('homepage.layout.home')

@section('content')
    <?php
    $albums = getDataJson($page->fields, 'config_colums_json_page_certification_albums');
    ?>
    <div class="page-certification wow fadeInUp">
        <div class="container">
            <div class="logo-page section-title-box">
                <img src="{{ asset($fcSystem['homepage_logo']) }}" style="max-width: 100%;"
                    alt="{{ $fcSystem['homepage_brandname'] }}">
                <h2 class="text-center">{{ $page->title }}</h2>
            </div>
            @if (isset($albums) && isset($albums->image))
                <div class="albums">
                    <div class="row">
                        @foreach ($albums->image as $k => $image)
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="box-text">
                                        <h3>{{ $albums->title[$k] }}</h3>
                                        <div class="desc">{{ $albums->desc[$k] }}</div>
                                    </div>
                                    <div class="box-thumb hover-zoom">
                                        <a href="{{ asset($image) }}" data-fancybox="gallery">
                                            <img src="{{ asset($image) }}" alt="{{ $albums->title[$k] }}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

    <style>
        .page-certification .logo-page img {
            height: 100px;
            display: inline-block;
        }

        .page-certification .logo-page {
            text-align: center;
            margin-top: 35px;
            margin-bottom: 30px;
        }

        .page-certification .albums .item h3 {
            text-align: center;
            font-weight: 600;
            font-size: 20px;
        }

        .page-certification .albums .item {
            margin-bottom: 73px;
        }

        .page-certification .albums .item .box-thumb img {
            object-fit: contain;
            width: 100%;
        }

        .page-certification .logo-page h2 {
            margin-top: 15px;
        }
    </style>
@endpush

@push('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
        $('[data-fancybox="gallery"]').fancybox({
            buttons: [
                "slideShow",
                "thumbs",
                "zoom",
                "fullScreen",
                "share",
                "close"
            ],
            loop: false,
            protect: true
        });
    </script>
@endpush
