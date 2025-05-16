@extends('homepage.layout.home')
@section('content')
    <?php $albums = json_decode($detail->image_json, true); ?>
    <div id="main" class="sitemap main-services-detail">
        {!! htmlBreadcrumb($detail->title, $breadcrumb) !!}
        <div class="content-product py-[30px] md:py-[50px]">
            <div class="container mx-auto px-3">
                <div class="w-full">
                    <h1 class="text-f20 md:text-f25 font-medium mb-8">
                        {{ $detail->title }}
                    </h1>

                    @if( $albums )
                    <div class="album">
                        <div class="slider slider-for">
                            @foreach( $albums as $v )
                            <div class="item">
                                <img src="{{ asset($v) }}" alt="">
                            </div>
                            @endforeach
                        </div>
                        <div class="slider slider-nav">
                            @foreach( $albums as $v )
                            <div class="item">
                                <img src="{{ asset($v) }}" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                
                    <div class="nav-content-content content-content mt-7">
                        {!! $detail->content !!}
                    </div>

                </div>

            </div>

            <div class="pb-10" style="background: #f8f8f8">
                <div class="container mx-auto px-3">
                    @if(!$sameArticle->isEmpty())
                        <div class="other-new pt-[20px] md:pt-[40px]">
                            <h2 class="title-primary pb-[20px] md:pb-[25px] text-center text-f25 md:text-f32 font-medium relative after:content after:absolute after:w-[65px] after:h-[4px] after:bg-color_primary after:bottom-0 after:left-1/2 after:-translate-x-1/2">
                                Dự án liên quan khác
                            </h2>
                            <div class="slider-other-projects owl-carousel mt-10">
                                @foreach($sameArticle as $vC)
                                <div class="item mt-3">
                                    <div
                                        class="group box-shadow-custom border border-gray-100 item mb-[10px] md:mb-[30px] relative shadow hover:transform hover:translate-y-[-10px] transition duration-300 ease-in-out">
                                        <div class="img hover-zoom">
                                            <a href="{{ route('routerURL', ['slug', $vC->slug]) }}">
                                                <img src="{{ asset($vC->image) }}"
                                                    class="w-full h-175px md:h-350px object-cover" alt="">
                                            </a>
                                        </div>
                                        <div
                                            class=" bg-white bottom-0 duration-300 ease-in-out group-hover:bg-color_hover group-hover:text-white last:border-00 md:px-3 md:py-3 md:text-center pb-2 px-2 text-black transition">
                                            <h3 class="my-3"><a href="{{ route('routerURL', ['slug', $vC->slug]) }}" class="font-medium text-f18 text-left" style="
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                                -webkit-line-clamp: 2;
                                                -webkit-box-orient: vertical;
                                                display: -webkit-box;
                                            ">{{ $vC->title }}</a></h3>
                                            <div
                                                class="xl:flex xl:flex-wrap justify-start mx-[-15px] mt-[15px] md:mt-[30px] items-center">
                                                <div class="w-full xl:w-3/4 px-[15px]">
                                                    <div class="text-left"
                                                        style="
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                                -webkit-line-clamp: 3;
                                                -webkit-box-orient: vertical;
                                                display: -webkit-box;
                                            ">{!! $vC->description !!}</div>
                                                </div>
                                                <div
                                                    class="mb-4 mt-5 px-[15px] md:text-center text-left w-full xl:mb-0 xl:mt-0 xl:text-right xl:w-1/4">
                                                    <a href="{{ route('routerURL', ['slug', $vC->slug]) }}"
                                                        class="border border-black btn-readmore group-hover:border-white header-22 px-3 md:py-2 py-1.5 rounded-[30px]">Xem
                                                        thêm <i class="fas fa-angle-double-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.min.css') }}" />
@endpush

@push('javascript')
    <script type="text/javascript" src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
            nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
            nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 1920,
                    settings: {
                        slidesToShow: 6,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 1366,
                    settings: {
                        slidesToShow: 6,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                }

        ]
        });
    </script>
@endpush
