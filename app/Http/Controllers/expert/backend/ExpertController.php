<?php

namespace App\Http\Controllers\expert\backend;

use App\Components\Nestedsetbie;
use App\Http\Controllers\Controller;
use App\Models\Expert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Components\Helper;
use App\Components\Polylang;
use App\Models\CategoryExpert;
use App\Models\Tag;
use Illuminate\Validation\Rule;
use App\Http\Requests\PostRequest;

class ExpertController extends Controller
{
    protected $Nestedsetbie;
    protected $Helper;
    protected $Polylang;
    protected $table = 'experts';
    public function __construct()
    {
        $this->Nestedsetbie = new Nestedsetbie(array('table' => 'category_experts'));
        $this->Helper = new Helper();
        $this->Polylang = new Polylang();
    }
    public function index(Request $request)
    {
        $module = $this->table;
        $data =  Expert::where(['alanguage' => config('app.locale')])
            ->with('user:id,name')
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'DESC');
        $keyword = $request->keyword;
        $type = $request->type;
        if (!empty($keyword)) {
            $data =  $data->where($this->table . '.title', 'like', '%' . $keyword . '%');
        }
        if (!empty($type)) {
            $data =  $data->where($this->table . '.' . $type,  1);
        }
        $data =  $data->select('experts.id', 'experts.image', 'experts.title', 'experts.slug', 'experts.catalogue_id', 'experts.userid_created', 'experts.created_at', 'experts.publish', 'experts.order', 'experts.ishome', 'experts.highlight', 'experts.isaside', 'experts.isfooter');
        $data =  $data->paginate(env('APP_paginate'));
        if (is($keyword)) {
            $data->appends(['keyword' => $keyword]);
        }
        //$htmlOption = $this->Nestedsetbie->dropdown([], config('app.locale'));
        $htmlOption = [];
        $configIs = \App\Models\Configis::select('title', 'type')->where(['module' => $this->table, 'active' => 1])->get();
        return view('expert.backend.expert.index', compact('data', 'module', 'htmlOption', 'configIs'));
    }
    public function create()
    {
        $dropdown = getFunctions();
        $module = $this->table;
        $action = 'create';
        $category_attribute = DB::table('category_attributes')
            ->select('id', 'title')
            ->where('alanguage', config('app.locale'))
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $listAttr = DB::table('attributes')
            ->select('id', 'title')
            ->where('alanguage', config('app.locale'))
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        if (old('attribute')) {
            $attribute = old('attribute');
        }
        $attribute_json = [];
        if (!empty($attribute)) {
            foreach ($attribute as $key => $value) {
                if ($value == '') {
                    $attribute_json[$key] = '';
                } else {
                    // $attribute_json[$key]['json'] = base64_encode(json_encode($value));
                    $attributes =  DB::table('attributes')->orderBy('order', 'asc')->orderBy('id', 'desc')->whereIn('id', $value)->get();
                    $temp = [];
                    if (!empty($attributes)) {
                        foreach ($attributes as $val) {
                            $temp[] = array(
                                'id' => $val->id,
                                'text' => $val->title,
                            );
                        }
                    }
                    $attribute_json[$key] = $temp;
                }
            }
        }
        $htmlAttribute = $this->Nestedsetbie->DropdownCatalogue($category_attribute, 'Chọn danh mục thuộc tính');
        //end tag
        $tags = Tag::select('id', 'title')->where('module', 'experts')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        $products = dropdown(\App\Models\Product::select('id', 'title')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get(), 'Chọn sản phẩm', 'id', 'title');
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        return view('expert.backend.expert.create', compact('module', 'tags', 'dropdown', 'action', 'field', 'products', 'listAttr', 'htmlAttribute', 'attribute_json'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            // 'slug' => 'required|unique:router,slug,' . config('app.locale') . ',alanguage',
            'slug' =>  ['required', Rule::unique('router')->where(function ($query) use ($request) {
                return $query->where('alanguage', config('app.locale'));
            })],
        ], [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'slug.required' => 'Đường dẫn bài viết là trường bắt buộc.',
            'slug.unique' => 'Đường dẫn bài viết đã tồn tại.',
        ]);
        if (!empty($request->file('image'))) {
            $image_url = uploadImageNone($request->file('image'), 'experts');
        } else {
            $image_url = $request->image_old;
        }
        $this->submit($request, 'create', 0, $image_url);
        return redirect()->route('experts.index')->with('success', "Thêm mới bài viết thành công");
    }
    public function edit($id)
    {
        $dropdown = getFunctions();
        $module = $this->table;
        $action = 'update';
        $detail  = Expert::where('alanguage', config('app.locale'))->find($id);
        if (!isset($detail)) {
            return redirect()->route('experts.index')->with('error', "Bài viết không tồn tại");
        }
        $category_attribute = DB::table('category_attributes')
            ->select('id', 'title')
            ->where('alanguage', config('app.locale'))
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        $htmlAttribute = $this->Nestedsetbie->DropdownCatalogue($category_attribute);
        //attr
        if (old('attribute')) {
            $attribute = old('attribute');
        } else {
            $version_json = json_decode(base64_decode($detail->version_json), true);
            $attribute = !empty($version_json[2]) ? $version_json[2] : [];
        }
        $attribute_json = [];
        if (!empty($attribute)) {
            foreach ($attribute as $key => $value) {
                if ($value == '') {
                    $attribute_json[$key] = '';
                } else {
                    // $attribute_json[$key]['json'] = base64_encode(json_encode($value));
                    $attributes =  DB::table('attributes')->orderBy('order', 'asc')->orderBy('id', 'desc')->whereIn('id', $value)->get();
                    $temp = [];
                    if (!empty($attributes)) {
                        foreach ($attributes as $val) {
                            $temp[] = array(
                                'id' => $val->id,
                                'text' => $val->title,
                            );
                        }
                    }
                    $attribute_json[$key] = $temp;
                }
            }
        }
        //end attr
        //tags
        $getTags = [];
        if (old('tags')) {
            $getTags = old('tags');
        } else {
            foreach ($detail->tags as $k => $v) {
                $getTags[] = $v['tag_id'];
            }
        }
        $tags = Tag::select('id', 'title')->where('module', 'experts')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        // $tags = relationships('\App\Models\Tag', $getTags);
        //end tag
        $getCatalogue = [];
        $getProduct = [];
        if (old('catalogue')) {
            $getCatalogue = old('catalogue');
        } else {
            $getCatalogue = json_decode($detail->catalogue);
        }
        if (old('products')) {
            $getProduct = old('products');
        } else {
            $getProduct = json_decode($detail->products);
        }
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        $products = dropdown(\App\Models\Product::select('id', 'title')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get(), 'Chọn sản phẩm', 'id', 'title');
        return view('expert.backend.expert.edit', compact('module', 'detail', 'tags', 'dropdown', 'htmlAttribute', 'getTags', 'action', 'getCatalogue', 'field', 'products', 'getProduct', 'attribute_json'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            // 'slug' => 'required|unique:router,slug,' . $id . ',moduleid,alanguage,' . config('app.locale') . '',
            'slug' => ['required', Rule::unique('router')->where(function ($query) use ($id) {
                return $query->where('moduleid', '!=', $id)->where('alanguage', config('app.locale'));
            })],
            //'catalogue_id' => 'required|gt:0',
        ], [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'slug.required' => 'Đường dẫn là trường bắt buộc.',
            'slug.unique' => 'Đường dẫn đã tồn tại.',
            //'catalogue_id.gt' => 'Danh mục chính là trường bắt buộc.',
        ]);
        //upload image
        if (!empty($request->file('image'))) {
            $image_url = uploadImage($request->file('image'), 'experts');
        } else {
            $image_url = $request->image_old;
        }
        //end
        $this->submit($request, 'update', $id, $image_url);
        return redirect()->route('experts.index')->with('success', "Cập nhập bài viết thành công");
    }
    
    public function submit($request = [], $action = '', $id = 0, $image_url = '')
    {
        if ($action == 'create') {
            $time = 'created_at';
            $user = 'userid_created';
        } else {
            $time = 'updated_at';
            $user = 'userid_updated';
        }

        // Thông tin thuộc tính
        $checkbox = isset($request['checkbox_val']) ? $request['checkbox_val'] : [];
        $attribute_catalogue = isset($request['attribute_catalogue']) ? $request['attribute_catalogue'] : [];
        $attribute = isset($request['attribute']) ? $request['attribute'] : [];

        //end
        $_data = [
            'title' => $request['title'],
            'slug' => $request['slug'],
            'image' => $image_url,
            'description' => $request['description'],
            'content' => $request['content'],
            'image_json' =>  !empty($request['album']) ? json_encode($request['album']) : '',
            'meta_title' => $request['meta_title'],
            'meta_description' => $request['meta_description'],
            'publish' => $request['publish'],
            'version_json' => base64_encode(json_encode(array($checkbox, $attribute_catalogue, $attribute))),
            $user => Auth::user()->id,
            $time => Carbon::now(),
            'alanguage' => config('app.locale'),
        ];
        if ($action == 'create') {
            $id = Expert::insertGetId($_data);
        } else {
            Expert::find($id)->update($_data);
        }
        if (!empty($id)) {
            //xóa khi cập nhập
            if ($action == 'update') {
                //xóa bảng router
                DB::table('router')->where(['moduleid' => $id, 'module' => $this->table])->delete();
                // xóa attributes_relationship
                DB::table('experts_attributes_relationships')->where('expert_id', $id)->delete();
                //xóa custom fields
                DB::table('config_postmetas')->where(['module_id' => $id, 'module' => $this->table])->delete();
                $this->Polylang->insert($this->table, $request['language'], $id);
            }
            //thêm router
            DB::table('router')->insert([
                'moduleid' => $id,
                'module' => $this->table,
                'slug' => $request['slug'],
                'created_at' => Carbon::now(),
                'alanguage' => config('app.locale'),
            ]);

            //thêm vào bảng experts_attributes_relationships
            $this->Helper->experts_attributes_relationships($id, $attribute, $attribute_catalogue);
            
            //START: custom fields
            fieldsInsert($this->table, $id, $request);
            //END
        }
    }

    public function check( PostRequest $request ){
        $params = $request->validated();
    }
}
