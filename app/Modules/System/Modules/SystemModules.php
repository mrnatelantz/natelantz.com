<?php

namespace App\Modules\System\Modules;

use App\Modules\System\Modules\ModuleLoader;

class SystemModules extends ModuleLoader
{
        public function __construct()
        {
            $this->modulesDir = $this->modulesDir.'System/';
            parent::__construct();
        }
}