<?php

namespace RadCms\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class ChildMenuItem extends Model
{
    protected $fillable =['parent_id', 'child_id'];

    public $timestamps = false;

    public function child_item()
    {
        return $this->hasOne('RadCms\Menu\Models\MenuItem', 'id', 'child_id');
    }


}
