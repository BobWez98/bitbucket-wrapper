<?php

namespace BitbucketWrapper;

class Base
{
    /**
     * @param $url
     * @return mixed
     */
    public function request($url)
    {
        return json_decode($res = $this->client->request('GET', $url, [
            'auth' => [
                config('bitbucket.bitbucket.username'),
                config('bitbucket.bitbucket.password')
            ]
        ])->getBody()->getContents());
    }

    /**
     * @param $page
     * @return bool
     */
    public function hasNextPage($page)
    {
        return isset($page->next) ? true : false;
    }
}
