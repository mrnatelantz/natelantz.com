<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use RadCms\Pages\ContentTypes\AdminContentType;
use RadCms\Pages\ContentTypes\AdminContentTypeTemplate;

class AdminContentTypeTest extends TestCase
{

    /*
    function it_should_find_head_content_types()
    {
        $contentType = new AdminContentType();
        $pageContentTypes = $contentType->head();
        $this->assertNotNull($pageContentTypes);

        // load template from controller
        $contentTypeTemplate = new AdminContentTypeTemplate();
        $template = $contentTypeTemplate->head($pageContentTypes[0]['name']);
        $viewInfo = $contentTypeTemplate->viewInfo('head.'.$pageContentTypes[0]['name']);

        // check to see if view file really exists
        // check to see if the rendered view is of string type
        $this->assertFileExists($viewInfo['real_path']);
        $this->assertInternalType('string', $template);
    }


    function it_should_find_body_content_types()
    {
        $contentType = new AdminContentType();
        $pageContentTypes = $contentType->body();
        $this->assertNotNull($pageContentTypes);



        // load template from controller
        $contentTypeTemplate = new AdminContentTypeTemplate();
        $template = $contentTypeTemplate->find($pageContentTypes[0]['name']);
        $viewInfo = $contentTypeTemplate->viewInfo($pageContentTypes[0]['name']);

        // check to see if view file really exists
        // check to see if the rendered view is of string type
        $this->assertFileExists($viewInfo['real_path']);
        $this->assertInternalType('string', $template);
    }


    function it_should_find_foot_content_types()
    {
        $contentType = new AdminContentType();
        $pageContentTypes = $contentType->foot();
        $this->assertNotNull($pageContentTypes);



        // load template from controller
        $contentTypeTemplate = new AdminContentTypeTemplate();
        $template = $contentTypeTemplate->find($pageContentTypes[0]['name']);
        $viewInfo = $contentTypeTemplate->viewInfo($pageContentTypes[0]['name']);

        // check to see if view file really exists
        // check to see if the rendered view is of string type
        $this->assertFileExists($viewInfo['real_path']);
        $this->assertInternalType('string', $template);
    }


    function it_should_get_all_content_types()
    {
        $contentType = new AdminContentType();

        $pageContentTypes = $contentType->all();
        $this->assertNotNull($pageContentTypes);

        dd($pageContentTypes);

        $this->assertArrayHasKey('head', $pageContentTypes);
        $this->assertArrayHasKey('body', $pageContentTypes);
        $this->assertArrayHasKey('foot', $pageContentTypes);

        // load template from controller
        $contentTypeTemplate = new AdminContentTypeTemplate();

        $templateHead = $contentTypeTemplate->find($pageContentTypes['head'][0]['name']);
        $viewInfoHead = $contentTypeTemplate->viewInfo($pageContentTypes['head'][0]['name']);

        // check to see if view file really exists
        // check to see if the rendered view is of string type
        $this->assertFileExists($viewInfoHead['real_path']);
        $this->assertInternalType('string', $templateHead);


        $templateBody = $contentTypeTemplate->find($pageContentTypes['body'][0]['name']);
        $viewInfoBody = $contentTypeTemplate->viewInfo($pageContentTypes['body'][0]['name']);

        // check to see if view file really exists
        // check to see if the rendered view is of string type
        $this->assertFileExists($viewInfoBody['real_path']);
        $this->assertInternalType('string', $templateBody);


        $templateFoot = $contentTypeTemplate->find($pageContentTypes['foot'][0]['name']);
        $viewInfoFoot = $contentTypeTemplate->viewInfo($pageContentTypes['foot'][0]['name']);

        // check to see if view file really exists
        // check to see if the rendered view is of string type
        $this->assertFileExists($viewInfoFoot['real_path']);
        $this->assertInternalType('string', $templateFoot);

    }
    */
}
