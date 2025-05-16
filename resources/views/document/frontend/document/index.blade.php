@extends('homepage.layout.home')
@section('content')
<main style="display: none">
    {!!htmlBreadcrumb($catalogues->title,$breadcrumb)!!}
    <section class="py-[30px]" id="scrollTop">
        <div class="container px-4 mx-auto" id="loadHtmlAjax">
            <div class="grid grid-cols-1 md:grid-cols-12 -mx-[10px]">
                @include('article.frontend.aside')
                <div class="md:col-span-9 px-[10px] order-0 md:order-1 space-y-5">
                    <div class="space-y-2">
                        <h1 class="font-bold text-xl leading-[1.1]">{{$detail->title}}</h1>
                        <div class="flex items-center space-x-3 text-sm text-[#999]">
                            <span>
                                By <a href="javascript:void(0)">{{$detail->user->name}}</a>
                            </span>
                            <span class="flex items-center space-x-1">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span>
                                    {{$detail->created_at}}
                                </span>
                            </span>
                            <span class="flex items-center space-x-1">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span>
                                    {{$detail->viewed}} lượt xem
                                </span>
                            </span>
                        </div>
                        <div class="box_content">
                            <?php echo $detail->content ?>
                        </div>
                        <?php /*<div class="flex items-center justify-between space-x-8">
                            <div class="w-1/2">
                                @if(!empty($previous))
                                <a href="{{route('routerURL',['slug' => $previous->slug])}}" class="flex items-center space-x-2 hover:text-global">
                                    <span class="border w-[35px] h-[35px] flex items-center justify-center text-lg">
                                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    </span>
                                    <span class="flex-1 clamp font-medium">{{$previous->title}}</span>
                                </a>
                                @endif
                            </div>
                            <div class="w-1/2">
                                @if(!empty($next))
                                <a href="{{route('routerURL',['slug' => $next->slug])}}" class="flex items-center space-x-2 hover:text-global">
                                    <span class="flex-1 clamp font-medium">{{$next->title}}</span>
                                    <span class="border w-[35px] h-[35px] flex items-center justify-center text-lg">
                                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    </span>
                                </a>
                                @endif
                            </div>
                        </div>*/?>
                    </div>
                    @if(!$sameArticle->isEmpty())
                    <div>
                        <h2 class="font-bold text-xl mb-2">Bài viết liên quan</h2>
                        <ul class="list-disc pl-5">
                            @foreach($sameArticle as $k=>$v)
                            <li><a class="hover:text-global" href="{{route('routerURL',['slug' => $v->slug])}}">{{$v->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </section>
</main>

<div id="main" class="sitemap main-new-page-detail pb-[50px]">
    {!!htmlBreadcrumb($detail->title, [])!!}
    <div class="main-content pt-[20px] md:pt-[50px]">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-between mx-[-15px]">
                <div class="w-full md:w-3/4 px-[15px]">
                    <div class="content-content">
                        <h1 class="text-f20 md:text-f25 font-bold">
                            {{ $detail->title }}
                        </h1>
                        <p class="date text-gray-500 mt-[10px]">
                            {{ date('d/m/Y', strtotime($detail->created_at)) }}
                        </p>
                        <div class="nav-content-content content-content">
                            {!!$detail->content!!}
                        </div>
                    </div>
                    @if(!$sameArticle->isEmpty())
                        <div class="other-new pt-[20px] md:pt-[40px]">
                            <h2 class="title-primary pb-[20px] md:pb-[25px] text-center text-f25 md:text-f32 font-bold relative after:content after:absolute after:w-[65px] after:h-[4px] after:bg-color_primary after:bottom-0 after:left-1/2 after:-translate-x-1/2">
                                Bài viết liên quan
                            </h2>
                            <div class="slider-other-new owl-carousel mt-[20px]">
                                @foreach($sameArticle as $item)
                                    <div class="item shadow border border-gray-100">
                                        <div class="img hover-zoom">
                                            <a href="{{ route('routerURL', ['slug' => $item->slug]) }}">
                                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full object-cover" style="height: 200px"/>
                                            </a>
                                        </div>
                                        <div class="nav-img p-[15px]">
                                            <h3 class="title-1 font-bold" style="
                            overflow: hidden;
                            text-overflow: ellipsis;
                            line-height: 22px;
                            -webkit-line-clamp: 2;
                            height: 44px;
                            display: -webkit-box;
                            -webkit-box-orient: vertical;
                          ">
                                                <a href="{{ route('routerURL', ['slug' => $item->slug]) }}" class="transition-all hover:text-color_primary">{{ $item->title }}</a>
                                            </h3>
                                            <p class="date my-[10px] text-gray-600">
                                                <i class="fa-regular fa-calendar-days mr-[5px]"></i>1
                                                {{ date('d/m/Y', strtotime($item->created_at)) }}
                                            </p>
                                            <div class="desc text-f14" style="
                            overflow: hidden;
                            text-overflow: ellipsis;
                            line-height: 22px;
                            -webkit-line-clamp: 3;
                            height: 66px;
                            display: -webkit-box;
                            -webkit-box-orient: vertical;
                          ">
                                                {!! $item->description !!}
                                            </div>
                                            <div class="readmore mt-[10px]">
                                                <a href="{{ route('routerURL', ['slug' => $item->slug]) }}" class="read-more-btn text-color_primary uppercase hover:pl-[10px] transition-all">
                                                    <i class="fas fa-long-arrow-right text-f11 mr-[10px]"></i>
                                                    Xem thêm
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                @include('homepage.common.aside')
            </div>
        </div>
    </div>
</div>

@endsection
