@extends('homepage.layout.home')
@section('content')

    <?php
    $homeBanner = getDataJson($page->fields, 'config_colums_json_home_banner_data');
    $homeBannerLink = getDataJson($page->fields, 'config_colums_json_homepage_link_banner');
    
    //
    $homeAbout = getDataJson($page->fields, 'config_colums_json_homepage_about_data');
    ?>
    @if (isset($homeBanner->image))
        @foreach ($homeBanner->image as $k => $image)
            <div id="home-banner">
                <div class="wow fadeInDown"
                    style="opacity: 1; transform: none; visibility: visible; animation-name: fadeInDown;">
                    <div id="banner-section" class="bg-center bg-cover flex h-[85vh] items-center justify-center sm:h-screen"
                        style="background-image: url({{ asset($image) }})">
                        <div class="flex flex-col items-center justify-between mb-[30%] sm:justify-start sm:mb-0">
                            <div>
                                <p
                                    class="font-bold font-tektur leading-[120%] sm:mb-6 sm:text-[36px] text-center text-white main-tite">
                                    {{ $homeBanner->title[$k] }}</p>
                                <p
                                    class="text-center text-white text-[16px] sm:text-[24px] sm:leading-[32px] mb-[48px] max-w-[370px] sm:max-w-full">
                                    {{ $homeBanner->desc[$k] }}</p>
                            </div>
                            <div
                                class="flex sm:flex-row flex-col sm:gap-x-6 w-full sm:w-auto gap-y-4 sm:gap-y-0 px-5 sm:px-0 ">
                                @if (isset($homeBannerLink->title))
                                    @foreach ($homeBannerLink->title as $k => $title)
                                        @if ($k == 0)
                                            <a href="{{ $homeBannerLink->link[$k] }}">
                                                <button
                                                    class="bg-color_primary disabled:bg-[#CECECD] disabled:pointer-events-none focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring font-[500] h-[48px] hover:text-white inline-flex items-center justify-center px-[40px] py-[12px] rounded-full text-[16px] text-white transition-colors w-full whitespace-nowrap">
                                                    {{ $title }}
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ $homeBannerLink->link[$k] }}">
                                                <button
                                                    class="bg-[#fff] border border-[#1D1B2029] disabled:bg-[#CECECD] disabled:pointer-events-none focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring font-[500] h-[48px] hover:bg-color_primary hover:text-black hover:text-white inline-flex items-center justify-center px-[40px] py-[12px] rounded-full text-[#090806] text-[16px] transition-colors w-full whitespace-nowrap">
                                                    {{ $title }}
                                                </button>
                                            </a>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if (isset($homeAbout->image))
        @foreach ($homeAbout->image as $k => $item)
            <div id="home-about" class="wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">
                <section class="py-12 relative">
                    <div class="container px-[15px] mx-auto w-full">
                        <div class="w-full justify-start items-center xl:gap-12 gap-8 grid lg:grid-cols-2 grid-cols-1">
                            <div class="w-full flex-col justify-center lg:items-start items-center gap-4 inline-flex">
                                <div class="w-full flex-col justify-center items-start gap-8 flex">
                                    <div class="flex flex-col gap-1 items-center justify-start lg:items-start">
                                        <h6 class=" text-base font-normal leading-relaxed">{{ $homeAbout->title_small[$k] }} <span class="line-line"></span>
                                        </h6>
                                        <div
                                            class="flex flex-col gap-1 items-center justify-start lg:items-start w-full description">
                                            <h2 class="my-2 text-2xl font-semibold">{{ $homeAbout->title[$k] }}</h2>
                                            <div class="description">
                                                {!! $homeAbout->desc[$k] !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (!empty($homeAbout->link[$k]))
                                    <a class="text-[#090806] no-underline" href="{{ $homeAbout->link[$k] }}">
                                        <button
                                            class="group bg-[#FFF] border border-[#5c5c5c] disabled:bg-[#CECECD] disabled:pointer-events-none focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring font-[500] hover:bg-color_primary hover:text-white inline-flex items-center justify-center px-[20px] py-2 rounded-full shadow-none text-[#090806] transition-colors whitespace-nowrap">
                                            Xem chi tiết
                                            <svg class="transition-all duration-700 ease-in-out text-black group-hover:text-white ml-2"
                                                xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 18 18" fill="none">
                                                <path d="M6.75265 4.49658L11.2528 8.99677L6.75 13.4996"
                                                    stroke="currentColor" stroke-width="1.6" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </a>
                                @endif
                            </div>
                            <div class="w-full justify-center items-start flex">
                                <div
                                    class="sm:w-[564px] w-full sm:h-[646px] h-full sm:bg-gray-100 rounded-3xl sm:border border-gray-200 relative">
                                    <img class="sm:mt-5 sm:ml-5 w-full h-full rounded-3xl object-cover about-banner"
                                        src="{{ asset($item) }}" alt="{{ $homeAbout->title[$k] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    @endif

    @if (isset($homeProducts))
        @foreach ($homeProducts as $k => $item)
            @if ($item->view_home == 0)
                @include('homepage.home.view_product.layout1', ['item' => $item])
            @elseif ($item->view_home == 1)
                @include('homepage.home.view_product.layout2', ['item' => $item])
            @elseif($item->view_home == 2)
                @include('homepage.home.view_product.layout3', ['item' => $item])
            @endif
        @endforeach
    @endif

    @if (isset($homeNews))
        @foreach ($homeNews as $k => $item)
            <div id="home-news" class="wow fadeInDown">
                <div class="container px-[15px] mx-auto">
                    <p class="font-[500] leading-[120%] mb-1 sm:font-[600] sm:mb-3 text-3xl text-center mt-10">
                        {{ $item->title }}</p>
                    <div class="mt-12 relative sm:my-10">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($item->posts as $post)
                                    <?php
                                    $img = !empty($post->image) ? asset($post->image) : asset('images/404.png');
                                    ?>
                                    <div class="swiper-slide w-full">
                                        <div class="border p-5 pt-10 pb-6">
                                            <div class="border-b mb-5 flex justify-between text-sm">
                                                <div class="border-b-2 flex items-center pb-2 pr-2 uppercase">
                                                    <svg class="h-6 mr-3"id=Capa_1
                                                        style="enable-background:new 0 0 455.005 455.005"version=1.1
                                                        viewBox="0 0 455.005 455.005"x=0px xml:space=preserve
                                                        xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink
                                                        y=0px>
                                                        <g>
                                                            <path d="M446.158,267.615c-5.622-3.103-12.756-2.421-19.574,1.871l-125.947,79.309c-3.505,2.208-4.557,6.838-2.35,10.343
                                                            c2.208,3.505,6.838,4.557,10.343,2.35l125.947-79.309c2.66-1.675,4.116-1.552,4.331-1.432c0.218,0.12,1.096,1.285,1.096,4.428
                                                            c0,8.449-6.271,19.809-13.42,24.311l-122.099,76.885c-6.492,4.088-12.427,5.212-16.284,3.084c-3.856-2.129-6.067-7.75-6.067-15.423
                                                            c0-19.438,13.896-44.61,30.345-54.967l139.023-87.542c2.181-1.373,3.503-3.77,3.503-6.347s-1.323-4.974-3.503-6.347L184.368,50.615
                                                            c-2.442-1.538-5.551-1.538-7.993,0L35.66,139.223C15.664,151.815,0,180.188,0,203.818v4c0,23.63,15.664,52.004,35.66,64.595
                                                            l209.292,131.791c3.505,2.207,8.136,1.154,10.343-2.35c2.207-3.505,1.155-8.136-2.35-10.343L43.653,259.72
                                                            C28.121,249.941,15,226.172,15,207.818v-4c0-18.354,13.121-42.122,28.653-51.902l136.718-86.091l253.059,159.35l-128.944,81.196
                                                            c-20.945,13.189-37.352,42.909-37.352,67.661c0,13.495,4.907,23.636,13.818,28.555c3.579,1.976,7.526,2.956,11.709,2.956
                                                            c6.231,0,12.985-2.176,19.817-6.479l122.099-76.885c11.455-7.213,20.427-23.467,20.427-37.004
                                                            C455.004,277.119,451.78,270.719,446.158,267.615z" />
                                                            <path d="M353.664,232.676c2.492,0,4.928-1.241,6.354-3.504c2.207-3.505,1.155-8.136-2.35-10.343l-173.3-109.126
                                                            c-3.506-2.207-8.136-1.154-10.343,2.35c-2.207,3.505-1.155,8.136,2.35,10.343l173.3,109.126
                                                            C350.916,232.303,352.298,232.676,353.664,232.676z" />
                                                            <path d="M323.68,252.58c2.497,0,4.938-1.246,6.361-3.517c2.201-3.509,1.14-8.138-2.37-10.338L254.46,192.82
                                                            c-3.511-2.202-8.139-1.139-10.338,2.37c-2.201,3.51-1.14,8.138,2.37,10.338l73.211,45.905
                                                            C320.941,252.21,322.318,252.58,323.68,252.58z" />
                                                            <path
                                                                d="M223.903,212.559c-3.513-2.194-8.14-1.124-10.334,2.39c-2.194,3.514-1.124,8.14,2.39,10.334l73.773,46.062
                                                            c1.236,0.771,2.608,1.139,3.965,1.139c2.501,0,4.947-1.251,6.369-3.529c2.194-3.514,1.124-8.14-2.39-10.334L223.903,212.559z" />
                                                            <path
                                                                d="M145.209,129.33l-62.33,39.254c-2.187,1.377-3.511,3.783-3.503,6.368s1.345,4.983,3.54,6.348l74.335,46.219
                                                            c1.213,0.754,2.586,1.131,3.96,1.131c1.417,0,2.833-0.401,4.071-1.201l16.556-10.7c3.479-2.249,4.476-6.891,2.228-10.37
                                                            c-2.248-3.479-6.891-4.475-10.37-2.228l-12.562,8.119l-60.119-37.38l48.2-30.355l59.244,37.147l-6.907,4.464
                                                            c-3.479,2.249-4.476,6.891-2.228,10.37c2.249,3.479,6.894,4.476,10.37,2.228l16.8-10.859c2.153-1.392,3.446-3.787,3.429-6.351
                                                            c-0.018-2.563-1.344-4.94-3.516-6.302l-73.218-45.909C150.749,127.792,147.647,127.795,145.209,129.33z" />
                                                            <path d="M270.089,288.846c2.187-3.518,1.109-8.142-2.409-10.329l-74.337-46.221c-3.518-2.188-8.143-1.109-10.329,2.409
                                                            c-2.187,3.518-1.109,8.142,2.409,10.329l74.337,46.221c1.232,0.767,2.601,1.132,3.953,1.132
                                                            C266.219,292.387,268.669,291.131,270.089,288.846z" />
                                                            <path d="M53.527,192.864c-2.187,3.518-1.109,8.142,2.409,10.329l183.478,114.081c1.232,0.767,2.601,1.132,3.953,1.132
                                                            c2.506,0,4.956-1.256,6.376-3.541c2.187-3.518,1.109-8.142-2.409-10.329L63.856,190.455
                                                            C60.338,188.266,55.714,189.346,53.527,192.864z" />
                                                        </g>
                                                    </svg>
                                                    <a href="{{ route('routerURL', ['slug' => $item->slug]) }}"
                                                        class="font-semibold inline-block">{{ $item->title }}</a>
                                                </div>
                                                <a href="{{ route('routerURL', ['slug' => $item->slug]) }}">Xem thêm</a>
                                            </div>
                                            <div class="mb-5 pb-5 w-full border-b">
                                                <a href="{{ route('routerURL', ['slug' => $post->slug]) }}">
                                                    <div class="h-56 bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
                                                        style="background-image: url('{{ $img }}')"
                                                        title="{{ $post->title }}" >
                                                    </div>
                                                </a>
                                                <div
                                                    class="mt-3 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                                                    <div class="">
                                                        <a href="{{ route('routerURL', ['slug' => $post->slug]) }}"
                                                            class="duration-500 ease-in-out font-bold hover:text-indigo-600 leading-[1.1] mb-2 text-gray-900 text-lg transition" style="overflow: hidden;text-overflow: ellipsis;
                                                            -webkit-box-orient: vertical;
                                                            -webkit-line-clamp: 2;line-height: 23px;height: 46px;
                                                            display: -webkit-box;">{{ $post->title }}</a>
                                                        <div class="text-gray-700 text-f15 mt-2"
                                                            style="overflow: hidden;text-overflow: ellipsis;
                                                            -webkit-box-orient: vertical;
                                                            -webkit-line-clamp: 3;
                                                            display: -webkit-box;">
                                                            {!! $post->description !!}</div>
                                                    </div>
                                                </div>
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
        @endforeach
    @endif


    @if( isset($slideFeedback) )
        <div id="home-testimonial" class="wow fadeInDown">
            <div class="container px-[15px] mx-auto">
                <div class="body-font pb-10">
                    <p class="font-[500] leading-[120%] mb-1 sm:font-[600] sm:mb-3 text-3xl text-center mt-10">{{ $slideFeedback->title }}</p>
                    <div class="flex flex-wrap mt-8 text-gray-600">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ( $slideFeedback->slides as $slide )
                                    <div class="swiper-slide w-full">
                                        <div class="h-full bg-gray-100 p-8 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                                                <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z"></path>
                                            </svg>
                                            <p class="leading-relaxed">{{ $slide->description }}</p>
                                            <p class="flex mb-5 mt-4 star">
                                                <svg height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 47.94 47.94" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#ED8A19;" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757 c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042 c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685 c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528 c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956 C22.602,0.567,25.338,0.567,26.285,2.486z"></path> </g></svg>
                                                <svg height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 47.94 47.94" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#ED8A19;" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757 c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042 c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685 c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528 c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956 C22.602,0.567,25.338,0.567,26.285,2.486z"></path> </g></svg>
                                                <svg height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 47.94 47.94" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#ED8A19;" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757 c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042 c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685 c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528 c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956 C22.602,0.567,25.338,0.567,26.285,2.486z"></path> </g></svg>
                                                <svg height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 47.94 47.94" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#ED8A19;" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757 c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042 c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685 c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528 c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956 C22.602,0.567,25.338,0.567,26.285,2.486z"></path> </g></svg>
                                                <svg height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 47.94 47.94" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#ED8A19;" d="M26.285,2.486l5.407,10.956c0.376,0.762,1.103,1.29,1.944,1.412l12.091,1.757 c2.118,0.308,2.963,2.91,1.431,4.403l-8.749,8.528c-0.608,0.593-0.886,1.448-0.742,2.285l2.065,12.042 c0.362,2.109-1.852,3.717-3.746,2.722l-10.814-5.685c-0.752-0.395-1.651-0.395-2.403,0l-10.814,5.685 c-1.894,0.996-4.108-0.613-3.746-2.722l2.065-12.042c0.144-0.837-0.134-1.692-0.742-2.285l-8.749-8.528 c-1.532-1.494-0.687-4.096,1.431-4.403l12.091-1.757c0.841-0.122,1.568-0.65,1.944-1.412l5.407-10.956 C22.602,0.567,25.338,0.567,26.285,2.486z"></path> </g></svg>
                                            </p>
                                            <a class="inline-flex items-center">
                                                <img alt="{{ $slide->title }}" src="{{ ($slide->src) }}" class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                                                <span class="flex-grow flex flex-col pl-4">
                                                    <span class="title-font font-medium text-gray-900">{{ $slide->title }}</span>
                                                </span>
                                            </a>
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
    @endif

@endsection

@push('css')
@endpush

@push('javascript')
    <script>
        // Dịch vụ - services
        var swiperCertification = new Swiper("#home-services .swiper-container", {
            loop: true,
            pagination: {
                el: "#home-services .swiper-pagination",
                clickable: true
            },
            spaceBetween: 20,
            navigation: {
                nextEl: '#home-services .swiper-button-next',
                prevEl: '#home-services .swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });

        // Thuê - rent
        var swiperCertification = new Swiper("#home-rents .swiper-container", {
            loop: true,
            pagination: {
                el: "#home-rents .swiper-pagination",
                clickable: true
            },
            centeredSlides: true,
            spaceBetween: 20,
            navigation: {
                nextEl: '#home-rents .swiper-button-next',
                prevEl: '#home-rents .swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });

        // Đám cưới - wedding
        var swiperCertification = new Swiper("#home-wedding .swiper-container", {
            loop: true,
            pagination: {
                el: "#home-wedding .swiper-pagination",
                clickable: true
            },
            centeredSlides: true,
            spaceBetween: 20,
            navigation: {
                nextEl: '#home-wedding .swiper-button-next',
                prevEl: '#home-wedding .swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });
        
        // Đám cưới - wedding
        var swiperCertification = new Swiper("#home-testimonial .swiper-container", {
            loop: true,
            pagination: {
                el: "#home-testimonial .swiper-pagination",
                clickable: true
            },
            spaceBetween: 20,
            navigation: {
                nextEl: '#home-testimonial .swiper-button-next',
                prevEl: '#home-testimonial .swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 2
                }
            }
        });
        
        // Đám cưới - wedding
        var swiperCertification = new Swiper("#home-news .swiper-container", {
            loop: true,
            pagination: {
                el: "#home-news .swiper-pagination",
                clickable: true
            },
            spaceBetween: 20,
            navigation: {
                nextEl: '#home-news .swiper-button-next',
                prevEl: '#home-news .swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                }
            }
        });

        $(document).on('click', 'a[href^="#"]', function (event) {
            event.preventDefault();

            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top
            }, 500);
        });
    </script>
@endpush
