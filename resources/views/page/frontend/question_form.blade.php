@extends('homepage.layout.home')
@section('content')
    <div id="main" class="sitemap main-info pb-[50px]">
        {!!htmlBreadcrumb($seo['meta_title'], [])!!}
        <div class="main-content">
            <div class="container">
                <div class="row">
                    @include('question.frontend.asideLeft')
                    <div class="col-lg-5 col-md-12 wow fadeInUp">
                        <div class="question-form">
                            <div class="block-title">
                                <h2>{{ $seo['meta_title'] }}</h2>
                                <p>Quý khách vui lòng điền đầy đủ thông bên dưới</p>
                            </div>

                            <form action="{{ route('page.create_askQuestion') }}" method="post">
                                @csrf
                                @if(session('question_id'))
                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                        </symbol>
                                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                        </symbol>
                                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </symbol>
                                    </svg>
                                    <div class="alert alert-success d-flex align-items-center" role="alert" style="font-size: 15px;">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                        <div>
                                            Đặt câu hỏi thành công!
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Chuyên mục tư vấn online<sup>*</sup></label>
                                    <label for="validationCatalogue_id" class="form-label">Họ và tên<sup>*</sup></label>
                                    <div class="control">
                                        <select class="form-control @if(checkErrorValidate($errors, 'name')) is-invalid @endif" name="catalogue_id" id="validationCatalogue_id" aria-describedby="validationcatalogue_idFeedback">
                                            <option value="">Chọn danh mục</option>
                                            @if( isset($catQuestions) )
                                                @foreach( $catQuestions as $cat )
                                                    <option value="{{ $cat->id }}" @if( old('catalogue_id') == $cat->id ) selected @endif >{{ $cat->title }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        {!! renderErrorValidate($errors, 'catalogue_id') !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="validationName" class="form-label">Họ và tên<sup>*</sup></label>
                                    <input type="text" value="{{ old('name') }}" class="form-control @if(checkErrorValidate($errors, 'name')) is-invalid @endif" id="validationName" placeholder="Nhập họ và tên" name="name" aria-describedby="validationnameFeedback">
                                    {!! renderErrorValidate($errors, 'name') !!}
                                </div>
                                <div class="form-group">
                                    <label>Tuổi</label>
                                    <div class="control">
                                        <input type="text" placeholder="Nhập số tuổi" value="{{ old('age') }}" name="age">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <div class="control">
                                        <input type="text" placeholder="Nhập địa chỉ" value="{{ old('address') }}" name="address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="validationEmail" class="form-label">Email<sup>*</sup></label>
                                    <input type="text" class="form-control @if(checkErrorValidate($errors, 'email')) is-invalid @endif" value="{{ old('email') }}" id="validationEmail" placeholder="Nhập email" name="email" aria-describedby="validationemailFeedback">
                                    {!! renderErrorValidate($errors, 'email') !!}
                                </div>
                                <div class="form-group">
                                    <label for="validationTitle" class="form-label">Tiêu đề<sup>*</sup></label>
                                    <input type="text" class="form-control @if(checkErrorValidate($errors, 'title')) is-invalid @endif" value="{{ old('title') }}" id="validationTitle" placeholder="Nhập tiêu đề câu hỏi" name="title" aria-describedby="validationtitleFeedback">
                                    {!! renderErrorValidate($errors, 'title') !!}
                                </div>
                                <div class="form-group">
                                    <label for="validationDescription" class="form-label">Nội dung câu hỏi<sup>*</sup></label>
                                    <textarea class="form-control @if(checkErrorValidate($errors, 'description')) is-invalid @endif" value="{{ old('description') }}" id="validationDescription" placeholder="Tôi muốn hỏi.." name="description" aria-describedby="validationdescriptionFeedback"></textarea>
                                    {!! renderErrorValidate($errors, 'description') !!}
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Đặt câu hỏi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @include('homepage.common.aside')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <script>
        $('select').select2({});
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}" />
    <style>
        .question-form form {
            margin-top: 25px;
        }
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-inline: 0!important;
            font-size: 14px!important;
        }
        .question-form .form-group label {
            display: block;
            color: #534E56;
            font-weight: 600;
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 8px;
        }
        .question-form .form-group {
            margin-bottom: 24px;
        }
        .question-form .form-group .form-control, .question-form .form-group .select2-container .select2-selection--single, .question-form input, .question-form textarea {
            background-color: #F5F5F5;
            border-radius: 4px;
            border-color: #F5F5F5;
            border: unset;
            width: 100%;
            padding: 0 15px;
            font-size: 14px;
            font-weight: 600;
            outline: unset;
        }

        .question-form input {
            height: 44px;
        }

        .question-form textarea {
            padding-block: 10px;
            height: 70px;
            padding-top: 10px !important;
        }
        .question-form .form-group label sup {
            color: #CC0000;
        }
        .cat-service {
            background: #CEE8FA;
            border-radius: 4px;
            padding: 32px 24px;
            overflow: hidden;
            margin-bottom: 32px;
        }

        .sidebar-faq .page-main-title {
            margin-bottom: 32px;
            display: none;
        }

        .question-form {
            margin-bottom: 52px;
            background: #FFFFFF;
            border: 1px solid #F5F5F5;
            border-radius: 4px;
            padding: 32px;
            font-weight: 500;
            font-size: 16px;
            line-height: 1.5;
        }

        .question-form h2 {
            font-weight: 600;
            font-size: 32px;
            letter-spacing: 0.002em;
            text-transform: uppercase;
            line-height: 1.62;
            margin: 0 0 12px;
        }

        .cat-service .block-title {
            background: #1D93E3;
            border-radius: 4px 4px 0px 0px;
            text-align: center;
            padding: 16px;
            color: #fff;
            border-bottom: 1px solid #fff;
        }

        .cat-service .block-title h2 {
            margin: 0;
            font-weight: 700;
            font-size: 16px;
            line-height: 24px;
        }

        .cat-service ul {
            list-style: none;
            padding: 0;
            margin: 0;
            background-color: #fff;
        }

        .cat-service ul li {
            position: relative;
            margin: 0;
        }

        .cat-service ul a {
            display: block;
            color: #534E56;
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
            padding: 12px 12px 12px 48px;
            background-repeat: no-repeat;
            background-position: left 14px top 14px;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0yMiAxMkMyMiAxNy41MiAxNy41MSAyMiAxMiAyMkwxMS43MjAyIDIxLjk5NjJDNi4zMjk0MiAyMS44NDc4IDIgMTcuNDI2NCAyIDEyQzIgNi40OSA2LjQ4IDIgMTIgMkMxNy41MSAyIDIyIDYuNDkgMjIgMTJaTTEwLjAyIDhDOS43MyA4LjMgOS43MyA4Ljc3IDEwLjAzIDkuMDZMMTIuOTggMTJMMTAuMDMgMTQuOTRDOS43MyAxNS4yMyA5LjczIDE1LjcxIDEwLjAyIDE2QzEwLjMyIDE2LjMgMTAuNzkgMTYuMyAxMS4wOCAxNkwxNC41NyAxMi41M0MxNC43MSAxMi4zOSAxNC43OSAxMi4yIDE0Ljc5IDEyQzE0Ljc5IDExLjggMTQuNzEgMTEuNjEgMTQuNTcgMTEuNDdMMTEuMDggOEMxMC45NCA3Ljg1IDEwLjc1IDcuNzggMTAuNTYgNy43OEMxMC4zNiA3Ljc4IDEwLjE3IDcuODUgMTAuMDIgOFoiIGZpbGw9IiMxRDkzRTMiLz4KPC9zdmc+Cg==);
            background-size: 20px 20px;
        }

        .faq-archive .block-title h2 {
            margin: 0;
            font-weight: 600;
            font-size: 32px;
            line-height: 1.62;
            text-transform: uppercase;
        }

        .faq-archive .block-title {
            margin-bottom: 32px;
        }

        .faq-item {
            padding: 24px 32px;
            background-color: #FFFFFF;
            border: 1px solid #F5F5F5;
            margin-bottom: -1px;
        }

        .faq-item-meta {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 12px;
        }

        .faq-item-author {
            color: #1D93E3;
            font-weight: 700;
            font-size: 16px;
            line-height: 1.5;
            margin-right: 12px;
            margin-bottom: 4px;
        }

        .faq-item-specialty {
            background-color: #FFC226;
            border-radius: 4px;
            font-weight: 700;
            font-size: 10px;
            line-height: 1.6;
            padding: 4px;
            color: #fff;
            margin-bottom: 4px;
        }

        .faq-item-date {
            font-weight: 500;
            font-size: 12px;
            line-height: 1.67;
            color: #534E56;
            margin-left: auto;
            margin-bottom: 4px;
        }

        .faq-item-date strong {
            color: #1D93E3;
            font-weight: 500;
        }

        .faq-item-title {
            font-weight: 700;
            font-size: 18px;
            line-height: 1.56;
            margin-bottom: 8px;
        }

        .faq-item-desc {
            font-weight: 500;
            font-size: 14px;
            line-height: 1.71;
            margin-bottom: 24px;
        }

        .faq-item-actions {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: end;
            -ms-flex-pack: end;
            justify-content: flex-end;
        }

        .faq-item-actions .action {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            color: #534E56;
            font-weight: 500;
            font-size: 12px;
            line-height: 20px;
            padding: 7px 8px;
            border: 1px solid #F5F5F5;
            border-radius: 4px;
            margin-left: 12px;
            text-align: center;
        }

        .faq-item-actions .view:before {
            content: "";
            width: 16px;
            height: 16px;
            display: block;
            background-repeat: no-repeat;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik04LjE5MDg0IDIuNjY5OTZMOC4wMDAwMyAyLjY2Njc1QzUuMjM5NDIgMi42NjY3NSAyLjc1MTU0IDQuNjE1NDcgMS4zNzI2NCA3LjgwMzk3QzEuMzE4NDkgNy45MjkxOCAxLjMxODQ5IDguMDcwOTggMS4zNzI2NCA4LjE5NjE5TDEuNDY4MTkgOC40MTEyOEMyLjgyOTYyIDExLjM5NTUgNS4xODIzMyAxMy4yNDMgNy44MDY1NiAxMy4zMzAyTDcuOTk3MzYgMTMuMzMzNEMxMC43NTggMTMuMzMzNCAxMy4yNDU5IDExLjM4NDcgMTQuNjI0OCA4LjE5NjE5QzE0LjY3OTYgOC4wNjk0MSAxNC42Nzg5IDcuOTI1NjggMTQuNjIyOCA3Ljc5OTQ0TDE0LjUyOTkgNy41OTA1QzEzLjE2NTIgNC42MDA2OSAxMC44MTE1IDIuNzU3MDYgOC4xOTA4NCAyLjY2OTk2Wk04LjAwNDcgMy42NTk2OUw4LjE2Mzk5IDMuNjYzMTJMOC4zNDIgMy42NzIzOEMxMC40NzM1IDMuODIzMzEgMTIuNDMzNyA1LjQwMzc3IDEzLjYxOCA3Ljk5OTQ5TDEzLjYxMTggOC4wMTU1QzEyLjM5NzggMTAuNjY3MSAxMC4zNyAxMi4yNTY5IDguMTcxMjkgMTIuMzM2N0w4LjAwMTM2IDEyLjMzOTNMNy44Mjk5OSAxMi4zMzdMNy42NTI0NCAxMi4zMjc3QzUuNTg3MTcgMTIuMTgxNSAzLjY4Mjk1IDEwLjY4OTcgMi40OTE0NiA4LjIzOTg4TDIuMzc4NyA3Ljk5OTQ5TDIuNDgzMDggNy43Nzc1NEMzLjczOTQ4IDUuMTgyMTggNS43OTMwMiAzLjY2MDI2IDguMDA0NyAzLjY1OTY5Wk03Ljk5ODM2IDUuNDA5MDZDNi41NTgwOSA1LjQwOTA2IDUuMzkxMDMgNi41Njg4NCA1LjM5MTAzIDguMDAwMjFDNS4zOTEwMyA5LjQzMTA2IDYuNTU4MjIgMTAuNTkwNyA3Ljk5ODM2IDEwLjU5MDdDOS40Mzg1OSAxMC41OTA3IDEwLjYwNjQgOS40MzA5OCAxMC42MDY0IDguMDAwMjFDMTAuNjA2NCA2LjU2ODkxIDkuNDM4NzEgNS40MDkwNiA3Ljk5ODM2IDUuNDA5MDZaTTcuOTk4MzYgNi40MDI2QzguODg2NDggNi40MDI2IDkuNjA2MzcgNy4xMTc2OCA5LjYwNjM3IDguMDAwMjFDOS42MDYzNyA4Ljg4MjE2IDguODg2NCA5LjU5NzE3IDcuOTk4MzYgOS41OTcxN0M3LjExMDUxIDkuNTk3MTcgNi4zOTEwMyA4Ljg4MjM0IDYuMzkxMDMgOC4wMDAyMUM2LjM5MTAzIDcuMTE3NTEgNy4xMTA0MyA2LjQwMjYgNy45OTgzNiA2LjQwMjZaIiBmaWxsPSIjNTM0RTU2Ii8+Cjwvc3ZnPgo=);
            background-position: center;
            margin-right: 4px;
        }

        .faq-item-actions .action {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            color: #534E56;
            font-weight: 500;
            font-size: 12px;
            line-height: 20px;
            padding: 7px 8px;
            border: 1px solid #F5F5F5;
            border-radius: 4px;
            margin-left: 12px;
            text-align: center;
        }

        .faq-item-actions .answer {
            background-color: #1D93E3;
            border-color: #1D93E3;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            padding: 7px 16px;
            -webkit-transition: 0.2s;
            transition: 0.2s;
        }

        .featured-question .block-title {
            background-color: #1D93E3;
            border-radius: 4px 4px 0px 0px;
            color: #fff;
            padding: 16px 24px;
        }

        .featured-question .block-title h2 {
            margin: 0;
            font-weight: 700;
            font-size: 20px;
            line-height: 32px;
        }

        .featured-question {
            margin-bottom: 52px;
            border: 1px solid #F5F5F5;
            border-radius: 4px;
            background-color: #fff;
            font-weight: 500;
            font-size: 16px;
            color: #534E56;
            line-height: 1.5;
        }

        .question-list {
            margin: 0;
            padding: 0 30px;
        }

        .question-list li {
            padding: 16px 0;
            position: relative;
            margin: 0;
            border-bottom: 1px solid #F5F5F5;
            list-style: none;
            counter-increment: css-counter 1;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .question-list li:before {
            content: counter(css-counter);
            font-weight: 700;
            font-size: 16px;
            background-color: #1D93E3;
            width: 34px;
            height: 34px;
            min-width: 34px;
            line-height: 34px;
            text-align: center;
            color: #fff;
            border-radius: 100%;
            margin-right: 15px;
        }
        .cat-service ul a:hover {
            color: #1D93E3;
        }
        .question-list a:hover {
            color: #1d93e3;
        }

        .question-list a {
            color: #534E56;
        }
    </style>
@endpush