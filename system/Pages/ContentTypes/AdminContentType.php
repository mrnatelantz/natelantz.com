<?php

namespace RadCms\Pages\ContentTypes;

use RadCms\Pages\ContentTypes\ContentTypeLoader;
use Config;

class AdminContentType extends ContentTypeLoader
{

    public function __construct()
    {
        $this->systemDir = __DIR__ . '/../Views/admin/content-types/body/';
        foreach(Config::get('view.paths') as $path) {
            $this->customDir[] = $path.'/admin/content-types/body/';
        }
    }




}