<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Modules\System\Modules\Modules;

class ModulesTest extends TestCase
{
    /** @test */
    function it_finds_modules_file()
    {
        $loader = new Modules();
        $modules = $loader->all();
        $this->assertGreaterThan(0, count($modules));
    }
}
