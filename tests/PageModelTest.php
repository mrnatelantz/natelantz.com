<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageModelTest extends TestCase
{
    /** @test */
    function it_should_have_the_same_structure()
    {
        $page = factory(App\Modules\Pages\Page::class)->make();
        $keys = array_keys($page['attributes']);
        $this->assertEquals([
                'slug', 'name', 'cover_image', 'content', 'template', 'published_date', 'unpublish_date', 'published'
            ],
            $keys
        );

    }

    /** @test */
    function content_should_be_json_decoded()
    {
        $page = factory(App\Modules\Pages\Page::class)->make();
        $this->assertTrue(is_object($page->content), 'Content should be an Object');
    }

    /** @test */
    function should_be_able_to_locate_template_file()
    {
        $page = factory(App\Modules\Pages\Page::class)->make();
        $this->assertFileExists(view($page->template)->getPath());
    }
}
