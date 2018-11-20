<?php

namespace BitbucketWrapper;


use GuzzleHttp\Client;
class PullRequest extends Base
{
    protected $client;
    protected $url = 'https://api.bitbucket.org/2.0/pullrequests/';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getUsersPullRequests(string $user)
    {
        return $this->request($this->url . $user);
    }

}
