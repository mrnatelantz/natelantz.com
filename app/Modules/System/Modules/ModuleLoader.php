<?php

namespace App\Modules\System\Modules;

use App\Modules\System\Modules\ModuleLoaderInterface;

class ModuleLoader implements ModuleLoaderInterface
{
    protected $modules = [];
    protected $modulesDir = 'app/Modules/';
    protected $moduleFiles = [];
    protected $moduleFileName = 'module.php';

    public function __construct($dir = null)
    {

        $this->scan($dir)
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