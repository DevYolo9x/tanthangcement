@extends('homepage.layout.home')
@section('content')

<?php
    $color = ['bg-[#64e658]', 'bg-[#32bca1]', 'bg-[#b5cc86]', 'bg-[#afb825]'];
?>
<div id="main" class="sitemap main-services">

    <section class="info-home wow fadeInUp ">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-between mx-[-15px] items-center">
                <div class="w-full md:w-1/2 px-[15px]">
                    <div class="info-home-right hover-zoom">
                        <img src="{{ asset($fcSystem['services_2']) }}" alt="{{ $fcSystem['services_1'] }}" class="w-full"/>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-[15px]">
                    <div class="top-home-left mb-[15px] md:mb-0">
                        <h2 class="text-green text-f20 md:text-f25 font-bold leading-[30px] md:leading-[40px] relative pb-[10px]">
                            {{ $fcSystem['services_1'] }}
                        </h2>
                        <div class="text-f15 leading-[25px] mt-[10px] md:mt-[15px]">
                            <div class="content-content">
                                {!! $fcSystem['services_3'] !!}
                                <a href="javascript:void(0)" class="openPopup moreless-button readmore text-f14 cursor-pointer inline-block border border-green py-[10px] px-[25px] uppercase text-f15 rounded-[5px] mt-[10px] md:mt-[20px] transition-all bg-color_primary text-white hover:bg-color_second hover:text-white">
                                    Đăng ký dùng thử ngay
                                    <i class="fa-solid fa-angles-right text-f11 ml-[5px]"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @if( !empty($service_1) && count($service_1->slides) > 0 )
    <section class="icon-box py-[30px] md:py-[60px] wow fadeInUp bg-color_primary">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-start mx-[-15px]">
                @foreach( $service_1->slides as $item )
                <div class="w-full md:w-1/3 px-[15px]">
                    <div class="item text-center py-[10px] md:py-[50px] px-[15px] relative overflow-hidden mb-[15px] lg:mb-0">
                        <div class="icon w-[80px] h-[80px] bg-white rounded-full text-center leading-[80px] inline-block">
                            <a href="{{ (!empty($item->link))?$item->link:'javascript:void(0)' }}">
                                <img src="{{ asset($item->src) }}" alt="{{ $item->title }}" class="inline-block w-[35px]"/>
                            </a>
                        </div>
                        <div class="nav-item mt-[20px]">
                            <h3 class="text-f20 font-bold mb-[10px] text-white">
                                <a href="{{ (!empty($item->link))?$item->link:'javascript:void(0)' }}">
                                    {{ $item->title }}
                                </a>
                            </h3>
                            <p class="desc-1 text-f14 text-white">{{ $item->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if( !empty($service_2) && count($service_2->slides) > 0 )
    <section class="icon-box icon-box-2 py-[30px] md:py-[60px] wow fadeInUp ">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-start mx-[-15px]">
                @foreach( $service_2->slides as $key => $item )
                    @if( $key < 4 )
                    <div class="w-full md:1/2 lg:w-1/4 px-[15px]">
                        <div class="item text-center py-[10px] md:py-[50px] px-[15px] relative overflow-hidden mb-[15px] lg:mb-0 {{ $color[$key] }}">
                            <div class="icon">
                                <a href="{{ (!empty($item->link))?$item->link:'javascript:void(0)' }}">
                                    <img src="{{ asset($item->src) }}" alt="{{ $item->title }}" class="inline-block w-[70px]"/>
                                </a>
                            </div>
                            <div class="nav-item mt-[20px]">
                                <h3 class="text-f18 font-bold mb-[10px] text-white">
                                    <a href="{{ (!empty($item->link))?$item->link:'javascript:void(0)' }}">{{ $item->title }}</a>
                                </h3>
                                <p class="desc-1 text-f14 text-white">{{ $item->description }} </p>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="Services-home wow fadeInUp py-[30px] md:py-[70px] relative bg-gray-50">
        <div class="container mx-auto px-3">
            <h2 class="title-primary uppercase text-green text-f20 md:text-f30 font-bold text-center leading-[30px] md:leading-[40px] relative pb-[20px]">
                {{ $detail->title }}
            </h2>
            @if( !empty($data) && count($data) )
            <div class="slider-services owl-carousel mt-[30px] pb-[30px]">
                @foreach( $data as $item )
                <div class="item text-center">
                    <div class="img hover-zoom">
                        <a href="{{ route('routerURL', ['slug' => $item->slug]) }}"><img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full object-cover"/></a>
                    </div>
                    <div class="mt-[15px]">
                        <h3 class="text-f15 font-bold">
                            <a href="{{ route('routerURL', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                        </h3>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <section class="info-home info-home-2 wow fadeInUp py-[30px] md:py-[60px]">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-between mx-[-15px] items-center">

                <div class="w-full md:w-1/2 px-[15px]">
                    <div class="top-home-left mb-[15px] md:mb-0">

                        <h2 class="text-green text-f20 md:text-f25 font-bold leading-[30px] md:leading-[40px] relative pb-[10px]">
                            {{ $fcSystem['services_5'] }}
                        </h2>
                        <div class="text-f15 leading-[25px] mt-[10px] md:mt-[15px]">
                            <div class="content-content">
                                {!! $fcSystem['services_7'] !!}

                                <a href="javascript:void(0)" class="openPopup moreless-button readmore text-f14 cursor-pointer inline-block border border-green py-[10px] px-[25px] uppercase text-f15 rounded-[5px] mt-[10px] md:mt-[20px] transition-all bg-color_primary text-white hover:bg-color_second hover:text-white"
                                >Đăng ký dùng thử ngay<i
                                            class="fa-solid fa-angles-right text-f11 ml-[5px]"
                                    ></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="w-full md:w-1/2 px-[15px]">
                    <div class="info-home-right hover-zoom">
                        <img src="{{ asset($fcSystem['services_6']) }}" alt="{{ $fcSystem['services_5'] }}" class="w-full"/>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="icon-box icon-box-2  py-[20px] wow fadeInUp bg-color_primary">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-start mx-[-15px]">
                <div class="w-full md:w-1/3 px-[15px]">
                    <div class="item text-center py-[10px] px-[15px] relative overflow-hidden mb-[10px] lg:mb-0">
                        <div class="nav-item ">
                            <h3 class="text-f20 font-bold mb-[10px] text-white">
                                Email
                            </h3>
                            <p class="desc-1 text-f16 text-white"><a href="mailto:{{ $fcSystem['contact_email'] }}">{{ $fcSystem['contact_email'] }}</a></p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-[15px]">
                    <div class="item text-center py-[10px] px-[15px] relative overflow-hidden mb-[10px] lg:mb-0">
                        <div class="nav-item ">
                            <h3 class="text-f20 font-bold mb-[10px] text-white">
                                Tư vấn dịch vụ(24/7)
                            </h3>
                            <p class="desc-1 text-f16 text-white"><a href="tel:{{ $fcSystem['contact_hotline'] }}">{{ $fcSystem['contact_hotline'] }}</a></p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-[15px]">
                    <div class="item text-center py-[10px] px-[15px] relative overflow-hidden mb-[10px] lg:mb-0">
                        <div class="nav-item ">
                            <h3 class="text-f20 font-bold mb-[10px] text-white">
                                Hỗ trợ kỹ thuật
                            </h3>
                            <p class="desc-1 text-f16 text-white"><a href="tel:{{ $fcSystem['contact_hotline'] }}">{{ $fcSystem['contact_hotline'] }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if( !empty($service) && count($service->posts) > 0 )
    <section class="difference-section py-[30px] md:py-[70px] wow fadeInUp">
        <div class="container mx-auto px-3">
            <h2 class="title-primary uppercase text-green text-f20 md:text-f30 font-bold text-center leading-[30px] md:leading-[40px] relative pb-[20px]">
                {{ $service->title }}
            </h2>
            <div class="nav-difference-section mt-[20px] md:mt-[40px]">
                <div class="flex flex-wrap justify-between mx-[-15px]">
                    @foreach( $service->posts as $item )
                    <div class="w-full md:w-1/2 px-[15px]">
                        <div class="item text-center border border-gray-100 shadow-md rounded-[10px] overflow-hidden mb-[10px] md:mb-0">
                            <h3 class="text-f20 font-bold border border-color_primary p-[10px] bg-color_primary text-white">{{ $item->title }}</h3>
                            <div class="nav-item p-[20px]">
                                <div class="desc">
                                    {!! $item->description !!}
                                </div>
                                <div class="img mt-[10px]">
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    @if( !empty($step) && count($step->slides) > 0 )
    <section class="procedure-section pb-[50px] wow fadeInUp">
        <div class="container mx-auto px-3">
            <h2 class="title-primary uppercase text-green text-f20 md:text-f30 font-bold text-center leading-[30px] md:leading-[40px] relative pb-[20px]">
                {{ $step->title }}
            </h2>
            <div class="flex flex-wrap justify-start mx-[-10px] mt-[20px] md:mt-[30px]">
                @foreach( $step->slides as $item )
                    <div class="w-full md:w-1/3 px-[10px]">
                        <div class="item mb-[10px] md:mb-[15px]">
                            <a href="{{ !empty($item->link)?$item->link:'javascript:void(0)' }}"><img src="{{ asset($item->src) }}" alt="{{ $item->title }}" class="w-full"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif


</div>
@endsection