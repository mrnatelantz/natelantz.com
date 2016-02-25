<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use RadCms\Pages\Models\Page;

class PageControllerTest extends TestCase
{
    use DatabaseTransactions, WithoutMiddleware;


    /** @test */
    function it_returns_all_pages()
    {
        $pageFactory = factory(RadCms\Pages\Models\Page::class)->make();
        Page::create($pageFactory['attributes']);

        $this->visit('admin/pages')
            ->assertViewHas('pages', Page::all());
    }

    /** @test */
    function it_has_a_create_form_page()
    {
        $this->visit('/admin/pages/create');
    }
}
