<?php

namespace RadCms\Modules;

use RadCms\Modules\ModuleLoader;

class SystemModules extends ModuleLoader
{
        public function __construct($dir = null)
        {
            $dir = (is_null($dir)) ? 'system/' : $dir;
            parent::__construct($dir);
        }
}