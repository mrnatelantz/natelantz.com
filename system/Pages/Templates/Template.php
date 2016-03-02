<?php

namespace RadCms\Pages\Templates;

use RadCms\Pages\Templates\TemplateInterface;
use Illuminate\Support\Facades\Config;

class Template implements TemplateInterface
{

    public function all()
    {
        $viewPaths = Config::get('view.paths');
        $viewFiles = [];

        foreach($viewPaths as $path) {
            $views = glob($path."/*.blade.php");
            foreach($views as $view) {
                $viewFiles[] = str_replace('.blade.php', '', last(explode("/", $view)));
            }

        }
        return $viewFiles;
    }
}