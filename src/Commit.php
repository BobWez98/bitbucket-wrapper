<?php

namespace BitbucketWrapper;


use GuzzleHttp\Client;

class Commit extends Base
{
    protected $url = 'https://api.bitbucket.org/2.0/repositories/';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getCommitsForRepo($repoSlug)
    {
        $commits = $this->request($this->url . config('bitbucket.bitbucket.account') . '/' . $repoSlug . '/commits');
        
    }

}
