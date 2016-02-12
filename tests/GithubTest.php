<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Api\Github\Github;

class GithubTest extends TestCase
{

	/** @test */
	function it_should_throw_an_exception_if_username_is_blank()
	{
		$this->setExpectedException(\Exception::class);
		$github = new Github();
		
	}

    /** @test */
    function it_should_have_repos()
    {
    	$github = new Github(env("GITHUB_USER"));	
    	$repos = $github->getRepos();
    	$this->assertGreaterThan(0, count($repos));		
    }

    /** @test */
    function repos_should_have_a_name()
    {
    	$github = new Github(env("GITHUB_USER"));	
    	$repos = $github->getRepos();
    	$this->assertGreaterThan(0, strlen($repos[0]['name']));		
    }

    /** @test */
    function repos_should_have_a_url()
    {
    	$github = new Github(env("GITHUB_USER"));	
    	$repos = $github->getRepos();
    	$this->assertGreaterThan(0, strlen($repos[0]['url']));	
    }
}
