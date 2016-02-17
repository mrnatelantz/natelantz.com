<?php

namespace App\Modules\System\Modules;

use App\Modules\System\Modules\ModuleLoader;

class Modules extends ModuleLoader
{
    public function __construct($dir = null)
    {
        $this->modulesDir = (is_null($dir)) ? $this->modulesDir : $dir;
        parent::__construct();
    }

}