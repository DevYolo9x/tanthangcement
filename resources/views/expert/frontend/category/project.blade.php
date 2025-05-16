@extends('homepage.layout.home')
@section('content')
<div id="main" class="sitemap main-new">
    {!!htmlBreadcrumb($detail->title, $breadcrumb)!!}
    <div class="content-new-page py-[30px] md:py-[50px]">
        <div class="container mx-auto px-3">
            <div class="section-title text-center">
                <h1 class="title-primary uppercase text-green text-f20 md:text-f30 font-medium text-center leading-[30px] md:leading-[40px] relative pb-[20px]">
                    {{ $detail->title }}
                </h1>
            </div>
            @if($data)
                <div class="flex flex-wrap justify-start mx-[-15px] mt-10">
                    @foreach ($data as $k => $vC)
                    <div class="w-1/2 lg:w-1/2 xl:w-1/2 xl:px-[15px] px-[10px]">
                        <div class="item mt-3">
                            <div
                                class="group box-shadow-custom border border-gray-100 item mb-[10px] md:mb-[30px] relative shadow hover:transform hover:translate-y-[-10px] transition duration-300 ease-in-out">
                                <div class="img hover-zoom">
                                    <a href="{{ route('routerURL', ['slug', $vC->slug]) }}">
                                        <img src="{{ asset($vC->image) }}"
                                            class="w-full h-175px md:h-350px object-cover" alt="">
                                    </a>
                                </div>
                                <div
                                    class=" bg-white bottom-0 duration-300 ease-in-out group-hover:bg-color_hover group-hover:text-white last:border-00 md:px-3 md:py-3 md:text-center pb-2 px-2 text-black transition">
                                    <h3 class="my-3"><a href="{{ route('routerURL', ['slug', $vC->slug]) }}" class="font-medium text-f18 text-left" style="
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        -webkit-line-clamp: 2;
                                        -webkit-box-orient: vertical;
                                        display: -webkit-box;
                                    ">{{ $vC->title }}</a></h3>
                                    <div
                                        class="xl:flex xl:flex-wrap justify-start mx-[-15px] mt-[15px] md:mt-[30px] items-center">
                                        <div class="w-full xl:w-3/4 px-[15px]">
                                            <div class="text-left"
                                                style="
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        -webkit-line-clamp: 3;
                                        -webkit-box-orient: vertical;
                                        display: -webkit-box;
                                    ">{!! $vC->description !!}</div>
                                        </div>
                                        <div
                                            class="mb-4 mt-5 px-[15px] md:text-center text-left w-full xl:mb-0 xl:mt-0 xl:text-right xl:w-1/4">
                                            <a href="{{ route('routerURL', ['slug', $vC->slug]) }}"
                                                class="border border-black btn-readmore group-hover:border-white header-22 px-3 md:py-2 py-1.5 rounded-[30px]">Xem
                                                thêm <i class="fas fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="pagenavi wow fadeInUp mt-[20px]">
                    <?php echo $data->links() ?>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection