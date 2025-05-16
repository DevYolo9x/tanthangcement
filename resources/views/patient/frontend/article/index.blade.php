@extends('homepage.layout.home')
@section('content')
    {!! htmlBreadcrumb($detail->title, $breadcrumb) !!}
    <main class="main-page page-detail-article">
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-{{ (isset($catalogues) && $catalogues->type == 2) ? 12 : 9 }}">
                        <div class="main-page-title">
                            <h1>{{ $detail->title }}</h1>
                        </div>
                        <a class="content-view-count" style="margin-bottom: 10px;display: inline-block;"><i>Lượt xem: {{ $detail->viewed }}</i></a>
                        <div class="content-content">{!! $detail->content !!}</div>

                    </div>
                    @if( (isset($catalogues) && $catalogues->type == 1) )
                        @include('homepage.common.aside')
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

@push('css')
@endpush

@push('javascript')
@endpush
