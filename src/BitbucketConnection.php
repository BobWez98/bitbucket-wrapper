<?php

namespace BitbucketWrapper;


use GuzzleHttp\Client;

class BitbucketConnection
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function connect($client)
    {

    }
}
