@extends('homepage.layout.home')
@section('content')

<main class="page-category-article">
    {!! htmlBreadcrumb() !!}

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 wow fadeInLeft">
                
                    
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