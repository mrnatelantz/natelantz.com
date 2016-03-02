<?php
/**
 * I have no idea why I made this. It's not being used
 */

namespace RadCms\Pages\ContentTypes;

use View;

trait ContentTypeTemplateTrait
{
    protected $viewInfo = [];

    public function find($viewName = null)
    {
        if(is_null($viewName)){ return null; }
        $this->viewInfo = $this->searchContentTypes($viewName, $this->contentTypes);
        return $this->loadView();
    }


    public function viewInfo($viewName = null)
    {
        if(is_null($viewName)){ return null; }
        $this->viewInfo = $this->searchContentTypes($viewName, $this->contentTypes);
        return $this->viewInfo;
    }

    protected function loadView()
    {
        $contentType = [
            'content' => '',
            'orderByCount' => '',
            'ajax' => true,
        ];

        if(View::exists($this->viewInfo['view_name'])) {
            $view = View::make($this->viewInfo['view_name'], ['contentType' => $contentType]);
            return $view->render();
        }

        return null;

    }

    protected function searchContentTypes($viewName)
    {
        foreach($this->contentTypes as $key => $val) {
            if($val['name'] === $viewName) {
                return $this->contentTypes[$key];
            }
        }
        return null;
    }
}