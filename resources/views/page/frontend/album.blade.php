@extends('homepage.layout.home')
@section('content')
    {!! htmlBreadcrumb($page->title) !!}
    <?php
    $albums = getDataJson($page->fields, 'config_colums_json_page_albums');
    ?>
    <main class="main-page page-album wow fadeInUp">
        <div class="main-content">
            <div class="container">
                {!! htmlTitleMain($page->title, $page->description) !!}
                <div class="list-album">
                    <div class="row row-custom">
                        @if (isset($albums) && isset($albums->image) && count($albums->image))
                            @foreach ($albums->image as $k => $image)
                                <div class="col-lg-2 col-md-4 col-6">
                                    <div class="item">
                                        <div class="box-thumb hover-zoom">
                                            <a href="{{ asset($image) }}" data-fancybox="gallery"><img
                                                    src="{{ asset($image) }}" alt="{{ $albums->title[$k] }}"></a>
                                        </div>
                                        <div class="box-text">
                                            <h3>{{ $albums->title[$k] }}</h3>
                                            <div class="desc">{{ $albums->desc[$k] }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <style>
        .page-album .list-album .box-thumb img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .page-album .list-album .box-text h3 {
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            display: -webkit-box;
            font-size: 16px;
            text-align: center;
            font-weight: 600;
            line-height: 20px;
            height: 40px;
        }

        .page-album .list-album .item {
            margin-bottom: 25px;
        }

        .page-album .list-album .box-text {
            margin-top: 12px;
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
