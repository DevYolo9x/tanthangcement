<section class="wow fadeInUp">
    {!! htmlBreadcrumb($detail->title, $breadcrumb) !!}
    <div class="container px-[15px] mx-auto mt-12">
        <div class="text-center">
            {!! htmlTitleMain($title, '', 'h1') !!}
        </div>
        @if (isset($data) && count($data))
            <div class="car-list grid grid-cols-12 md:gap-6 gap-x-6 gap-y-8 my-7">
                @foreach ($data as $v)
                    <?php 
                    $img = !empty($v['image']) ? asset($v['image']) : asset('images/404.png');
                    $price = getPrice(array('price' => $v->price, 'price_sale' => $v->price_sale, 'price_contact' => $v->price_contact));
                    $version = json_decode(base64_decode($v->version_json), true);
                    $attr = getAttributeByCatColumn($version, 'ishome');
                    ?>
                    <a class="car-item w-full col-span-12 lg:col-span-4 md:col-span-6" href="{{ route('routerURL', ['slug' => $v->slug]) }}">
                        <div class="relative car-image hover-zoom transition-all duration-700 ease-in-out">
                            <img alt="{{ $v->title }}" class="h-[300px] object-cover w-full duration-700 ease-in-out" src="{{ $img }}" style="color: transparent;">
                        </div>
                        <div class="relative car-info">
                            <div class="absolute left-2/4 -translate-x-2/4 -translate-y-2/4 border border-[#b4c3de] p-4 bg-white h-max w-max">
                                <div class="flex items-center text-center">
                                    @if( $price['price_final_none_format'] )
                                        <div class="font-normal text-[#3c3c3c]">Chỉ từ</div>
                                        <div class="font-extrabold text-2xl mx-2 text-[#FF0000]">{{ number_format($price['price_final_none_format'], 0, ',', '.') }}</div>
                                        <div class="font-semibold text-md text-[#374151]">VNĐ/Ngày</div>          
                                    @else                                        
                                        <div class="font-extrabold text-2xl mx-2 text-[#FF0000]">Liên hệ</div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-col border border-[#4b9c6b] px-4 gap-4 pt-11 pb-4 info-detail">
                                <div class="text-center font-extrabold text-2xl text-[#111827]">{{ $v->title }}</div>
                                @if( isset($attr) )
                                    <div class="grid grid-cols-2 gap-x-0 gap-y-3 list-attr">
                                        @foreach( $attr as $v )
                                            <?php
                                            $titles = array_column($v['attr'], 'title');
                                            $titleString = implode(', ', $titles);
                                            ?>
                                            <div class="flex gap-2 items-center">
                                                <img src="{{ asset($v['cat']) }}" alt="icon" style="width: 22px;object-fit: contain;">
                                                <div class="text-sm font-medium text-[#374151]">{{ $titleString }}</div>
                                            </div>
                                        @endforeach
                                        <hr class="col-span-2 h-px border-[#d9e1e2] m-0">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="pagenavi wow fadeInUp mt-[20px]">
                <?php echo $data->links(); ?>
            </div>
        @endif
    </div>
</section>

@push('javascript')
    <script>
        $(document).ready(function () {
            if(window.innerWidth <= 1024 && window.innerWidth >= 768){
                var h3height = 0;
                $('.car-list .car-item').each(function() {
                    if(h3height < $(this).find('.list-attr').outerHeight()){
                        h3height = $(this).find('.list-attr').outerHeight();
                    }
                    console.log(h3height)
                });
                $('.car-list .car-item .list-attr').height(h3height);
            }
        })
    </script>
@endpush