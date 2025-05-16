<?php
$menu_footer = getMenus('menu-footer');
?>
{{-- Footer --}}
<div id="web_footer">
    <div class="bg-color_primary  relative">
        <div class=" max-w-[1512px] pt-[36px] px-4 sm:px-12 pb-8 text-white xs:rounded-b-none xs:rounded-t-3xl xs:bg-stone-950 sm:pt-[76px] xs:pb-[3.75vw] lg:pt-[3.75vw] xl:rounded-3xl xl:bg-transparent mx-auto "
            style="">
            <div class="text-left">
                <img alt="Logo" width="182" height="48"
                class="cursor-pointer logo-footer" src="{{ asset($fcSystem['homepage_logo']) }}" style="color: transparent;">
            </div>
            <div class="grid sm:grid-cols-6 sm:space-x-12 mt-[40px]">
                <div class="sm:col-span-2 col-1">
                    <p class="font-semibold text-[16px] uppercase mb-1">{{ $fcSystem['homepage_brandname'] }}</p>
                    <div class="text-f14 description">{!! $fcSystem['homepage_mst'] !!}</div>
                </div>
                <div class="sm:col-span-4 mt-[40px] sm:mt-0">
                    <div class="grid sm:grid-cols-3 grid-cols-2 gap-y-10 sm:gap-y-0 dev-ctm-gird">
                        @if( isset($menu_footer) && count($menu_footer->menu_items) )
                            @foreach( $menu_footer->menu_items as $menu )
                                <div class="col-span-1 flex flex-col">
                                    <a
                                        class="no-underline text-white mb-4 font-[500] text-[20px] leading-[28px] cursor-pointer"
                                        href="javascript:void(0)">{{ $menu->title }}</a>
                                    @foreach( $menu->children as $child  )
                                        <a class="no-underline text-white mb-4 font-[400] text-[16px] cursor-pointer" href="{{ url($child->slug) }}">{{ $child->title }}</a>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                        <div class="sm:col-span-1 flex flex-col ">
                            <a class="no-underline text-white mb-4 font-[500]  text-[20px] leading-[28px] cursor-pointer"
                                        href="javascript:void(0)">Liên hệ</a>
                            <div class="flex items-center gap-x-1 mb-[10px]">
                                <img alt="icon"
                                    src="{{ asset('frontend/images/headphone.svg') }}" style="color: transparent;filter: brightness(0) invert(1);"><a
                                    href="tel:{{ $fcSystem['contact_hotline'] }}"
                                    class="text-[16px] font-semibold cursor-pointer hover:underline">{{ $fcSystem['contact_hotline'] }}</a></div>
                            <div class="flex items-center gap-x-1  mb-[10px]">
                                <img alt="icon"
                                    src="{{ asset('frontend/images/email.svg') }}" style="color: transparent;filter: brightness(0) invert(1);"><a
                                    href="mailto:{{ $fcSystem['contact_email'] }}"
                                    class="text-[16px] font-semibold cursor-pointer hover:underline ">{{ $fcSystem['contact_email'] }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>
    </div>
</div>

{{--<div class="flex items-center bg-color_primary text-white p-3 rounded-full duration-300 w-12" style="--}}
{{--position: fixed;--}}
{{--bottom: 95px;--}}
{{--right: 15px;--}}
{{--">--}}
{{--<a href="tel:{{ $fcSystem['contact_hotline'] }}">--}}
{{--    <img alt="Phone Icon" width="28" height="28" decoding="async" data-nimg="1" src="{{ asset('frontend/images/call-calling-default.svg') }}" style="filter: brightness(0) invert(1);color: transparent;">--}}
{{--</a>--}}
{{--</div>--}}

<a class="call-hotline zalo left" href="https://zalo.me/{{ $fcSystem['social_zalo'] }}" target="_blank">
    <img src="{{asset('frontend/images/zalo.png')}}" />
    <div class="shadow"></div>
</a>

<a class="call-hotline left" href="tel:{{ $fcSystem['contact_hotline'] }}">
    <img src="{{asset('frontend/images/ega-hotline-icon.webp?v=5710')}}" />
    <div class="phone">
        <span>{{ $fcSystem['contact_hotline'] }}</span>
    </div>
    <div class="shadow"></div>
</a>

<!--  end: Footer -->
<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.mmenu.all.js') }}"></script>
{{-- <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script> --}}
<script src="{{ asset('frontend/js/jquery.lazy.min.js') }}"></script>
<script src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('frontend/js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        if ($(window).width() < 1024) {
            var $menu = $("#mmenu").mmenu({
                //   options
            });
            var API = $menu.data("mmenu");

            // Open and close button logic
            $("#menu-open").on("click", function() {
                API.open();
            });

            $("#menu-close").on("click", function() {
                API.close();
            });
        }
    });
</script>

<script>
    //hieu ung wow------------------------------------------
    wow = new WOW({
        animateClass: "animated",
        offset: 100,
        callback: function(box) {
            console.log("WOW: animating <" + box.tagName.toLowerCase() + ">");
        },
    });
    wow.init();
</script>


<script>
    $(document).ready(function() {
        $('#formemail').submit(function() {
            var form = $(this);
            var data = form.serialize();
            var url = form.attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(res) {
                    if (res.status == '500') {
                        form.find('.alert-success').addClass('d-none');
                        form.find('.alert-danger').removeClass('d-none');
                        form.find('.alert-danger').find('.message-alert').html(res.error);
                    } else {
                        form.find('.alert-danger').addClass('d-none');
                        form.find('.alert-success').removeClass('d-none');
                        form[0].reset();
                    }
                },
                error: function(err) {
                    alert('Có lỗi xảy ra, vui lòng thử lại sau!');
                }
            });
            return false
        });
    });
</script>
