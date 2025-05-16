<?php

if (!function_exists('svl_ismobile')) {

    function svl_ismobile()
    {
        $tablet_browser = 0;
        $mobile_browser = 0;

        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $tablet_browser++;
        }

        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
        }

        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $mobile_browser++;
        }

        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
            'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
            'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
            'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
            'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
            'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
            'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
            'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
            'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-'
        );

        if (in_array($mobile_ua, $mobile_agents)) {
            $mobile_browser++;
        }

        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
            $mobile_browser++;
            //Check for tablets on opera mini alternative headers
            $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
                $tablet_browser++;
            }
        }

        if ($tablet_browser > 0) {
            // do something for tablet devices
            return 'is tablet';
        } else if ($mobile_browser > 0) {
            // do something for mobile devices
            return 'is mobile';
        } else {
            // do something for everything else
            return 'is desktop';
        }
    }
}
if (!function_exists('getImageUrl')) {
    function getImageUrl($module = '', $src = '', $type = '')
    {
        $path  = '';
        $dir = explode("/", $src);
        $file = collect($dir)->last();
        if (svl_ismobile() == 'is mobile') {
            $path = 'upload/.thumbs/images/' . $module . '/' . $type . '/' . $file;
        } else if (svl_ismobile() == 'is tablet') {
            $path = 'upload/.thumbs/images/' . $module . '/' . $type . '/' . $file;
        } else if (svl_ismobile() == 'is desktop') {
            $path = 'upload/.thumbs/images/' . $module . '/' . $type . '/' . $file;
        } else {
            $path = $src;
        }
        if (File::exists(base_path($path))) {
            $path = $path;
        } else {
            $path = $src;
        }
        return asset($path);
    }
}
if (!function_exists('getFunctions')) {
    function getFunctions()
    {
        $data = [];
        $getFunctions = \App\Models\Permission::select('title')->where('publish', 0)->where('parent_id', 0)->get()->pluck('title');
        if (!$getFunctions->isEmpty()) {

            foreach ($getFunctions as $v) {
                $data[] = $v;
            }
        }
        return $data;
    }
}
if (!function_exists('getUrlHome')) {
    function getUrlHome()
    {
        return !empty(config('app.locale') == 'vi') ? url('/') : url('/en');
    }
}
/**HTML: Breadcrumb */
if (!function_exists('htmlBreadcrumb')) {
    function htmlBreadcrumb($title = '', $breadcrumb = [])
    {
        $html = '';
        $html .= '<div class="wow fadeInUp" style="background: #f5f5f5">';
        $html .= '<div class="container px-[15px] mx-auto">';
        $html .= '<div class="page-hero-title ">
                        <ol class="breadcrumb lg:flex py-2">
                            <li><a href="'.url('/').'">Trang chủ</a></li>';
                            if( isset($breadcrumb) && count($breadcrumb) ) {
                                foreach( $breadcrumb as $k => $v ) {
                                    $html .= '<li class="flex items-center mx-1 separate"><svg width="15px" height="15px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="layer1"> <path d="M 5 3.2910156 L 4.2910156 4 L 4.6464844 4.3535156 L 10.291016 10 L 4.6464844 15.646484 L 4.2910156 16 L 5 16.708984 L 5.3535156 16.353516 L 11.708984 10 L 5.3535156 3.6464844 L 5 3.2910156 z M 9 3.2910156 L 8.2910156 4 L 8.6464844 4.3535156 L 14.291016 10 L 8.6464844 15.646484 L 8.2910156 16 L 9 16.708984 L 9.3535156 16.353516 L 15.708984 10 L 9.3535156 3.6464844 L 9 3.2910156 z " style="fill:#222222; fill-opacity:1; stroke:none; stroke-width:0px;"></path> </g> </g></svg></li><li><a href="'.route('routerURL', ['slug' => $v['slug']]).'">'.$v['title'].'</a></li>';
                                }
                                $html .= '<li class="flex items-center mx-1 separate"><svg width="15px" height="15px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="layer1"> <path d="M 5 3.2910156 L 4.2910156 4 L 4.6464844 4.3535156 L 10.291016 10 L 4.6464844 15.646484 L 4.2910156 16 L 5 16.708984 L 5.3535156 16.353516 L 11.708984 10 L 5.3535156 3.6464844 L 5 3.2910156 z M 9 3.2910156 L 8.2910156 4 L 8.6464844 4.3535156 L 14.291016 10 L 8.6464844 15.646484 L 8.2910156 16 L 9 16.708984 L 9.3535156 16.353516 L 15.708984 10 L 9.3535156 3.6464844 L 9 3.2910156 z " style="fill:#222222; fill-opacity:1; stroke:none; stroke-width:0px;"></path> </g> </g></svg></li><li class="active" >'.$title.'</li>';
                            } else {
                                $html .= '<li class="flex items-center mx-1 separate"><svg width="15px" height="15px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="layer1"> <path d="M 5 3.2910156 L 4.2910156 4 L 4.6464844 4.3535156 L 10.291016 10 L 4.6464844 15.646484 L 4.2910156 16 L 5 16.708984 L 5.3535156 16.353516 L 11.708984 10 L 5.3535156 3.6464844 L 5 3.2910156 z M 9 3.2910156 L 8.2910156 4 L 8.6464844 4.3535156 L 14.291016 10 L 8.6464844 15.646484 L 8.2910156 16 L 9 16.708984 L 9.3535156 16.353516 L 15.708984 10 L 9.3535156 3.6464844 L 9 3.2910156 z " style="fill:#222222; fill-opacity:1; stroke:none; stroke-width:0px;"></path> </g> </g></svg></li><li class="active">'.$title.'</li>';
                            }
                            
                        $html .= '</ol>
                </div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}


if (!function_exists('htmlArticle')) {
    function htmlArticle($item = [])
    {
        $id = $item['id'];
        $route = route('routerURL', ['slug' => $item['slug']]);
        $image = asset( !empty($item['image']) ? $item['image'] : 'images/404.png' );
        $title = $item['title'];
        $desc = $item['description'];
        $date = date('d.m.Y', strtotime($item['created_at']));
        $html = '';
        $html .= '<div class="max-w-lg bg-white rounded-lg overflow-hidden shadow-[0px_2px_4px_0px_#00000013] group">
                <a href="'.$route.'" title="'.$title.'" class="rounded-lg overflow-hidden group">
                    <div class="overflow-hidden group hover-zoom">
                        <img src="'.$image.'" alt="'.$title.'" class="w-full h-[220px] object-cover rounded-[16px] transition-transform duration-300 group-hover:scale-110">
                    </div>
                    <div class="p-4">
                        <h3 class="text-[18px] font-semibold text-[#3c3c3c] leading-normal md:leading-[26px]" style="
                            overflow: hidden;
                            text-overflow: ellipsis;
                            -webkit-line-clamp: 1;
                            -webkit-box-orient: vertical;
                            display: -webkit-box;
                        ">'.$title.'</h3>
                        <div class="text-[14px] font-normal text-[#3c3c3c] mt-2 md:mt-[13px]" style="
                            overflow: hidden;
                            text-overflow: ellipsis;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                            display: -webkit-box;
                        ">'.$desc.'</div>
                        <p class="text-[12px] text-[#979797] mt-4">'.$date.'</p>
                    </div>
                </a>
            </div>';
        return $html;
    }
}

if (!function_exists('htmlArticleAside')) {
    function htmlArticleAside($item = [], $class = '')
    {
        $id = $item['id'];
        $route = route('routerURL', ['slug' => $item['slug']]);
        $image = asset( !empty($item['image']) ? $item['image'] : 'images/404.png' );
        $title = $item['title'];
        $desc = $item['description'];
        $date = date('d.m.Y', strtotime($item['created_at']));
        $html = '';
        $html .= '<a href="'.$route.'" class="'.$class.' gap-3 shadow-[0px_2px_4px_0px_#00000013]" title="'.$title.'">
                    <img src="'.$image.'" alt="'.$title.'" class="w-[176px] h-auto object-cover rounded">
                    <p class="text-[14px] text-[#3c3c3c] font-semibold">'.$title.'<br>
                        <span class="text-[12px] text-[#979797] font-semibold block mt-[5px] transform translate-y-[4px]">'.$date.'</span>
                    </p>
                </a>';
        return $html;
    }
}

if (!function_exists('htmlArticleDetailAside')) {
    function htmlArticleDetailAside($item = [])
    {
        $id = $item['id'];
        $route = route('routerURL', ['slug' => $item['slug']]);
        $image = asset( !empty($item['image']) ? $item['image'] : 'images/404.png' );
        $title = $item['title'];
        $desc = $item['description'];
        $date = date('d.m.Y', strtotime($item['created_at']));
        $html = '';
        $html .= '<a href="'.$route.'" class="bg-white rounded-lg overflow-hidden shadow-[0px_2px_4px_0px_#00000013]">
                    <img src="'.$image.'" alt="'.$title.'" class="w-[184px] h-auto object-cover" height="110">
                    <div class="p-4">
                    <h3 class="text-gray-800 text-sm font-medium">'.$title.'</h3>
                    </div>
                    </a>';
        return $html;
    }
}

if (!function_exists('htmlAddress')) {
    function htmlAddress($data = [])
    {
        $html = '';
        if (isset($data)) {
            foreach ($data as $k => $v) {
                $html .= ' <li class="showroom-item loc_link result-item" data-brand="' . $v->title . '"
    data-address="' . $v->address . '" data-phone="' . $v->hotline . '" data-lat="' . $v->lat . '"
    data-long="' . $v->long . '">
    <div class="heading" style="display: flex">

        <p class="name-label" style="flex: 1">
            <strong>' . ($k + 1) . '. ' . $v->title . '</strong>
        </p>
    </div>
    <div class="details">
        <p class="address" style="flex:1"><em>' . $v->address . '</em>
        </p>

        <p class="button-desktop button-view hidden-xs">
            <a href="javascript:void(0)" onclick="return false;">Tìm đường</a>
            <a class="arrow-right"><span><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
        </p>
        <p class="button-mobile button-view visible-xs">
            <a target="_blank" href="https://www.google.com/maps/dir//' . $v->lat . ',' . $v->long . '">Tìm đường</a>
            <a class="arrow-right" target="_blank"
                href="https://www.google.com/maps/dir//' . $v->lat . ',' . $v->long . '"><span><i
                        class="fa fa-angle-right" aria-hidden="true"></i></span></a>
        </p>
    </div>
</li>';
            }
        }
        return $html;
    }
}

/**HTML: item sản phẩm */
if (!function_exists('htmlItemProduct')) {
    function htmlItemProduct( $item = [] )
    {
        //dd($item);
        $wishlist = isset($_COOKIE['wishlist']) ? json_decode($_COOKIE['wishlist'],TRUE) : NULL;
        $html = '';
        $id = $item['id'];
        $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' =>
        $item['price_contact']));
        $route = route('routerURL', ['slug' => $item['slug']]);
        $image = asset( !empty($item['image']) ? $item['image'] : 'images/404.png' );
        $title = $item['title'];
        $code = $item['code'];
        $desc = $item['description'];

        $html .= '<div class="product-item">
                    <div class="box-thumb hover-zoom">
                        <a href="'.$route.'">
                            <img src="'.$image.'" style="width: 100%;" alt="'.$image.'">
                        </a>
                    </div>
                    <div class="box-text">
                        <h3 class="title">
                            <a href="'.$route.'">'.$title.'</a>
                        </h3>
                        <div class="desc text-center">'.$desc.'</div>
                    </div>
                </div>';
        return $html;
    }
}

