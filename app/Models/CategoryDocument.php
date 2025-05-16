<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'parentid', 'description', 'image', 'image_json', 'type', 'isservice', 'meta_title', 'meta_description', 'userid_created', 'userid_updated', 'created_at', 'updated_at', 'publish', 'order', 'alanguage', 'banner'
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid_created');
    }
    public function listDocument()
    {
        return $this->hasMany(Documents_relationships::class, 'catalogueid')->where('module', '=', 'documents');
    }
    public function documents()
    {
        return $this->hasMany(Article::class, 'catalogue_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(CategoryDocument::class, 'parentid', 'id')->select('id', 'title', 'slug', 'parentid')->orderBy('order', 'asc')->orderBy('id', 'desc');
    }
    public function posts()
    {
        return $this->hasMany(Documents_relationships::class, 'catalogueid')->where('module', '=', 'documents')
            ->join('documents', 'documents.id', '=', 'documents_relationships.moduleid')
            ->where(['documents.publish' => 0])
            ->select('documents.id', 'documents.title', 'documents.slug', 'documents.description', 'documents.image', 'documents.created_at', 'documents_relationships.catalogueid')
            ->orderBy('documents.order', 'asc')->orderBy('documents.id', 'desc');
    }
    public function postsFields()
    {
        return $this->hasMany(Documents_relationships::class, 'catalogueid')->where('documents_relationships.module', '=', 'documents')
            ->join('documents', 'documents.id', '=', 'documents_relationships.moduleid')
            ->join('config_postmetas', 'documents_relationships.moduleid', '=', 'config_postmetas.module_id')
            ->where(['documents.publish' => 0, 'config_postmetas.module' => 'documents'])
            ->select('documents.id', 'documents.title', 'documents.slug', 'documents.image', 'documents_relationships.catalogueid', 'config_postmetas.meta_value')
            ->orderBy('documents.order', 'asc')->orderBy('documents.id', 'desc');
    }
}
