<div id="home-services" class="wow fadeInDown">
    <div class="">
        <div class="py-8 bg-[#F2F2F7]">
            <div class="container px-[15px] mx-auto">
                <div class="">
                    <div class="mb-3 px-4 sm:mb-16 sm:px-0 text-center">
                        <p class="font-[500] leading-[120%] mb-1 sm:font-[600] sm:mb-3 text-3xl">
                            {{ $item->title }}</p>
                        <div class="font-[400] text-[16px] my-4">{!! $item->description !!}</div>
                    </div>
                    <section class="embla__services">
                        <div class="embla__viewport__services swiper-container">
                            <div class="embla__container__services swiper-wrapper">
                                @foreach ($item->products as $product)
                                    <div class="swiper-slide embla__slide__services">
                                        <a class="text-[#090806] no-underline"
                                           href="{{ route('routerURL', ['slug' => $product->slug]) }}">
                                            <div class="relative">
                                                <div class="md:h-[500px] item"
                                                     style="background-color: var(--primary-color); color: white; clip-path: polygon(100% 6.4%, 100% 6.4%, 99.906% 5.362%, 99.634% 4.377%, 99.199% 3.459%, 98.616% 2.62%, 97.899% 1.875%, 97.062% 1.235%, 96.122% 0.714%, 95.093% 0.326%, 93.989% 0.084%, 92.825% 0%, 7.175% 0%, 7.175% 0%, 6.011% 0.084%, 4.907% 0.326%, 3.878% 0.714%, 2.937% 1.235%, 2.101% 1.875%, 1.384% 2.62%, 0.801% 3.459%, 0.366% 4.377%, 0.094% 5.362%, 0% 6.4%, 0% 93.6%, 0% 93.6%, 0.094% 94.638%, 0.366% 95.623%, 0.801% 96.541%, 1.384% 97.38%, 2.101% 98.125%, 2.937% 98.765%, 3.878% 99.286%, 4.907% 99.674%, 6.011% 99.916%, 7.175% 100%, 50.516% 100%, 50.516% 100%, 51.071% 99.981%, 51.619% 99.924%, 52.159% 99.83%, 52.687% 99.7%, 53.202% 99.534%, 53.702% 99.334%, 54.183% 99.101%, 54.645% 98.834%, 55.084% 98.535%, 55.498% 98.205%, 65.5% 89.595%, 65.5% 89.595%, 65.915% 89.265%, 66.354% 88.966%, 66.815% 88.699%, 67.297% 88.466%, 67.796% 88.266%, 68.311% 88.1%, 68.84% 87.97%, 69.379% 87.876%, 69.928% 87.819%, 70.483% 87.8%, 92.825% 87.8%, 92.825% 87.8%, 93.989% 87.716%, 95.093% 87.474%, 96.122% 87.086%, 97.062% 86.565%, 97.899% 85.925%, 98.616% 85.18%, 99.199% 84.341%, 99.634% 83.423%, 99.906% 82.438%, 100% 81.4%, 100% 6.4%);">
                                                    <img alt="{{ $product->title }}"
                                                         class="object-cover h-[315px] sm:h-[315px]"
                                                         src="{{ asset(!empty($product->image) ? $product->image : 'images/404.png') }}"
                                                         style="color: transparent;">
                                                    <div class="md:p-6 px-5 pt-5 pb-10">
                                                        <p class="text-lg font-semibold">
                                                            {{ $product->title }}</p>
                                                        <p class="text-base font-normal mt-5"
                                                           style="
                                                                    overflow: hidden;
                                                                    text-overflow: ellipsis;
                                                                    -webkit-box-orient: vertical;
                                                                    -webkit-line-clamp: 2;
                                                                    display: -webkit-box;
                                                                ">
                                                            {!! $product->description !!}</p>
                                                    </div>
                                                </div>
                                                <button
                                                        class="absolute bg-[#FFF] border bottom-0 disabled:bg-[#CECECD] disabled:pointer-events-none focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring gap-2 h-[48px] hover:bg-[#00568f] hover:text-white inline-flex items-center justify-center max-md:px-5 max-w-[120px] min-h-12 my-auto overflow-hidden px-6 py-3 right-0 rounded-full self-stretch sm:max-w-[142px] text-[16px] text-black transition-colors whitespace-nowrap">
                                                    <p class="leading-[150%] mb-0 text-base">Xem chi tiết
                                                    </p>
                                                </button>
                                            </div>
                                        </a>
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
                        <div class="embla__controls__services !flex !items-center !justify-center">
                            <div class="embla__dots__services"><button type="button"
                                                                       class="embla__dot__services embla__dot__services--selected"></button><button
                                        type="button" class="embla__dot__services"></button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>