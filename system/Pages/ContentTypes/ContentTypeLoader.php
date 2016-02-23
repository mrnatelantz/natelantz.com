<?php

namespace RadCms\Pages\ContentTypes;

use RadCms\Pages\ContentTypes\ContentTypeInterface;

class ContentTypeLoader implements ContentTypeInterface
{
    protected $systemDir = '';
    protected $systemViewPrefix = 'pages::admin.content-types.';
    protected $customViewPrefix = 'admin.content-types.';
    protected $customDir = [];
    protected $contentTypes = [];

    public function all()
    {
        $this->loadTemplates();
        return $this->contentTypes;
    }

    /**
     * @param array $paths
     * @return $this
     * Overrides currently defined custom directory paths
     */
    public function setCustomPaths($paths = [])
    {
        if(empty($paths)){ return $this; }

        $this->customDir = $paths;
        return $this;
    }

    /**
     * @param array $paths
     * @return $this
     * Adds more to currently defined custom directory paths
     */
    public function addCustomPaths($paths = [])
    {
        if(empty($paths)){ return $this; }

        foreach($paths as $path) {
            $this->customDir[] = $path;
        }
    }


    /**
     * @return $this
     * @todo Implement caching
     */
    protected function loadTemplates()
    {
        // Load the system content types
        foreach(glob($this->systemDir.'*.blade.php') as $file) {
            $this->addContentType($file, $this->systemViewPrefix);
        }

        // load the custom content types
        foreach($this->customDir as $path) {
            foreach(glob($path.'*.blade.php') as $file) {
                $this->addContentType($file, $this->customViewPrefix);
            }
        }

        return $this;
    }

    /**
     * @param $file
     * @param $viewPrefix
     */
    protected function addContentType($file, $viewPrefix)
    {
        $viewArray = explode('/', $file);
        $viewFile = end($viewArray);
        $contentTypeName = explode('.', $viewFile)[0];
        $this->filterContentTypes($contentTypeName);
        $viewName = $viewPrefix . $contentTypeName;
        $this->contentTypes[] = [
            'name' => $contentTypeName,
            'real_path' => $file,
            'view_name' => $viewName,
        ];

        $this->contentTypes = $this->cleanUpContentTypes($this->contentTypes);
    }

    /**
     * @param null $contentTypeName
     * @return null
     * Removes duplicates from array.
     * Allows for custom content types to override system content types
     */
    protected function filterContentTypes($contentTypeName = null)
    {
        if(is_null($contentTypeName)) { return null; }
        foreach($this->contentTypes as $key => $contentType) {
            if($contentType['name'] === $contentTypeName) {
                unset($this->contentTypes[$key]);
            }
        }
    }

    /**
     * @param array $data
     * @return array|null
     * Formats content type array for return
     */
    protected function cleanUpContentTypes($data = [])
    {
        if(empty($data)){ return null; }

        $tmp = [];
        $tmp = array_merge($tmp, $data); // re-index array, happens when overriding content types
        $tmp = array_sort_recursive($tmp); // puts it in alphabetical order
        return $tmp;
    }
}