<?php

namespace App\Modules\Pages;

use Illuminate\Database\Eloquent\Model;

class PageVersions extends Model
{

    protected $fillable = ['page_id', 'slug', 'name', 'cover_image', 'content', 'template'];

    public function setContentAttribute($value)
    {
        if(is_object($value)) {
            $this->attributes['content'] = json_encode($value);
        }
        else {
            $this->attributes['content'] = $value;
        }

    }

    public function page()
    {
        return $this->belongsTo('App\Modules\Pages\Page');
    }
}
