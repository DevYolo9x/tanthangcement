@extends('homepage.layout.home')

@section('content')
    <main class="page-fidding">
        <div class="container" style="position: relative;">
            <div class="head">
                <a href="{{ url('/') }}"><img src="{{ asset($fcSystem['homepage_logo_footer']) }}"
                        alt="{{ $fcSystem['homepage_brandname'] }}" width="200"></a>
            </div>
        </div>
        <main class="container">
            <section class="zirconx-guaran">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="zirconx-title">
                            <h3>Tra cứu bảo hành</h3>
                        </div>
                        <div class="zig-content">
                            <form action="" method="">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mã số thẻ</label>
                                    <div class="col-sm-9">
                                        <input name="code" value="{{ request()->code }}" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                                    <div class="col-sm-9 text-left">
                                        <button type="submit" class="btn btn-light">Tra cứu</button>
                                        <a href="{{ url('/') }}" class="btn btn-light"
                                            style="background: #494949;color: #BCBEC0;border-radius: 20px;border-color: #494949;font-weight:500;">Trang
                                            chủ</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="content-content">
                            {!! $page->description !!}
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </main>
@endsection

@push('css')
    <style>
        header,
        footer,
        .home-form {
            display: none;
        }

        .page-fidding {
            background: #e1aa3a;
            padding-top: 65px;
            min-height: 100vh;
        }

        .page-fidding .head {
            padding-bottom: 35px;
        }

        .zirconx-title h3 {
            font-size: 36px;
            position: relative;
            font-weight: 700;
            margin-top: 30px;
            margin-bottom: 45px;
        }

        .zirconx-title h3:before {
            position: absolute;
            content: '';
            width: 100px;
            height: 1px;
            background: #fff;
            bottom: -10px;
            left: 0;
        }

        .zig-content .form-group input,
        .zig-content .form-group textarea,
        .zig-content .form-group select {
            background: #494949;
            border: 0;
            color: #fff;
        }

        .zig-content .form-group button {
            background: #494949;
            border-radius: 20px;
            color: #BCBEC0;
            border-color: #494949;
        }

        .zig-content>form>.row:first-child {
            margin-bottom: 15px;
        }
    </style>
@endpush



@push('javascript')
@endpush
