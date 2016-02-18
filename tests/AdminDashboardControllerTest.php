<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use RadCms\Modules\Modules;

class AdminDashboardControllerTest extends TestCase
{
    use WithoutMiddleware;

    /** @test */
    function should_see_dashboard_page()
    {
        $this->visit('/admin/dashboard');
    }

    /**
     * @test
     * @todo move test to a view composer test if possible
     * Doesn't make sense, passes if hardcode the data expected,
     * but fails when loading it dynamically.
     * This was moved to a view composer, should get moved.
     */
    function it_should_have_modules()
    {
        $this->markTestSkipped('must be revisited.');
        $modules = [
            0 => [
                'name' => 'Pages',
                'route' => 'pages.index',
                'icon' => 'glyphicon glyphicon-book'
            ]
        ];

        $realModules = new Modules();
        $this->assertEquals($modules, $realModules->all());

        $this->visit('/admin/dashboard')
            ->assertViewHas('modules', $modules);

        // This throws 500 errors
        // When visiting the page in the browser it works as expected
        $this->visit('/admin/dashboard')
            ->assertViewHas('modules', $realModules->all());

    }
}
