<?php

namespace RadCms\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

    public function menu_items()
    {
        return $this->hasMany('RadCms\Menu\Models\MenuItem', 'menu_id', 'id');
    }
}
