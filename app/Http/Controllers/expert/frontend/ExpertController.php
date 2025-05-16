<?php

namespace App\Http\Controllers\expert\frontend;

use App\Http\Controllers\Controller;
use App\Models\Expert;
use App\Models\CategoryExpert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cache;
use App\Components\Comment;
use App\Components\System;

class ExpertController extends Controller
{
    protected $comment;
    protected $system;
    public function __construct()
    {
        $this->comment = new Comment();
        $this->system = new System();
    }
    public function index($slug = "")
    {
        $segments = request()->segments();
        $slug = end($segments);
        $detail = Expert::select()
            ->where(['slug' => $slug, 'alanguage' => config('app.locale'), 'publish' => 0])
            ->with(['attributes', 'fields'])
            ->first();

        // Lấy thuộc tính theo danh mục thuộc tính HighLight
        $attr = $detail->attributes->pluck('attribute_id')->toArray();

        if (!isset($detail)) {
            return redirect()->route('homepage.index');
        }
        
        // breadcrumb
        $breadcrumb = '';

        // Lấy tỉnh thành phố
        $getCity = getListCity();

        // Bài viết cùng chuyên khoa
        $sameExpert =  Expert::select('id', 'title', 'slug', 'image', 'description',  'experts.created_at')
        ->with(['attributes'])
        ->join('experts_attributes_relationships', 'experts.id', '=', 'experts_attributes_relationships.expert_id')
        ->whereIn('experts_attributes_relationships.attribute_id', $attr)
        ->groupBy('experts.id')
        ->where('alanguage', config('app.locale'))->where('experts.publish', 0)->where('experts.id', '!=', $detail->id)->orderBy('order', 'ASC');
        $sameExpert =  $sameExpert->limit(4)->get();

        //cập nhập lượt xem
        DB::table('experts')->where('id', '=', $detail['id'])->update([
            'viewed' => $detail['viewed'] + 1,
        ]);
        $fcSystem = $this->system->fcSystem();
        $seo['canonical'] = route('routerURL', ['slug' => $slug]);
        $seo['meta_title'] =  !empty($detail['meta_title']) ? $detail['meta_title'] : $detail['title'];
        $seo['meta_description'] = !empty($detail['meta_description']) ? $detail['meta_description'] : cutnchar(strip_tags($detail->description));
        $seo['meta_image'] = $detail['image'];
        $fcSystem = $this->system->fcSystem();
        $module = 'experts';
        $polylang = langURLFrontend($module, config('app.locale'), $detail->id, '\App\Models\Expert');
        if (!empty($polylang)) {
            foreach ($polylang as $key => $item) {
                $fcSystem['language_' . $key] = $item;
            }
        }
        $view = 'expert.frontend.expert.index';
        return view($view, compact('module', 'fcSystem', 'detail', 'seo', 'breadcrumb', 'sameExpert', 'getCity'));
    }
}