/**HTML: item sản phẩm bán kèm */
if (!function_exists('htmlAlbum')) {
    function htmlAlbum($item = [])
    {
        $html = '';
        if (!empty($item['image_json'])) {
            $listAlbums = json_decode($item['image_json'], true);
        } else {
            $listAlbums = [$item['image']];
        }

        $html .= '<ul class="pt-0.5 grid grid-cols-6 gap-0.5">';
        foreach( $listAlbums as $k => $v ) {
            if( $k < 6 ) {
                $html .= '<li class="px-0.5">
                            <a href="javascript:void(0)" class="load-img" data-img="'.asset($v).'">
                                <img src="'.asset($v).'" class="rounded h-50px object-cover w-full" alt="">
                            </a>
                        </li>';
            }
        }
        $html .= '</ul>';
        return $html;
    }
}

/**HTML: item sản phẩm bán kèm */
if (!function_exists('htmlItemProductUpSell')) {
    function htmlItemProductUpSell($item = [])
    {
        $html = '';
        $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' => $item['price_contact']));
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];

        $html .= '<div class="product-item text-center pd-2 mb-6" style="border-bottom: 1px solid #ddd">
                    <div class="box-image">
                        <a href="' . $href . '"><img src="' . $img . '" alt="' . $title . '" height="90" width="90" style="display: inline-block;object-fit: contain"></a>
                    </div>
                    <div class="box-text pt-2 pb-2">
                        <a href="' . $href . '">
                            <h4 class="title-product text-f15">
                                ' . $title . '
                            </h4>
                        </a>
                    </div>
                    <div class="box-price pb-2">
                        <span class="text-red extraPriceFinal text-f16 text-red-600 font-bold">' . $price['price_final'] . '</span>
                        <del class="ml-[5px] extraPriceOld text-f14">' . $price['price_old'] . '</del>
                    </div>
                    <div class="box-action pb-5">
                        <a href="javascript:void(0)" class="addToCartDeals text-f15 text-blue-700">+ Thêm vào giỏ</a>
                    </div>
                </div>';
        return $html;
    }
}

