@extends('homepage.layout.home')
@section('content')

    <?php
    $timeBooking = getDataJson($detail->fields, 'config_colums_json_expert_time_booking');
    $expert_json = $detail->toArray();
    ?>
    <main class="page-detail-experts">
        {!! htmlBreadcrumb(0) !!}

        <div class="container">
            <div class="doctor-single wow fadeInUp">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="doctor-single-info">
                            <div class="avata">
                                @if (!empty($detail->image))
                                    <img src="{{ asset($detail->image) }}" alt="{{ $detail->title }}">
                                @endif
                            </div>
                            <h1>{{ $detail->title }}</h1>
                            <div class="position">{{ convertGroupAttr(groupAttr($detail->attributes)) }}</div>
                            <div class="review">
                                <label>Đánh giá:</label>
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.9317 11.934C14.7159 12.1432 14.6167 12.4457 14.6659 12.7423L15.4067 16.8423C15.4692 17.1898 15.3226 17.5415 15.0317 17.7423C14.7467 17.9507 14.3676 17.9757 14.0567 17.809L10.3659 15.884C10.2376 15.8156 10.0951 15.779 9.94925 15.7748H9.72341C9.64508 15.7865 9.56841 15.8115 9.49841 15.8498L5.80675 17.784C5.62425 17.8757 5.41758 17.9082 5.21508 17.8757C4.72175 17.7823 4.39258 17.3123 4.47341 16.8165L5.21508 12.7165C5.26425 12.4173 5.16508 12.1132 4.94925 11.9007L1.94008 8.98398C1.68841 8.73982 1.60091 8.37315 1.71591 8.04232C1.82758 7.71232 2.11258 7.47148 2.45675 7.41732L6.59841 6.81648C6.91341 6.78398 7.19008 6.59232 7.33175 6.30898L9.15674 2.56732C9.20008 2.48398 9.25591 2.40732 9.32341 2.34232L9.39841 2.28398C9.43758 2.24065 9.48258 2.20482 9.53258 2.17565L9.62341 2.14232L9.76508 2.08398H10.1159C10.4292 2.11648 10.7051 2.30398 10.8492 2.58398L12.6984 6.30898C12.8317 6.58148 13.0909 6.77065 13.3901 6.81648L17.5317 7.41732C17.8817 7.46732 18.1742 7.70898 18.2901 8.04232C18.3992 8.37648 18.3051 8.74315 18.0484 8.98398L14.9317 11.934Z"
                                        fill="#FFC226"></path>
                                </svg>
                                <span>5/5</span>
                            </div>
                            <div class="excerpt">
                            </div>
                            <div class="actions text-center">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalBooking">Đặt lịch khám</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="doctor-single-content content-content">
                            {!! $detail->content !!}
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($sameExpert) && count($sameExpert))
                <section class="home-teams teams wow fadeInUp">
                    <div class="container">
                        <div class="block-title">
                            <h2>{{ showFieldOfPage('experts', 'config_colums_input_homepage_block_1_title') }}</h2>
                        </div>
                        <div class="row">
                            @foreach ($sameExpert as $v)
                                <div class="col-lg-3 col-md-6 col-12 wow fadeInUp">
                                    {!! htmlItemMember($v) !!}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            @include('homepage.common.serveice')
        </div>
    </main>


    <div class="modal fade modal-booking" id="modalBooking"
        tabindex="-1" data-easein="slideDownIn" aria-labelledby="modalBookingLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="popup-login-content">
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="modal-header">
                        <h4 class="modal-title">ĐẶT LỊCH KHÁM CÙNG <br>CHUYÊN GIA</h4>

                        <div class="note">
                            Quý khách hàng vui lòng điền thông tin để đặt lịch thăm khám cùng
                            <span style="color: #1D93E3;">{{ $detail->title }}</span>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form action="" id="bookingForm" class="bookings">
                            @csrf
                            <div class="alert alert-success d-flex align-items-center d-none" role="alert">
                                <svg fill="#59b540" height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" stroke="#59b540"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M256,0C114.608,0,0,114.608,0,256s114.608,256,256,256s256-114.608,256-256S397.392,0,256,0z M256,496 C123.664,496,16,388.336,16,256S123.664,16,256,16s240,107.664,240,240S388.336,496,256,496z"></path> </g> </g> <g> <g> <polygon points="362.224,155.76 212.016,322.656 148.72,259.36 137.408,270.672 212.64,345.904 374.128,166.464 "></polygon> </g> </g> </g></svg>
                                <div class="message-alert">
                                    Đăng ký thành công!
                                </div>
                            </div>
                            <div class="alert alert-danger d-flex align-items-center d-none" role="alert">
                                <svg fill="#ff0000" height="24px" width="24px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 612.002 612.002" xml:space="preserve" stroke="#ff0000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M512.376,584.192H99.624c-35.959,0-68.162-18.593-86.14-49.732s-17.981-68.325,0-99.467L219.862,77.542 c17.978-31.139,50.181-49.732,86.14-49.732s68.162,18.593,86.14,49.732l206.375,357.451c17.981,31.142,17.981,68.325,0,99.467 S548.333,584.192,512.376,584.192z M306.002,56.396c-25.625,0-48.571,13.25-61.384,35.439L38.241,449.286 c-12.812,22.192-12.81,48.689,0,70.88s35.759,35.439,61.384,35.439h412.749c25.625,0,48.571-13.25,61.384-35.439 c12.812-22.189,12.812-48.689,0-70.88L367.383,91.835C354.573,69.643,331.627,56.396,306.002,56.396z M555.493,450.902 L356.5,106.234c-10.54-18.258-29.418-29.155-50.498-29.155c-21.083,0-39.961,10.9-50.501,29.155L56.507,450.902 c-10.543,18.258-10.54,40.055,0,58.311c10.54,18.255,29.418,29.155,50.501,29.155h397.987c21.083,0,39.961-10.9,50.501-29.155 C566.036,490.957,566.033,469.157,555.493,450.902z M269.963,213.788c0-19.87,16.166-36.036,36.036-36.036 s36.036,16.166,36.036,36.036v116.947c0,19.871-16.166,36.036-36.036,36.036s-36.036-16.166-36.036-36.036V213.788z M305.999,473.068c-20.362,0-36.928-16.566-36.928-36.928s16.566-36.928,36.928-36.928s36.928,16.566,36.928,36.928 S326.361,473.068,305.999,473.068z"></path> </g> </g></svg>
                                <div class="message-alert">
                                    Vui lòng nhập đầy đủ thông tin!
                                </div>
                            </div>
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
                                        <label for="name">Số điện thoại <span class="require">*</span></label>
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="Nhập số điện thoại">
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
                                        <label for="name">Email <span class="require">*</span></label>
                                        <input type="text" name="email" class="form-control" placeholder="Nhập email">
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
                                    <div class="form-group">
                                        <label for="name">Tỉnh/Thành phố <span class="require">*</span></label>
                                        <select name="cityid" class="select2 form-control" id="city"
                                            placeholder="Chọn Tỉnh/Thành phố">
                                            @if (isset($getCity))
                                                <option value="">Chọn Tỉnh/Thành phố</option>
                                                @foreach ($getCity as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="hidden" name="city_hidden" id="city_hidden">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Quận/Huyện <span class="require">*</span></label>
                                        <select name="district" class="select2 form-control" id="district"
                                            placeholder="Chọn Quận/Huyện">
                                            <option value="">Chọn Quận/Huyện</option>
                                        </select>
                                        <input type="hidden" name="district_hidden" id="district_hidden">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Địa chỉ <span class="require">*</span></label>
                                        <input type="text" name="address" class="form-control"
                                            placeholder="Nhập địa chỉ" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Chuyên khoa <span class="require">*</span></label>
                                        <select name="expert" class="form-control select2">
                                            <option value="Xét nghiệm">Xét nghiệm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Chọn cơ sở khám <span class="require">*</span></label>
                                        <select name="location" class="form-control select2">
                                            <option value="Hà nội">Hà nội</option>
                                        </select>
                                    </div>
                                </div>
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
                                                @if (isset($timeBooking) && isset($timeBooking->title))
                                                    @foreach ($timeBooking->title as $time)
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
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Nội dung yêu cầu <span class="require">*</span></label>
                                        <textarea name="message" class="form-control" placeholder="Tôi cảm thấy..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="actions">
                                <input type="hidden" name="expert_id" value="{{ $detail->id }}">
                                <input type="hidden" name="expert_json" value="{{ json_encode($expert_json) }}">
                                <a href="tel:{{ showField($detail->fields, 'config_colums_input_expert_phone') }}"
                                    class="action">Cần tư vấn trực tiếp?</a>
                                <button type="submit" class="btn btn-primary">Đặt lịch</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}" />
