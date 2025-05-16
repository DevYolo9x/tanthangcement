<?php

namespace App\Http\Controllers\product\backend;

use App\Components\Nestedsetbie;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\ProductVersion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Components\Helper;
use App\Components\Polylang;
use App\Exports\ProductExport;
use App\Models\Attribute;
use App\Models\Catalogues_relationships;
use App\Models\CategoryAttribute;
use App\Models\ProductTmp;
use App\Models\Router;
use App\Models\Tag;
use App\Models\Tags_relationship;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\View;
use Storage;

class ProductController extends Controller
{
    protected $Nestedsetbie;
    protected $Brands;
    protected $table = 'products';
    protected $Helper;
    protected $Polylang;
    public function __construct()
    {
        $this->Nestedsetbie = new Nestedsetbie(array('table' => 'category_products'));
        $this->Helper = new Helper();
        $this->Polylang = new Polylang();
        $this->Brands = new Nestedsetbie(array('table' => 'brands'));
        $taxesType = array(
            'notax' => 'Giá chưa bao gồm thuế',
            'tax' => 'Giá đã bao gồm thuế',
        );
        View::share([
            'taxesType' => $taxesType,
            'dropdown' => getFunctions()
        ]);
    }

    public function index(Request $request)
    {
        $module = $this->table;
        //call url
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://127.0.0.1:5000/products',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, TRUE);
        foreach ($response as $item) {
            $_data = [
                'name' => $item['name'],
                'tag_name' => $item['tag_name'],
                'link' => $item['link'] . '.js',
                'category_id' => json_encode($item['category_id']),
            ];
            ProductTmp::insert($_data);
        }
        //end call
        die;
        //API
        $data = ProductTmp::where('status', null)->orderBy('id', 'asc')->paginate(1000);
        foreach ($data as $item) {
            $catalogue_id = json_decode($item->category_id);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $item->link,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response, TRUE);
            if (!empty($response)) {
                //lay ma san pham
                $type = 'simple';
                if (!empty($response['options'])) {
                    if (count($response['options']) > 2) {
                        $type = 'variable';
                    }
                }
                //image_json
                $image_json = [];
                if (!empty($response['images'])) {
                    foreach ($response['images'] as $image) {
                        if (!strpos($image, 'icon')) {
                            $image_json[] = $image;
                        }
                    }
                }
                //thêm tag $response['vendor']
                $checkTag = Tag::where('title', $response['vendor'])->first();
                $tag_id = [];
                if (empty($checkTag)) {
                    $tag_id[] = Tag::insertGetId([
                        'title' => $response['vendor'],
                        'slug' => slug($response['vendor']),
                        'module' => 'products',
                        'publish' => 0,
                        'userid_created' => Auth::user()->id,
                        'created_at' => Carbon::now(),
                        'alanguage' => config('app.locale'),
                    ]);
                } else {
                    $tag_id[] = $checkTag->id;
                }
                //attributes
                if (!empty($response['options'])) {
                    $attributes = collect($response['options'])->filter(function ($value, $key) {
                        return $value['name'] == 'Kích thước';
                    })->pluck('values')->all();
                }
                $attr_id = [];
                if (!empty($attributes[0])) {
                    foreach ($attributes[0] as $attr) {
                        $checkAttr = Attribute::where('title', $attr)->first();
                        if (empty($checkAttr)) {
                            $attr_id[] = Attribute::insertGetId([
                                'title' => $attr,
                                'slug' => slug($attr),
                                'catalogueid' => 14,
                                'publish' => 0,
                                'userid_created' => Auth::user()->id,
                                'created_at' => Carbon::now(),
                                'alanguage' => config('app.locale'),
                            ]);
                        } else {
                            $attr_id[] = $checkAttr->id;
                        }
                    }
                }
                //version_json
                $checkbox[] = 1;
                $attribute_catalogue[] = 14;
                $attribute[] = $attr_id;
                //thêm sản phẩm
                $code = CodeRender('products');
                if ($response['price_max'] > $response['price_min']) {
                    $price_sale = $response['price_min'] / 100;
                } else {
                    $price_sale = 0;
                }
                $_data = [
                    'title' => $response['title'],
                    'slug' => $response['handle'],
                    'description' => $response['description'],
                    'code' => $code,
                    'image' => $response['featured_image'],
                    'image_json' =>  json_encode($image_json),
                    'catalogue_id' => $catalogue_id[1],
                    'catalogue' => $item->category_id,
                    'price' => isset($response['price_max']) ?  $response['price_max'] / 100 : 0,
                    'price_sale' => $price_sale,
                    'price_contact' => 0,
                    'publish' => 0,
                    'userid_created' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'version_json' => base64_encode(json_encode(array($checkbox, $attribute_catalogue, $attribute))),
                    'alanguage' => 'vi',
                    'type' => $type,
                    'meta_title'  => $response['pagetitle'],
                    'meta_description'  => $response['metadescription'],
                    'website' => 'maisononline'
                ];
                $id = Product::insertGetId($_data);
                if ($id > 0) {
                    //thêm router
                    DB::table('router')->insert([
                        'moduleid' => $id,
                        'module' => $this->table,
                        'slug' => $response['handle'],
                        'created_at' => Carbon::now(),
                        'alanguage' => 'vi',
                    ]);
                    //thêm vào bảng catalogue_relationship
                    $this->Helper->catalogue_relation_ship($id, $catalogue_id[1], $catalogue_id, $this->table);
                    //thêm vào bảng tags_relationships
                    $this->Helper->tags_relationships($id, $tag_id, $this->table);
                    //thêm vào bảng attributes_relationships

                    $this->Helper->attributes_relationships($id, $attribute, $catalogue_id);

                    $address = \App\Models\Address::select('id')->where('alanguage', config('app.locale'))->get();
                    $_insert_version = [];
                    if (!empty($attr_id)) {
                        foreach ($attr_id as $q => $n) {
                            $id_attr = Attribute::where('id', $n)->pluck('id');
                            $title_attr = Attribute::where('id', $n)->pluck('title');

                            $_insert_version[]  = array(
                                'product_id' => $id,
                                'id_version' => json_encode($id_attr),
                                'title_version' => json_encode($title_attr),
                                'code_version' => $code . '-' . $q,
                                'image_version' => '',
                                'price_version' => isset($response['price_max']) ?  $response['price_max'] / 100 : 0,
                                'price_sale_version' => $price_sale,
                                'price_import_version' => null,
                                '_stock_status' => 0,
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
                    if (!empty($_insert_version)) {
                        foreach ($_insert_version as $key => $version) {
                            $id_insert = \App\Models\ProductVersion::insertGetId($version);
                            if ($id_insert > 0) {
                                if (!empty($address)) {
                                    foreach ($address as $ks => $vs) {
                                        $_insert_stock[]  = array(
                                            'address_id' => $vs->id,
                                            'product_id' => $id,
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
                }
            }
            //xong cập nhập trạng thái
            ProductTmp::where('id', $item->id)->update(['status' => 'done']);
        }
        //END: API

        return view('product.backend.product.index_tmp', compact('module', 'data'));
    }
    public function create(Request $request)
    {
        $module = $this->table;
        $category_attribute = DB::table('category_attributes')
            ->select('id', 'title')
            ->where('ishome', 0)
            ->where('alanguage', config('app.locale'))
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();
        //tag
        $getTags = [];
        if (old('tags')) {
            $getTags = old('tags');
        }
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
        $htmlAttribute = $this->Nestedsetbie->DropdownCatalogue($category_attribute, 'Chọn danh mục thuộc tính');
        $address = \App\Models\Address::select('id', 'title', 'cityid', 'districtid', 'wardid')
            ->with(['city_name', 'district_name', 'ward_name'])
            ->with(['stocks' => function ($query) {
                $query->where('product_id', '=', 0);
            }])
            ->orderBy('active', 'desc')
            ->orderBy('id', 'desc')
            ->get();
        $listTaxes = \App\Models\Tax::select('id', 'title', 'value')->where('id', '!=', 1)->get();
        $catalogues = $this->Nestedsetbie->dropdown([], config('app.locale'));
        $brands =  $this->Brands->dropdown();
        $tags = \App\Models\Tag::select('id', 'title')->where('module', 'products')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $this->table])->get();
        return view('product.backend.product.create', compact('field', 'module', 'catalogues', 'tags', 'brands', 'address', 'listTaxes', 'htmlAttribute', 'getTags',  'attribute_json'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            // 'slug' => 'required|unique:router,slug,' . config('app.locale') . ',alanguage',
            'slug' =>  ['required', Rule::unique('router')->where(function ($query) use ($request) {
                return $query->where('alanguage', config('app.locale'));
            })],
            'code' => 'required|unique:products',
            'catalogueid' => 'required|gt:0',
        ], [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'code.required' => 'Mã sản phẩm là trường bắt buộc.',
            'code.unique' => 'Mã sản phẩm đã tồn tại.',
            'slug.required' => 'Đường dẫn là trường bắt buộc.',
            'slug.unique' => 'Đường dẫn đã tồn tại.',
            'catalogueid.required' => 'Danh mục chính là trường bắt buộc.',
            'catalogueid.gt' => 'Danh mục chính là trường bắt buộc.',
        ]);

        //upload image
        if (!empty($request->file('image'))) {
            $image_url = uploadImage($request->file('image'), 'products');
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
        $detail  = Product::where('alanguage', config('app.locale'))
            ->with(['product_versions' => function ($query) {
                $query->with(['product_stocks']);
            }])
            ->with(['product_versions'])
            ->with(['TaxesRelationships'])
            // ->with(['product_stock_histories' => function ($query) {
            //     $query->with(['user', 'product_versions', 'address'])->paginate(1);
            // }])
            ->with(['product_stocks' => function ($query) {
                $query->where('type', 'simple');
            }])
            ->find($id);

        if (!isset($detail)) {
            return redirect()->route('products.index')->with('error', "Sản phẩm không tồn tại");
        }
        // $product_stock_histories = \App\Models\ProductStockHistory::where('product_id', $detail->id)->with(['user', 'product_versions', 'address'])->paginate(1);
        $product_stocks = $detail->product_stocks->groupBy('product_version_id');
        $category_attribute = DB::table('category_attributes')
            ->select('id', 'title')
            ->where('alanguage', config('app.locale'))
            ->where('ishome', 0)
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
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
        //end tag
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
        $getCatalogue = [];
        if (old('catalogue')) {
            $getCatalogue = old('catalogue');
        } else {
            $getCatalogue = json_decode($detail->catalogue);
        }
        $address = \App\Models\Address::select('id', 'title', 'cityid', 'districtid', 'wardid')
            ->where('alanguage', config('app.locale'))
            ->with(['city_name', 'district_name', 'ward_name'])
            ->with(['stocks' => function ($query) use ($id) {
                $query->where('product_id', '=', $id)->where('type', '=', 'simple');
            }])
            ->orderBy('active', 'desc')
            ->orderBy('id', 'desc')
            ->get();
        $listTaxes = \App\Models\Tax::select('id', 'title', 'value')->where('id', '!=', 1)->get();
        $catalogues = $this->Nestedsetbie->dropdown([], config('app.locale'));
        $brands =  $this->Brands->dropdown();
        $tags = \App\Models\Tag::select('id', 'title')->where('module', 'products')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $this->table])->get();
        return view('product.backend.product.edit', compact('field', 'catalogues', 'brands', 'tags', 'module', 'address', 'listTaxes', 'getCatalogue', 'detail', 'htmlAttribute', 'getTags',  'attribute_json', 'product_stocks'));
    }
    public function copy($id)
    {
        $module = $this->table;
        $detail  = Product::where('alanguage', config('app.locale'))
            ->with('TaxesRelationships')
            ->find($id);
        if (!isset($detail)) {
            return redirect()->route('products.index')->with('error', "Sản phẩm không tồn tại");
        }
        $category_attribute = DB::table('category_attributes')
            ->select('id', 'title')
            ->where('alanguage', config('app.locale'))
            ->where('ishome', 0)
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
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
        //end tag
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
        $getCatalogue = [];
        if (old('catalogue')) {
            $getCatalogue = old('catalogue');
        } else {
            $getCatalogue = json_decode($detail->catalogue);
        }
        $address = \App\Models\Address::select('id', 'title', 'cityid', 'districtid', 'wardid')
            ->with(['city_name', 'district_name', 'ward_name'])
            ->with(['stocks' => function ($query) {
                $query->where('product_id', '=', 0);
            }])
            ->orderBy('active', 'desc')
            ->orderBy('id', 'desc')
            ->get();
        $listTaxes = \App\Models\Tax::select('id', 'title', 'value')->where('id', '!=', 1)->get();
        $catalogues = $this->Nestedsetbie->dropdown([], config('app.locale'));
        $brands =  $this->Brands->dropdown();
        $tags = \App\Models\Tag::select('id', 'title')->where('module', 'products')->where('alanguage', config('app.locale'))->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
        $field = \App\Models\ConfigColum::where(['trash' => 0, 'publish' => 0, 'module' => $this->table])->get();
        return view('product.backend.product.copy', compact('field', 'catalogues', 'brands', 'tags', 'module', 'address', 'listTaxes', 'getCatalogue', 'detail', 'htmlAttribute', 'getTags', 'attribute_json'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            //'slug' => 'required|unique:router,slug,' . $id . ',moduleid,alanguage,' . config('app.locale') . '',
            'slug' => ['required', Rule::unique('router')->where(function ($query) use ($id) {
                return $query->where('moduleid', '!=', $id)->where('alanguage', config('app.locale'));
            })],
            'code' => 'required|unique:products,code,' . $id . ',id',
            'catalogueid' => 'required|gt:0',
        ], [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'code.unique' => 'Mã sản phẩm đã tồn tại.',
            'code.required' => 'Mã sản phẩm là trường bắt buộc.',
            'slug.required' => 'Đường dẫn là trường bắt buộc.',
            'slug.unique' => 'Đường dẫn đã tồn tại.',
            'catalogueid.required' => 'Danh mục chính là trường bắt buộc.',
            'catalogueid.gt' => 'Danh mục chính là trường bắt buộc.',
        ]);
        //upload image
        if (!empty($request->file('image'))) {
            $image_url = uploadImage($request->file('image'), 'products');
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
        $type = $request['type'];
        //lấy danh mục phụ
        $catalogue = $request['catalogue'];
        $tmp_catalogue = [];
        if (isset($catalogue)) {
            foreach ($catalogue as $v) {
                if ($v != 0 && $v != $request['catalogueid']) { //check id != 0 và id != danh mục chính
                    $tmp_catalogue[] = $v;
                }
            }
        }
        //lấy danh mục cha (nếu có)
        $detail = CategoryProduct::select('id', 'title', 'slug', 'lft')->where('id', $request['catalogueid'])->first();
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
        //data create - update
        $alanguage = !empty($request['polylang_language']) ? $request['polylang_language'] : config('app.locale');
        $_data_product = [
            'title' => $request['title'],
            'slug' => $request['slug'],
            'description' => $request['description'],
            'content' => $request['content'],
            'code' => is($request['code']),
            'unit' => !empty($request['unit']) ? $request['unit'] : '',
            'price_import' => isset($request['price_import']) ? str_replace('.', '', $request['price_import']) : 0,
            'price' => isset($request['price']) ? str_replace('.', '', $request['price']) : 0,
            'price_sale' => isset($request['price_sale']) ? str_replace('.', '', $request['price_sale']) : 0,
            'price_contact' => isset($request['price_contact']) ? $request['price_contact'] : 0,
            //inventory
            'inventory' => isset($request['inventory']) ? $request['inventory'] : 0,
            'inventoryPolicy' => isset($request['inventoryPolicy']) ? $request['inventoryPolicy'] : 0,
            // 'inventoryQuantity' =>  str_replace('.', '', $request['inventoryQuantity']),
            //ship
            'ships' => json_encode($request['ships']),
            'image_json' =>  !empty($request['album']) ? json_encode($request['album']) : '',
            'brand_id' => $request['brand_id'],
            'catalogue_id' => $request['catalogueid'],
            'catalogue' => json_encode($tmp_catalogue),
            'image' => $image_url,
            'meta_title' => $request['meta_title'],
            'meta_description' => $request['meta_description'],
            'publish' => $request['publish'],
            $user => Auth::user()->id,
            $time => Carbon::now(),
            'version_json' => base64_encode(json_encode(array($checkbox, $attribute_catalogue, $attribute))),
            'alanguage' => $alanguage,
            'type' => $type,
        ];
        if ($action == 'create') {
            $id = Product::insertGetId($_data_product);
        } else {
            DB::table('products')->where('id', '=', $id)->update($_data_product);
        }
        if (!empty($id)) {
            /*xóa khi cập nhập*/
            if ($action == 'update') {
                /*xóa router*/
                DB::table('router')->where(['moduleid' => $id, 'module' => $this->table, 'alanguage' => $alanguage])->delete();
                /*xóa catalogue_relationship*/
                DB::table('catalogues_relationships')->where('moduleid', $id)->where('module', $this->table)->delete();
                /*xóa tags_relationship*/
                DB::table('tags_relationships')->where('module_id', $id)->where('module', $this->table)->delete();
                /*xóa brands_relationship*/
                DB::table('brands_relationships')->where('product_id', $id)->delete();
                /*xóa attribute_relationship*/
                DB::table('attributes_relationships')->where('product_id', $id)->delete();
                /*xóa custom fields*/
                DB::table('config_postmetas')->where(['module_id' => $id, 'module' => $this->table])->delete();
                /*xoa product_versions*/
                // \App\Models\ProductVersion::where('product_id', $id)->delete();
                /*xoa product_stocks*/
                // \App\Models\ProductStock::where('product_id', $id)->delete();
                /*xoa taxes_relationships*/
                \App\Models\TaxesRelationships::where('product_id', $id)->delete();
                /*polylang*/
                $this->Polylang->insert($this->table, $request['language'], $id);
            } else {
                //Thêm số lượng stock vào bảng product_stocks => "Sản phẩm đơn giản"
                $this->Helper->insert_product_stocks($id);
            }
            //thêm router
            DB::table('router')->insert([
                'moduleid' => $id,
                'module' => $this->table,
                'slug' => $request['slug'],
                'created_at' => Carbon::now(),
                'alanguage' => $alanguage,
            ]);
            //thêm vào bảng catalogue_relationship
            $this->Helper->catalogue_relation_ship($id, $request['catalogueid'], $tmp_catalogue, $this->table);
            //thêm vào bảng brands_relationships
            $this->Helper->brands_relationships($id, $request['brand_id'], $tmp_catalogue);
            //thêm vào bảng tags_relationships
            $this->Helper->tags_relationships($id, $request['tags'], $this->table);
            //thêm vào bảng attributes_relationships
            $this->Helper->attributes_relationships($id, $attribute, $tmp_catalogue);
            //thêm sản phẩm vào khoảng giá
            $this->Helper->price_attributes((float)str_replace('.', '', $request['price']), $id, $tmp_catalogue);
            if ($type == 'variable') {
                //Them moi phien ban san pham: product_versions
                $this->Helper->insert_product_versions($request, $id);
            }
            //thêm thuế vào bảng taxes_relationships
            if (!empty($request['taxes'])) {
                $this->Helper->insert_taxes_relationships($request['taxes_type'], $request['taxes_import'], $request['taxes_export'], $id);
            }
            //START: custom fields
            fieldsInsert(
                $this->table,
                $id,
                $request
            );
        }
    }
    public function delete(Request $request)
    {
        $id = (int) $request->id;
        $this->delete_function($id);
        return response()->json([
            'code' => 200,
        ], 200);
    }
    public function delete_all(Request $request)
    {
        $post = $request->param;
        if (isset($post['list']) && is_array($post['list']) && count($post['list'])) {
            foreach ($post['list'] as $id) {
                $this->delete_function($id);
            }
        }
        return response()->json([
            'code' => 200,
        ], 200);
    }
    public function delete_function($id = 0)
    {
        //xóa brands_relationship
        DB::table('brands_relationships')->where('product_id', $id)->delete();
        //xóa tags_relationship
        DB::table('tags_relationships')->where('module_id', $id)->where('module', $this->table)->delete();
        //xóa attribute_relationship
        DB::table('attributes_relationships')->where('product_id', $id)->delete();
        //xóa custom fields
        DB::table('config_postmetas')->where(['module_id' => $id, 'module' => $this->table])->delete();
        //xóa catalogue_relationship
        DB::table('catalogues_relationships')->where('moduleid', $id)->where('module', $this->table)->delete();
        //xóa product_deals
        DB::table('product_deals')->where('product_id', $id)->delete();
        //xóa product_deal_items
        DB::table('product_deal_items')->where('product_id', $id)->delete();
        //xóa product_stocks
        DB::table('product_stocks')->where('product_id', $id)->delete();
        //xóa product_stock_histories
        DB::table('product_stock_histories')->where('product_id', $id)->delete();
        //xóa product_versions
        DB::table('product_versions')->where('product_id', $id)->delete();
        //xóa router
        DB::table('router')->where('moduleid', $id)->where('module', $this->table)->delete();
        Product::where('id', $id)->delete();
    }
    public function get_attrid(Request $request)
    {
        $catalogue_id = $request->catalogue_id;
        $attribute_catalogue = [];
        $detailCatalogue = DB::table('attributes_relationships')->where('category_product_id', '=', $catalogue_id)->groupBy('attribute_id')->pluck('attribute_id');
        if (!$detailCatalogue->isEmpty()) {
            $detailCatalogue = DB::table('attributes')
                ->select('attributes.id', 'attributes.title', 'category_attributes.title as titleC')
                ->whereIn('attributes.id', $detailCatalogue)
                ->orderBy('attributes.order', 'asc')
                ->orderBy('attributes.id', 'desc')
                ->join('category_attributes', 'category_attributes.id', '=', 'attributes.catalogueid')
                ->get();
            if (!$detailCatalogue->isEmpty()) {
                $attribute_catalogue = $detailCatalogue->groupBy('titleC');
                $attribute_catalogue->all();
            }
        }
        $html = '';
        if ($attribute_catalogue) {
            foreach ($attribute_catalogue as $key => $val) {
                if (count($val) > 1) {
                    $html = $html . '<li class="catalogue mb-3" data-keyword = ' . slug($key) . '>';
                    $html = $html . '<label class="form-label text-base font-semibold">' . $key . '</label>';
                    $html = $html . '<div class="grid grid-cols-12 gap-6" >';
                    foreach ($val as $item) {
                        $html = $html . '<div class="col-span-3">';
                        $html = $html . '<div class="attr cursor-pointer">';
                        $html = $html . '<input disabled="disabled"  class="checkbox-item filter mr-2" type="checkbox" name="attr[]" value="' . $item->id . '"><span style="margin-left: -24px;padding-left: 24px;">';
                        $html = $html . $item->title;
                        $html = $html . '</span></div>';
                        $html = $html . '</div>';
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
        $module = $this->table;
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
        $data = $data->join('catalogues_relationships', 'products.id', '=', 'catalogues_relationships.moduleid')->where('catalogues_relationships.module', '=', $this->table);
        if (!empty($request->catalogue_id)) {
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
                $data =  $data->whereIn('tb' . $index . '.attribute_id', $val);
            }
            $data =  $data->groupBy('tb102.product_id');
        }
        $data =  $data->groupBy('catalogues_relationships.moduleid');
        $data =  $data->paginate(env('APP_paginate'));
        $configIs = \App\Models\Configis::select('title', 'type')->where(['module' => $this->table, 'active' => 1])->get();

        return view('product.backend.product.index.data', compact('data', 'configIs', 'module'))->render();
    }
    public function exportProducts(Request $request)
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }
}
