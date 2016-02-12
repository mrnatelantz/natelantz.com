<?php

namespace App\Repositories;

use App\Api\Github\Github;

class MyActivities
{
	protected $github;

	
	public function __construct()
	{
		$this->github = new Github(env('GITHUB_USER'));
	}
	

	public function all()
	{
		return $this->githubRepos();
	}

	private function githubRepos()
	{
		$repos = [];
		foreach($this->github->getRepos() as $key => $repo) {
			$repos[$key] = $repo;
			$repos[$key]['background_class'] = 'github';
		}
		return $repos;
	}
}