<?php

namespace App\Http\Controllers\homepage;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Components\Comment;
use App\Components\System;
use Cache;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Components\Nestedsetbie;
use App\Components\Helper;

class HomeController extends Controller
{
    protected $comment;
    protected $system;
    protected $Nestedsetbie;
    protected $Helper;

    public function __construct()
    {
        $this->comment = new Comment();
        $this->system = new System();
        $this->Helper = new Helper();
        $this->Nestedsetbie = new Nestedsetbie(array('table' => 'category_products'));
    }
    public function index()
    {
        $fcSystem = $this->system->fcSystem();

        $slideHome = Cache::remember('slideHome', 10000, function () {
            $slideHome = \App\Models\CategorySlide::select('title', 'id')->where(['alanguage' => config('app.locale'), 'keyword' => 'bannerHome'])->with('slides')->first();
            return $slideHome;
        });

        //page: HOME
        $page = Page::with('fields')->where(['alanguage' => config('app.locale'), 'page' => 'index', 'publish' => 0])->select('id', 'title', 'image', 'meta_title', 'meta_description')->first();
        $fields = [];
        if (!empty($page->fields) && count($page->fields) > 0) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }

        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        return view('homepage.home.index', compact('page', 'seo', 'fcSystem', 'slideHome', 'partner', 'cpOne', 'cpTwo', 'cpThree', 'fields', 'cpFour', 'ishomeCategoryProduct'));
    }
    public function sitemap()
    {
        /*
        $Tags = \App\Models\Tag::select('id', 'slug', 'created_at')->where('alanguage', config('app.locale'))->where('publish', 0)->get();
        $Brands = \App\Models\Brand::select('id', 'slug', 'created_at')->where('alanguage', config('app.locale'))->where('publish', 0)->get(); */
        $router = DB::table('router')->select('slug', 'created_at')->get();
        return response()->view('homepage.home.sitemap', compact('router'))->header('Content-Type', 'text/xml');
    }
}
