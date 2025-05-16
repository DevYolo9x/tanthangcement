<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'parentid', 'description', 'image', 'image_json', 'type', 'isservice', 'meta_title', 'meta_description', 'userid_created', 'userid_updated', 'created_at', 'updated_at', 'publish', 'order', 'alanguage', 'banner'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid_created');
    }
    public function listQuestion()
    {
        return $this->hasMany(Catalogues_relationships::class, 'catalogueid')->where('module', '=', 'questions');
    }
    public function questions()
    {
        return $this->hasMany(Article::class, 'catalogue_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(CategoryArticle::class, 'parentid', 'id')->select('id', 'title', 'slug', 'parentid')->orderBy('order', 'asc')->orderBy('id', 'desc');
    }
    public function posts()
    {
        return $this->hasMany(Catalogues_relationships::class, 'catalogueid')->where('module', '=', 'questions')
            ->join('questions', 'questions.id', '=', 'catalogues_relationships.moduleid')
            ->where(['questions.publish' => 0])
            ->select('questions.id', 'questions.title', 'questions.slug', 'questions.description', 'questions.image', 'questions.created_at', 'catalogues_relationships.catalogueid')
            ->orderBy('questions.order', 'asc')->orderBy('questions.id', 'desc');
    }
    public function postsFields()
    {
        return $this->hasMany(Catalogues_relationships::class, 'catalogueid')->where('catalogues_relationships.module', '=', 'questions')
            ->join('questions', 'questions.id', '=', 'catalogues_relationships.moduleid')
            ->join('config_postmetas', 'catalogues_relationships.moduleid', '=', 'config_postmetas.module_id')
            ->where(['questions.publish' => 0, 'config_postmetas.module' => 'questions'])
            ->select('questions.id', 'questions.title', 'questions.slug', 'questions.image', 'catalogues_relationships.catalogueid', 'config_postmetas.meta_value')
            ->orderBy('questions.order', 'asc')->orderBy('questions.id', 'desc');
    }
}
