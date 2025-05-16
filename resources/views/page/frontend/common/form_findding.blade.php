<div class="row">
    <div class="col-lg-5 block-right wow fadeInRight">
        <form action="{{ url("tra-cuu-ket-qua") }}" id="bookingForm" class="bookings">

            <div class="description">
                <h2>{{ $page->title }}</h2>
                {!! $page->description !!}
            </div>
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


            <div class="form-group">
                <label for="name">Ngày khám <span class="require">*</span></label>
                <input type="text" name="examination_date" class="form-control date" required placeholder="--/--/----">
            </div>
            <div class="form-group">
                <label for="name">Mã tra cứu <span class="require">*</span></label>
                <input type="text" name="examination_code" class="form-control" required placeholder="Mã tra cứu của bạn">
            </div>
            <div class="form-group">
                <label for="name">Mật khẩu <span class="require">*</span></label>
                <input type="password" name="examination_pass" class="form-control" required placeholder="Nhập mật khẩu của bạn">
            </div>
            <div class="actions">
                <button type="submit" class="btn btn-primary">Tra cứu</button>
            </div>
        </form>

    </div>
    <div class="col-lg-6 offset-lg-1 block-right wow fadeInRight" style="text-align: right">
        @if (!empty($page->image))
            <img src="{{ asset($page->image) }}" alt="{{ $page->title }}" style="max-width: 100%">
        @endif
    </div>
</div>