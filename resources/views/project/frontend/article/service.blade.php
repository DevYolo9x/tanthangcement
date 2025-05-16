@extends('homepage.layout.home')
@section('content')
<?php $menu_aside = getMenus('menu-service'); ?>
<div id="main" class="sitemap main-services-detail">
    {!!htmlBreadcrumb($detail->title, $breadcrumb)!!}
    <div class="content-product py-[30px] md:py-[50px]">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-between mx-[-15px]">
                <div class="w-full md:w-4/12 px-[15px] order-2 md:order-1">
                    <aside class="sidebar mt-[15px] md:mt-0">
                        @if( !empty($menu_aside->menu_items) && count($menu_aside->menu_items) > 0 )
                        <div class="item-sidebar mb-[10px] md:mb-[20px] bg-[#F0F3FA] p-[10px] md:p-[30px] rounded-[10px]">
                            <h3 class="title-wd mb-[20px] text-f20  font-bold">
                                {{ $menu_aside->menu_items->first()->title }}
                            </h3>
                            <div class="nav-item-sidebar">
                                <ul class="border border-gray-100">
                                    @foreach( $menu_aside->menu_items->first()->children as $item )
                                    <li class="border-b border-gray-100 mb-[10px] md:mb-[15px]">
                                        <a href="{{ url($item->slug) }}" class="hover:opacity-80 transition-all bg-white inline-block w-full py-[10px] px-[10px] rounded-[5px] hover:bg-color_primary hover:text-white">
                                            {{ $item->title }}
                                            <i class="fa-solid fa-right-long float-right mt-[3px] text-f14"></i>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                    </aside>
                </div>
                <div class="w-full md:w-8/12 px-[15px] order-1 md:order-2">
                    <div class="content-content">
                        <h1 class="text-f20 md:text-f25 font-bold">
                            {{ $detail->title }}
                        </h1>
                        <p class="date text-gray-500 mt-[10px]">
                            Ngày đăng: {{ date('d/m/Y', strtotime($detail->created_at)) }}
                        </p>
                        <div class="nav-content-content content_content">
                            {!! $detail->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection