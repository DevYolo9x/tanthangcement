<?php

namespace App\Http\Controllers\document\frontend;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\CategoryDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cache;
use App\Components\Comment;
use App\Components\System;

class DocumentController extends Controller
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
        $detail = Document::select()
            ->where(['slug' => $slug, 'alanguage' => config('app.locale'), 'publish' => 0])
            ->with('catalogues')
            ->first();
        if (!isset($detail)) {
            return redirect()->route('homepage.index');
        }
        $catalogues = $detail->catalogues;
        // breadcrumb
        $breadcrumb = CategoryDocument::select('title', 'slug')->where('alanguage', config('app.locale'))->where('lft', '<=', $catalogues->lft)->where('rgt', '>=', $catalogues->lft)->orderBy('lft', 'ASC')->orderBy('order', 'ASC')->get();
        //bài viết liên quan
        $sameDocument =  Document::select('id', 'title', 'slug', 'image', 'description',  'documents.created_at')->where('alanguage', config('app.locale'))->where('documents_relationships.catalogueid', $catalogues->id)->where('documents_relationships.moduleid', '!=', $detail['id'])->where('documents.publish', 0)->orderBy('order', 'ASC')->orderBy('id', 'DESC');
        $sameDocument = $sameDocument->join('documents_relationships', 'documents.id', '=', 'documents_relationships.moduleid')->where('documents_relationships.module', '=', 'documents');
        $sameDocument =  $sameDocument->groupBy('documents_relationships.moduleid');
        $sameDocument =  $sameDocument->limit(4)->get();
        //cập nhập lượt xem
        DB::table('documents')->where('id', '=', $detail['id'])->update([
            'viewed' => $detail['viewed'] + 1,
        ]);
        //lấy comment
        $comment_view =  $this->comment->comment(array('id' => $detail->id, 'sort' => 'id'), 'documents');
//        $previous = document::select('id', 'slug', 'title')->where('id', '<', $detail->id)->where('alanguage', config('app.locale'))->where('catalogue_id', $detail->catalogue_id)->first();
//        $next = document::select('id', 'slug', 'title')->where('id', '>', $detail->id)->where('alanguage', config('app.locale'))->where('catalogue_id', $detail->catalogue_id)->first();
        $fcSystem = $this->system->fcSystem();
        $seo['canonical'] = route('routerURL', ['slug' => $slug]);
        $seo['meta_title'] =  !empty($detail['meta_title']) ? $detail['meta_title'] : $detail['title'];
        $seo['meta_description'] = !empty($detail['meta_description']) ? $detail['meta_description'] : cutnchar(strip_tags($detail->description));
        $seo['meta_image'] = $detail['image'];
        $fcSystem = $this->system->fcSystem();
        $module = 'documents';
        $polylang = langURLFrontend($module, config('app.locale'), $detail->id, '\App\Models\Document');
        if (!empty($polylang)) {
            foreach ($polylang as $key => $item) {
                $fcSystem['language_' . $key] = $item;
            }
        }
        $view = 'document.frontend.document.index';
        if( $catalogues['type'] == 1 ){
            $view = 'document.frontend.document.service';
        }
        return view($view, compact('module', 'fcSystem', 'detail', 'seo', 'breadcrumb', 'sameDocument', 'catalogues', 'comment_view'));
    }
}
