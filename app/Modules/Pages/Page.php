<?php

namespace App\Modules\Pages;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{


    public function getContentAttribute($value)
    {
        if(is_string($value)) {
            return json_decode($value);
        }
        return $value;
    }
}
