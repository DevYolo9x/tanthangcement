@extends('homepage.layout.home')
@section('content')

<main class="page-category-article">
    {!! htmlBreadcrumb($detail->title, $breadcrumb) !!}

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInLeft">
                    @if( isset($latestArticle) )
                        <div class="hot-news">
                            <div class="post-item post-item-list">
                                <div class="post-item-info">
                                    <div class="post-item-photo">
                                        <a href="{{ route('routerURL', ['slug' => $latestArticle->slug]) }}" class="post-image-container">
                                            <img src="{{ !empty($latestArticle->image) ? asset($latestArticle->image) : asset('images/404.png') }}" alt="{{ $latestArticle->title }}">
                                        </a>
                                    </div>
                                    <div class="post-item-details">
                                        <div class="post-item-cat">TIN TỨC HOT NHẤT</div>
                                        <h3 class="post-item-title">
                                            <a href="{{ route('routerURL', ['slug' => $latestArticle->slug]) }}">{{ $latestArticle->title }}</a>
                                        </h3>
                                        <div class="post-item-excerpt">{{ strip_tags($latestArticle->description) }}</div>
                                        <div class="post-item-date">{{ formatDateVietnamese($latestArticle->created_at) }}</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    
                    @if( isset($data) && count($data) )
                    <div class="post-list">
                        @foreach( $data as $k => $article )
                            {!! htmlItemArticleAside($article) !!}
                        @endforeach

                        <div class="wow fadeInUp">{!! $data->links() !!}</div>
                    </div>
                    @endif
                


                </div>
                @include('homepage.common.aside')
            </div>

            @include('homepage.common.serveice')
        </div>
    </div>
</main>

@endsection