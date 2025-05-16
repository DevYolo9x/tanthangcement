<?php $services = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'services'])->with('slides')->first(); ?>
@if( $services && count($services->slides) )
    <section class="Services-home wow fadeInUp py-[30px] md:py-[70px] relative bg-gray-50">
        <div class="container mx-auto px-3">
            <h2 class="title-primary uppercase text-green text-f20 md:text-f30 font-bold text-center leading-[30px] md:leading-[40px] relative pb-[20px]">
                {{ $services->title }}
            </h2>
            <div class="slider-services owl-carousel mt-[30px] pb-[30px]">
                @foreach( $services->slides as $item )
                    <div class="item text-center">
                        <div class="img hover-zoom">
                            <a href="{{ !empty($item->link)?$item->link:'javascript:void(0)' }}"><img src="{{ asset($item->src) }}" alt="{{ $item->title }}" class="w-full object-cover"/></a>
                        </div>
                        <div class="mt-[15px]">
                            <h3 class="text-f15 font-bold">
                                <a href="{{ !empty($item->link)?$item->link:'javascript:void(0)' }}">{{ $item->title }}</a>
                            </h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif