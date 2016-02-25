<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use RadCms\Modules\SystemModules;

class ModulesTest extends TestCase
{
    /** @test */
    function it_finds_system_modules_file()
    {
        $loader = new SystemModules();
        $modules = $loader->all();
        $this->assertGreaterThan(0, count($modules));
    }
}
