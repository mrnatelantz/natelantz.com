<?php

namespace RadCms\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $fillable = ['menu_id', 'parent_id', 'type', 'page_id', 'name', 'url', 'target'];

    public $timestamps = false;

    public function page()
    {
        return $this->hasOne('RadCms\Pages\Models\Page', 'id', 'page_id');
    }
}
