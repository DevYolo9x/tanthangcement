<?php

namespace App\Http\Controllers\question\frontend;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\CategoryQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cache;
use App\Components\Comment;
use App\Components\System;

class QuestionController extends Controller
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
        $detail = Question::select()
            ->where(['slug' => $slug, 'alanguage' => config('app.locale'), 'publish' => 0])
            ->with('catalogues')
            ->first();
        if (!isset($detail)) {
            return redirect()->route('homepage.index');
        }
        $catalogues = $detail->catalogues;
        // breadcrumb
        $breadcrumb = CategoryQuestion::select('title', 'slug')->where('alanguage', config('app.locale'))->where('lft', '<=', $catalogues->lft)->where('rgt', '>=', $catalogues->lft)->orderBy('lft', 'ASC')->orderBy('order', 'ASC')->get();
        //bài viết liên quan
        $sameQuestion =  Question::select('id', 'title', 'slug', 'image', 'description',  'questions.created_at')->where('alanguage', config('app.locale'))->where('catalogues_relationships.catalogueid', $catalogues->id)->where('catalogues_relationships.moduleid', '!=', $detail['id'])->where('questions.publish', 0)->orderBy('order', 'ASC')->orderBy('id', 'DESC');
        $sameQuestion = $sameQuestion->join('catalogues_relationships', 'questions.id', '=', 'catalogues_relationships.moduleid')->where('catalogues_relationships.module', '=', 'questions');
        $sameQuestion =  $sameQuestion->groupBy('catalogues_relationships.moduleid');
        $sameQuestion =  $sameQuestion->limit(4)->get();
        //cập nhập lượt xem
        DB::table('questions')->where('id', '=', $detail['id'])->update([
            'viewed' => $detail['viewed'] + 1,
        ]);
        //lấy comment
        $comment_view =  $this->comment->comment(array('id' => $detail->id, 'sort' => 'id'), 'questions');
        //$previous = Question::select('id', 'slug', 'title')->where('id', '<', $detail->id)->where('alanguage', config('app.locale'))->where('catalogue_id', $detail->catalogue_id)->first();
        //$next = Question::select('id', 'slug', 'title')->where('id', '>', $detail->id)->where('alanguage', config('app.locale'))->where('catalogue_id', $detail->catalogue_id)->first();
        $fcSystem = $this->system->fcSystem();
        $seo['canonical'] = route('routerURL', ['slug' => $slug]);
        $seo['meta_title'] =  !empty($detail['meta_title']) ? $detail['meta_title'] : $detail['title'];
        $seo['meta_description'] = !empty($detail['meta_description']) ? $detail['meta_description'] : cutnchar(strip_tags($detail->description));
        $seo['meta_image'] = $detail['image'];
        $fcSystem = $this->system->fcSystem();
        $module = 'questions';
        $polylang = langURLFrontend($module, config('app.locale'), $detail->id, '\App\Models\Question');
        if (!empty($polylang)) {
            foreach ($polylang as $key => $item) {
                $fcSystem['language_' . $key] = $item;
            }
        }
        return view('question.frontend.question.index', compact('module', 'fcSystem', 'detail', 'seo', 'breadcrumb', 'sameQuestion', 'catalogues', 'comment_view'));
    }
}