if (!function_exists('htmlItemProduct1')) {
    function htmlItemProduct1($item = [])
    {
        $html = '';
        $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' => $item['price_contact']));
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? asset($item['image']) : asset('images/404.png');
        $title = $item['title'];
        $desc = $item['description'];

        $html .= '<div class="swiper-slide embla__slide__services">
                    <a class="text-[#090806] no-underline" href="'.$href.'">
                        <div class="relative">
                            <div class="xl:h-[500px]"
                                style="background-color: var(--primary-color); color: white; clip-path: polygon(100% 6.4%, 100% 6.4%, 99.906% 5.362%, 99.634% 4.377%, 99.199% 3.459%, 98.616% 2.62%, 97.899% 1.875%, 97.062% 1.235%, 96.122% 0.714%, 95.093% 0.326%, 93.989% 0.084%, 92.825% 0%, 7.175% 0%, 7.175% 0%, 6.011% 0.084%, 4.907% 0.326%, 3.878% 0.714%, 2.937% 1.235%, 2.101% 1.875%, 1.384% 2.62%, 0.801% 3.459%, 0.366% 4.377%, 0.094% 5.362%, 0% 6.4%, 0% 93.6%, 0% 93.6%, 0.094% 94.638%, 0.366% 95.623%, 0.801% 96.541%, 1.384% 97.38%, 2.101% 98.125%, 2.937% 98.765%, 3.878% 99.286%, 4.907% 99.674%, 6.011% 99.916%, 7.175% 100%, 50.516% 100%, 50.516% 100%, 51.071% 99.981%, 51.619% 99.924%, 52.159% 99.83%, 52.687% 99.7%, 53.202% 99.534%, 53.702% 99.334%, 54.183% 99.101%, 54.645% 98.834%, 55.084% 98.535%, 55.498% 98.205%, 65.5% 89.595%, 65.5% 89.595%, 65.915% 89.265%, 66.354% 88.966%, 66.815% 88.699%, 67.297% 88.466%, 67.796% 88.266%, 68.311% 88.1%, 68.84% 87.97%, 69.379% 87.876%, 69.928% 87.819%, 70.483% 87.8%, 92.825% 87.8%, 92.825% 87.8%, 93.989% 87.716%, 95.093% 87.474%, 96.122% 87.086%, 97.062% 86.565%, 97.899% 85.925%, 98.616% 85.18%, 99.199% 84.341%, 99.634% 83.423%, 99.906% 82.438%, 100% 81.4%, 100% 6.4%);">
                                <img alt="'.$title.'" class="object-cover h-[250px] sm:h-[315px]"
                                    src="'.$img.'"
                                    style="color: transparent;">
                                <div class="sm:p-6 pt-[28px] px-5">
                                    <p class="text-lg font-medium">'.$title.'</p>
                                    <p class="text-base font-normal mt-5"
                                        style="
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    -webkit-box-orient: vertical;
                                    -webkit-line-clamp: 2;
                                    display: -webkit-box;
                                ">'.$desc.'</p>
                                </div>
                            </div>
                            <a href="'.$href.'"
                                class="absolute bg-[#FFF] border bottom-0 disabled:bg-[#CECECD] disabled:pointer-events-none focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring gap-2 h-[48px] hover:bg-[#00568f] hover:text-white inline-flex items-center justify-center max-md:px-5 max-w-[120px] min-h-12 my-auto overflow-hidden px-6 py-3 right-0 rounded-full self-stretch sm:max-w-[142px] text-[16px] text-black transition-colors whitespace-nowrap">
                                <p class="leading-[150%] mb-0 text-base">Xem chi tiết</p>
                            </a>
                        </div>
                    </a>
                </div>';
        return $html;
    }
}

if (!function_exists('htmlItemProduct2')) {
    function htmlItemProduct2($item = [])
    {
        $html = '';
        $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' => $item['price_contact']));
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? asset($item['image']) : asset('images/404.png');
        $title = $item['title'];
        $desc = $item['description'];

        $html .= '<div class="embla__slide__scale swiper-slide">
                    <div class="embla__slide__number__scale"
                        style="transform: scale(0.85);transition: all 0.4s;">
                        <div class="relative">
                            <a class="no-underline" href="/thue-xe-tu-lai">
                                <div class="py-10 flex flex-col rounded-[32px] border border-[#CECECD] text-white"
                                    style="box-shadow: var(--sds-size-depth-0) var(--sds-size-depth-400) var(--sds-size-depth-800) var(--sds-size-depth-negative-200) var(--sds-color-black-400) inset; background-image: url(https://greenfuture.tech/images/rents/service_card_bg.webp); background-size: cover; background-position: center center;">
                                    <div
                                        class="rounded-[28px] ml-[30px] flex px-[12px] py-1 items-center justify-center max-w-fit gap-x-1 min-h-[30px] bg-[#00423E]">
                                        <img alt="" loading="lazy"
                                            width="20"src="https://greenfuture.tech/images/rents/battery_dk.svg"
                                            style="color: transparent;">
                                        <p class="text-xs font-normal mb-0">Miễn phí sạc</p>
                                    </div>
                                    <p class="text-[32px] font-medium leading-[120%] mb-4 mt-3 pl-[30px]">'.$title.'</p>
                                    <img alt="'.$title.'"src="'.$img.'" style="color: transparent;">
                                    <div class="grid grid-cols-5  pl-[30px]">
                                        <div class="col-span-2 flex flex-col ">
                                            <div class="flex items-center gap-x-1">
                                                <img alt=""src="https://greenfuture.tech/images/rents/car_dk.svg" style="color: transparent;">
                                                <p class="text-[18px] font-medium leading-[150%] mb-0"> Minicar</p>
                                            </div>
                                            <div class="flex items-center gap-x-1">
                                                <img alt=""src="https://greenfuture.tech/images/rents/2user_dk.svg" style="color: transparent;">
                                                <p class="text-[18px] font-medium leading-[150%] mb-0">4 chỗ</p>
                                            </div>
                                        </div>
                                        <div class="col-span-3 flex flex-col ">
                                            <div class="flex items-center gap-x-1">
                                                <img alt=""src="https://greenfuture.tech/images/rents/battery_footer_dk.svg" style="color: transparent;">
                                                <p class="text-[18px] font-medium leading-[150%] mb-0">210km (NEDC)</p>
                                            </div>
                                            <div class="flex items-center gap-x-1">
                                                <img alt=""src="https://greenfuture.tech/images/rents/box_dk.svg" style="color: transparent;">
                                                <p class="text-[18px] font-medium leading-[150%] mb-0">Dung tích cốp 285L</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>';
        return $html;
    }
}

if (!function_exists('htmlItemProduct3')) {
    function htmlItemProduct3($item = [])
    {
        $html = '';
        $price = getPrice(array('price' => $item['price'], 'price_sale' => $item['price_sale'], 'price_contact' => $item['price_contact']));
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? asset($item['image']) : asset('images/404.png');
        $title = $item['title'];
        $desc = $item['description'];

        $html .= '<div class="embla__slide__scale swiper-slide">
                            <div class="embla__slide__number__scale" style="transform: scale(0.85);">
                                <div class="relative">
                                    <a href="'.$href.'">
                                    <img alt="'.$title.'" class="rounded-[32px] w-full h-full" src="'.$img.'" style="color: transparent;">
                                     </a>
                                </div>
                            </div>
                       
                    </div>';
        return $html;
    }
}

/**HTML: item tin tức */
if (!function_exists('htmlItemNews')) {
    function htmlItemNews($item = [], $classParent = 'md:w-1/2 lg:w-1/2', $classColL = 'lg:w-1/2', $classColR = 'lg:w-1/2')
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];
        $desc = $item['description'];

        $html .= '<div class="w-full '. $classParent .' px-[15px]">
                    <div class="lg:flex items-center my-4 box-shadow-custom px-3 py-3 group hover:transform hover:translate-y-[-10px] transition duration-300 ease-in-out"
                        style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                        <div class="'. $classColL.' w-full img hover-zoom">
                            <a href="'.$href.'">
                                <img src="'.$img.'"
                                    class="h-260px object-cover w-full" alt="">
                            </a>
                        </div>
                        <div
                            class="'. $classColR.' w-full bg-white pl-3 bottom-0 last:border-00 text-black transition duration-300 ease-in-out">
                            <h3 class="border-b border-black my-3 pb-2"><a href="'.$href.'"
                                    class="font-medium leading-7 text-f18">'.$title.'</a></h3>
                            <p class="mb-2 text-f15"><i class="fas fa-calendar-alt"></i> '.getDateName($item->created_at).', '.date('h:m', strtotime($item->created_at)).' - '.date('d/m/Y', strtotime($item->created_at)).'</p>
                            <div class="mt-4 text-justify"
                                style="
                            overflow: hidden;
                            text-overflow: ellipsis;
                            -webkit-line-clamp: 3;
                            -webkit-box-orient: vertical;
                            display: -webkit-box;
                            text-align: justify;
                        ">'.$desc.'</div>
                        </div>
                    </div>
                </div>';
        return $html;
    }
}

/**HTML: item dự án */
if (!function_exists('htmlItemProject')) {
    function htmlItemProject($item = [])
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];
        $desc = $item['description'];

        $html .= '<div class="w-1/2 lg:w-1/2 xl:w-1/2 xl:px-[15px] px-[10px]">
                    <div class="item mt-3">
                        <div
                            class="group box-shadow-custom border border-gray-100 item mb-[10px] md:mb-[30px] relative shadow hover:transform hover:translate-y-[-10px] transition duration-300 ease-in-out">
                            <div class="img hover-zoom">
                                <a href="'.$href.'">
                                    <img src="'.$img.'"
                                        class="w-full h-175px md:h-500px lg:h-500px xl:h-500px object-cover" alt="">
                                </a>
                            </div>
                            <div
                                class=" bg-white bottom-0 duration-300 ease-in-out group-hover:bg-color_hover group-hover:text-white last:border-00 md:px-3 md:py-3 md:text-center pb-2 px-2 text-black transition">
                                <h3 class="my-3"><a href="'.$href.'" class="font-medium text-f18 text-left" style="
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                    display: -webkit-box;
                                ">'.$title.'</a></h3>
                                <div
                                    class="xl:flex xl:flex-wrap justify-start mx-[-15px] mt-[15px] md:mt-[30px] items-center">
                                    <div class="w-full xl:w-3/4 px-[15px]">
                                        <div class="text-left"
                                            style="
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                    -webkit-line-clamp: 3;
                                    -webkit-box-orient: vertical;
                                    display: -webkit-box;
                                ">'.$desc.'</div>
                                    </div>
                                    <div
                                        class="mb-4 mt-5 px-[15px] md:text-center text-left w-full xl:mb-0 xl:mt-0 xl:text-right xl:w-1/4">
                                        <a href="'.$href.'"
                                            class="border border-black btn-readmore group-hover:border-white header-22 px-3 md:py-2 py-1.5 rounded-[30px]">Xem
                                            thêm <i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        return $html;
    }
}

if (!function_exists('htmlItemPostHome')) {
    function htmlItemPostHome($item = [])
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];
        $desc = $item['description'];
        $html .= '<div class="post-item">
                    <div class="post-item-info">
                        <div class="post-item-photo">
                            <a href="'.$href.'" class="post-image-container">
                                <img src="'.$img.'" alt="'.$title.'">
                            </a>
                        </div>
                        <div class="post-item-details">
                            <h3 class="post-item-title">
                                <a href="'.$href.'">'.$title.'</a>
                            </h3>
                            <div class="post-item-excerpt">'.$desc.'</div>
                            <div class="post-item-actions">
                                <a href="'.$href.'">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>';
        return $html;
    }
}

if (!function_exists('htmlItemMember')) {
    function htmlItemMember($item = [])
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? $item['image'] : 'images/404.png';
        $title = $item['title'];
        $desc = $item['description'];
        $attr = groupAttr($item['attributes']);
        $html .= '<div class="team-item" style="width: 100%; display: inline-block;">
                    <div class="team-item-info">
                        <div class="team-item-photo">
                            <a href="'.$href.'" class="post-image-container"
                                tabindex="0">
                                <img src="'.$img.'" alt="'.$title.'">
                            </a>
                            <span class="circle"></span>
                        </div>
                        <div class="team-item-details">
                            <h3><a style="color:black" href="'.$href.'"
                                    tabindex="0">'.$title.'</a></h3>
                            <div class="team-item-meta">'.convertGroupAttr($attr).'</div>
                            <div class="team-item-review">
                                <img src="'.asset('frontend/images/star.png').'">
                                <img class="star-icon" src="'.asset('frontend/images/star.png').'">
                                <img class="star-icon" src="'.asset('frontend/images/star.png').'">
                                <img class="star-icon" src="'.asset('frontend/images/star.png').'">
                                <img class="star-icon" src="'.asset('frontend/images/star.png').'">
                            </div>
                            <div class="team-item-excerpt">'.$desc.'</div>
                            <div class="team-item-actions">
                                <a href="'.$href.'#modalBooking" tabindex="0">Đặt lịch</a>
                            </div>
                        </div>
                    </div>
                </div>';
        return $html;
    }
}


if (!function_exists('htmlItemArticleAside')) {
    function htmlItemArticleAside($item = [])
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? asset($item['image']) : asset('images/404.png');
        $title = $item['title'];
        $desc = strip_tags($item['description']);
        $attr = groupAttr($item['attributes']);
        $html .= '<div class="post-item post-item-list">
                <div class="post-item-info">
                    <div class="post-item-photo">
                        <a href="'.$href.'"
                            class="post-image-container">
                            <img src="'.$img.'" alt="'.$title.'">
                        </a>
                    </div>
                    <div class="post-item-details">
                        <div class="post-item-date">'.formatDateVietnamese($item['created_at']).'</div>
                        <h3 class="post-item-title">
                            <a href="'.$href.'">'.$title.'</a>
                        </h3>
                        <div class="post-item-excerpt">'.$desc.'</div>
                    </div>
                </div>
            </div>';
        return $html;
    }
}

