<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Modules\Pages\Http\Controllers\PageController;

class PageControllerTest extends TestCase
{
    /** @test */
    function it_returns_all_pages()
    {
        $page = factory(App\Modules\Pages\Models\Page::class)->make();
        $this->visit('admin/pages')
            //->assertViewHas('pages', $page);
    }
}
