<?php

namespace BitbucketWrapper;


use GuzzleHttp\Client;

class Teams extends Base
{
    protected $client;
    protected $url = 'https://api.bitbucket.org/2.0/teams';

    /**
     * Teams constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @return mixed
     */
    public function getUsersInTeam()
    {
        return $this->request($this->url);
    }

    /**
     * @return mixed
     */
    public function getTeamProfile()
    {
        return $this->request($this->url .'/' . config('bitbucket.bitbucket.account'));
    }

    /**
     * @return mixed
     */
    public function getTeamFollowers()
    {
        return $this->request($this->url . '/' . config('bitbucket.bitbucket.account'). '/followers');
    }

    /**
     * @return mixed
     */
    public function getMembers()
    {
        return $this->request($this->url . '/' . config('bitbucket.bitbucket.account'). '/members');
    }
}
