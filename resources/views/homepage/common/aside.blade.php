<?php
$postAside = getAsideArticle();
$layoutClass = 'space-y-4 mb-[32px]';
$itemClass = 'flex items-center';
if( isset($module) && $module == 'articles' ) {
    $layoutClass = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 grid-cols-2 gap-4';
    $itemClass = '';
}
?>
    <aside class="shrink-0 w-full py-4 mt-6 md:mt-0 sticky top-0">
        @if (isset($postAside))
            <div class="space-y-4 mb-[32px]">
                <h2 class="text-f20 font-bold text-[#3c3c3c] mb-[23px]">Tin tức nổi bật</h2>
                <div class="{{ $layoutClass }}">
                    @foreach ($postAside as $item)
                        <?php 
                        $img = !empty($item['image']) ? asset($item['image']) : asset('images/404.png');
                        ?>
                        @if( isset($module) && $module == 'articles' )
                            <a href="{{ route('routerURL', ['slug' => $item->slug]) }}" class="bg-white rounded-lg overflow-hidden shadow-[0px_2px_4px_0px_#00000013]">
                                <img src="{{ $img }}" alt="{{ $item->title }}" class="w-[184px] h-auto object-cover" style="
                                    height: 105px;
                                ">
                                <div class="p-4">
                                    <h3 class="text-gray-800 text-sm font-medium" style="
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                    display: -webkit-box;
                                ">{{ $item->title }}</h3>
                                </div>
                            </a>
                        @else
                            <a href="{{ route('routerURL', ['slug' => $item->slug]) }}" class="{{ $itemClass }} shadow-[0px_2px_4px_0px_#00000013]" title="{{ $item->title }}">
                                <img src="{{ $img }}" alt="{{ $item->title }}" class="w-[176px] h-auto object-cover rounded" style="
                                    height: 115px;width: 170px;
                                ">
                                <p class="text-[14px] text-[#3c3c3c] font-semibold pl-3" style="width: calc( 100% - 170px );">
                                    <span style="
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    -webkit-box-orient: vertical;
                                    -webkit-line-clamp: 2;
                                    display: -webkit-box;
                                    ">{{ $item->title }}</span>
                                    <br>
                                    <span class="text-[12px] text-[#979797] font-semibold block mt-[5px] transform translate-y-[4px]">{{ date('d.m.Y', strtotime($article['created_at'])) }}</span>
                                </p>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
        <div class="ads-wrap mt-3">
            <ul class="flex flex-col space-y-4">
                <li>
                    @if( !empty($fcSystem['banner_0']) )
                    <a href="{{ $fcSystem['banner_1'] }}">
                        <img alt="banner" src="{{ asset($fcSystem['banner_0']) }}" style="color: transparent;">
                    </a>
                    @endif
                </li>
            </ul>
        </div>
    </aside>
@push('css')
@endpush
