<?php

namespace BitbucketWrapper;

use GuzzleHttp\Client;

class PullRequest extends Base
{
    protected $client;
    protected $url = 'https://api.bitbucket.org/2.0/pullrequests/';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getUsersPullRequests(string $user)
    {
        return $this->request($this->url . $user);
    }

}
