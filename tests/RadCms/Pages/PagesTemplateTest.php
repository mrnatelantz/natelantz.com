<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use RadCms\Pages\Templates\Template;

class PagesTemplateTest extends TestCase
{
    /** @test */
    function it_should_find_templates_in_theme_directory()
    {
        $templates = new Template();
        $this->assertGreaterThan(0, count($templates->all()));

    }
}
