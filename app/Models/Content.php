<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translatable;

class Content extends Model
{

    use Translatable;
    protected $table = 'contents';
    protected $fillable = ['title', 'path', 'image_preview', 'content_type_id', 'category_id', 'patch_number'];


    public function getImagePreviewAttribute($value)
    {
        return $value ? url($value) : '';
    }


    public function getPathAttribute($value)
    {
        if (preg_match('(mp4|flv|3gp|mp3|webm|wav|png|jpeg|jpg)', $value)) {
            return $value ? url($value) : '';
        }
        return $value;
    }


    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\ContentType', 'content_type_id', 'id');
    }

    // rbt sms code realtion
    public function rbt_operators()
    {
        return $this->belongsToMany('App\Models\Operator', 'rbt_codes', 'content_id', 'operator_id')
            ->withPivot('id', 'rbt_code')->withTimestamps();
    }

    public function operators()
    {
        return $this->belongsToMany('App\Models\Operator', 'posts', 'content_id', 'operator_id')->using(Post::class)
            ->withPivot('id', 'published_date', 'active', 'url', 'user_id')->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'content_id', 'id');
    }
}
