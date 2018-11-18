<?php

namespace BitbucketWrapper;

class base
{
    /**
     * @param $url
     * @return mixed
     */
    public function request($url)
    {
        if (!strpos($url, config('bitbucket.bitbucket.account'))) {
            $url = $url . config('bitbucket.bitbucket.account');
        }
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
