<?php

namespace RadCms\Modules;

use RadCms\Modules\ModuleLoaderInterface;

class ModuleLoader implements ModuleLoaderInterface
{
    protected $modules = [];
    protected $modulesDir = 'Modules/';
    protected $moduleFiles = [];
    protected $moduleFileName = 'module.php';

    public function __construct($dir = null)
    {
        $this->modulesDir = (is_null($dir)) ? app_path($this->modulesDir) : base_path($dir);
        $this->scan()
            ->load();
    }

    public function all()
    {
        return $this->modules;
    }

    protected function scan()
    {
        if(is_null($this->modulesDir)) { return null; }

        foreach(glob($this->modulesDir.'*/'.$this->moduleFileName) as $file) {
            array_push($this->moduleFiles, $file);
        }

        return $this;
    }

    protected function load()
    {
        if(empty($this->moduleFiles)) { return null; }

        foreach($this->moduleFiles as $file) {
            $this->modules[] = $this->readModuleFile($file);
        }
    }

    protected function readModuleFile($file = null)
    {
        if(is_null($file)) { return null; }

        if(file_exists($file)) {
            return include_once $file;
        }
    }

}