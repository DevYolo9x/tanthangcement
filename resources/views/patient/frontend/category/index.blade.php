@extends('homepage.layout.home')
@section('content')

{!! htmlBreadcrumb($detail->title, $breadcrumb) !!}
<main class="main-page page-category-article">
    <div class="main-content">
        <div class="container">
            <div class="main-page-title">
                <h1>{{ $detail->title }}</h1>
            </div>
            @if( isset($data) && count($data) )
                <div class="list-post">
                    <div class="row">
                        @foreach( $data as $k => $article )
                            <div class="col-lg-4">
                                {!! htmlArticle($article) !!}
                            </div>
                        @endforeach
                        <div class="wow fadeInUp">{!! $data->links() !!}</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection

@push('css')
<style>
    .page-category-article .list-post {
    margin-top: 30px;
}

.page-category-article .list-post .item img {
    height: 250px;
    object-fit: cover;
}

.page-category-article .list-post .item {
    background: #fff;
    border: 1px solid #efefef;
    margin-bottom: 15px;
}

.page-category-article .list-post .item .box-text .title a {
    font-size: 18px;
    font-weight: 600;
}

.page-category-article .list-post .item .box-text .desc {
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 3;
    display: -webkit-box;
}

.page-category-article .list-post .item .box-text .title {
    line-height: 20px;
}

.page-category-article .list-post .item .box-text {
    padding: 10px;
}
.page-category-article .list-post .item .action {
    display: inline-block!important;
}
</style>
@endpush