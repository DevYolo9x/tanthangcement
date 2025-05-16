@extends('homepage.layout.home')
@section('content')
    <main class="main-page page-category-article">
        <div class="main-content">
            {!! htmlBreadcrumb($detail->title, $breadcrumb) !!}
            <div class="container px-[15px] mx-auto pb-10">
                @if (isset($data) && count($data))
                    <div class="grid grid-cols-12 gap-6 mt-12">
                        <div class="w-full col-span-12 lg:col-span-9 md:col-span-12 list-post wow fadeInLeft">
                            <div class="wow fadeInUp text-center">
                                {!! htmlTitleMain($detail->title, '', 'h1') !!}
                            </div>
                            <div class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 md:grid-cols-2 gap-y-[32px] mt-10">
                                @foreach ($data as $k => $article)
                                    <?php
                                        $image = asset( !empty($article['image']) ? asset($article['image']) : asset('images/404.png') );
                                    ?>
                                    <div class="max-w-lg bg-white rounded-lg overflow-hidden shadow-[0px_2px_4px_0px_#00000013] group">
                                        <a href="{{ route('routerURL', ['slug' => $article->slug]) }}" title="{{ $article->title }}" class="rounded-lg overflow-hidden group">
                                            <div class="overflow-hidden group hover-zoom">
                                                <img src="{{ $image }}" alt="{{ $article->title }}" class="w-full h-[200px] object-cover rounded-[16px] transition-transform duration-300 group-hover:scale-110">
                                            </div>
                                            <div class="p-4">
                                                <h3 class="text-[18px] font-semibold text-[#3c3c3c] leading-normal md:leading-[26px]" style="
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    -webkit-line-clamp: 1;
                                                    -webkit-box-orient: vertical;
                                                    display: -webkit-box;
                                                ">{{ $article->title }}</h3>
                                                <div class="text-[14px] font-normal text-[#3c3c3c] mt-2 md:mt-[13px]" style="
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    -webkit-line-clamp: 3;
                                                    -webkit-box-orient: vertical;
                                                    display: -webkit-box;
                                                ">{!! $article->description !!}</div>
                                                <p class="text-[12px] text-[#979797] mt-4">{{ date('d.m.Y', strtotime($article['created_at'])) }}</p>
                                            </div>
                                        </a>
                                    </div>

                                @endforeach
                            </div>
                            <div class="wow fadeInUp">{!! $data->links() !!}</div>
                        </div>
                        <div class="w-full col-span-12 lg:col-span-3  md:col-span-12 wow fadeInRight">
                            @include('homepage.common.aside')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
