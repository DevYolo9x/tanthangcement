<?php
$catQuestions = App\Models\CategoryQuestion::where(['alanguage' => config('app.locale'), 'publish' => 0, 'highlight' => 1])->get();
?>
<div class="col-lg-3 col-md-12 sidebar-faq wow fadeInLeft">
    <div class="page-main-title">
        <h2>Hỏi đáp chuyên gia</h2>
    </div>
    @if( isset($catQuestions) && count($catQuestions) )
        <div class="cat-service">
            <div class="block-title" style="background-color:#1D93E3" data-toggle="dropdown">
                <h2><a style="color:white; cursor:pointer">Chuyên mục tư vấn online</a></h2>
            </div>
            <div class="block-content">
                <ul>
                    @foreach( $catQuestions as $cat )
                        <li class="@if( Request::url() == route('routerURL', ['slug' => $cat->slug]) ) active @endif"><a href="{{ route('routerURL', ['slug' => $cat->slug]) }}">{{ $cat->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
@push('css')
    <style>
        .cat-service ul .active:hover a {
            color: #fff;
        }
    </style>
@endpush