<?php

namespace RadCms\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $fillable = ['slug', 'name', 'cover_image', 'head', 'body', 'foot', 'template', 'publish_date', 'unpublish_date', 'published'];


    public function getHeadAttribute($value)
    {
        if(is_string($value)) {
            return json_decode($value);
        }
        return $value;
    }

    public function getBodyAttribute($value)
    {
        if(is_string($value)) {
            return json_decode($value);
        }
        return $value;
    }

    public function getFootAttribute($value)
    {
        if(is_string($value)) {
            return json_decode($value);
        }
        return $value;
    }

    public function setHeadAttribute($value)
    {
        if(!is_string($value)) {
            $this->attributes['head'] = json_encode($value);
        }
        else {
            $this->attributes['head'] = $value;
        }

    }

    public function setBodyAttribute($value)
    {
        if(!is_string($value)) {
            $this->attributes['body'] = json_encode($value);
        }
        else {
            $this->attributes['body'] = $value;
        }

    }

    public function setFootAttribute($value)
    {
        if(!is_string($value)) {
            $this->attributes['foot'] = json_encode($value);
        }
        else {
            $this->attributes['foot'] = $value;
        }

    }

    public function versions()
    {
        return $this->hasMany('RadCms\Pages\Models\PageVersions', 'page_id', 'id');
    }

}
