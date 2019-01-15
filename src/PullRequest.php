<?php

namespace BitbucketWrapper;

class PullRequest extends Base
{
    protected $client;
    protected $url = 'https://api.bitbucket.org/2.0/pullrequests/';

    /**
     * @param string $user
     * @return mixed
     */
    public function getUsersPullRequests(string $user)
    {
        return $this->request($this->url.$user);
    }
}
