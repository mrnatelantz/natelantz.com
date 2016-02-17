<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Modules\System\Modules\SystemModules;

class SystemModulesTest extends TestCase
{
    /** @test */
    function it_should_find_modules()
    {
        $loader = new SystemModules();
        $modules = $loader->all();
        $this->assertGreaterThan(0, count($modules));
    }
}
