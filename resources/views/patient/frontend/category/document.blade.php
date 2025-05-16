@extends('homepage.layout.home')
@section('content')

{{-- Article --}}
<div id="main" class="sitemap main-new">
    {!!htmlBreadcrumb($detail->title, $breadcrumb)!!}
    <div class="content-new-page py-[30px] md:py-[50px]">
        <div class="container mx-auto px-3">
            <div class="section-title text-center">
                <h1 class="title-primary uppercase text-green text-f20 md:text-f30 font-bold text-center leading-[30px] md:leading-[40px] relative pb-[20px]">
                    {{ $detail->title }}
                </h1>
            </div>
            @if( $data )
            <div class="flex flex-wrap justify-start mx-[-15px] mt-10">
                @foreach( $data as $v )
                <div class="w-1/2 lg:w-1/3 md:w-1/3 xl:w-1/5 md:px-[15px] px-[10px] md:mb-0 mb-3">
                    <div class="bg-white border border-gray-100 box-shadow-custom duration-300 ease-in-out group hover:bg-color_document hover:transform hover:translate-y-[-10px] item mb-[10px] md:mb-[30px] p-2 relative shadow transition" style="">
                        <div class="hover-zoom img pt-5 xl:px-4">
                            <a href="{{ showField($v->postmetas, 'config_colums_input_article_document_link') }}" target="_blank">
                                <i class="fa-file-pdf fa-regular text-5xl group-hover:text-white text-color_document"></i>
                            </a>
                        </div>
                        <div class="bottom-0 duration-300 ease-in-out last:border-00 xl:px-4 md:px-3 md:py-3 md:text-center px-2 py-2 text-black transition">
                            <h3 class="mb-2 md:my-3 mt-0.5 text-left">
                                <a href="{{ showField($v->postmetas, 'config_colums_input_article_document_link') }}"  target="_blank" class="group-hover:text-white font-medium leading-[24px] text-f18" style="
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                    display: -webkit-box;
                                    height: 48px;
                                ">{{ $v->title }}</a>
                                </h3>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            <div class="pagenavi wow fadeInUp mt-[20px]">
                <?php echo $data->links() ?>
            </div>
        </div>
    </div>
</div>
@endsection