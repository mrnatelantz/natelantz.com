<?php

namespace RadCms\Pages\ContentTypes;

use RadCms\Pages\ContentTypes\AdminContentType;
use RadCms\Pages\ContentTypes\ContentTypeTemplateTrait;

class AdminContentTypeTemplate extends AdminContentType
{
    use ContentTypeTemplateTrait;

    public function __construct()
    {
        // This is needed in order to setup the content type paths
        parent::__construct();
        $this->loadTemplates();
    }

}