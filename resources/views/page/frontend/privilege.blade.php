@extends('homepage.layout.home')
@section('content')
    {!! htmlBreadcrumb($page->title) !!}
    <?php
    $data = getDataJson($page->fields, 'config_colums_json_pag_privilege_data');
    ?>
    <main class="main-page page-privilege" style="background: #f9f8f4">
        <div class="container">
            <div class="wow fadeInUp">
                {!! htmlTitleMain($page->title, $page->description) !!}
            </div>
            <div class="list-item">
                @if (isset($data) && isset($data->image) && count($data->image))
                    @foreach ($data->image as $k => $image)
                        <div class="row wow fadeInUp">
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="box-thumb hover-zoom">
                                        <a href="{{ asset($image) }}" data-fancybox="gallery">
                                            <img src="{{ asset($image) }}" alt="{{ $data->title[$k] }}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="box-text">
                                        <h3>{{ $data->title[$k] }}</h3>
                                        <div class="desc">{!! $data->desc[$k] !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </main>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <style>
        .list-item .row:nth-child(even)>div:nth-child(2) {
            order: 1;
        }

        .main-page {
            padding-top: 30px;
            margin-top: 0 !important;
        }

        footer {
            margin-top: 0 !important;
        }

        .page-privilege .list-item {
            padding-bottom: 45px;
        }

        .list-item .item .box-thumb img {
            width: 100%;
        }

        .list-item .item .box-text {
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;
        }

        .list-item .item .box-text h3 {
            font-size: 20px;
            font-weight: 800;
        }

        .list-item .row {
            margin: 0;
        }

        .list-item .row>div {
            padding: 0;
        }

        .list-item .row:nth-child(even)>div:nth-child(1) {
            order: 2;
        }

        .list-item .row:nth-child(even)>div:nth-child(2) {
            order: 1;
        }

        @media (min-width: 1024px) {
            .page-privilege .list-item .item {
                height: 400px;
                overflow: hidden;
            }
        }
        
        @media (max-width: 991px) {
            .list-item .row:nth-child(even)>div:nth-child(1) {
                order: 1;
            }

            .list-item .row:nth-child(even)>div:nth-child(2) {
                order: 2;
            }
            .list-item .item .box-text {
                padding: 0px!important;
                margin-block: 15px;
            }
            .list-item .item .box-text h3 {
                font-size: 17px;
            }
        }

        @media (max-width: 1024px) and (min-width: 992px) {
            .list-item .item .box-text {
                padding-bottom: 30px;
            }

            .list-item .item .box-text h3 {
                font-size: 17px;
                font-weight: 800;
            }
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
