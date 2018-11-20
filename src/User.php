<?php

namespace BitbucketWrapper;

use GuzzleHttp\Client;

class User extends Base
{
    protected $url = 'https://api.bitbucket.org/2.0/user';

    /**
     * User constructor.
     * @param Client $client
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->request($this->url);
    }
}
