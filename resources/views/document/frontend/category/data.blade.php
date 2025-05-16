@if($data)
    <div class="flex flex-wrap justify-start mx-[-15px]">
        @foreach ($data as $k => $item)
            <div class="w-full md:w-1/3 px-[15px]">
                <div class="item shadow border border-gray-100 mb-[10px] md:mb-[30px]">
                    <div class="img hover-zoom">
                        <a href="{{ route('routerURL', ['slug' => $item->slug]) }}">
                            <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-full object-cover"
                                 style="height: 260px">
                        </a>
                    </div>
                    <div class="nav-img p-[15px]">
                        <h3 class="title-1 font-bold" style="
                                  overflow: hidden;
                                  text-overflow: ellipsis;
                                  line-height: 22px;
                                  -webkit-line-clamp: 2;
                                  height: 44px;
                                  display: -webkit-box;
                                  -webkit-box-orient: vertical;
                                ">
                            <a href="{{ route('routerURL', ['slug' => $item->slug]) }}"
                               class="transition-all hover:text-color_primary">{{ $item->title }}</a>
                        </h3>
                        <p class="date my-[10px] text-gray-600">
                            <i class="fa-regular fa-calendar-days mr-[5px]"></i>{{ date('d-m-Y', strtotime($item->created_at)) }}
                        </p>
                        <div class="desc text-f14" style="
                                  overflow: hidden;
                                  text-overflow: ellipsis;
                                  line-height: 22px;
                                  -webkit-line-clamp: 3;
                                  height: 66px;
                                  display: -webkit-box;
                                  -webkit-box-orient: vertical;
                                ">
                            {!! $item->description !!}
                        </div>
                        <div class="readmore mt-[10px]">
                            <a href="{{ route('routerURL', ['slug' => $item->slug]) }}"
                               class="read-more-btn text-color_primary uppercase hover:pl-[10px] transition-all"><i
                                        class="fas fa-long-arrow-right text-f11 mr-[10px]"></i>Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagenavi wow fadeInUp mt-[20px]">
        <?php echo $data->links() ?>
    </div>
@endif