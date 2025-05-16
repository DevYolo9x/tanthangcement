@extends('homepage.layout.home')
@section('content')
<div id="main" class="sitemap main-table">
    {!!htmlBreadcrumb($page->title, [])!!}
    <div class="content-table py-[30px] md:py-[60px] wow fadeInUp ">
        <div class="container mx-auto px-3">
            <h2 class="title-primary uppercase text-green text-f20 md:text-f30 font-bold text-center leading-[30px] md:leading-[40px] relative pb-[20px]">
                {{ $page->title }}
            </h2>
            <?php $data = getDataJson( $page->fields, 'config_colums_json_tableprice_data' ); //dd($data);  ?>
            @if( !empty($data->title) && count( $data->title ) > 0 )
            <div class="flex flex-wrap justify-start mx-[-15px] mt-[15px] md:mt-[30px]">
                @foreach( $data->title as $key => $item )
                <div class="w-full md:w-1/3 px-[15px] mb-5">
                    <div class="item text-center rounded-[10px] overflow-hidden shadow-md mb-[10px] md:mb-0">
                        <div class="item-icon bg-[#ed2c41] px-[10px] py-[20px]">
                            <div class="icon w-[80px] h-[80px] leading-[80px] text-f30 text-white border-[2px] border-white rounded-full inline-block">
                                <i class="fa-solid fa-bullseye"></i></div>
                            <h3 class="text-f20 md:text-f30 font-bold text-white mt-[10px] md:mt-[20px]">{{ $item }}</h3>
                            <p class="price text-f18 text-white mt-[10px]">{{ $data->price[$key] }}</p>
                        </div>
                        <div class="nav-item p-[15px] md:p-[50px] ">
                            <div class="desc">
                                {!! $data->desc[$key] !!}
                            </div>
                            <a href="javascript:void(0)" class="openPopup moreless-button mt-[10px] readmore text-f14 cursor-pointer inline-block border border-green py-[10px] px-[25px] uppercase text-f15 rounded-[25px] transition-all bg-color_primary text-white hover:bg-color_second hover:text-white">Đăng
                                ký<i class="fa-solid fa-angles-right text-f11 ml-[5px]"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    <!-- start: box 2 -->

    @include('homepage.common.slideService')

    <!-- end: box 2 -->
    <section class="table-table py-[30px] md:py-[60px] wow fadeInUp ">
        <div class="container mx-auto px-3">
            {!! $page->description !!}
        </div>
    </section>

</div>
@endsection