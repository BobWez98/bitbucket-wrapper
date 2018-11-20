<?php

namespace BitbucketWrapper;


use GuzzleHttp\Client;

class Teams extends Base
{
    protected $client;
    protected $url = 'https://api.bitbucket.org/2.0/teams';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getUsersInTeam()
    {
        return $this->request($this->url);
    }

    public function getTeamProfile()
    {
        return $this->request($this->url .'/' . config('bitbucket.bitbucket.account'));
    }

    public function getTeamFollowers()
    {
        return $this->request($this->url . '/' . config('bitbucket.bitbucket.account'). '/followers');
    }

    public function getMembers()
    {
        return $this->request($this->url . '/' . config('bitbucket.bitbucket.account'). '/members');
    }
}
