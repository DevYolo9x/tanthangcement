<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'catalogue_id', 'catalogue', 'image', 'content', 'description', 'meta_title', 'meta_description', 'image_json', 'userid_created', 'version_json', 'userid_updated', 'created_at', 'updated_at', 'publish', 'order', 'alanguage', 'products'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid_created');
    }
    public function relationships()
    {
        return $this->hasMany(Catalogues_relationships::class, 'moduleid');
    }
    public function catalogues()
    {
        return $this->hasOne(CategoryArticle::class, 'id', 'catalogue_id');
    }
    public function attributes()
    {
        return $this->hasMany(Experts_attributes_relationships::class, 'expert_id')
        ->select('attributes.id', 'attributes.title', 'category_attributes.title as category_attributes_title',  'attributes.slug', 'experts_attributes_relationships.attribute_id', 'experts_attributes_relationships.expert_id', 'category_attributes.id as category_attributes', 'category_attributes.highlight')
        ->join('attributes', 'attributes.id', '=', 'experts_attributes_relationships.attribute_id')
        ->join('category_attributes', 'category_attributes.id', '=', 'attributes.catalogueid')
        ->where('attributes.publish', 0)->where('attributes.alanguage', config('app.locale'))
        ->where('category_attributes.highlight', 1);
    }
    public function tags()
    {
        return $this->hasMany(Tags_relationship::class, 'module_id', 'id')->where('module', '=', 'experts');
    }
    public function getTags()
    {
        return $this->hasMany(Tags_relationship::class, 'module_id', 'id')->where('tags_relationships.module', '=', 'experts')->join('tags', 'tags.id', '=', 'tags_relationships.tag_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'module_id', 'id')->where('module', '=', 'experts')->where('parentid', 0)->get();
    }
    public function fields()
    {
        return $this->hasMany(ConfigPostmeta::class, 'module_id')->where(['module' => 'experts'])->select('module_id', 'meta_key', 'meta_value');
    }
}
