<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Modules\Pages\Models\Page;
use App\Modules\Pages\Models\PageVersions;

class PageModelTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function it_should_have_the_same_structure()
    {
        $page = factory(App\Modules\Pages\Models\Page::class)->make();
        $keys = array_keys($page['attributes']);
        $this->assertEquals([
                'slug', 'name', 'cover_image', 'content', 'template', 'publish_date', 'unpublish_date', 'published'
            ],
            $keys
        );
    }

    /** @test */
    function content_should_be_json_decoded()
    {
        $page = factory(App\Modules\Pages\Models\Page::class)->make();
        $this->assertTrue(is_object($page->content), 'Content should be an Object');
    }

    /** @test */
    function should_be_able_to_locate_template_file()
    {
        $page = factory(App\Modules\Pages\Models\Page::class)->make();
        $this->assertFileExists(view($page->template)->getPath());
    }

    /** @test */
    function it_should_create_a_page_version_from_a_page()
    {
        $pageFactory = factory(App\Modules\Pages\Models\Page::class)->make();

        $page = Page::create($pageFactory['attributes']);
        $this->assertInstanceOf('App\Modules\Pages\Models\Page', $page);
        $data = [
            'page_id' => $page->id,
            'slug' => $page->slug,
            'cover_image' => $page->cover_image,
            'content' => $page->content,
            'template' => $page->template
        ];
        $pageVersion = PageVersions::create($data);
        $this->assertInstanceOf('App\Modules\Pages\Models\PageVersions', $pageVersion);
    }
}
