<?php

namespace App\Http\Controllers\page\frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Article;
use App\Models\CategoryAttribute;
use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Components\System;
use App\Models\Orders_item;
use Carbon\Carbon;
use Validator;

class PageController extends Controller
{
    protected $system;
    public function __construct()
    {
        $this->system = new System();
    }
    public function aboutUs()
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'aboutus', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.aboutus', compact('seo', 'page', 'fcSystem', 'fields'));
    }
    
    public function experts(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'experts', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        // Lấy ra thuộc tính lọc từ url
        $filters = $request->filters;
        $filters = !empty($filters) ? array_unique(explode('-',$filters)) : [];
        
        // Danh sách lọc
        $listAttribute = CategoryAttribute::where(['alanguage' => config('app.locale'), 'publish' => 0])->with('listAttr')->orderBy('order', 'ASC')->orderBy('id', 'desc')->get();   
        
        $data = Expert::select('id', 'title', 'slug', 'image', 'description',  'experts.created_at')
        ->join('experts_attributes_relationships', 'experts.id', '=', 'experts_attributes_relationships.expert_id')
        
        ->where('alanguage', config('app.locale'))->where('experts.publish', 0)
        ->with(['attributes'])
        ->groupBy('experts.id');
        if( !empty($filters) ){
            $data = $data->whereIn('experts_attributes_relationships.attribute_id', $filters);
        }
        $data = $data->orderBy('order', 'ASC')->orderBy('experts.id', 'desc')->paginate(2);

        if (is($filters)) {
            $data->appends(['filters' => join('-', $filters)]);
        }

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.experts', compact('seo', 'page', 'fcSystem', 'fields', 'data', 'listAttribute', 'filters'));
    }
    
    public function scheduleSampling(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'schedule_sampling', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        // Lấy tỉnh thành phố
        $getCity = getListCity();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.schedule_sampling', compact('seo', 'page', 'fcSystem', 'fields', 'getCity'));
    }
    
    public function finding(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'finding', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.fidding', compact('seo', 'page', 'fcSystem', 'fields'));
    }
    
    public function scheduleAnAppointment(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'schedule_an_appointment', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        // Lấy tỉnh thành phố
        $getCity = getListCity();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.schedule_an_appointment', compact('seo', 'page', 'fcSystem', 'fields', 'getCity'));
    }

    public function tablePrice()
    {
        //page: Table Price
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'table_price', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();
        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.tablePrice', compact('seo', 'page', 'fcSystem', 'fields'));
    }
    public function agency()
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'agency', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();
        $article = Article::where(['alanguage' => config('app.locale'), 'isagency' => 1, 'publish' => 0])->get();
        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = $item->meta_value;
            }
        }

        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.agency', compact('seo', 'page', 'fcSystem', 'fields', 'article'));
    }
    public function reviews()
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'reviews', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();
        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = $item->meta_value;
            }
        }
        $data = \App\Models\Comment::where(['parentid' => 0, 'module' => 'products', 'publish' => 0])
            ->orderBy('id', 'desc')
            ->paginate(30);
        if (!empty($data)) {
            foreach ($data as $key => $item) {
                $checkOrder = \App\Models\Orders_item::where(['product_id' => $item->module_id, 'customer_id' => $item->customerid])->first();
                $data[$key]['checkOrder'] = !empty($checkOrder) ? 1 : 0;
            }
        }
        $ratings = \App\Models\Comment::where(['parentid' => 0, 'module' => 'products'])->sum('rating');
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.reviews', compact('seo', 'page', 'fcSystem', 'fields', 'data', 'ratings'));
    }
}
