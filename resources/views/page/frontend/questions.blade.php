@extends('homepage.layout.home')
@section('content')
    <div id="main" class="sitemap main-info pb-[50px]">
        {!!htmlBreadcrumb($seo['meta_title'], [])!!}
        <div class="main-content">
            <div class="container">
                <div class="row">
                    @include('question.frontend.asideLeft')
                    <div class="col-lg-5 col-md-12 wow fadeInUp">
                        <div class="faq-archive">
                            <div class="block-title">
                                <h2>{{ $seo['meta_title'] }}</h2>
                            </div>
                            @if( isset($data) && count($data) )
                                <div class="block-content">
                                    @foreach( $data as $question )
                                        <div class="faq-items">
                                            <div class="faq-item">
                                                <div class="faq-item-meta">
                                                    <div class="faq-item-author">{{ $question->name }}</div>
                                                    <div class="faq-item-specialty">{{ isset($question->catalogues) ? $question->catalogues->title : 'Không xác định' }}</div>
                                                    <div class="faq-item-date">Đã hỏi: <strong>Ngày {{ date('d/m/Y', strtotime($question->created_at)) }}</strong></div>
                                                </div>
                                                <div class="faq-item-title">{{ $question->title }}</div>
                                                <div class="faq-item-desc">{{ $question->description }}</div>
                                                <div class="faq-item-actions">
                                                    <div class="action view">{{ !empty($question->viewed) ? $question->viewed : 0 }} lượt xem</div>
                                                    <a href="{{ route('routerURL', ['slug' => $question->slug]) }}" class="action answer">Xem câu trả lời</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="pagenavi wow fadeInUp mt-[20px]" style="margin-top: 20px;">
                                    <?php echo $data->links() ?>
                                </div>
                            @else
                                <div class="faq-items">
                                    <p style="font-size:16px">Chưa có câu hỏi nào, bạn có thể đặt câu hỏi <a href="{{ route('page.askQuestion') }}">tại đây</a></p>
                                </div>
                            @endif
                        </div>
                    </div>
                    @include('homepage.common.aside')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .cat-service ul .active a {
            background-color: #1D93E3;
            background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0yMiAxMkMyMiAxNy41MiAxNy41MSAyMiAxMiAyMkwxMS43MjAyIDIxLjk5NjJDNi4zMjk0MiAyMS44NDc4IDIgMTcuNDI2NCAyIDEyQzIgNi40OSA2LjQ4IDIgMTIgMkMxNy41MSAyIDIyIDYuNDkgMjIgMTJaTTEwLjAyIDhDOS43MyA4LjMgOS43MyA4Ljc3IDEwLjAzIDkuMDZMMTIuOTggMTJMMTAuMDMgMTQuOTRDOS43MyAxNS4yMyA5LjczIDE1LjcxIDEwLjAyIDE2QzEwLjMyIDE2LjMgMTAuNzkgMTYuMyAxMS4wOCAxNkwxNC41NyAxMi41M0MxNC43MSAxMi4zOSAxNC43OSAxMi4yIDE0Ljc5IDEyQzE0Ljc5IDExLjggMTQuNzEgMTEuNjEgMTQuNTcgMTEuNDdMMTEuMDggOEMxMC45NCA3Ljg1IDEwLjc1IDcuNzggMTAuNTYgNy43OEMxMC4zNiA3Ljc4IDEwLjE3IDcuODUgMTAuMDIgOFoiIGZpbGw9IndoaXRlIi8+Cjwvc3ZnPgo=);
            color: #fff;
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