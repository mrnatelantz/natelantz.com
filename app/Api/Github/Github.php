<?php

namespace app\Api\Github;

use GuzzleHttp\Client as GuzzleClient;
use Cache;

class Github
{
    protected $username;
    protected $url = 'https://api.github.com/users/';
    protected $response;
    protected $repos;
    protected $cacheKey = 'Github_Repos';
    protected $cacheTime = 1;

    public function __construct($username = null)
    {
        $this->username = $username;
        $this->checkUserName();
    }

    public function getRepos()
    {
        return $this->getCache();
    }

    private function checkUserName()
    {
        if (!isset($this->username) || strlen($this->username) <= 0) {
            throw new \Exception('Missing Username!');
        }
    }

    private function parseRepos()
    {
        $tmp = [];
        foreach (json_decode($this->response->getBody()->getContents()) as $key => $repo) {
            $tmp[] = [
                'name' => $repo->name,
                'url' => $repo->html_url,
            ];
        }
        $this->repos = $tmp;
    }

    private function setCache($repos)
    {
        Cache::put($this->cacheKey, $repos, $this->cacheTime);
    }

    private function getCache()
    {
        return Cache::remember($this->cacheKey, $this->cacheTime, function () {
            return $this->send('repos');
        });
    }

    private function send($param = 'repos')
    {
        $githubUrl = $this->url.$this->username.'/'.$param.'?access_token='.env('GITHUB_TOKEN');
        $client = new GuzzleClient();
        $this->response = $client->get($githubUrl);
        $this->parseRepos();
        $this->setCache($this->repos);

        return $this->getCache();
    }
}
