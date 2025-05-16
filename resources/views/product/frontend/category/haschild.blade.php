@extends('homepage.layout.home')
@section('content')
{{-- Product Parent --}}
<div id="main" class="sitemap main-category-product ">
    {!!htmlBreadcrumb($detail->title, $breadcrumb)!!}
    @if( !empty($data_child) && count($data_child) > 0 )
    <div class="content-product py-[30px] md:py-[50px]">
        <div class="container mx-auto px-3">
            @foreach( $data_child as $item )
            <div class="box-item-product mb-[20px] md:mb-[30px]">
                <div class="title-title border-b border-gray-200 pb-[10px]">
                    <div class="flex flex-wrap justify-between mx-[-10px] items-center">
                        <div class="w-full md:w-2/3 px-[10px]">
                            <h2 class="text-f20 md:text-f23 font-bold"><a href="{{ route('routerURL', ['slug' => $item->slug]) }}">{{ $item->title }}</a></h2>
                        </div>
                        <div class="hidden md:block w-1/3 px-[10px]">
                            <a href="{{ route('routerURL', ['slug' => $item->slug]) }}"
                               class="readmore uppercase text-f15 float-right text-color_primary transition-all hover:text-color_second">Xem
                                tất cả <i class="fa-solid fa-angle-right text-f12"></i></a>
                        </div>
                    </div>
                </div>
                @if( !empty($item->data) && count($item->data) > 0 )
                <div class="nav-item-product mt-[30px]">
                    <div class="flex flex-wrap justify-start mx-[-10px]">
                        @foreach( $item->data as $itemC )
                        <div class="w-1/2 md:w-1/4 px-[10px]">
                            {!! htmlItemProduct($itemC) !!}
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection