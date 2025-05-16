<?php


if (!function_exists('getMenus')) {

    function getMenus($keyword = "")
    {
        $data = Cache::remember($keyword, 600, function () use ($keyword) {
            $data = \App\Models\Menu::select('id', 'title')->where(['slug' => $keyword])->with(['menu_items' => function ($query) {
                $query->select('menu_items.id', 'menu_items.menu_id', 'menu_items.parentid', 'menu_items.title', 'menu_items.image', 'menu_items.slug', 'menu_items.target')
                    ->where(['alanguage' => config('app.locale'), 'parentid' => 0])
                    ->with(['children' => function ($query) {
                        $query->select('menu_items.id', 'menu_items.menu_id', 'menu_items.parentid', 'menu_items.title', 'menu_items.image', 'menu_items.slug', 'menu_items.target')->where('alanguage', config('app.locale'))
                            ->orderBy('menu_items.order', 'asc')->orderBy('menu_items.id', 'desc');
                    }])
                    ->orderBy('menu_items.order', 'asc')->orderBy('menu_items.id', 'desc');
            }])->first();
            return $data;
        });
        return $data;
    }
}

if (!function_exists('getAttrAll')) {

    function getAttrAll()
    {
        $data = \App\Models\CategoryAttribute::where(['alanguage' => config('app.locale'), 'publish' => 0])
                ->with(['listAttr'])
                ->orderBy('order', 'asc')
                ->orderBy('id', 'desc')
                ->limit(100)
                ->get();
        return $data;
    }
}

if (!function_exists('getHtmlMenus')) {
    function getHtmlMenus($data = [], $arr = [])
    {
        $html = '';
        $html .= '<ul class="' . $arr['ul'] . '">';
        if ($data) {
            if (count($data->menu_items) > 0) {
                foreach ($data->menu_items as $item) {
                    $_blank = !empty($item->target === '_blank') ? 'target="_blank"' : '';
                    $html .= '<li class="' . $arr['li'] . ' group relative ">';
                    $html .= '<a href="' . url($item->slug) . '" class="' . $arr['a'] . ' ' . $arr['hover_color'] . ' flex items-center" ' . $_blank . '>';
                    $html .= '<span class="lg:mt-0 ' . $arr['hover_color'] . '">' . $item->title . '</span>';

                    if (count($item->children) > 0) {
                        $html .= '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>';
                    }

                    $html .= '</a>';
                    if (count($item->children) > 0) {
                        //menu cấp 2
                        $html .= '<ul class="' . $arr['ul_2'] . ' group-hover:block hidden absolute dropdown left-0 top-full w-[200px] bg-white text-left rounded z-10 ">';
                        foreach ($item->children as $item2) {
                            $_blank_2 = !empty($item2->target === '_blank') ? 'target="_blank"' : '';
                            $html .= '<li class="' . $arr['li_2'] . ' group2 relative">';
                            $html .= '<a href="' . url($item2->slug) . '" class="' . $arr['hover_color'] . '" ' . $_blank_2 . '>' . $item2->title . '';
                            if (count($item2->children) > 0) {
                                $html .= ' <span class="float-right"><i class="fa fa-angle-right " aria-hidden="true"></i></span>';
                            }
                            $html .= '</a>';
                            if (count($item2->children) > 0) {
                                $html .= '<ul class="' . $arr['ul_3'] . ' group2-hover:block hidden absolute dropdown left-full top-0 w-[200px]">';
                                foreach ($item2->children as $item3) {
                                    $_blank_3 = !empty($item3->target === '_blank') ? 'target="_blank"' : '';
                                    $html .= '<li class="' . $arr['li_3'] . '"><a href=" ' . url($item3->slug) . '" class="' . $arr['hover_color'] . '" ' . $_blank_3 . '>' . $item3->title . '</a></li>';
                                }
                                $html .= '</ul>';
                            }
                            $html .= '</li>';
                        }
                        $html .= '</ul>';
                        //end
                    }
                    $html .= '</li>';
                }
            }
        }
        $html .= '</ul>';
        return $html;
    }
}
if (!function_exists('getHtmlMenusFooter')) {
    function getHtmlMenusFooter($data = [], $arr = [])
    {
        $html = '';
        if ($data) {
            if (count($data->menu_items) > 0) {
                foreach ($data->menu_items as $item) {
                    if (count($item->children) > 0) {
                        $html .= '<div class="' . $arr['class'] . '">';
                        $html .= '<div class="item">';
                        $html .= '<div class="' . $arr['class_title'] . '">' . $item->title . '';
                        $html .= '</div>';
                        $html .= ' <ul class="' . $arr['class_ul'] . '">';
                        foreach ($item->children as $item2) {
                            $_blank = !empty($item2->target === '_blank') ? 'target="_blank"' : '';
                            $html .= ' <li class="' . $arr['class_li'] . '">';
                            $html .= ' <a href="' . url($item2->slug) . '" class="' . $arr['class_a'] . '" ' . $_blank . '>' . $item2->title . '</a>';
                            $html .= ' </li>';
                        }
                        $html .= ' </ul>';
                        $html .= '</div>';
                        $html .= '</div>';
                    }
                }
            }
        }
        return $html;
    }
}
if (!function_exists('getHtmlFormSearch')) {

    function getHtmlFormSearch($arr = [])
    {
        $html = '';
        $html .= '<form class="' . $arr['classForm'] . '" action="' . $arr['action'] . '" method="GET" enctype="multipart/form">';
        $html .= '<div class="relative">';
        $html .= '<input placeholder="' . $arr['placeholder'] . '" type="text" value="" class="' . $arr['classInput'] . '" name="keyword" />';
        $html .= '<button class="absolute right-1 rounded-full bg-d61c1f h-9 w-10 text-white top-1/2 ' . $arr['classButton'] . '" style="transform: translateY(-50%) " type="submit">';
        $html .= '<svg
  width="24"
  height="24"
  viewBox="0 0 24 24"
  fill="none"
  class="' . $arr['classSvg'] . '"
  xmlns="http://www.w3.org/2000/svg"
>
  <path
    fill-rule="evenodd"
    clip-rule="evenodd"
    d="M18.319 14.4326C20.7628 11.2941 20.542 6.75347 17.6569 3.86829C14.5327 0.744098 9.46734 0.744098 6.34315 3.86829C3.21895 6.99249 3.21895 12.0578 6.34315 15.182C9.22833 18.0672 13.769 18.2879 16.9075 15.8442C16.921 15.8595 16.9351 15.8745 16.9497 15.8891L21.1924 20.1317C21.5829 20.5223 22.2161 20.5223 22.6066 20.1317C22.9971 19.7412 22.9971 19.1081 22.6066 18.7175L18.364 14.4749C18.3493 14.4603 18.3343 14.4462 18.319 14.4326ZM16.2426 5.28251C18.5858 7.62565 18.5858 11.4246 16.2426 13.7678C13.8995 16.1109 10.1005 16.1109 7.75736 13.7678C5.41421 11.4246 5.41421 7.62565 7.75736 5.28251C10.1005 2.93936 13.8995 2.93936 16.2426 5.28251Z"
    fill="currentColor"
  />
</svg>';
        $html .= '</button>';
        $html .= '</div>';
        $html .= '</form>';
        return $html;
    }
}
if (!function_exists('dropdown')) {

    function dropdown($data = [], $title = 'Select', $key = '', $value = '')
    {
        if (!empty($title)) {
            $return['0'] = $title;
        }
        if (!empty($data)) {
            foreach ($data as $item) {
                $return[$item[$key]] = $item[$value];
            }
        }
        return $return;
    }
}

if (!function_exists('getAttrItemProduct')) {

    function getAttrItemProduct($attrId = 0)
    {
        $detail = \App\Models\Attribute::select('title')->where('id', $attrId)->first();
        return isset($detail) ? $detail->toArray(): [];
    }
}

if (!function_exists('getPartner')) {

    function getPartner()
    {
        return \App\Models\Article::select('title', 'image_json')->where('highlight', 1)->get();
    }
}

if (!function_exists('langURLFrontend')) {

    function langURLFrontend($module = '', $locale = '', $id = 0, $model = '')
    {
        $data = [];
        $lang = \App\Models\Polylang::where(['module' => $module, $locale => $id])->first();
        if (!empty($lang)) {
            $slugVI = $model::select('slug')->find($lang->vi);
            if (!empty($slugVI)) {
                $data['vi'] = url($slugVI->slug);
            }
            foreach (config('app.alt_langs') as $item) {
                $slugLanguage = $model::select('slug')->find($lang->$item);
                if (!empty($slugLanguage)) {
                    $data[$item] = url($item . '/' . $slugLanguage->slug);
                }
            }
        }
        return $data;
    }
}
if (!function_exists('configEmail')) {

    function configEmail()
    {
        $settingEmail = \App\Models\ConfigEmail::select('data')->where('id', 1)->first();
        if ($settingEmail) {
            $emailJson = json_decode($settingEmail->data, true);
            config(['mail.mailers.smtp.username' => !empty($emailJson) ? (!empty($emailJson[0]) ? $emailJson[0] : env('MAIL_USERNAME')) : env('MAIL_USERNAME'), 'mail.mailers.smtp.password' => !empty($emailJson) ? (!empty($emailJson[1]) ? $emailJson[1] : env('MAIL_USERNAME')) : env('MAIL_PASSWORD')]);
        }
    }
}


if (!function_exists('postHighLight')) {

    function postHighLight()
    {
        return \App\Models\Article::select('id', 'title', 'slug', 'image')->where(['alanguage' => config('app.locale'), 'publish' => 0, 'isaside' => 1])->orderBy('order', 'asc')->orderBy('id', 'desc')->limit(5)->get();
    }
}


if (!function_exists('productHighLight')) {

    function productHighLight()
    {
        return \App\Models\Product::select('id', 'title', 'slug', 'image')->where(['alanguage' => config('app.locale'), 'publish' => 0, 'isaside' => 1])->orderBy('order', 'asc')->orderBy('id', 'desc')->limit(5)->get();
    }
}

if (!function_exists('getHighLightCategoryAttr')) {

    function getHighLightCategoryAttr()
    {
        return \App\Models\CategoryAttribute::where(['alanguage' => config('app.locale'), 'publish' => 0, 'highlight' => 1])->limit(1)->orderBy('id', 'asc')->pluck('id')->toArray();
    }
}

if (!function_exists('groupAttr')) {
    function groupAttr($attr = [])
    {
        $results = [];
        if( isset($attr) ) {
            foreach ($attr as $k => $item) {
                $results[$item->category_attributes_title][] = $item->title;
            }
        }
    return $results;
    }
}

if (!function_exists('convertGroupAttr')) {
    function convertGroupAttr($attr = [])
    {
        $text = '';
        if( isset($attr) ) {
            foreach ($attr as $k => $item) {
                $text = $k . ' - ' . implode(', ', $item);
            }
        }
        return $text;
    }
}

if (!function_exists('getAsideCatArticle')) {
    function getAsideCatArticle()
    {
        return \App\Models\CategoryArticle::select('id', 'title', 'image', 'slug')
        ->where(['alanguage' => config('app.locale'), 'publish' => 0, 'isaside' => 1])
        ->orderBy('order', 'asc')
        ->with(['posts'])
        ->orderBy('id', 'desc')
        ->get()
        ->map(function($query) {
            $query->setRelation('posts', $query->posts->take(3));
            return $query;
        });
    }
}

if (!function_exists('getAsideArticle')) {
    function getAsideArticle()
    {
        return \App\Models\Article::where(['alanguage' => config('app.locale'), 'publish' => 0, 'highlight' => 1])
        ->orderBy('order', 'asc')
        ->orderBy('id', 'desc')
        ->get();
    }
}

if (!function_exists('formatDateVietnamese')) {
    function formatDateVietnamese($dateString) {
        $weekday = date("l", strtotime($dateString));
        $weekday = strtolower($weekday);
        switch($weekday) {
            case 'monday':
                $weekday = 'Thứ hai';
                break;
            case 'tuesday':
                $weekday = 'Thứ ba';
                break;
            case 'wednesday':
                $weekday = 'Thứ tư';
                break;
            case 'thursday':
                $weekday = 'Thứ năm';
                break;
            case 'friday':
                $weekday = 'Thứ sáu';
                break;
            case 'saturday':
                $weekday = 'Thứ bảy';
                break;
            default:
                $weekday = 'Chủ nhật';
                break;
        }
        return $weekday . ', ' . date("d", strtotime($dateString)) . ' tháng ' . date("m", strtotime($dateString)) . ', ' . date("Y", strtotime($dateString));
    }
}

