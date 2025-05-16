<?php

namespace App\Http\Controllers\product\backend;

use App\Components\Nestedsetbie;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CategoryProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Components\Helper;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    // $data = Product::select('id', 'slug', 'title')->get();
    // if (!empty($data)) {
    //     foreach ($data as $item) {
    //         $check = Product::where('slug', $item->slug)->first();
    //         if (!empty($check)) {
    //             Product::where('id', $item->id)->update(['slug' => slug($item->title) . '-' . $item->id]);
    //         } else {
    //             Product::where('id', $item->id)->update(['slug' => slug($item->title)]);
    //         }
    //     }
    // }
    // die;
    /* $data = Product::select('id', 'code', 'version_json', 'price', 'price_sale')->get();
        $address = \App\Models\Address::select('id')->where('alanguage', config('app.locale'))->get();
        $_insert_version = [];
        if (!empty($data)) {
            foreach ($data as $item) {
                $version_json = json_decode(base64_decode($item->version_json), true);
                $attribute = !empty($version_json[2]) ? $version_json[2] : [];
                if (!empty($attribute[0]) && !empty($attribute[1])) {
                    $news = collect($attribute[0])->crossJoin($attribute[1])->all();
                    if (!empty($news)) {
                        foreach ($news as $q => $n) {
                            $id_attr = Attribute::whereIn('id', $n)->pluck('id');
                            $title_attr = Attribute::whereIn('id', $n)->pluck('title');
                            $_insert_version[]  = array(
                                'product_id' => $item->id,
                                'id_version' => json_encode($id_attr),
                                'title_version' => json_encode($title_attr),
                                'code_version' => $item->code . '-' . $q,
                                'image_version' => '',
                                'price_version' => $item->price,
                                'price_sale_version' => $item->price_sale,
                                'price_import_version' => null,
                                '_stock_status' => 0,
                                // '_stock' => !empty($_stock[$key]) ? $_stock[$key] : '',
                                '_outstock_status' => 0,
                                '_ships_weight' => null,
                                '_ships_length' => null,
                                '_ships_width' => null,
                                '_ships_height' => null,
                                'created_at' => Carbon::now(),
                                'userid_created' => Auth::user()->id,
                            );
                        }
                    }
                }
            }
        }
        if (!empty($_insert_version)) {
            foreach ($_insert_version as $key => $item) {
                $id_insert = \App\Models\ProductVersion::insertGetId($item);
                if ($id_insert > 0) {
                    if (!empty($address)) {
                        foreach ($address as $ks => $vs) {
                            $_insert_stock[]  = array(
                                'address_id' => $vs->id,
                                'product_id' => $item['product_id'],
                                'product_version_id' => $id_insert,
                                'type' => 'variable',
                                'created_at' => Carbon::now(),
                                'user_id' => Auth::user()->id,
                            );
                        }
                    }
                }
            }
        }
        \App\Models\ProductStock::insert($_insert_stock);
        die; */
    /* $data = Product::select('id', 'attrs', 'catalogue')->get();
        if (!empty($data)) {
            foreach ($data as $item) {
                $checkbox = [];
                $attribute_catalogue = [];
                $attribute = [];
                $attrs = json_decode($item->attrs, TRUE);
                $i = 0;
                foreach ($attrs as $key => $a1) {
                    $checkbox[] = 1;
                    $cA = CategoryAttribute::select('id')->where('title', $key)->first();
                    $attribute_catalogue[] = $cA->id;
                    if (!empty($a1)) {
                        foreach ($a1 as $a) {
                            $attrID = Attribute::select('id')->where('title', $a)->first();
                            $attribute[$i][] = $attrID->id;
                        }
                    }
                    $i++;
                }
                // echo "<pre>";
                // var_dump($checkbox);
                // echo "<pre>";
                // var_dump($attribute_catalogue);
                // echo "<pre>";
                // var_dump($attribute);
                if (!empty($checkbox) && !empty($attribute_catalogue) && !empty($attribute)) {
                    Product::where('id', $item->id)->update(['type' => 'variable']);
                } else {
                    Product::where('id', $item->id)->update(['type' => 'simple']);
                }
                Product::where('id', $item->id)->update(['version_json' => base64_encode(json_encode(array($checkbox, $attribute_catalogue, $attribute)))]);
            }
        }
        die; */
    /* $_insert_attribute = [];
        if (!empty($data)) {
            foreach ($data as $item) {
                $catalogue = json_decode($item->catalogue, TRUE);
                $attrs = json_decode($item->attrs, TRUE);
                if (!empty($catalogue)) {
                    foreach ($catalogue as $c) {
                        if (!empty($attrs)) {
                            foreach ($attrs as $a1) {
                                if (!empty($a1)) {
                                    foreach ($a1 as $a) {
                                        $attrID = Attribute::select('id')->where('title', $a)->first();
                                        $_insert_attribute[] = array(
                                            'product_id' => $item->id,
                                            'attribute_id' => $attrID->id,
                                            'created_at' => Carbon::now(),
                                            'category_product_id' => $c
                                        );
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        DB::table('attributes_relationships')->insert($_insert_attribute);
        die; */
    /* foreach ($data as $item) {
            $attrs = json_decode($item->attrs, TRUE);
            if (!empty($attrs)) {
                foreach ($attrs as $key => $item) {

                    if ($key == 'colour') {
                        $catalogue_id = 13;
                    } else if ($key == 'size') {
                        $catalogue_id = 14;
                    }

                    if (!empty($item)) {
                        foreach ($item as $val) {
                            $check  = Attribute::where('title', $val)->first();
                            if (empty($check)) {
                                $_data = [
                                    'title' => $val,
                                    'slug' => slug($val),
                                    'catalogueid' => $catalogue_id,
                                    'publish' => 0,
                                    'userid_created' => Auth::user()->id,
                                    'created_at' => Carbon::now(),
                                    'alanguage' => config('app.locale'),
                                ];
                                $id = Attribute::insertGetId($_data);
                            }
                        }
                    }
                }
            }
        } */
    //xóa router products
    // Router::where('module', $this->table)->delete();
    // Catalogues_relationships::where('module', $this->table)->delete();
    // Tags_relationship::where('module', $this->table)->delete();
    // foreach ($data as $item) {
    //     Product::where('id', $item->id)->update(['price' => $item->price_sale, 'price_sale' => 0]);
    // }
    // $_insert = [];
    // foreach ($data as $item) {
    //     $_insert[] = array(
    //         'module_id' => $item->id,
    //         'tag_id'  => $item->tag_id,
    //         'module' => $this->table,
    //         'created_at' => Carbon::now(),
    //         'userid_created' => Auth::user()->id,
    //     );
    // }
    // DB::table('tags_relationships')->insert($_insert);
    // die;
    /*
    $data = Product::select('title', 'id', 'slug', 'catalogue', 'catalogue_id', 'price', 'price_sale', 'image_json')->get();
    foreach ($data as $item) {
            $images = json_decode($item->image_json, TRUE);
            if (!empty($images)) {
                foreach ($images as $key => $img) {
                    if ($key == 0) {
                        Product::where('id', $item->id)->update(['image' => $img]);
                    }
                }
            }
        }
        foreach ($data as $item) {
            $images = json_decode($item->image_json, TRUE);
            if (!empty($images)) {
                foreach ($images as $img) {
                    $exp = explode('?v=', $img);
                    $contents = file_get_contents($exp[0]);
                    $name = substr($exp[0], strrpos($exp[0], '/') + 1);
                    Storage::put(
                        $name,
                        $contents
                    );
                }
            }
        } */

    // die;


    /*foreach ($data as $item) {
            $image_json = [];
            $images = json_decode($item->image_json, TRUE);
            if (!empty($images)) {
                foreach ($images as $img) {
                    $image_json[] =  $img;
                }
            }
            Product::where('id', $item->id)->update(['image_json' => json_encode($image_json)]);
        } */
    /*if (!empty($data)) {
            foreach ($data as $item) {
                $check = \App\Models\Router::where('slug', slug($item->title))->first();
                DB::table('router')->insert([
                    'moduleid' => $item->id,
                    'module' => $this->table,
                    'slug' => !empty($check) ? slug($item->title) . '-' . $item->id : slug($item->title),
                    'created_at' => Carbon::now(),
                    'alanguage' => config('app.locale'),
                ]);
            }
        }
        $_catalogue_relation_ship = [];
        if (!empty($data)) {
            foreach ($data as $item) {
                $catalogues = json_decode($item['catalogue'], TRUE);

                if (!empty($catalogues)) {
                    foreach ($catalogues as $v) {
                        $_catalogue_relation_ship[] = array(
                            'module' => $this->table,
                            'moduleid' => $item->id,
                            'catalogueid' => $v,
                            'created_at' => Carbon::now(),
                        );
                    }
                }
            }
        }
        DB::table('catalogues_relationships')->insert($_catalogue_relation_ship);
        die;
 */
    protected $Nestedsetbie;
    protected $Brands;
    protected $Lang;
    protected $table = 'products';
    public function __construct()
    {
        $this->Nestedsetbie = new Nestedsetbie(array('table' => 'category_products'));
        $this->Brands = new Nestedsetbie(array('table' => 'brands'));
        $this->Helper = new Helper();
    }
    public function index(Request $request)
    {
        $module = $this->table;
        $htmlOption = $this->Nestedsetbie->dropdown([], config('app.locale'));
        $catalogueid = $request->catalogueid;
        $data =  Product::query()
            ->with('user:id,name')
            ->with(['relationships' => function ($query) {
                $query->select('catalogues_relationships.moduleid', 'category_products.title', 'category_products.id')
                    ->where('module', '=', $this->table)
                    ->join('category_products', 'category_products.id', '=', 'catalogues_relationships.catalogueid');
            }])
            ->where('alanguage', config('app.locale'))
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'DESC');
        $data = $data->join('catalogues_relationships', $this->table . '.id', '=', 'catalogues_relationships.moduleid')->where('catalogues_relationships.module', '=', $this->table);
        if (!empty($catalogueid)) {
            $data =  $data->where('catalogues_relationships.catalogueid', $catalogueid);
        }
        $data =  $data->select(
            'products.id',
            'products.title',
            'products.slug',
            'products.image',
            'products.price',
            'products.price_sale',
            'products.price_contact',
            'products.order',
            'products.publish',
            'products.ishome',
            'products.highlight',
            'products.isaside',
            'products.isfooter',
            'products.userid_created',
            'products.created_at',
            'catalogues_relationships.catalogueid',

        );
        $data =  $data->groupBy('catalogues_relationships.moduleid');
        $data =  $data->paginate(env('APP_paginate'));
        if (is($catalogueid)) {
            $data->appends(['catalogueid' => $catalogueid]);
        }
        $dropdown = getFunctions();
        $tags = \App\Models\Tag::select('id', 'title')->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        $brands = \App\Models\Brand::select('id', 'title')->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        $configIs = \App\Models\Configis::select('title', 'type')->where(['module' => $this->table, 'active' => 1])->get();
        return view('product.backend.product.index', compact('data', 'module', 'htmlOption', 'tags', 'brands', 'dropdown', 'configIs'));
    }
    public function create()
    {
        $module = $this->table;
        $dropdown = getFunctions();
        $htmlCatalogue = $this->Nestedsetbie->dropdown([], config('app.locale'));
        $htmlBrands = $this->Brands->dropdown();
        $category_attribute = DB::table('category_attributes')
            ->select('id', 'title')
            ->where('id', '!=', 1)
            ->where('alanguage', config('app.locale'))
            ->get();
        //tag
        $getTags = [];
        if (old('tags')) {
            $getTags = old('tags');
        }
        $tags = \App\Models\Tag::select('id', 'title')->where('module', 'products')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        //end
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
        $htmlAttribute = $this->Nestedsetbie->DropdownCatalogue($category_attribute);
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        return view('product.backend.product.create', compact('field', 'module', 'htmlCatalogue', 'htmlAttribute', 'tags', 'getTags', 'htmlBrands', 'attribute_json', 'dropdown'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            // 'slug' => 'required|unique:router,slug,' . config('app.locale') . ',alanguage',
            'slug' =>  ['required', Rule::unique('router')->where(function ($query) use ($request) {
                return $query->where('alanguage', config('app.locale'));
            })],
            'code' => 'unique:products',
            'catalogue_id' => 'required|gt:0',
        ], [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'slug.required' => 'Đường dẫn là trường bắt buộc.',
            'slug.unique' => 'Đường dẫn đã tồn tại.',
            'code.unique' => 'Mã sản phẩm đã tồn tại.',
            'catalogue_id.gt' => 'Danh mục chính là trường bắt buộc.',
        ]);
        //upload image
        if (!empty($request->file('image'))) {
            $image_url = uploadImage($request->file('image'), 'san-pham');
        } else {
            $image_url = $request->image_old;
        }
        //end

        $this->submit($request, 'create', 0, $image_url);
        return redirect()->route('products.index')->with('success', "Thêm mới sản phẩm thành công");
    }
    public function edit($id)
    {
        $module = $this->table;
        $dropdown = getFunctions();
        $detail  = Product::where('alanguage', config('app.locale'))->find($id);
        if (!isset($detail)) {
            return redirect()->route('products.index')->with('error', "Sản phẩm không tồn tại");
        }
        $htmlCatalogue = $this->Nestedsetbie->dropdown([], config('app.locale'));
        $category_attribute = DB::table('category_attributes')
            ->select('id', 'title')
            ->where('alanguage', config('app.locale'))
            ->where('id', '!=', 1)
            ->get();
        $htmlAttribute = $this->Nestedsetbie->DropdownCatalogue($category_attribute);
        //tags
        $getTags = [];
        if (old('tags')) {
            $getTags = old('tags');
        } else {
            foreach ($detail->tags as $k => $v) {
                $getTags[] = $v['tag_id'];
            }
        }
        $tags = \App\Models\Tag::select('id', 'title')->where('module', 'products')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        //end tag
        //brands
        $htmlBrands = $this->Brands->dropdown();
        //end brand
        //attr
        if (old('attribute')) {
            $attribute = old('attribute');
        } else {
            $version_json = json_decode(base64_decode($detail->version_json), true);
            $attribute = $version_json[2];
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
        $getCatalogue = [];
        if (old('catalogue')) {
            $getCatalogue = old('catalogue');
        } else {
            $getCatalogue = json_decode($detail->catalogue);
        }
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        return view('product.backend.product.edit', compact('field', 'module', 'getCatalogue', 'detail', 'htmlCatalogue', 'htmlAttribute', 'tags', 'getTags', 'htmlBrands',  'attribute_json', 'dropdown'));
    }
    public function copy($id)
    {
        $module = $this->table;
        $dropdown = getFunctions();
        $detail  = Product::where('alanguage', config('app.locale'))->find($id);
        if (!isset($detail)) {
            return redirect()->route('products.index')->with('error', "Sản phẩm không tồn tại");
        }
        $htmlCatalogue = $this->Nestedsetbie->dropdown([], config('app.locale'));
        $category_attribute = DB::table('category_attributes')
            ->select('id', 'title')
            ->where('alanguage', config('app.locale'))
            ->where('id', '!=', 1)
            ->get();
        $htmlAttribute = $this->Nestedsetbie->DropdownCatalogue($category_attribute);
        //tags
        $getTags = [];
        if (old('tags')) {
            $getTags = old('tags');
        } else {
            foreach ($detail->tags as $k => $v) {
                $getTags[] = $v['tag_id'];
            }
        }
        $tags = \App\Models\Tag::select('id', 'title')->where('module', 'products')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        //end tag
        //brands
        $htmlBrands = $this->Brands->dropdown();
        //end brand
        //attr
        if (old('attribute')) {
            $attribute = old('attribute');
        } else {
            $version_json = json_decode(base64_decode($detail->version_json), true);
            $attribute = $version_json[2];
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
        $getCatalogue = [];
        if (old('catalogue')) {
            $getCatalogue = old('catalogue');
        } else {
            $getCatalogue = json_decode($detail->catalogue);
        }
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $module])->get();
        return view('product.backend.product.copy', compact('field', 'module', 'getCatalogue', 'detail', 'htmlCatalogue', 'htmlAttribute', 'tags', 'getTags', 'htmlBrands', 'attribute_json', 'dropdown'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            //'slug' => 'required|unique:router,slug,' . $id . ',moduleid,alanguage,' . config('app.locale') . '',
            'slug' => ['required', Rule::unique('router')->where(function ($query) use ($id) {
                return $query->where('moduleid', '!=', $id)->where('alanguage', config('app.locale'));
            })],
            'code' => 'unique:products,code,' . $id . ',id',
            'catalogue_id' => 'required|gt:0',
        ], [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'slug.required' => 'Đường dẫn là trường bắt buộc.',
            'slug.unique' => 'Đường dẫn đã tồn tại.',
            'code.unique' => 'Mã sản phẩm đã tồn tại.',
            'catalogue_id.gt' => 'Danh mục chính là trường bắt buộc.',
        ]);
        //upload image
        if (!empty($request->file('image'))) {
            $image_url = uploadImage($request->file('image'), 'san-pham');
        } else {
            $image_url = $request->image_old;
        }
        //end
        $this->submit($request, 'update', $id, $image_url);
        return redirect()->route('products.index')->with('success', "Cập nhập sản phẩm thành công");
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
        //lấy danh mục phụ
        $catalogue = $request['catalogue'];
        $tmp_catalogue = [];
        if (isset($catalogue)) {
            foreach ($catalogue as $v) {
                if ($v != 0 && $v != $request['catalogue_id']) { //check id != 0 và id != danh mục chính
                    $tmp_catalogue[] = $v;
                }
            }
        }
        //lấy danh mục cha (nếu có)
        $detail = CategoryProduct::select('id', 'title', 'slug', 'lft')->where('id', $request['catalogue_id'])->first();
        $breadcrumb = CategoryProduct::select('id', 'title')->where('alanguage', config('app.locale'))->where('lft', '<=', $detail->lft)->where('rgt', '>=', $detail->lft)->orderBy('lft', 'ASC')->orderBy('order', 'ASC')->get();
        if ($breadcrumb->count() > 0) {
            foreach ($breadcrumb as $v) {
                $tmp_catalogue[] = $v->id;
            }
        }
        $tmp_catalogue = array_unique($tmp_catalogue);
        // dd($tmp_catalogue);
        //end
        //version
        $checkbox = isset($request['checkbox_val']) ? $request['checkbox_val'] : [];
        $attribute_catalogue = isset($request['attribute_catalogue']) ? $request['attribute_catalogue'] : [];
        $attribute = isset($request['attribute']) ? $request['attribute'] : [];
        dd($attribute);
        //data create - update
        $_data_product = [
            'title' => $request['title'],
            'slug' => $request['slug'],
            'description' => $request['description'],
            'content' => $request['content'],
            'code' => is($request['code']),
            'price' => isset($request['price']) ? str_replace('.', '', $request['price']) : 0,
            'price_sale' => str_replace('.', '', $request['price_sale']),
            'price_contact' => isset($request['price_contact']) ? $request['price_contact'] : 0,
            //inventory
            'inventory' => isset($request['inventory']) ? $request['inventory'] : 0,
            'inventoryPolicy' => isset($request['inventoryPolicy']) ? $request['inventoryPolicy'] : 0,
            'inventoryQuantity' => $request['inventoryQuantity'],
            'image_json' =>  !empty($request['album']) ? json_encode($request['album']) : '',
            'brand_id' => $request['brand_id'],
            'catalogue_id' => $request['catalogue_id'],
            'catalogue' => json_encode($tmp_catalogue),
            'image' => $image_url,
            'meta_title' => $request['meta_title'],
            'meta_description' => $request['meta_description'],
            'publish' => $request['publish'],
            $user => Auth::user()->id,
            $time => Carbon::now(),
            'version_json' => base64_encode(json_encode(array($checkbox, $attribute_catalogue, $attribute))),
            'alanguage' => config('app.locale'),
        ];
        if ($action == 'create') {
            $id = Product::insertGetId($_data_product);
        } else {
            DB::table('products')->where('id', '=', $id)->update($_data_product);
        }
        if (!empty($id)) {
            /*xóa khi cập nhập*/
            if ($action == 'update') {
                /*xóa catalogue_relationship*/
                DB::table('catalogues_relationships')->where('moduleid', $id)->where('module', $this->table)->delete();
                /*xóa tags_relationship*/
                DB::table('tags_relationships')->where('module_id', $id)->where('module', $this->table)->delete();
                /*xóa brands_relationship*/
                DB::table('brands_relationships')->where('product_id', $id)->delete();
                /*xóa attribute_relationship*/
                DB::table('attributes_relationships')->where('moduleid', $id)->delete();
                /*Xóa  products_versions*/
                DB::table('products_versions')->where('productid', $id)->delete();
                /*Xóa products_colors and products_sizes */
                DB::table('products_sizes')->where('product_id', $id)->delete();
                DB::table('products_colors')->where('product_id', $id)->delete();
                /*xóa router*/
                DB::table('router')->where('moduleid', $id)->where('module', $this->table)->delete();
                //xóa custom fields
                DB::table('config_postmetas')->where(['module_id' => $id, 'module' => $this->table])->delete();
            }
            //thêm router
            DB::table('router')->insert([
                'moduleid' => $id,
                'module' => $this->table,
                'slug' => $request['slug'],
                'created_at' => Carbon::now(),
                'alanguage' => config('app.locale'),
            ]);
            //thêm vào bảng catalogue_relationship
            $this->Helper->catalogue_relation_ship($id, $request['catalogue_id'], $tmp_catalogue, $this->table);
            //thêm vào bảng brands_relationships
            $this->Helper->brands_relationships($id, $request['brand_id'], $tmp_catalogue);
            //end
            //thêm vào bảng tags_relationships
            $this->Helper->tags_relationships($id, $request['tags'], $this->table);
            //end
            //thêm product_version
            /* $this->Helper->create_product_version(array(
                'title_version_1' => $request['title_version_1'],
                'title_version_2' => $request['title_version_2'],
                'id_version' => $request['id_version'],
                'title_version' => $request['title_version'],
                'code_version' => $request['code_version'],
                'image_version' => $request['image_version'],
                'price_version' => $request['price_version'],
                'price_sale_version' => $request['price_sale_version'],
                '_stock_status' => $request['_stock_status'],
                '_stock' => $request['_stock'],
                '_outstock_status' => $request['_outstock_status'],
                'productid' => $id,
            )); */
            //thêm nhóm thuộc tính vào nhóm sản phẩm
            /*$this->Helper->update_attribute_catalogue_in_product_catalogue(array(
                'catalogueid' => $request['catalogue_id'],
                'tmp_catalogue' => $tmp_catalogue,
                'attribute_catalogue' => $attribute_catalogue,
                'attribute' => $attribute,
            )); */
            //thêm vào bảng attributes_relationships
            $this->Helper->attributes_relationships($id, $attribute, $tmp_catalogue);
            //thêm sản phẩm vào khoảng giá
            $this->Helper->price_attributes((float)str_replace('.', '', $request['price']), $id);


            //new: thêm version table product_color and product_size
            /* $colors =  $request['colors'];
            $sizes =  $request['sizes'];
            $color_page = $this->convert_color($colors, $sizes);
            $color_size_insert = [];
            if (isset($color_page) && is_array($color_page) && count($color_page)) {
                foreach ($color_page as $keyc => $vals) {
                    $tmp_status[$keyc] = [];
                    $totalSizeOfColor = 0;
                    $color_id = \App\Models\products_color::insertGetId([
                        'title' => $vals['title'],
                        'image' => $vals['image'],
                        'product_id' => $id,
                        'stock' => 0,
                        $user => Auth::user()->id,
                        $time => Carbon::now(),
                    ]);
                    if (isset($vals['page']) && is_array($vals['page']) && count($vals['page'])) {
                        foreach ($vals['page'] as $key => $val) {
                            $totalSizeOfColor += $val['_stock'];
                            $color_size_insert[] = array(
                                'title' => $val['title'],
                                'title_color' => $vals['title'] . '/' . $val['title'],
                                'code' => $val['code'],
                                'price' => isset($val['price']) ? str_replace('.', '', $val['price']) : 0,
                                'price_sale' => isset($val['price_sale']) ? str_replace('.', '', $val['price_sale']) : 0,
                                '_stock_status' => $val['_stock_status'],
                                '_stock' =>  $val['_stock'],
                                '_outstock_status' => $val['_outstock_status'],
                                'color_id' => $color_id,
                                'product_id' => $id,
                                $user => Auth::user()->id,
                                $time => Carbon::now(),
                            );

                            if ($val['_stock_status'] == 0 || $val['_outstock_status'] == 1) {
                                $tmp_status[$keyc][] = $vals['title'] . '/' . $val['title'];
                            }
                            if ($totalSizeOfColor > 0) {
                                $tmp_status[$keyc][] = $vals['title'] . '/' . $val['title'];
                            }
                        }
                    }
                    // echo "<pre>";var_dump($tmp_status[$keyc]);
                    // echo "<pre>";var_dump($totalSizeOfColor);
                    if (!empty($tmp_status[$keyc])) {
                        DB::table('products_colors')->where('id', '=', $color_id)->update([
                            'stock' => 1,
                        ]);
                    }
                }
                DB::table('products_sizes')->insert($color_size_insert);
            } */
            //end
            //START: custom fields
            fieldsInsert($this->table, $id, $request);
            //END

        }
    }
    public function convert_color($color = '', $size = '')
    {
        //vòng lặp của color
        $tempColor = [];
        if (isset($color['title']) && is_array($color['title'])  && count($color['title'])) {
            foreach ($color['title'] as $key => $val) {
                $tempColor[] = array('title' => $val);
            }
        }
        if (isset($tempColor) && is_array($tempColor) && count($tempColor)) {
            foreach ($tempColor as $key => $val) {
                $tempColor[$key]['title'] = $color['title'][$key];
                $tempColor[$key]['image'] = $color['image'][$key];
                $tempColor[$key]['count'] = $color['count'][$key];
            }
        }
        //vòng lặp của size
        $tempSize = [];
        if (isset($size['title']) && is_array($size['title'])  && count($size['title'])) {
            foreach ($size['title'] as $key => $val) {
                $tempSize[] = array('title' => $val);
            }
        }
        if (isset($tempSize) && is_array($tempSize) && count($tempSize)) {
            foreach ($tempSize as $key => $val) {
                $tempSize[$key]['title'] = $size['title'][$key];
                $tempSize[$key]['code'] = $size['code'][$key];
                $tempSize[$key]['price'] = $size['price'][$key];
                $tempSize[$key]['price_sale'] = $size['price_sale'][$key];
                $tempSize[$key]['_stock_status'] = $size['_stock_status'][$key];
                $tempSize[$key]['_stock'] = $size['_stock'][$key];
                $tempSize[$key]['_outstock_status'] = $size['_outstock_status'][$key];
            }
        }
        $array = [];
        if (isset($tempColor) && is_array($tempColor) && count($tempColor)) {
            $j = $i = 0;
            foreach ($tempColor as $key => $val) {
                $array[$key]['title'] = $val['title'];
                $array[$key]['image'] = $val['image'];
                $j = $j + $val['count'];
                $page = [];
                if (isset($tempSize) && is_array($tempSize) && count($tempSize)) {
                    foreach ($tempSize as $keyS => $valS) {
                        if ($keyS < $j && $keyS >= $i) {
                            $page[$keyS] = $valS;
                            $i++;
                        }
                    }
                    $page = array_values($page);
                }
                $array[$key]['page'] = $page;
            }
        }
        return $array;
    }
    public function get_attrid(Request $request)
    {
        $catalogue_id = $request->catalogue_id;
        $detailCatalogue = DB::table('category_products')->select('id', 'attrid')->where('id', '=', $catalogue_id)->first();
        $attribute_catalogue = getListAttr($detailCatalogue->attrid);
        $html = '';
        if (check_array($attribute_catalogue)) {
            foreach ($attribute_catalogue as $key => $val) {
                if (count($val) > 1) {
                    $html = $html . '<li class="catalogue mb-3" data-keyword = ' . $val['keyword_cata'] . '>';
                    $html = $html . '<label class="form-label text-base font-semibold">' . $key . '</label>';
                    $html = $html . '<div class="grid grid-cols-12 gap-6" >';
                    foreach ($val as $sub => $subs) {
                        if ($sub != 'keyword_cata') {
                            $html = $html . '<div class="col-span-3">';
                            $html = $html . '<div class="attr cursor-pointer">';
                            $html = $html . '<input disabled="disabled"  class="checkbox-item filter mr-2" type="checkbox" name="attr[]" value="' . $sub . '"><span style="margin-left: -24px;padding-left: 24px;">';
                            $html = $html . $subs;
                            $html = $html . '</span></div>';
                            $html = $html . '</div>';
                        }
                    }
                    $html = $html . '</div>';
                    $html = $html . '</li>';
                }
            }
        }
        echo json_encode(array(
            'attribute_catalogue' => $html,
        ));
        die();
    }
    public function listproduct(Request $request)
    {
        $data =  Product::where('alanguage', config('app.locale'))->orderBy('order', 'ASC')->orderBy('id', 'DESC');
        $keyword = $request->keyword;
        $brand = $request->brand;
        $tag = $request->tag;
        $request_attr = $request->attr;
        $type = $request->type;
        if (!empty($keyword)) {
            $data =  $data->where('products.title', 'like', '%' . $keyword . '%');
            $data =  $data->orWhere('products.code', 'like', '%' . $keyword . '%');
        }
        if (!empty($type)) {
            $data =  $data->where('products.' . $type, 1);
        }
        //xử lý danh mục
        if (!empty($request->catalogue_id)) {
            $data = $data->join('catalogues_relationships', 'products.id', '=', 'catalogues_relationships.moduleid')->where('catalogues_relationships.module', '=', $this->table);
            $data =  $data->where('catalogues_relationships.catalogueid', $request->catalogue_id);
        }
        //xử lý khoảng giá
        $request->start_price = (int)str_replace('.', '', $request->start_price);
        $request->end_price = (int)str_replace('.', '', $request->end_price);
        if (isset($request->start_price) && !empty($request->end_price)) {
            $data =  $data->where('products.price', '>=', $request->start_price);
            $data =  $data->where('products.price', '<=', $request->end_price);
        }
        //xử lý tags
        if (!empty($brand)) {
            $data = $data->join('brands_relationships', 'products.id', '=', 'brands_relationships.product_id');
            $data =  $data->whereIn('brands_relationships.brand_id', $brand);
        }
        //xử lý tags
        if (!empty($tag)) {
            $data = $data->join('tags_relationships', 'products.id', '=', 'tags_relationships.module_id')->where('tags_relationships.module', '=', $this->table);
            $data =  $data->whereIn('tags_relationships.tag_id', $tag);
        }
        //xử lý thuộc tính
        if (!empty($request_attr)) {
            $attr = explode(';', $request_attr);
            foreach ($attr as $key => $val) {
                if ($key % 2 == 0) {
                    if ($val != '') {
                        $attribute[$val][] = $attr[$key + 1];
                    }
                } else {
                    continue;
                }
            }
            $total = 0;
            $index = 100;
            foreach ($attribute as $key => $val) {
                $total++;
                $index++;
                foreach ($val as $subs) {
                    $index = $index + $total;
                    $data = $data->join('attributes_relationships as tb' . $index . '', 'products.id', '=', 'tb' . $index . '.product_id');
                }
                $data =  $data->whereIn('tb' . $index . '.attrid', $val);
            }
            $data =  $data->groupBy('tb102.moduleid');
        }
        $data =  $data->groupBy('catalogues_relationships.moduleid');
        $data =  $data->paginate(env('APP_paginate'));
        $configIs = \App\Models\Configis::select('title', 'type')->where(['module' => $this->table, 'active' => 1])->get();

        return view('product.backend.product.index.data', compact('data', 'configIs'))->render();
    }
}
