@extends('homepage.layout.home')
@section('content')

    <?php
    $timeBooking = ['12h00', '1h00'];
    ?>

    <main class="page-schedule-sampling">
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 block-left wow fadeInLeft">

                        <form action="" id="bookingForm" class="bookings">

                            <div class="description">
                                <h2>{{ $page->title }}</h2>
                                {!! $page->description !!}
                            </div>

                            @csrf
                            <div class="alert alert-success d-flex align-items-center d-none" role="alert">
                                <svg fill="#59b540" height="24px" width="24px" version="1.1" id="Layer_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 512 512" xml:space="preserve" stroke="#59b540">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <g>
                                                <path
                                                    d="M256,0C114.608,0,0,114.608,0,256s114.608,256,256,256s256-114.608,256-256S397.392,0,256,0z M256,496 C123.664,496,16,388.336,16,256S123.664,16,256,16s240,107.664,240,240S388.336,496,256,496z">
                                                </path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <polygon
                                                    points="362.224,155.76 212.016,322.656 148.72,259.36 137.408,270.672 212.64,345.904 374.128,166.464 ">
                                                </polygon>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <div class="message-alert">
                                    Đăng ký thành công!
                                </div>
                            </div>
                            <div class="alert alert-danger d-flex align-items-center d-none" role="alert">
                                <svg fill="#ff0000" height="24px" width="24px" version="1.1" id="Capa_1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 612.002 612.002" xml:space="preserve" stroke="#ff0000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <g>
                                            <path
                                                d="M512.376,584.192H99.624c-35.959,0-68.162-18.593-86.14-49.732s-17.981-68.325,0-99.467L219.862,77.542 c17.978-31.139,50.181-49.732,86.14-49.732s68.162,18.593,86.14,49.732l206.375,357.451c17.981,31.142,17.981,68.325,0,99.467 S548.333,584.192,512.376,584.192z M306.002,56.396c-25.625,0-48.571,13.25-61.384,35.439L38.241,449.286 c-12.812,22.192-12.81,48.689,0,70.88s35.759,35.439,61.384,35.439h412.749c25.625,0,48.571-13.25,61.384-35.439 c12.812-22.189,12.812-48.689,0-70.88L367.383,91.835C354.573,69.643,331.627,56.396,306.002,56.396z M555.493,450.902 L356.5,106.234c-10.54-18.258-29.418-29.155-50.498-29.155c-21.083,0-39.961,10.9-50.501,29.155L56.507,450.902 c-10.543,18.258-10.54,40.055,0,58.311c10.54,18.255,29.418,29.155,50.501,29.155h397.987c21.083,0,39.961-10.9,50.501-29.155 C566.036,490.957,566.033,469.157,555.493,450.902z M269.963,213.788c0-19.87,16.166-36.036,36.036-36.036 s36.036,16.166,36.036,36.036v116.947c0,19.871-16.166,36.036-36.036,36.036s-36.036-16.166-36.036-36.036V213.788z M305.999,473.068c-20.362,0-36.928-16.566-36.928-36.928s16.566-36.928,36.928-36.928s36.928,16.566,36.928,36.928 S326.361,473.068,305.999,473.068z">
                                            </path>
                                        </g>
                                    </g>
                                </svg>
                                <div class="message-alert">
                                    Vui lòng nhập đầy đủ thông tin!
                                </div>
                            </div>


                            <div class="tabs-container">
                                <div class="tabs">
                                    <div class="tab-content active" id="tab-1">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Họ và tên <span class="require">*</span></label>
                                                    <input type="text" name="fullname" class="form-control"
                                                        placeholder="Nhập họ và tên">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Ngày sinh <span class="require">*</span></label>
                                                    <input type="text" name="birthday" class="form-control date"
                                                        placeholder="-- / -- / ----">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Số điện thoại <span
                                                            class="require">*</span></label>
                                                    <input type="text" name="phone" class="form-control"
                                                        placeholder="Nhập số điện thoại">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Email <span class="require">*</span></label>
                                                    <input type="text" name="email" class="form-control"
                                                        placeholder="Nhập email">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Giới tính <span class="require">*</span></label>
                                                    <select name="gender" class="select2 form-control">
                                                        <option value="Nam">Nam</option>
                                                        <option value="Nữ">Nữ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Tỉnh/Thành phố <span
                                                            class="require">*</span></label>
                                                    <select name="cityid" class="select2 form-control" id="city"
                                                        placeholder="Chọn Tỉnh/Thành phố">
                                                        @if (isset($getCity))
                                                            <option value="">Chọn Tỉnh/Thành phố</option>
                                                            @foreach ($getCity as $city)
                                                                <option value="{{ $city->id }}">{{ $city->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <input type="hidden" name="city_hidden" id="city_hidden">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name">Quận/Huyện <span
                                                            class="require">*</span></label>
                                                    <select name="district" class="select2 form-control" id="district"
                                                        placeholder="Chọn Quận/Huyện">
                                                        <option value="">Chọn Quận/Huyện</option>
                                                    </select>
                                                    <input type="hidden" name="district_hidden" id="district_hidden">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">Địa chỉ <span class="require">*</span></label>
                                                    <input type="text" name="address" class="form-control"
                                                        placeholder="Nhập địa chỉ" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">Nội dung yêu cầu <span
                                                            class="require">*</span></label>
                                                    <textarea name="message" class="form-control" placeholder="Tôi cảm thấy..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-links">
                                            <button type="button" class="tab-link btn btn-outline-secondary"
                                                data-tab="tab-2" style="min-width: 60px;">
                                                Tiếp theo
                                                <svg fill="#000000" width="25px" height="25px" viewBox="-12 0 32 32"
                                                    version="1.1" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <title>angle-right</title>
                                                        <path
                                                            d="M0.88 23.28c-0.2 0-0.44-0.080-0.6-0.24-0.32-0.32-0.32-0.84 0-1.2l5.76-5.84-5.8-5.84c-0.32-0.32-0.32-0.84 0-1.2 0.32-0.32 0.84-0.32 1.2 0l6.44 6.44c0.16 0.16 0.24 0.36 0.24 0.6s-0.080 0.44-0.24 0.6l-6.4 6.44c-0.2 0.16-0.4 0.24-0.6 0.24z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="tab-content" id="tab-2">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">Ngày khám <span class="require">*</span></label>
                                                    <input type="text" name="date" class="form-control date"
                                                        placeholder="-- / -- / ----">
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group time-booking">
                                                    <label for="name">Chọn giờ <span class="require">*</span></label>
                                                    <div class="swiper-container">
                                                        <div class="swiper-wrapper">
                                                            @if (isset($timeBooking) && isset($timeBooking))
                                                                @foreach ($timeBooking as $time)
                                                                    <div class="swiper-slide control-time">
                                                                        <label style="width: 100%; display: inline-block;">
                                                                            <input type="radio" name="time_booinkg"
                                                                                value="{{ $time }}">
                                                                            <span>{{ $time }}</span>
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="swiper-button-next"></div>
                                                        <div class="swiper-button-prev"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-links">
                                            <div class="actions">
                                                <button type="button" class="tab-link btn btn-outline-secondary"
                                                    data-tab="tab-1" style="min-width: 60px;">
                                                    <svg fill="#000000" width="25px" height="25px"
                                                        viewBox="-12 0 32 32" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <title>angle-left</title>
                                                            <path
                                                                d="M7.28 23.28c-0.2 0-0.44-0.080-0.6-0.24l-6.44-6.44c-0.32-0.32-0.32-0.84 0-1.2l6.44-6.44c0.32-0.32 0.84-0.32 1.2 0 0.32 0.32 0.32 0.84 0 1.2l-5.8 5.84 5.84 5.84c0.32 0.32 0.32 0.84 0 1.2-0.16 0.16-0.44 0.24-0.64 0.24z">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                    Quay lại
                                                </button>
                                                <button type="submit" class="btn btn-primary">Đặt lịch</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                        <div class="footer-desc">
                            {!! showField($page->fields, 'config_colums_editor_page_form_desc') !!}
                        </div>
                    </div>
                    <div class="col-lg-6 block-right wow fadeInRight">
                        @if (!empty($page->image))
                            <img src="{{ asset($page->image) }}" alt="{{ $page->title }}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}" />

    <style>
        .tab-content {
            display: none;
            animation: fadeInUp 0.5s ease;
        }

        .tab-content.active {
            display: block;
        }

        .block-right img {
            max-width: 100%;
        }
        .bootstrap-datetimepicker-widget.dropdown-menu {
            z-index: 99999999;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@push('javascript')

    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('.select2').select2();

            // Swiper
            var swiperTimeBooing = new Swiper('.time-booking .swiper-container', {
                spaceBetween: 10,
                breakpoints: {
                    640: {
                        slidesPerView: 3
                    },
                    768: {
                        slidesPerView: 4
                    },
                    1024: {
                        slidesPerView: 5
                    }
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });

            // Datepicker
            if ($('input.date').length) {
                $('input.date').datetimepicker({
                    format: 'LT',
                    format: 'DD / MM / YYYY',
                });
            }

            // Lấy quận huyện theo tỉnh thành phố
            $(document).on("change", "#city", function(e, data) {
                let _this = $(this);
                let param = {
                    id: _this.val(),
                    type: "city",
                    trigger_district: typeof data != "undefined" ? true : false,
                    text: "Chọn Quận/Huyện",
                    select: "districtid",
                };
                getLocation(param, "#district");
                text = _this.find('option:selected').text();
                $('#city_hidden').val(text);
            });

            $(document).on("change", "#district", function(e, data) {
                text = $(this).find('option:selected').text();
                $('#district_hidden').val(text);
            });

            function getLocation(param, object) {
                let formURL = BASE_URL + "gio-hang/get-location";
                $.post(
                    formURL, {
                        param: param,
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    function(data) {
                        let json = JSON.parse(data);
                        $(object).html(json.html)
                    }
                );
            }

            // Active thời gian đặt lịch
            $(document).on("click", ".control-time", function() {
                $(".control-time").removeClass("active");
                $(this).find("input").prop("checked", true);
                $(this).addClass("active");
            });

            $('#bookingForm').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                let data = form.serialize();
                let url = BASE_URL + 'dat-lich-kham';
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function(res) {
                        if (res.error == '' || res.status == 200) {
                            form.find('.alert-success').removeClass('d-none');
                            form.find('.alert-danger').addClass('d-none');
                            $('#bookingForm').trigger('reset')
                        } else {
                            form.find('.alert-success').addClass('d-none');
                            form.find('.alert-danger').removeClass('d-none');
                        }
                        $('#bookingForm').animate({
                            scrollTop: 0
                        }, "slow");
                    },
                    error: function() {
                        form.find('.alert-success').addClass('d-none');
                        form.find('.alert-danger').addClass('d-none');
                        alert('Có lỗi xảy ra');
                    }
                });
            });

            // Tabs
            const tabLinks = document.querySelectorAll('.tab-link');
            const tabContents = document.querySelectorAll('.tab-content');

            tabLinks.forEach(link => {
                link.addEventListener('click', () => {
                    // Remove active class from all links
                    tabLinks.forEach(link => link.classList.remove('active'));
                    // Add active class to clicked link
                    link.classList.add('active');

                    // Hide all tab contents
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Show current tab content
                    const targetTab = document.getElementById(link.dataset.tab);
                    targetTab.classList.add('active');

                    swiperTimeBooing.update()
                });
            });

        });
    </script>

    <script></script>
@endpush
