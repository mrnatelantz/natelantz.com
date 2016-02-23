<?php

namespace App\Modules\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class PageVersions extends Model
{

    protected $fillable = ['page_id', 'slug', 'name', 'cover_image', 'content', 'template'];

    public function getContentAttribute($value)
    {
        if(is_string($value)) {
            return json_decode($value);
        }
        return $value;
    }

    public function setContentAttribute($value)
    {
        if(!is_string($value)) {
            $this->attributes['content'] = json_encode($value);
        }
        else {
            $this->attributes['content'] = $value;
        }

    }

    public function page()
    {
        return $this->belongsTo('App\Modules\Pages\Models\Page', 'page_id', 'id');
    }
}