if (!function_exists('htmlItemService')) {
    function htmlItemService($item = [])
    {
        $html = '';
        $href = route('routerURL', ['slug' => $item['slug']]);
        $img = !empty($item['image']) ? asset($item['image']) : 'images/404.png';
        $title = $item['title'];
        $desc = $item['description'];
        $attr = groupAttr($item['attributes']);
        $fields = $item->fields;
        $iconUrl = !empty(showField($fields, 'config_colums_input_articles_icon')) ? asset(showField($fields, 'config_colums_input_articles_icon')) : '';
        $icon = !empty($iconUrl) ? '<img src="'.$iconUrl.'" alt="'.$title.'" class="base"> ' : '';
        $html .= '<div class="service-item">
                    <div class="service-item-info">
                        <div class="service-item-photo">
                            <div class="service-item-image"> 
                                <img src="'.$img.'" alt="'.$title.'"> 
                            </div>
                            <div class="service-item-icon"> 
                                '.$icon.'
                            </div>
                        </div>
                        <div class="service-item-details">
                            <h3 class="service-item-title"><a href="'.$href.'">'.$title.'</a></h3>
                            <div class="service-item-excerpt">'.$desc.'</div>
                            <div class="service-item-actions"> 
                                <a href="'.$href.'" class="action action-book">Đặt lịch</a> 
                                <a href="'.$href.'" class="action action-view">Xem chi tiết</a> 
                            </div>
                        </div>
                    </div>
                </div>';
        return $html;
    }
}

if (!function_exists('checkErrorValidate')) {
    function checkErrorValidate($errors, $name = '')
    {
        if( $errors->any() ){
            $arrError = $errors->default->toArray();
            if( isset($arrError[$name]) ) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('renderErrorValidate')) {
    function renderErrorValidate($errors, $name = '')
    {
        $html = '';
        if( $errors->any() ){
            $arrError = $errors->default->toArray();
            if( isset($arrError[$name]) ) {
                $html = '
                <div id="validation'.$name.'Feedback" class="invalid-feedback">
                    '.implode(".", $arrError[$name]).'
                </div>';
            }
        }
        return $html;
    }
}

if (!function_exists('checkFinalValidate')) {
    function checkFinalValidate($errors, $name = '')
    {
        $html = '';
        if( $errors->any() ){
            $arrError = $errors->default->toArray();
            if( isset($arrError[$name]) ) {
                $html = '
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                    </svg>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>'.implode(".", $arrError[$name]).'</div>
                    </div>';
            }
        } else {
            $hml = '
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
                </svg>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    Đăng nhập thành công!
                </div>
                </div>';
        }
        return $html;
    }
}

if (!function_exists('htmlTitleMain')) {
    function htmlTitleMain($title = '', $desc = '', $tag = 'h2')
    {
        $system = new \App\Components\System;
        $fcSystem = $system->fcSystem();
        return '<div class="section-title">
                    <'.$tag.' class="font-bold main-title text-3xl">'.$title.'</'.$tag.'>
                    <div class="desc">'.$desc.'</div>
                </div>';
    }
}

if (!function_exists('alertSuccess')) {
    function alertSuccess($msg = '')
    {
        if( !empty($msg) ) {
            return '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
                </svg>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    '.$msg.'
                </div>
                </div>';
        }
    }
}

if (!function_exists('alertError')) {
    function alertError($msg = '')
    {
        if( !empty($msg) ) {
            return '<div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                    <div>'.$msg.'</div>
                    </div>';
        }
    }
}

if (!function_exists('renderIframeYoutube')) {
    function renderIframeYoutube($link = '', $height = 300)
    {
        $exp = explode('?v=', $link);
        if( isset($exp) && is_array($exp) && count($exp) ) {
            return '<iframe width="100%" height="'.$height.'" src="https://www.youtube.com/embed/'.$exp[1].'" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
        }
    }
}