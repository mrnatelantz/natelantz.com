<?php

namespace RadCms\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class PageVersions extends Model
{

    protected $fillable = ['page_id', 'slug', 'name', 'cover_image', 'head', 'content', 'foot', 'template'];

    public function getHeadAttribute($value)
    {
        if(is_string($value)) {
            return json_decode($value);
        }
        return $value;
    }

    public function getContentAttribute($value)
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

    public function setContentAttribute($value)
    {
        if(!is_string($value)) {
            $this->attributes['content'] = json_encode($value);
        }
        else {
            $this->attributes['content'] = $value;
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

    public function page()
    {
        return $this->belongsTo('RadCms\Pages\Models\Page', 'page_id', 'id');
    }
}
