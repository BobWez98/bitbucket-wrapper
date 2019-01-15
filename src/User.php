<?php

namespace BitbucketWrapper;

class User extends Base
{
    protected $url = 'https://api.bitbucket.org/2.0/user';

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->request($this->url);
    }
}
