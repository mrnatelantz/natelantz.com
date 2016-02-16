<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminDashboardControllerTest extends TestCase
{
    use WithoutMiddleware;

    /** @test */
    function should_see_dashboard_page()
    {
        $this->visit('/admin/dashboard');
    }
}