if (!function_exists('getListCity')) {
    function getListCity() {
        return \App\Models\VNCity::orderBy('name', 'asc')->get();
    }
}

if (!function_exists('getFcSystem')) {
    function getFcSystem($keyword = '') {
        $fcSystem =  \App\Models\General::where('keyword', $keyword)->first();
        return (isset($fcSystem)) ? (config('app.locale') == 'vi' ? $fcSystem->content : $fcSystem->content_.config('app.locale')) : '';
    }
}

if (!function_exists('getPage')) {
    function getPage($page_name = '') {
        return \App\Models\Page::where(['page' => $page_name, 'publish' => 0, 'alanguage' => config('app.locale')])->with('fields')->first();
    }
}

if (!function_exists('countQuestionAnswer')) {
    function countQuestionAnswer() {
        return \App\Models\Question::where(['publish' => 0, 'alanguage' => config('app.locale'), 'is_asw' => 1])->count();
    }
}

if (!function_exists('getHighLightQuestion')) {
    function getHighLightQuestion() {
        return \App\Models\Question::where(['publish' => 0, 'alanguage' => config('app.locale'), 'highlight' => 1])->get();
    }
}

if (!function_exists('countPatient')) {
    function countPatient($customer_id) {
        return \App\Models\Patient::where(['publish' => 0,'trash' => 0, 'alanguage' => config('app.locale'), 'customerid_created' => $customer_id])->count();
    }
}

if (!function_exists('getMaxQtyPatient')) {
    function getMaxQtyPatient($id) {
        return \App\Models\Product::getQtyProductById($id);
    }
}

if (!function_exists('getAttributeByCat')) {
    function getAttributeByCat($version = [], $check = 0) {
        $attribute_tmp = [];
        $attributesID =  [];
        if (!empty($version) && !empty($version[2])) {
            $attributesChecked = $version[0];
            foreach ($version[2] as $key => $item) {
                if( (int)$attributesChecked[$key] === $check ) {
                    foreach ($item as $val) {
                        $attributesID[] = $val;
                    }
                }
                
            }
            if (!empty($attributesID)) {
                $attribute_tmp = \App\Models\Attribute::whereIn('id', $attributesID);
                if( !empty($cat) ) {
                    $attribute_tmp = $attribute_tmp->whereHas('catalogue', function ($query) use ($cat) {
                        $query->where($cat, 1);
                    });
                }
                $attribute_tmp = $attribute_tmp->select('id', 'title', 'image', 'catalogueid')->with('catalogue')->get();
            }
        }
        $attributes = [];
        if (!empty($attribute_tmp)) {
            foreach ($attribute_tmp as $item) {
                $attributes[$item->catalogue->id]['cat'] = $item->catalogue->image;
                $attributes[$item->catalogue->id]['attr'][] = array(
                    'id' => $item->id,
                    'title' => $item->title,
                    'titleC' => $item->catalogue->title,
                    'image' => $item->catalogue->image,
                );
            }
        }
        return $attributes;
    }
}

if (!function_exists('getAttributeByCatColumn')) {
    function getAttributeByCatColumn($version = [], $cat = '') {
        $attribute_tmp = [];
        $attributesID =  [];
        if (!empty($version) && !empty($version[2])) {
            foreach ($version[2] as $key => $item) {
                foreach ($item as $val) {
                    $attributesID[] = $val;
                }
            }
            if (!empty($attributesID)) {
                $attribute_tmp = \App\Models\Attribute::whereIn('id', $attributesID);
                if( !empty($cat) ) {
                    $attribute_tmp = $attribute_tmp->whereHas('catalogue', function ($query) use ($cat) {
                        $query->where($cat, 1);
                    });
                }
                $attribute_tmp = $attribute_tmp->select('id', 'title', 'image', 'catalogueid')->with('catalogue')->get();
            }
        }
        $attributes = [];
        if (!empty($attribute_tmp)) {
            foreach ($attribute_tmp as $item) {
                $attributes[$item->catalogue->id]['cat'] = $item->catalogue->image;
                $attributes[$item->catalogue->id]['attr'][] = array(
                    'id' => $item->id,
                    'title' => $item->title,
                    'titleC' => $item->catalogue->title,
                    'image' => $item->catalogue->image,
                );
            }
        }
        return $attributes;
    }
}