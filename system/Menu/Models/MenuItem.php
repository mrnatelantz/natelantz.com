<?php

namespace RadCms\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $fillable = ['menu_id', 'type', 'page_id', 'name', 'url', 'target'];

    public $timestamps = false;

    public function page()
    {
        return $this->hasOne('RadCms\Pages\Models\Page', 'id', 'page_id');
    }

    public function children()
    {
        return $this->hasMany('RadCms\Menu\Models\ChildMenuItem', 'parent_id', 'id');
        /*
        return $this->hasManyThrough(
            'RadCms\Menu\Models\MenuItem',
            'RadCms\Menu\Models\ChildMenuItem',
            'child_id',
            'id'
        );
        */
    }

    public function child()
    {
        $this->belongsTo('RadCms\Menu\Models\ChildMenuItem');
    }


}
