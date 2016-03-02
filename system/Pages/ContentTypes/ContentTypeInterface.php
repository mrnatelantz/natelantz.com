<?php

namespace RadCms\Pages\ContentTypes;


interface ContentTypeInterface
{

    public function all();

    public function head();

    public function body();

    public function foot();
}