<?php

namespace BitbucketWrapper;

class Teams extends Base
{
    protected $client;
    protected $url = 'https://api.bitbucket.org/2.0/teams';

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
        return $this->request($this->url.'/'.config('bitbucket.bitbucket.account'));
    }

    /**
     * @return mixed
     */
    public function getTeamFollowers()
    {
        return $this->request($this->url.'/'.config('bitbucket.bitbucket.account').'/followers');
    }

    /**
     * @return mixed
     */
    public function getMembers()
    {
        return $this->request($this->url.'/'.config('bitbucket.bitbucket.account').'/members');
    }
}
