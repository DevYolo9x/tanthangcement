@extends('homepage.layout.home')
@section('content')
    <div id="main" class="sitemap main-contact pb-[50px]">
        {!! htmlBreadcrumb($page->title, []) !!}
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap mx-[-15px] justify-between">
                <div class="w-full px-[15px] xl:order-1 order-2">
                    <div class="map pt-[30px] md:pt-[50px]">
                        {!! $fcSystem['contact_map'] !!}
                    </div>
                </div>
                <div class="w-full px-[15px] xl:order-2 order-1">
                    <div class="contact-btottom mt-[20px] md:mt-[50px]">
                        <div class="flex flex-wrap mx-[-15px] justify-between">
                            <div class="w-full xl:w-2/3 xl:order-1 px-[15px] mt-[15px] md:mt-0">
                                <div class="">
                                    <h2
                                        class="title-primary uppercase text-green text-f20 md:text-f23  font-bold leading-[30px] md:leading-[40px] relative pb-[5px] mb-[20px]">
                                        Liên hệ với chúng tôi
                                    </h2>

                                    <form action="" id="form-submit-contact">
                                        @csrf

                                        @include('homepage.common.alert')

                                        <div class="flex flex-wrap justify-between -mx-3">
                                            <div class="w-full md:w-1/2 px-3">

                                                <input name="fullname" type="text"
                                                    class="w-full h-[45px] border border-gray-300 mb-[10px] md:mb-[15px] rounded-sm text-f15 bg-white"
                                                    placeholder="Họ và tên" />
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <input name="email" type="text"
                                                    class="w-full h-[45px] border border-gray-300 mb-[10px] md:mb-[15px] rounded-sm text-f15 bg-white"
                                                    placeholder="Email" />
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">

                                                <input name="address" type="text"
                                                    class="w-full h-[45px] border border-gray-300 mb-[10px] md:mb-[15px] rounded-sm text-f15 bg-white"
                                                    placeholder="Địa chỉ" />
                                            </div>
                                            <div class="w-full md:w-1/2 px-3">
                                                <input name="phone" type="text"
                                                    class="w-full h-[45px] border border-gray-300 mb-[10px] md:mb-[15px] rounded-sm text-f15 bg-white"
                                                    placeholder="Số điện thoại" />
                                            </div>
                                        </div>


                                        <textarea name="message" id="" cols="30" rows="10"
                                            class="w-full h-[120px] border border-gray-300 px-3 py-3 bg-white rounded-sm text-f15" placeholder="Nội dung..."></textarea>
                                        <button type="submit"
                                            class="bg-color_primary border border-color_primary btn-submit-contact h-[45px] hover:bg-white hover:text-color_primary mt-2 rounded-[5px] text-f15 text-white transition-all uppercase w-24 write-review__button write-review__button--submit">
                                            <span>Gửi </span>
                                        </button>

                                    </form>
                                </div>

                            </div>
                            <div class="w-full xl:w-1/3 xl:order-2 px-[15px] mb-6">
                                <div class="bg-gray-100 text-black p-[10px] md:p-[25px] h-full mt-8">
                                    <h2
                                        class="title-primary uppercase text-green text-f20 md:text-f23  font-bold leading-[30px] md:leading-[40px] relative pb-[5px] mb-[20px]">
                                        VỀ CHÚNG TÔI
                                    </h2>
                                    <div class="mb-[20px]">
                                        <h4 class=" font-bold mb-[5px] ">
                                            <i class="fa-solid fa-phone text-f14 mr-[5px] text-Orangefc5"></i>
                                            Hotline
                                        </h4>
                                        <p class="">
                                            <a href="tel:{{ $fcSystem['contact_hotline'] }}">{{ $fcSystem['contact_hotline'] }}</a>
                                        </p>
                                    </div>
                                    <div class="mb-[20px]">
                                        <h4 class=" font-bold mb-[5px] ">
                                            <i class="fa-solid fa-envelope text-f14 mr-[5px] text-Orangefc5"></i>
                                            Email
                                        </h4>
                                        <p class=""><a
                                                href="mailto:{{ $fcSystem['contact_email'] }}">{{ $fcSystem['contact_email'] }}</a>
                                        </p>
                                    </div>
                                    <div class="mb-[20px]">
                                        <h4 class=" font-bold mb-[5px] ">
                                            <i class="fa-solid fa-location-dot text-f14 mr-[5px] text-Orangefc5"></i>Địa chỉ
                                        </h4>
                                        <p class="">
                                            {{ $fcSystem['contact_address'] }}
                                        </p>
                                    </div>
                                    <div class="border-t border-gray-200 pt-5 mt-5">
                                        <ul class="flex flex-wrap justify-center">
                                            <li class="mr-[10px]">
                                                <a href="{{ $fcSystem['social_facebook'] }}"
                                                    class="w-[35px] h-[35px] leading-[35px] text-center bg-color_second text-white border border-color_second hover:bg-white hover:text-color_second inline-block rounded-full mx-[2p transition-all">
                                                    <i class="fa-brands fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="mr-[10px]">
                                                <a href="{{ $fcSystem['social_twitter'] }}"
                                                    class="w-[35px] h-[35px] leading-[35px] text-center bg-color_second text-white border border-color_second hover:bg-white hover:text-color_second inline-block rounded-full mx-[2p transition-all">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="mr-[10px]">
                                                <a href="{{ $fcSystem['social_instagram'] }}"
                                                    class="w-[35px] h-[35px] leading-[35px] text-center bg-color_second text-white border border-color_second hover:bg-white hover:text-color_second inline-block rounded-full mx-[2p transition-all"><i
                                                        class="fa-brands fa-instagram"></i></a>
                                            </li>
                                            <li class="mr-[10px]">
                                                <a href="{{ $fcSystem['social_youtube'] }}"
                                                    class="w-[35px] h-[35px] leading-[35px] text-center bg-color_second text-white border border-color_second hover:bg-white hover:text-color_second inline-block rounded-full mx-[2p transition-all"><i
                                                        class="fa-brands fa-youtube"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-submit-contact").click(function(e) {
                e.preventDefault();
                var _token = $("#form-submit-contact input[name='_token']").val();
                var fullname = $("#form-submit-contact input[name='fullname']").val();
                var address = $("#form-submit-contact input[name='address']").val();
                var email = $("#form-submit-contact input[name='email']").val();
                var phone = $("#form-submit-contact input[name='phone']").val();
                var message = $("#form-submit-contact textarea[name='message']").val();
                $.ajax({
                    url: "<?php echo route('contactFrontend.store'); ?>",
                    type: 'POST',
                    data: {
                        _token: _token,
                        fullname: fullname,
                        address: address,
                        phone: phone,
                        email: email,
                        message: message
                    },
                    success: function(data) {
                        console.log(data.status);
                        if (data.status == 200) {
                            $("#form-submit-contact .print-error-msg").css('display', 'none');
                            $("#form-submit-contact .print-success-msg").css('display',
                            'block');
                            $("#form-submit-contact .print-success-msg span").html(
                                "<?php echo $fcSystem['message_2']; ?>");
                            setTimeout(function() {
                                //location.reload();
                            }, 3000);
                        } else {
                            $("#form-submit-contact .print-error-msg").css('display', 'block');
                            $("#form-submit-contact .print-success-msg").css('display', 'none');
                            $("#form-submit-contact .print-error-msg span").html(data.error);
                        }
                    }
                });
            });
        });
    </script>
@endpush
