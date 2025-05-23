<?php

namespace App\Components;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Helper
{
    //thêm vào bảng catalogue_relationship
    function catalogue_relation_ship($productid = 0, $catalogueid = 0, $tmp_catalogue = [], $module = '')
    {
        /*$_catalogue_relation_ship[] = array(
            'module' => $module,
            'moduleid' => $productid,
            'catalogueid' => $catalogueid,
            'created_at' => Carbon::now(),
        ); */
        $_catalogue_relation_ship = [];
        if (isset($tmp_catalogue)) {
            foreach ($tmp_catalogue as $v) {
                $_catalogue_relation_ship[] = array(
                    'module' => $module,
                    'moduleid' => $productid,
                    'catalogueid' => $v,
                    'created_at' => Carbon::now(),
                );
            }
        }
        DB::table('catalogues_relationships')->insert($_catalogue_relation_ship);
    }
    //thêm vào bảng attributes_relationships
    function attributes_relationships($productid = 0, $attribute = [], $tmp_catalogue = [])
    {
        $_insert_attribute = [];
        if (isset($attribute) && is_array($attribute) && count($attribute) && $attribute != array('0' => 0)) {
            foreach ($attribute as $key => $val) {
                if (isset($val) && is_array($val) && count($val) && $val != array('0' => 0)) {
                    foreach ($val as $sub => $subs) {
                        if (isset($tmp_catalogue)) {
                            foreach ($tmp_catalogue as $v) {
                                $_insert_attribute[] = array(
                                    'product_id' => $productid,
                                    'attribute_id' => $subs,
                                    'created_at' => Carbon::now(),
                                    'category_product_id' => $v
                                );
                            }
                        }
                    }
                }
            }
            if (check_array($_insert_attribute)) {
                DB::table('attributes_relationships')->insert($_insert_attribute);
            }
        }
    }
    //thêm vào bảng experts_attributes_relationships
    function experts_attributes_relationships($expertid = 0, $attribute = [], $tmp_catalogue = [])
    {
        $_insert_attribute = [];
        if (isset($attribute) && is_array($attribute) && count($attribute) && $attribute != array('0' => 0)) {
            foreach ($attribute as $key => $val) {
                if (isset($val) && is_array($val) && count($val) && $val != array('0' => 0)) {
                    foreach ($val as $sub => $subs) {
                        if (isset($tmp_catalogue)) {
                            foreach ($tmp_catalogue as $v) {
                                $_insert_attribute[] = array(
                                    'expert_id' => $expertid,
                                    'attribute_id' => $subs,
                                    'created_at' => Carbon::now(),
                                    'category_attributes_id' => $v
                                );
                            }
                        }
                    }
                }
            }
            if (check_array($_insert_attribute)) {
                DB::table('experts_attributes_relationships')->insert($_insert_attribute);
            }
        }
    }
    /*// thêm nhóm thuộc tính vào nhóm sản phẩm
    function update_attribute_catalogue_in_product_catalogue($param = [])
    {
        $_catalogue_relation_ship[] = $param['catalogueid'];
        if (isset($param['tmp_catalogue'])) {
            foreach ($param['tmp_catalogue'] as $v) {
                $_catalogue_relation_ship[] = $v;
            }
        }

        if (!empty($param['attribute_catalogue']) && $param['attribute_catalogue'] != array(0 => 0)) {
            //foreach từng mảng danh mục sản phẩm
            if (isset($_catalogue_relation_ship)) {
                foreach ($_catalogue_relation_ship as $v) {
                    $product_catalogue = DB::table('category_products')->select('attrid')->where('id', '=', $v)->first();
                    $attrid_old = is(json_decode($product_catalogue->attrid, true));
                    foreach ($param['attribute_catalogue'] as $key => $cata) {
                        if (!empty($param['attribute'])) {
                            foreach ($param['attribute'] as $sub => $attr) {
                                if ($key == $sub) {
                                    $attrid_new[$cata] = $attr;
                                }
                            }
                        }
                    }
                    if (!empty($attrid_old)) {
                        foreach ($attrid_old as $cata_old => $attr_old) {
                            if (!empty($attr_old)) {
                                if (!empty($attrid_new) && check_array($attrid_new)) {
                                    foreach ($attrid_new as $cata_new => $attr_new) {
                                        if ($cata_old == $cata_new) {
                                            $attrid[$cata_old] = array_unique(array_merge($attr_new, $attr_old));
                                        }
                                        if ($cata_old != $cata_new) {
                                            $attrid[$cata_new] = (isset($attrid[$cata_new])) ? array_unique(array_merge($attr_new, $attrid[$cata_new])) : $attr_new;
                                            $attrid[$cata_old] = (isset($attrid[$cata_old])) ? array_unique(array_merge($attr_old, $attrid[$cata_old])) : $attr_old;
                                        }
                                    }
                                }
                            } else {
                                foreach ($param['attribute_catalogue'] as $key => $val) {
                                    foreach ($param['attribute'] as $sub => $subs) {
                                        if ($sub == $key) {
                                            $attrid[$val] = $subs;
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        foreach ($param['attribute_catalogue'] as $key => $val) {
                            foreach ($param['attribute'] as $sub => $subs) {
                                if ($sub == $key) {
                                    $attrid[$val] = $subs;
                                }
                            }
                        }
                    }
                    if (isset($attrid) && check_array($attrid)) {
                        $_update_attrid = array(
                            'attrid' => json_encode($attrid),
                        );
                        DB::table('category_products')->where('id', '=', $v)->update($_update_attrid);
                    }
                }
            }
        }
    } */
    // thêm phiên bản sản phẩm: products_version
    /* function create_product_version($param = [])
    {
        $_insert_version = [];
        //lấy dữ liệu post lên
        if (isset($param['title_version']) && is_array($param['title_version']) && count($param['title_version'])) {
            foreach ($param['title_version'] as $key => $val) {
                //thêm id sort để chọn các thuộc tính mua hàng theo thứ tự
                $ex = explode(":", $param['id_version'][$key]);
                $id_sort = array();
                foreach ($ex as $k => $row) {
                    $id_sort[$k] = $row;
                }
                array_multisort($id_sort, SORT_DESC, $ex);
                $_insert_version[] = array(
                    'title_version_1' => $param['title_version_1'][$key],
                    'title_version_2' => !empty($param['title_version_2'][$key]) ? $param['title_version_2'][$key] : '',

                    'productid' => $param['productid'],
                    'title_version' => $val,

                    'id_version' => $param['id_version'][$key],

                    'code_version' => $param['code_version'][$key],
                    'image_version' => !empty($param['image_version'][$key]) ? $param['image_version'][$key] : '',

                    'price_version' => (int)str_replace('.', '', $param['price_version'][$key]),
                    'price_sale_version' => (int)str_replace('.', '', $param['price_sale_version'][$key]),

                    '_stock_status' => $param['_stock_status'][$key],
                    '_stock' => $param['_stock'][$key],
                    '_outstock_status' => $param['_outstock_status'][$key],

                    'id_sort' => json_encode($id_sort),

                    'created_at' => Carbon::now(),
                    'userid_created' => Auth::user()->id,
                );
            }
        }
        //thuc hien groupBy id_version
        $tmpArr = [];
        if (!empty($_insert_version)) {
            foreach ($_insert_version as $key => $item) {
                $tmpArr[$item['title_version_1']]['title'] = $item['title_version_1'];
                $tmpArr[$item['title_version_1']]['children'][$key] = $item;
            }
            ksort($tmpArr, SORT_NUMERIC);
            array_values($tmpArr);
        }
        //done groupBy id_version => getname
        $productVersionArr = [];
        if (isset($tmpArr) && is_array($tmpArr) && count($tmpArr)) {
            foreach ($tmpArr as $key => $value) {
                $tmp_status[$key] = [];
                $totalStock = 0;
                $addOneID = \App\Models\products_color::insertGetId([
                    'title' => $value['title'],
                    'product_id' => $param['productid'],
                    'stock' => 0,
                    'userid_created' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                ]);
                if (isset($value['children']) && is_array($value['children']) && count($value['children'])) {
                    // echo "<pre>";var_dump(array_values($value['children']));
                    //  array_values($value['children']);
                    foreach ($value['children'] as $keyC => $val) {
                        $totalStock += $val['_stock'];
                        $productVersionArr[] = array(
                            'title_version' => $val['title_version'],
                            'code_version' => $val['code_version'],
                            'image_version' => $val['image_version'],
                            'price_version' => $val['price_version'],
                            'price_sale_version' => $val['price_sale_version'],
                            '_stock_status' => $val['_stock_status'],
                            '_stock' =>  $val['_stock'],
                            '_outstock_status' => $val['_outstock_status'],
                            'id_sort' => $val['id_sort'],
                            'productid' => $val['productid'],
                            'product_color_id' => $addOneID,
                            'userid_created' => Auth::user()->id,
                            'created_at' => Carbon::now(),
                        );
                        //check không quản lý tồn kho và đồng ý đặt hàng khi hết hàng

                        if ($val['_stock_status'] == 0 || $val['_outstock_status'] == 1) {
                            $tmp_status[$key][] = $value['title'] . '/' . $val['title_version'];
                        }
                        //tổng số lượng sản phẩm tồn kho lớn hơn 0
                        if ($totalStock > 0) {
                            $tmp_status[$key][] = $value['title'] . '/' . $val['title_version'];
                        }
                    }
                }

                if (!empty($tmp_status[$key])) {
                    DB::table('products_colors')->where('id', '=', $addOneID)->update([
                        'stock' => 1,
                    ]);
                }
            }
        }
        //thực hiện thêm vào bảng products_versions
        if (!empty($productVersionArr)) {
            DB::table('products_versions')->insert($productVersionArr);
        }
    } */
    //thêm vào bảng table_relationship: brand, tag,...
    function tags_relationships($id = 0, $tag_id = [], $module = '')
    {
        $_insert = [];
        if (isset($tag_id) && is_array($tag_id) && count($tag_id) && $tag_id != array('0' => 0)) {
            foreach ($tag_id as $val) {
                if (isset($val) && is_array($val) && count($val) && $val != array('0' => 0)) {
                    foreach ($val as $subs) {
                        $_insert[] = array(
                            'module_id' => $id,
                            'tag_id' => $subs,
                            'module' => $module,
                            'created_at' => Carbon::now(),
                            'userid_created' => Auth::user()->id,
                        );
                    }
                } else {
                    $_insert[] = array(
                        'module_id' => $id,
                        'tag_id'  => $val,
                        'module' => $module,
                        'created_at' => Carbon::now(),
                        'userid_created' => Auth::user()->id,
                    );
                }
            }
            if (check_array($_insert)) {
                DB::table('tags_relationships')->insert($_insert);
            }
        }
    }
    //thêm vào bảng brands_relationships
    function brands_relationships($id = 0, $brand_id = 0, $tmp_catalogue = [])
    {
        //lấy danh mục cha của brand
        $detailBrand = \App\Models\Brand::select('id', 'title', 'slug', 'lft')->where('id', $brand_id)->first();
        if ($detailBrand) {
            $breadcrumbBrand = \App\Models\Brand::select('id', 'title')->where('alanguage', config('app.locale'))->where('lft', '<=', $detailBrand->lft)->where('rgt', '>=', $detailBrand->lft)->orderBy('lft', 'ASC')->get();
            //end
            $_insert_brands_relationships = [];
            if (!$breadcrumbBrand->isEmpty()) {
                foreach ($breadcrumbBrand as $val) {
                    if (isset($tmp_catalogue)) {
                        foreach ($tmp_catalogue as $v) {
                            $_insert_brands_relationships[] = array(
                                'product_id' => $id,
                                'brand_id' => $val->id,
                                'created_at' => Carbon::now(),
                                'userid_created' => Auth::user()->id,
                                'category_product_id' => $v
                            );
                        }
                    }
                }
                if (check_array($_insert_brands_relationships)) {
                    DB::table('brands_relationships')->insert($_insert_brands_relationships);
                }
            }
        }
    }
    //thêm giá của sản phẩm vào khoảng giá của bộ lọc
    function price_attributes($price = 0, $productid = 0, $tmp_catalogue = [])
    {
        $category_attributes = DB::table('category_attributes')->where(['ishome' => 1, 'alanguage' => config('app.locale')])->first();

        if ($category_attributes) {
            // $attributes = DB::table('attributes')->where('price_start', '<=', $price)->where('price_end', '>=', $price)->where('catalogueid', $category_attributes->id)->where('price_end', 0)->first();
            $attributes = DB::table('attributes')->where('price_start', '<=', $price)->where('price_end', '>', $price)->where('catalogueid', $category_attributes->id)->first();
            if ($attributes) {
                if (isset($tmp_catalogue)) {
                    foreach ($tmp_catalogue as $v) {
                        DB::table('attributes_relationships')->insert(array(
                            'product_id' => $productid,
                            'attribute_id' => $attributes->id,
                            'category_product_id' => $v,
                            'created_at' => Carbon::now(),
                        ));
                    }
                }
            } else {
                $attributesMax = DB::table('attributes')->where('price_start', '<=', $price)->where('price_end', 0)->where('catalogueid', $category_attributes->id)->first();
                if ($attributesMax) {
                    if (isset($tmp_catalogue)) {
                        foreach ($tmp_catalogue as $v) {
                            DB::table('attributes_relationships')->insert(array(
                                'product_id' => $productid,
                                'attribute_id' => $attributesMax->id,
                                'category_product_id' => $v,
                                'created_at' => Carbon::now(),
                            ));
                        }
                    }
                }
            }
        }
    }
    //Them moi phien ban san pham: product_versions
    function insert_product_versions($request = [], $id)
    {
        //lấy danh sách chi nhánh
        $address = \App\Models\Address::select('id')->where('alanguage', config('app.locale'))->get();
        //end
        $ids = $request['ids'];
        $title_version = $request['title_version'];
        $image_version = $request['image_version'];
        $code_version = $request['code_version'];
        $_stock_status = $request['_stock_status'];
        // $_stock = !empty($request['_stock']) ? $request['_stock'] : 0;
        $_outstock_status = !empty($request['_outstock_status']) ? $request['_outstock_status'] : 0;
        $_ships_weight = !empty($request['_ships_weight']) ? $request['_ships_weight'] : '';
        $_ships_length = !empty($request['_ships_length']) ? $request['_ships_length'] : '';
        $_ships_width = !empty($request['_ships_width']) ? $request['_ships_width'] : '';
        $_ships_height = !empty($request['_ships_height']) ? $request['_ships_height'] : '';
        $price_version =  !empty($request['price_version']) ? str_replace('.', '', $request['price_version']) : 0;
        $price_sale_version =  !empty($request['price_sale_version']) ? str_replace('.', '', $request['price_sale_version']) : 0;
        $price_import_version =  !empty($request['price_import_version']) ? str_replace('.', '', $request['price_import_version']) : 0;
        // $_stock_address =  !empty($request['_stock_address']) ? $request['_stock_address'] : [];
        $_insert_version = [];
        $_insert_stock = [];
        if (!empty($title_version)) {
            foreach ($title_version as $key => $item) {
                $value_id = [];
                $value_title = [];
                //lấy id theo title 
                $explodeID = explode('&&&&', $item);
                if (!empty($explodeID)) {
                    $filtered = collect($explodeID)->filter(function ($value, $key) {
                        return $value != '';
                    });
                    $getAttrid = \App\Models\Attribute::select('id', 'title')->where(['alanguage' => config('app.locale')])->whereIn('title', $filtered)->orderBy('id', 'asc')->get();
                    if (!$getAttrid->isEmpty()) {
                        foreach ($getAttrid as $val) {
                            $value_id[] = $val->id;
                            $value_title[] = $val->title;
                        }
                    }
                }
                //end
                if (!empty($ids[$key])) {
                    $_insert_version[]  = array(
                        'id' => $ids[$key],
                        'product_id' => $id,
                        'id_version' => json_encode(collect($value_id)->sort()),
                        'title_version' => json_encode($value_title),
                        'code_version' => $code_version[$key],
                        'image_version' => !empty($image_version[$key]) ? $image_version[$key] : '',
                        'price_version' => $price_version[$key],
                        'price_sale_version' => $price_sale_version[$key],
                        'price_import_version' => $price_import_version[$key],
                        '_stock_status' => $_stock_status[$key],
                        // '_stock' => !empty($_stock[$key]) ? $_stock[$key] : '',
                        '_outstock_status' => !empty($_outstock_status[$key]) ? $_outstock_status[$key] : '',
                        '_ships_weight' => !empty($_ships_weight[$key]) ? $_ships_weight[$key] : '',
                        '_ships_length' => !empty($_ships_length[$key]) ? $_ships_length[$key] : '',
                        '_ships_width' => !empty($_ships_width[$key]) ? $_ships_width[$key] : '',
                        '_ships_height' => !empty($_ships_height[$key]) ? $_ships_height[$key] : '',
                        'updated_at' => Carbon::now(),
                        'userid_updated' => Auth::user()->id,
                    );
                } else {
                    $_insert_version[]  = array(
                        'product_id' => $id,
                        'id_version' => json_encode(collect($value_id)->sort()),
                        'title_version' => json_encode($value_title),
                        'code_version' => $code_version[$key],
                        'image_version' => !empty($image_version[$key]) ? $image_version[$key] : '',
                        'price_version' => $price_version[$key],
                        'price_sale_version' => $price_sale_version[$key],
                        'price_import_version' => $price_import_version[$key],
                        '_stock_status' => $_stock_status[$key],
                        // '_stock' => !empty($_stock[$key]) ? $_stock[$key] : '',
                        '_outstock_status' => !empty($_outstock_status[$key]) ? $_outstock_status[$key] : '',
                        '_ships_weight' => !empty($_ships_weight[$key]) ? $_ships_weight[$key] : '',
                        '_ships_length' => !empty($_ships_length[$key]) ? $_ships_length[$key] : '',
                        '_ships_width' => !empty($_ships_width[$key]) ? $_ships_width[$key] : '',
                        '_ships_height' => !empty($_ships_height[$key]) ? $_ships_height[$key] : '',
                        'created_at' => Carbon::now(),
                        'userid_created' => Auth::user()->id,
                    );
                }

                //lưu tồn kho
                /*if (!empty($_stock_address) && !empty($_stock_address[$key])) {
                    foreach ($_stock_address[$key] as $ks => $vs) {
                        $_insert_stock[]  = array(
                            'product_id' => $id,
                            'value' => $vs,
                            'address_id' => $ks,
                            'type' => 'variable',
                            'product_version_id' => json_encode(collect($value_id)->sort()),
                            'created_at' => Carbon::now(),
                            'user_id' => Auth::user()->id,
                        );
                    }
                } */
                //end
            }
        }
        /* \App\Models\ProductVersion::insert($_insert_version); */
        if (!empty($_insert_version)) {
            foreach ($_insert_version as $key => $item) {
                if (!empty($item['id'])) {
                    \App\Models\ProductVersion::where('id', $item['id'])->update($item);
                } else {
                    $id_insert = \App\Models\ProductVersion::insertGetId($item);
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
        }
        \App\Models\ProductStock::insert($_insert_stock);
    }
    //Them moi phien ban san pham: product_versions
    function insert_product_stocks($id)
    {
        $address = \App\Models\Address::select('id')->where('alanguage', config('app.locale'))->get();
        /*
        if (!empty($inventoryQuantity)) {
            $idProductStock = \App\Models\ProductStock::insertGetId(array(
                'product_id' => $id,
                'value' => $inventoryQuantity,
                'type' => 'simple',
                'user_id' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ));
        }
        $_insert = [];
        if (!empty($stockAddress)) {
            foreach ($stockAddress as $key => $item) {
                $_insert[]  = array(
                    'product_id' => $id,
                    'address_id' => $key,
                    'type' => 'simple',
                    'value' => (float)str_replace('.', '', $item),
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                );
            }
            \App\Models\ProductStock::insert($_insert);
        }*/
        $_insert = [];
        if (!empty($address) && count($address) > 0) {
            foreach ($address as $k => $v) {
                $_insert[]  = array(
                    'address_id' => $v->id,
                    'product_id' => $id,
                    'type' => 'simple',
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                );
            }
        }
        \App\Models\ProductStock::insert($_insert);
    }
    //thêm thuế vào bảng taxes_relationships
    function insert_taxes_relationships($taxes_type = 'notax', $taxes_import = 0, $taxes_export = 0, $id)
    {
        \App\Models\TaxesRelationships::insertGetId(array(
            'product_id' => $id,
            'taxes_type' => $taxes_type,
            'taxes_import' => $taxes_import,
            'taxes_export' => $taxes_export,
            'created_at' => Carbon::now(),
        ));
    }

    // Thêm bài viết từ danh mục con vào danh mục cha relationship (Bài viết và sản phẩm)
    function get_parent_category($category_parents_id){
        $id[] = $category_parents_id;
        $category_parents = DB::table('category_articles')->where(['id' => $category_parents_id])->first();
        if( $category_parents && $category_parents->parentid > 0 ){
            $id[] = $this->get_parent_category($category_parents->parentid);
        }
        return $id;
    }

    function get_post_by_category_id ( $category_id ){
        $posts =  \App\Models\Article::where(['alanguage' => config('app.locale'), 'type' => 0])
            ->join('catalogues_relationships', 'articles.id', '=', 'catalogues_relationships.moduleid')->where('catalogues_relationships.module', '=', 'articles')
            ->where('catalogues_relationships.catalogueid', $category_id)
            ->orderBy('order', 'ASC')
            ->orderBy('id', 'DESC')->get();
        return $posts;
    }

    function insert_parent_category($category_id, $category_parents_id){
        $category_parents = $this->get_parent_category($category_parents_id);
        $posts =  $this->get_post_by_category_id ( $category_id );
        $this->insert_category_of_posts($posts, $category_parents);
    }

    // Thêm id danh mục cha của danh mục hiện tại của các bài viết nằm trong danh mục
    function insert_category_of_posts( $posts, $category_parents ){
        if( $posts && count($posts) > 0 ){
            foreach( $posts as $post ){
                $catalogue = json_decode($post->catalogue, true);
                if( isset($category_parents) && is_array($category_parents) && count($category_parents) ){
                    foreach ( $category_parents as $key => $cat ){
                        $catalogue[] = (int)$cat;
                    }
                }
                if(($key = array_search(0, $catalogue)) !== false) {
                    unset($catalogue[$key]);
                }
                $catalogue = array_unique($catalogue);

                $this->update_data_and_catalogues_relationships($post, $catalogue);
            }
        }
    }

    // Thay đổi danh mục cha của danh muc hiện tại của các bài viết nằm trong danh mục
    function change_parent_category( $category_parent, $cagegory_old, $category_new ){
        $posts =  $this->get_post_by_category_id ( $cagegory_old );
        if( $posts && !empty($posts) ){
            foreach( $posts as $post ){
                $catalogue = json_decode($post->catalogue, true);
                if(($key = array_search($category_parent, $catalogue)) !== false) {
                    unset($catalogue[$key]);
                }

                if(($key = array_search(0, $catalogue)) !== false) {
                    unset($catalogue[$key]);
                }
                
                $catalogue[] = (int)$category_new;
                
                $catalogue = array_unique($catalogue);
                $this->update_data_and_catalogues_relationships($post, $catalogue);
            }
        }
    }

    function change_parent_category_( $category_parent, $cagegory_old, $category_new ){
        $posts =  $this->get_post_by_category_id ( $cagegory_old );
        if( $posts && !empty($posts) ){
            foreach( $posts as $post ){
                $catalogue = json_decode($post->catalogue, true);
                if(($key = array_search($category_parent, $catalogue)) !== false) {
                    unset($catalogue[$key]);
                }

                if(($key = array_search(0, $catalogue)) !== false) {
                    unset($catalogue[$key]);
                }
                
                $catalogue[] = (int)$category_new;
                
                $catalogue = array_unique($catalogue);

                $_data = [
                    'catalogue' => json_encode($catalogue),
                    'userid_updated' => Auth::user()->id,
                    'updated_at' => Carbon::now(),
                    'alanguage' => config('app.locale'),
                ];

                \App\Models\Article::find($post->id)->update($_data);

                $_catalogue_relation_ship = [];
                if( isset($catalogue) && is_array($catalogue) && count($catalogue) ){
                    foreach ( $catalogue as $key => $cat ){
                        $_catalogue_relation_ship[] = array(
                            'module' => 'articles',
                            'moduleid' => $post->id,
                            'catalogueid' => $cat,
                            'created_at' => Carbon::now(),
                        );
                    }
                }
                DB::table('catalogues_relationships')->where(['moduleid' => $post->id, 'module' => 'articles', 'catalogueid' => $cagegory_old])->delete();
                DB::table('catalogues_relationships')->insert($_catalogue_relation_ship);
            }
        }
    }

    // Xoá bỏ danh mục cha hiện tại của các bài viết nằm trong danh mục
    function remove_parent_category( $cagegory_id ){
        $posts =  $this->get_post_by_category_id ( $cagegory_id );
        if( $posts && !empty($posts) ){
            foreach( $posts as $post ){
                $catalogue = json_decode($post->catalogue, true);
                if(($key = array_search($cagegory_id, $catalogue)) !== false) {
                    unset($catalogue[$key]);
                }
                if(($key = array_search(0, $catalogue)) !== false) {
                    unset($catalogue[$key]);
                }
                $catalogue = array_unique($catalogue);
                $this->update_data_and_catalogues_relationships($post, $catalogue);
                
            }
        }
    }

    function update_data_and_catalogues_relationships( $post, $catalogue ){
        $_data = [
            'catalogue' => json_encode($catalogue),
            'userid_updated' => Auth::user()->id,
            'updated_at' => Carbon::now(),
            'alanguage' => config('app.locale'),
        ];

        \App\Models\Article::find($post->id)->update($_data);

        $_catalogue_relation_ship = [];
        if( isset($catalogue) && is_array($catalogue) && count($catalogue) ){
            foreach ( $catalogue as $key => $cat ){
                $_catalogue_relation_ship[] = array(
                    'module' => 'articles',
                    'moduleid' => $post->id,
                    'catalogueid' => $cat,
                    'created_at' => Carbon::now(),
                );
            }
        }
        DB::table('catalogues_relationships')->where(['moduleid' => $post->id, 'module' => 'articles'])->delete();
        DB::table('catalogues_relationships')->insert($_catalogue_relation_ship);
    }


}
