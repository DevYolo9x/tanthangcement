<div id="home-rents" class="wow fadeInDown">
    <div class="">
        <div class="container px-[15px] mx-auto">
            <div class="">
                <div class="text-center mt-9 mb-8 px-4 sm:px-0">
                    <p class="font-[500] leading-[120%] mb-1 sm:font-[600] sm:mb-3 text-3xl">
                        {{ $item->title }}</p>
                    <div class="font-[400] text-[16px] my-4">{!! $item->description !!}</div>
                    <a class="text-[#090806] no-underline"
                       href="{{ route('routerURL', ['slug' => $item->slug]) }}">
                        <button
                                class="inline-flex items-center justify-center whitespace-nowrap text-[16px] font-[500] transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:bg-[#CECECD] h-[48px] py-[12px] px-[32px] rounded-full text-[#090806] border border-black shadow-none sm:mt-[36px] mt-0 bg-[#FFF] hover:text-white hover:bg-color_primary min-w-[190px]">Xem
                            chi tiết
                        </button>
                    </a>
                </div>
                <div class="sm:block">
                    <div class="embla__scale">
                        <div class="embla__viewport__scale swiper-container">
                            <div class="embla__container__scale swiper-wrapper">
                                @foreach ($item->posts as $product)
                                    <?php
                                    $version = json_decode(base64_decode($product->version_json), true);
                                    $attr = getAttributeByCatColumn($version, 'ishome');
                                    ?>
                                    <div class="embla__slide__scale swiper-slide">
                                        <div class="embla__slide__number__scale"
                                             style="transform: scale(0.85);transition: all 0.4s;">
                                            <div class="relative">
                                                <a class="no-underline"
                                                   href="{{ route('routerURL', ['slug' => $product->slug]) }}">
                                                    <div class="py-10 flex flex-col rounded-[32px] border border-[#CECECD] text-white"
                                                         style="box-shadow: var(--sds-size-depth-0) var(--sds-size-depth-400) var(--sds-size-depth-800) var(--sds-size-depth-negative-200) var(--sds-color-black-400) inset; background: var(--primary-color)">

                                                        <p class="text-[32px] font-medium leading-[120%] mb-4 mt-3 pl-[30px]">
                                                            {{ $product->title }}</p>
                                                        <img alt="{{ $product->title }}"src="{{ asset(!empty($product->image) ? $product->image : 'images/404.png') }}"
                                                             style="color: transparent;">
                                                        @if( isset($attr) && is_array($attr) && count($attr) )
                                                            <div class="grid grid-cols-4 px-6">
                                                                @foreach( $attr as $it )
                                                                    <?php
                                                                    $titles = array_column($it['attr'], 'title');
                                                                    $titleString = implode(', ', $titles);
                                                                    ?>
                                                                    <div class="col-span-2 flex flex-col ">
                                                                        <div class="flex items-center gap-x-1">
                                                                            <img alt="icon" class="icon" src="{{ asset($it['cat']) }}" style="color: transparent;filter: brightness(0) invert(1);width: 17px;">
                                                                            <p class="text-[18px] font-medium leading-[150%] mb-0 desc"> {{ $titleString }}</p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next" tabindex="0" role="button"
                                 aria-label="Next slide" aria-controls="swiper-wrapper-39107fd6245ac39c8">
                            </div>
                            <div class="swiper-button-prev" tabindex="0" role="button"
                                 aria-label="Previous slide"
                                 aria-controls="swiper-wrapper-39107fd6245ac39c8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>