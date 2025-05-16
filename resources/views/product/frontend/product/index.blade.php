@extends('homepage.layout.home')

@section('content')
    <?php
    $listAlbums = json_decode($detail->image_json, true);
    $img = !empty($detail->image) ? asset($detail->image) : asset('images/404.png');
    $dieukien = getDataJson($detail->fields, 'config_colums_json_product_dieukien');
    $price = getPrice(array('price' => $detail->price, 'price_sale' => $detail->price_sale, 'price_contact' =>
        $detail->price_contact));
    $version = json_decode(base64_decode($detail->version_json), true);
    $attrDesc = getAttributeByCat($version, 0); // Danh sách thuộc tính mô tả
    $attrTiennghi = getAttributeByCat($version, 1); // Danh sách thuộc tính mở rộng
    $address = explode(PHP_EOL, $fcSystem['homepage_address']);
    ?>

    <div class="page-product-single section-title-box">
        {!! htmlBreadcrumb($detail->title, $breadcrumb) !!}
        <div class="container px-[15px] mx-auto mt-12">
            <div class="c-detail-box grid grid-cols-12 gap-6">
                <div class="c-detail-box__left w-full col-span-12 lg:col-span-6 overflow-hidden">
                    <div class="swiper gallery-top relative">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ $img }}" class="h-350px w-full object-cover" alt="{{ $detail->title }}">
                            </div>
                            @if (isset($listAlbums) && is_array($listAlbums) && count($listAlbums))
                                @foreach ($listAlbums as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset($image) }}" class="h-350px w-full object-cover"
                                            alt="{{ $detail->title }}">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide"
                            aria-controls="swiper-wrapper-39107fd6245ac39c8"></div>
                        <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide"
                            aria-controls="swiper-wrapper-39107fd6245ac39c8"></div>
                    </div>

                    <div class="swiper gallery-thumbs mt-1">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ $img }}" alt="{{ $detail->title }}">
                            </div>
                            @if (isset($listAlbums) && is_array($listAlbums) && count($listAlbums))
                                @foreach ($listAlbums as $image)
                                    <div class="swiper-slide">
                                        <img src="{{ asset($image) }}" alt="{{ $detail->title }}">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="c-detail-box__right w-full col-span-12 lg:col-span-6">
                    <div class="c-detail-box__row">
                        <h1 class="c-detail-title font-black relative lg:text-3xl text-f21">{{ $detail->title }}
                            <span
                                class="hidden absolute bg-[#FF00001A] font-bold ml-[10px] px-2 right-auto rounded text-[#FF0000] text-[12px]">Hết
                                xe
                            </span>
                        </h1>
                        <div class="c-product-price font-extrabold mt-3 text-2xl text-[#FF0000]">
                            @if( $price['price_final_none_format'] )
                                {{ number_format($price['price_final_none_format'], 0, ',', '.') }}<sup class="font-medium ml-2 text-[#000] text-f14">VNĐ/Ngày</sup>
                            @else
                                Liên hệ
                            @endif
                        </div>
                        <div class="flex gap-1 mt-3 flex-wrap sm:flex-nowrap hidden">
                            <div class="c-hint c-hint-success font-bold text-[12px]"
                                style="background-color: rgb(232, 238, 252); height: 28px; line-height: 28px; border-radius: 4px; padding: 0px 8px;">
                                Miễn phí sạc tới 31/12/2027</div>
                        </div>
                    </div>
                    @if( isset($attrDesc) && count($attrDesc) )
                    <div class="border c-detail-box__row mt-5 px-3 py-2">
                        <div class="c-utilities-box grid grid-cols-12 gap-1">
                            @foreach( $attrDesc as $k => $v )
                                <?php
                                $titles = array_column($v['attr'], 'title');
                                $titleString = implode(', ', $titles);
                                ?>
                                <div class="col-span-12 lg:col-span-6 w-full">
                                    <div class="c-utility-item flex items-center">
                                        <div class="c-utility-item__icon mr-2">
                                            <img src="{{ asset($v['cat']) }}" class="w-6" alt="icon" >
                                        </div>
                                        <div class="c-utility-item__content text-[#374151]">{{ $titleString }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="content-content description mt-5">{!! $detail->description !!}</div>
                    @endif
                    <div class="c-detail-box__row">
                        <div class="c-detail-book d-grid">
                            <a onclick="openModal()" class="bg-color_primary booking-btn btn btn-block btn-lg btn-primary px-3 text-center cursor-pointer font-semibold mt-5 py-3 rounded text-f18 text-white w-full"
                                    type="submit" disabled="">Đặt xe
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 g-4 mb-3 mt-5">
                <div class="w-full col-span-12 lg:col-span-8">
                    @if( isset($attrTiennghi) && count($attrTiennghi) )
                    <div class="c-widget">
                        <div class="c-widget__title">
                            <h2 class="c-widget__title__name font-bold text-f21">Các tiện nghi khác</h2>
                        </div>
                        <div class="c-widget__content">
                            
                            <div class="border c-detail-box__row mt-5 px-3 py-2">
                                <div class="c-utilities-box grid grid-cols-12 gap-1">
                                    @foreach( $attrTiennghi as $k => $v )
                                        <?php
                                        $titles = array_column($v['attr'], 'title');
                                        $titleString = implode(', ', $titles);
                                        ?>
                                        <div class="col-span-12 lg:col-span-6 w-full">
                                            <div class="c-utility-item flex items-center">
                                                <div class="c-utility-item__icon mr-2">
                                                    <img src="{{ asset($v['cat']) }}" class="w-6" alt="icon">
                                                </div>
                                                <div class="c-utility-item__content text-[#374151]">{{ $titleString }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if( isset($dieukien->title) && count($dieukien->title) )
                    <div class="c-widget mt-7">
                        <div class="c-widget__title">
                            <h2 class="c-widget__title__name font-bold text-f21">Điều kiện thuê xe</h2>
                        </div>
                        <div class="c-widget__content">
                            @foreach( $dieukien->title as $k => $item )
                                <div class="border c-utilities-box px-3 py-3 mt-4">
                                    <div class="g-2 row">
                                        <div class="">
                                            <div class="c-utility-label font-semibold mb-1.5 text-f16">{{ $item }}</div>
                                        </div>
                                        <div class="description">{!! $dieukien->desc[$k] !!}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="c-widget mt-7">
                        <div class="c-widget__title">
                            <h2 class="c-widget__title__name font-bold text-f21">Thông tin</h2>
                        </div>
                        <div class="c-widget__content">
                            <div class="border c-utilities-box px-3 py-3 mt-4">
                                <div class="g-2 row">
                                    <div class="">
                                        <div class="c-utility-label font-semibold mb-1.5 text-f16"></div>
                                    </div>
                                    <div class="description content-content">{!! $detail->content !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full col-span-12 lg:col-span-4">
                    <div class="c-widget">
                        <div class="c-widget__title">
                            <h2 class="c-widget__title__name font-bold text-f21">Xe tương tự</h2>
                        </div>
                        <div class="c-widget__content">
                            <div class="c-product-other">
                                <ul>
                                    @if( isset($productSame) )
                                        @foreach( $productSame as $product )
                                            <?php 
                                            $img = !empty($product->image) ? asset($product->image) : asset('images/404.png');
                                            $price = getPrice(array('price' => $product->price, 'price_sale' => $product->price_sale, 'price_contact' =>
                                                $product->price_contact));
                                            ?>
                                            <li class="mt-5">
                                                <a class="no-underline" href="{{ route('routerURL', ['slug' => $product->slug]) }}">
                                                    <div class="border c-product-item text-center">
                                                        <div class="c-product-item__img">
                                                            <img alt="{{ $product->title }}" src="{{ $img }}" style=" height: 100%; width: 100%; inset: 0px; color: transparent;">
                                                        </div>
                                                        <div class="c-product-item__content py-4">
                                                            <div class="c-product-item__row">
                                                                <h3 class="c-product-item__title font-bold text-black text-f18">{{ $product->title }}</h3>
                                                            </div>
                                                            <div class="c-product-item__row is-flex mt-2">
                                                                @if( $price['price_final_none_format'] )
                                                                    <div class="c-product-price font-semibold text-[#FF0000] text-f18">{{ number_format($price['price_final_none_format'], 0, ',', '.') }}<span class="ml-1 text-f14 text-black">VNĐ/Ngày</span></div>
                                                                @else
                                                                    <div class="c-product-price font-semibold text-[#FF0000] text-f18">Liên hệ</div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
		style="background: rgba(0,0,0,.7);display:none">
		<div
			class="bg-white border border-teal-500 md:max-w-md_ modal-container mx-auto overflow-y-auto rounded shadow-lg lg:w-1/2 w-11/12z-50">
			<div class="modal-content py-4 text-left px-6">
				<form action="{{ route('contactFrontend.register') }}" id="formRegis">
                    <div class="flex justify-between items-center pb-3">
                        <p class="md:text-2xl font-bold">Đăng Ký Nhận Tư Vấn Thuê Xe</p>
                        <div class="modal-close cursor-pointer z-50">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 18 18">
                                <path
                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    @include('homepage.common.alert')
                    <div class="my-5 grid grid-cols-12 gap-x-6 gap-y-4">
                        @csrf
                        <div class="w-full col-span-12 lg:col-span-6">
                            <label for="fullname">Họ và tên</label>
                            <input type="text" id="fullname" name="fullname" placeholder="" class="mt-2 border outline-none h-[40px] border-gray-300 shadow px-3 w-full rounded">
                        </div>
                        <div class="w-full col-span-12 lg:col-span-6">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" id="phone" name="phone" placeholder="" class="mt-2 border outline-none h-[40px] border-gray-300 shadow px-3 w-full rounded">
                        </div>
                        <div class="w-full col-span-12 lg:col-span-6">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="" class="mt-2 border outline-none h-[40px] border-gray-300 shadow px-3 w-full rounded">
                        </div>
                        <div class="w-full col-span-12 lg:col-span-6">
                            <label for="product">Sản phẩm</label>
                            <input type="text" id="product" name="product" value="{{ $detail->title }}" placeholder="" class="mt-2 border outline-none h-[40px] border-gray-300 shadow px-3 w-full rounded">
                        </div>
                        <div class="w-full col-span-12 lg:col-span-12">
                            <label for="time">Số ngày thuê</label>
                            <input type="number" id="time" name="time" value="" placeholder="" class="mt-2 border outline-none h-[40px] border-gray-300 shadow px-3 w-full rounded">
                        </div>
                        <div class="w-full col-span-12 lg:col-span-12">
                            <label for="time">Địa điểm muốn thuê</label>
                            @if( isset($address) )
                                @foreach( $address as $k => $it )
                                    <div class="mt-2">
                                        <input type="radio" id="add_{{$k}}" name="address" value="{{$it}}" placeholder=""> <label for="add_{{$k}}">{{$it}}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-center pt-2">
                        <button type="submit" class="bg-color_primary focus:outline-none p-3 px-4 rounded-lg md:text-f16 text-f14 text-white">Đăng ký</button>
                    </div>
                </form>
			</div>
		</div>
	</div>
@endsection

@push('css')
<style>
    .animated {
			-webkit-animation-duration: 1s;
			animation-duration: 1s;
			-webkit-animation-fill-mode: both;
			animation-fill-mode: both;
		}

		.animated.faster {
			-webkit-animation-duration: 500ms;
			animation-duration: 500ms;
		}

		.fadeIn {
			-webkit-animation-name: fadeIn;
			animation-name: fadeIn;
		}

		.fadeOut {
			-webkit-animation-name: fadeOut;
			animation-name: fadeOut;
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
			}

			to {
				opacity: 1;
			}
		}

		@keyframes fadeOut {
			from {
				opacity: 1;
			}

			to {
				opacity: 0;
			}
		}
</style>
@endpush

@push('javascript')
    <script>
        $(document).ready(function() {
            $('#formRegis').submit(function() {
                var form = $(this);
                var data = form.serialize();
                var url = form.attr('action');
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        if (data.error == '') {
                            form.find(".print-error-msg").css('display', 'none');
                            form.find(".print-success-msg").css('display', 'block');
                            form.find(".print-success-msg span").html("Đăng ký thành công!");
                            form[0].reset();
                        } else {
                            form.find(".print-error-msg").css('display', 'block');
                            form.find(".print-success-msg").css('display', 'none');
                            form.find(".print-error-msg span").html(data.error);
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
    <script>
        const modal = document.querySelector('.main-modal');
        const closeButton = document.querySelectorAll('.modal-close');

		const modalClose = () => {
			modal.classList.remove('fadeIn');
			modal.classList.add('fadeOut');
			setTimeout(() => {
				modal.style.display = 'none';
			}, 500);
		}

		const openModal = () => {
			modal.classList.remove('fadeOut');
			modal.classList.add('fadeIn');
			modal.style.display = 'flex';
		}

		for (let i = 0; i < closeButton.length; i++) {

			const elements = closeButton[i];

			elements.onclick = (e) => modalClose();

			modal.style.display = 'none';

			window.onclick = function (event) {
				if (event.target == modal) modalClose();
			}
		}
    </script>
    <script>
        $(document).ready(function() {
            var galleryThumbs = new Swiper(".gallery-thumbs", {
                spaceBetween: 5,
                slidesPerView: 6,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                centerInsufficientSlides: true,
                slideToClickedSlide: true
            });
            var galleryTop = new Swiper(".gallery-top", {
                //loop: true,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
                thumbs: {
                    swiper: galleryThumbs
                },
                on: {
                    slideChange: function() {
                        let activeIndex = this.activeIndex + 1;

                        let activeSlide = document.querySelector(
                            `.gallery-thumbs .swiper-slide:nth-child(${activeIndex})`
                        );
                        let nextSlide = document.querySelector(
                            `.gallery-thumbs .swiper-slide:nth-child(${activeIndex + 1})`
                        );
                        let prevSlide = document.querySelector(
                            `.gallery-thumbs .swiper-slide:nth-child(${activeIndex - 1})`
                        );

                        if (nextSlide && !nextSlide.classList.contains("swiper-slide-visible")) {
                            this.thumbs.swiper.slideNext();
                        } else if (
                            prevSlide &&
                            !prevSlide.classList.contains("swiper-slide-visible")
                        ) {
                            this.thumbs.swiper.slidePrev();
                        }
                    }
                }
            });

        })
    </script>
@endpush
