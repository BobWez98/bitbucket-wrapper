<?php

namespace BitbucketWrapper;

use GuzzleHttp\Client;

class PullRequest extends Base
{
    protected $client;
    protected $url = 'https://api.bitbucket.org/2.0/pullrequests/';

    /**
     * PullRequest constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $user
     * @return mixed
     */
    public function getUsersPullRequests(string $user)
    {
        return $this->request($this->url . $user);
    }

}
