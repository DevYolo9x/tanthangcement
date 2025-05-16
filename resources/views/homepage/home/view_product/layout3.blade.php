<div id="home-wedding" class="bg-[#F2F2F7] fadeInDown mt-16 pb-10 pt-3 wow">
    <div class="">
        <div class="container px-[15px] mx-auto">
            <div class="">
                <div class="text-center mt-9 mb-10 px-4 sm:px-0">
                    <div class="sm:flex sm:items-center sm:justify-center sm:gap-x-2">
                        <p class="font-[500] leading-[120%] mb-1 sm:font-[600] sm:mb-3 text-3xl">
                            {{ $item->title }}</p>
                    </div>
                    <div class="my-4">{!! $item->description !!}
                    </div>
                    <a href="{{ route('routerURL', ['slug' => $item->slug]) }}">
                        <button
                                class="inline-flex items-center justify-center whitespace-nowrap text-[16px] font-[500] transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:bg-[#CECECD] h-[48px] py-[12px] px-[32px] rounded-full text-[#090806] shadow-none sm:mt-[36px] bg-[#FFF] hover:bg-[#07F668] hover:text-[#FFF] min-w-[190px]"
                                disabled="">Xem chi tiết</button>
                    </a>
                </div>
                <div class="sm:block">
                    <div class="embla__scale">
                        <div class="embla__viewport__scale swiper-container">
                            <div class="embla__container__scale swiper-wrapper">
                                @foreach ($item->posts as $product)
                                    <div class="embla__slide__scale swiper-slide">
                                        <div class="embla__slide__number__scale"
                                             style="transform: scale(0.85);transition: all 0.4s;">
                                            <div class="relative">
                                                <a
                                                        href="{{ route('routerURL', ['slug' => $product->slug]) }}">
                                                    <img src="{{ asset(!empty($product->image) ? $product->image : 'images/404.png') }}"
                                                         class="rounded-[32px] w-full h-full"
                                                         alt="{{ $product->title }}"
                                                         style="color: transparent;">
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>