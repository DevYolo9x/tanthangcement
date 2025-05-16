<?php

namespace App\Http\Controllers\page\frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Article;
use App\Models\Patient;
use App\Models\Question;
use App\Models\Router;
use App\Models\Examination;
use App\Models\CategoryAttribute;
use App\Models\CategoryQuestion;
use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Components\System;
use App\Models\Orders_item;
use Carbon\Carbon;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
        $data = $data->orderBy('order', 'ASC')->orderBy('experts.id', 'desc')->paginate(20);

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
    
    public function history(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'history', 'publish' => 0])
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
        return view('page.frontend.history', compact('seo', 'page', 'fcSystem', 'fields'));
    }
    
    public function albums(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'album', 'publish' => 0])
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
        return view('page.frontend.album', compact('seo', 'page', 'fcSystem', 'fields'));
    }
    
    public function partner(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'parnter', 'publish' => 0])
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
        return view('page.frontend.partner', compact('seo', 'page', 'fcSystem', 'fields'));
    }
    
    public function privilege(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'privilege', 'publish' => 0])
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
        return view('page.frontend.privilege', compact('seo', 'page', 'fcSystem', 'fields'));
    }

    public function questions(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'question', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }

        $data = Question::where('alanguage', config('app.locale'))->with('catalogues')->where('publish', 0)->orderBy('order', 'ASC')->orderBy('id', 'desc')->paginate(20);

        $module = 'page_question';
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.questions', compact('seo', 'page', 'fcSystem', 'fields', 'module', 'data'));
    }

    public function askQuestion(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'question_form', 'publish' => 0])
            ->select('id', 'image', 'title', 'description', 'meta_title', 'meta_description')
            ->with('fields')
            ->first();

        $fields = [];
        if (!empty($page->fields)) {
            foreach ($page->fields as $item) {
                $fields[$item->meta_key] = !empty($item->meta_value) ? json_decode($item->meta_value) : [];
            }
        }

        $catQuestions = CategoryQuestion::where(['alanguage' => config('app.locale'), 'publish' => 0])->get();

        $module = 'page_question';
        $seo['canonical'] = url('/');
        $seo['meta_title'] = !empty($page['meta_title']) ? $page['meta_title'] : $page['title'];
        $seo['meta_description'] = !empty($page['meta_description']) ? $page['meta_description'] : '';
        $seo['meta_image'] = !empty($page['image']) ? url($page['image']) : '';
        $fcSystem = $this->system->fcSystem();
        return view('page.frontend.question_form', compact('seo', 'page', 'fcSystem', 'fields', 'module', 'catQuestions'));
    }

    public function create_askQuestion(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'description' => 'required',
            'catalogue_id' => 'required|gt:0',
        ], [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'name.required' => 'Họ và tên là trường bắt buộc.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email không đúng định dạng.',
            'description.required' => 'Nội dung câu hỏi là trường bắt buộc.',
            'slug.required' => 'Đường dẫn câu hỏi là trường bắt buộc.',
            'catalogue_id.required' => 'Danh mục là trường bắt buộc.',
            'catalogue_id.gt' => 'Danh mục là trường bắt buộc.',
        ]);
        // Check đường dẫn nếu tồn tại thêm nội dung vào sau
        $slug = Str::slug($request['title']);
        $router = Router::where(['slug' => $slug])->first();
        if( isset($router) ) {
            $slug .= '-'.time();
        }
        $_data = [
            'title' => $request['title'],
            'slug' => $slug,
            'name' => $request['name'],
            'age' => $request['age'],
            'address' => $request['address'],
            'email' => $request['email'],
            'catalogue_id' => $request['catalogue_id'],
            'description' => $request['description'],
            'meta_title' => $request['title'],
            'meta_description' => $request['meta_description'],
            'publish' => 0,
            'created_at' => Carbon::now(),
            'alanguage' => config('app.locale'),
        ];
        $id = Question::insertGetId($_data);
        if( $id > 0 ) {
            $module  = 'questions';
            // Xoá router cuxQQ
            DB::table('router')->where(['moduleid' => $id, 'module' => $module])->delete();
            DB::table('router')->insert([
                'moduleid' => $id,
                'module' => $module,
                'slug' => $slug,
                'created_at' => Carbon::now(),
                'alanguage' => config('app.locale'),
            ]);
            return redirect()->route('page.askQuestion')->with('success', "Đặt câu hỏi thành công!")->with('question_id', $id);;
        } else {
            return redirect()->route('page.askQuestion')->with('error', "Có lỗi, vui lòng thử lại!");
        }
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

        $detail = null;
        $error = false;
        $view = 'page.frontend.fidding';

        if( isset($request->code) ) {
            $detail = Patient::where(['code' => $request->code])->with('productDetail')->first();
            if( isset($detail) ) {
                $view = 'page.frontend.fidding_result';
            } else {
                $error = true;
            }            
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
        return view($view, compact('seo', 'page', 'fcSystem', 'fields', 'detail', 'error'));
    }
    
    public function certification(Request $request)
    {
        //page: HOME
        $page = Page::where(['alanguage' => config('app.locale'), 'page' => 'certification', 'publish' => 0])
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
        return view('page.frontend.certification', compact('seo', 'page', 'fcSystem', 'fields', 'getCity'));
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
