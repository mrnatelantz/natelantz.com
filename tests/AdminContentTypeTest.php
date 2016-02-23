<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use RadCms\Pages\ContentTypes\AdminContentType;
use RadCms\Pages\ContentTypes\AdminContentTypeTemplate;

class AdminContentTypeTest extends TestCase
{
    /** @test */
    function it_should_find_all_admin_module_content_types()
    {
        $contentType = new AdminContentType();
        $pageContentTypes = $contentType->all();
        $this->assertGreaterThan(0, count($pageContentTypes));
    }

    /** @test */
    function it_should_return_a_content_type_template()
    {
        // load the content types for the view
        $contentType = new AdminContentType();
        $pageContentTypes = $contentType->all();

        // load template from controller
        $contentTypeTemplate = new AdminContentTypeTemplate();
        $template = $contentTypeTemplate->find($pageContentTypes[0]['name']);
        $viewInfo = $contentTypeTemplate->viewInfo($pageContentTypes[0]['name']);

        $this->assertFileExists($viewInfo['real_path']);
        $this->assertInternalType('string', $template);

    }
}
