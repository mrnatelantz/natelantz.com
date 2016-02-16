<?php

namespace App\Modules\Pages;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $fillable = ['slug', 'name', 'cover_image', 'content', 'template', 'publish_date', 'unpublish_date', 'published'];

    public function getContentAttribute($value)
    {
        if(is_string($value)) {
            return json_decode($value);
        }
        return $value;
    }

    public function versions()
    {
        return $this->hasMany('App\Modules\Pages\PageVersions');
    }
}
