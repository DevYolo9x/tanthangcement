@extends('homepage.layout.home')
@section('content')
    {!!htmlBreadcrumb($seo['meta_title'])!!}

    <div id="main" class="sitemap main-product">
        <div class="content-main-new pt-0 md:pt-[20px]" id="scrollTop">
            <h1 class="title-primary text-center text-f28 uppercase font-bold">
                {{$seo['meta_title']}}
            </h1>
            <div class="content-content-product pt-[30px]">
                <div class=" mx-auto">
                    <div class="flex flex-wrap justify-start" id="js_data_product_filter">
                        @if(!empty($data) && count($data) > 0)
                            @foreach($data as $key=>$item)
                                <div class="w-1/2 md:w-1/4 px-[5px] md:px-[2px] box_wishlist_<?php echo $item->id?>">
                                    <?php echo htmlItemProduct($key, $item, 'item item-product mb-[15px] md:mb-[30px]') ?>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('javascript')
        <style>
            select {
                -webkit-appearance: none;
                -moz-appearance: none;
                text-indent: 1px;
                text-overflow: '';
            }
        </style>
    @endpush
@endsection
