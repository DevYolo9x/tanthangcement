@extends('homepage.layout.home')
@section('content')
{!!htmlBreadcrumb($page->title)!!}
<div id="main" class="sitemap pb-[50px] main-agent-registration">

    @if( $article )
    <section class="subscribe-section py-10 relative">
        <div class="container mx-auto px-3">
            <div class="flex flex-wrap justify-between md:mx-[-15px] mx-[-10px]">
                @foreach( $article as $vC )
                <div class="w-full md:w-1/3 lg:w-1/3 md:px-[15px] px-[10px]">
                    <div class="item mt-3">
                        <div
                            class="box-shadow-custom bg-white border border-gray-100 duration-300 ease-in-out group hover:transform hover:translate-y-[-10px] item mb-[10px] md:mb-[30px] p-2 relative shadow transition">
                            <div class="img hover-zoom">
                                <a href="{{ route('routerURL', ['slug' => $vC->slug]) }}">
                                    <img src="{{ asset($vC->image) }}"
                                        class="w-full h-175px object-cover" alt="">
                                </a>
                            </div>
                            <div class="bg-white bottom-0 duration-300 ease-in-out last:border-00 md:px-3 md:py-3 md:text-center px-2 py-2 text-black transition">
                                <h3 class="mb-2 md:my-3 mt-0.5"><a href="{{ route('routerURL', ['slug' => $vC->slug]) }}" class="font-medium text-f18" style="
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        -webkit-line-clamp: 2;
                                        -webkit-box-orient: vertical;
                                        display: -webkit-box;
                                    ">{{ $vC->title }}</a></h3>
                                <div class="leading-[24px]" style="
                                overflow: hidden;
                                text-overflow: ellipsis;
                                -webkit-line-clamp: 3;
                                -webkit-box-orient: vertical;
                                display: -webkit-box;
                            ">{!! $vC->description !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <div class="content-agent-registration py-[30px] wow fadeInUp" style="background: #d3d3d326;">
        <div class="container mx-auto px-3">
            <h1 class="title-primary uppercase text-green text-f20 md:text-f23  font-bold leading-[30px] md:leading-[40px] relative pb-[5px] mb-[20px] text-center">
                {{$page->title}}
            </h1>
            <div class="flex flex-wrap justify-between md:mx-[-15px] mx-[-10px]  pt-[30px]">
                <div class="w-full lg:w-1/2 md:px-[15px] px-[10px]">
                    <form action="" id="form-submit-regis" class="validate form-subscribe-register">
                        <div class="custom-imformation">
                            @csrf
                            @include('homepage.common.alert')
                            <div class="form-content">
                                <div class="flex flex-wrap justify-between md:mx-[-15px] mx-[-10px]">
                                    <div class="w-full md:px-[15px] px-[10px]">
                                        <label class="font-medium font-medium inline-block mb-1.5"> Họ và tên *</label>
                                        <input type="text" name="fullname" class="w-full h-[45px] border border-gray-300 mb-[10px] md:mb-[15px] rounded-sm text-f15 bg-white" />
                                    </div>
                                    <div class="w-full d:px-[15px] px-[10px]">
                                        <label class="font-medium font-medium inline-block mb-1.5"> Địa chỉ *</label>
                                        <input type="text" name="address" class="w-full h-[45px] border border-gray-300 mb-[10px] md:mb-[15px] rounded-sm text-f15 bg-white" />
                                    </div>
                                    <div class="w-full  md:px-[15px] px-[10px]">
                                        <label class="font-medium font-medium inline-block mb-1.5"> Điện thoại *</label>
                                        <input type="text" name="phone" class="w-full h-[45px] border border-gray-300 mb-[10px] md:mb-[15px] rounded-sm text-f15 bg-white" />
                                    </div>
                                    <div class="w-full md:px-[15px] px-[10px]">
                                        <label class="font-medium font-medium inline-block mb-1.5"> Email *</label>
                                        <input type="text" name="email" class="w-full h-[45px] border border-gray-300 mb-[10px] md:mb-[15px] rounded-sm text-f15 bg-white" />
                                    </div>

                                    <div class="px-[5px] mb-3 space-y-2 md:col-span-2 md:px-[15px] px-[10px]">
                                        <button id="btn-regis" class=" bg-[#363636] bg-global border font-bold hover:bg-red-800 hover:text-white px-4 py-2 rounded-[5px] text-center text-white transition-all" style="min-width: 150px;">
                                            <i class="fa fa-spinner hidden" aria-hidden="true"></i>
                                            Đăng ký đại lý
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                </div>
                <div class="w-full lg:w-1/2 px-[15px] lg:mt-0 mt-3">
                    <img src="http://tqc-market.laravel/upload/images/banner/16632099087714_z3722833597453_37a8236c27aa89135d979b3d3e8876a9.jpg" class="rounded-[5px]" alt="">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('css')
@endpush
@push('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        var btnRegis = $("#btn-regis");
        btnRegis.click(function(e) {
            e.preventDefault();
            btnRegis.prop("disabled", true)
            btnRegis.find('i').removeClass('hidden').addClass('animate-spin');
            var _token = $("#form-submit-regis input[name='_token']").val();
            var fullname = $("#form-submit-regis input[name='fullname']").val();
            var address = $("#form-submit-regis input[name='address']").val();
            var email = $("#form-submit-regis input[name='email']").val();
            var phone = $("#form-submit-regis input[name='phone']").val();
            $.ajax({
                url: "<?php echo route('contactFrontend.agency'); ?>",
                type: 'POST',
                data: {
                    _token: _token,
                    fullname: fullname,
                    address: address,
                    phone: phone,
                    email: email,
                },
                success: function(data) {
                    btnRegis.prop("disabled", false)
                    btnRegis.find('i').removeClass('animate-spin').addClass('hidden');
                    if (data.status == 200) {
                        $("#form-submit-regis .print-error-msg").css('display', 'none');
                        $("#form-submit-regis .print-success-msg").css('display',
                        'block');
                        $("#form-submit-regis .print-success-msg span").html(
                            "<?php echo $fcSystem['message_7']; ?>");
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        $("#form-submit-regis .print-error-msg").css('display', 'block');
                        $("#form-submit-regis .print-success-msg").css('display', 'none');
                        $("#form-submit-regis .print-error-msg span").html(data.error);
                    }
                }
            });
        });
    });
</script>
@include('homepage.common.loading')
@endpush