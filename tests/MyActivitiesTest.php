<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Repositories\MyActivities;

class MyActivitiesTest extends TestCase
{
    /** @test */
    function it_should_have_this_structure()
    {
    	$activities = new MyActivities();
    	$res = $activities->all();
    	$this->assertArrayHasKey('name', $res[0]);
    	$this->assertArrayHasKey('url', $res[0]);
    	$this->assertArrayHasKey('background_class', $res[0]);
    }
}