@endpush

@push('javascript')
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            if (window.location.hash === "#modalBooking") {
                var myModal = new bootstrap.Modal(document.getElementById("modalBooking"));
                myModal.show();
            }

            // Modal
            let swiper;
            $('#modalBooking').on('shown.bs.modal', function() {
                if (!swiper) {
                    swiper = new Swiper('.time-booking .swiper-container', {

                        spaceBetween: 10,
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
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
                }
                $('.select2').select2({
                    dropdownParent: $('body'),
                });

                const $selectCity = $('#city');
                $('#modalBooking').on('scroll', function() {
                    const instance = $selectCity.data('select2');
                    instance.dropdown._positionDropdown(); // Reposition dropdown

                });
            });

            $('#modalBooking').on('hidden.bs.modal', function() {
                if (swiper) {
                    swiper.destroy(true, true);
                    swiper = null;
                }
            });

            // Datepicker
            if ($('input.date').length) {
                $('input.date').datetimepicker({
                    format: 'LT',
                    format: 'DD / MM / YYYY'
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
                        $('#modalBooking').animate({ scrollTop: 0 }, "slow");
                    },
                    error: function() {
                        form.find('.alert-success').addClass('d-none');
                        form.find('.alert-danger').addClass('d-none');
                        alert('Có lỗi xảy ra');
                    }
                });
            });

        });
    </script>
@endpush
