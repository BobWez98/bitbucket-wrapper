<?php

namespace BitbucketWrapper;

class Repository extends Base
{
    protected $client;
    protected $url = 'https://api.bitbucket.org/2.0/repositories/';
    protected $account_name;
    protected $nextPage;

    /**
     * @param $url
     * @return mixed
     */
    public function getPagedRepositories()
    {
        if (! strpos($this->url, config('bitbucket.bitbucket.account'))) {
            $url = $this->url.config('bitbucket.bitbucket.account');
        } else {
            $url = $this->url;
        }
        $repositories = $this->request($url);

        $this->url = isset($repositories->next) ? $repositories->next : $this->url;

        return $repositories;
    }

    /**
     * @param $page
     * @return bool|mixed
     */
    public function getNextPage()
    {
        $page = $this->request($this->url);
        $this->url = isset($page->next) ? $page->next : $this->url;

        return $page;
    }

    /**
     * @return array
     */
    public function all()
    {
        $repositories = [];
        while (true) {
            $repos = $this->getPagedRepositories();
            foreach ($repos->values as $repo) {
                $repositories[] = $repo;
            }

            if (isset($repos->next)) {
                $this->url = $repos->next;
            } else {
                break;
            }
        }

        return $repositories;
    }
}
