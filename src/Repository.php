<?php

namespace BitbucketWrapper;

use \GuzzleHttp\Client;

class Repository extends Base
{
    protected $client;
    protected $url = 'https://api.bitbucket.org/2.0/repositories/';
    protected $account_name;
    protected $nextPage;

    /**
     * Repository constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->account_name = config('bitbucket.bitbucket.account');
    }

    /**
     * @param $url
     * @return mixed
     */
    public function getPagedRepositories($url)
    {
        if (!strpos($url, config('bitbucket.bitbucket.account'))) {
            $url = $url . config('bitbucket.bitbucket.account');
        }

        return json_decode($this->request($url));
    }

    /**
     * @param $page
     * @return bool|mixed
     */
    public function getNextPage($page)
    {
        if ($this->hasNextPage($page)) {
            $this->nextPage = $page->next;
        } else {
            return $this->hasNextPage($page);
        }

        return $this->getPagedRepositories($page->next);
    }

    /**
     * @return array
     */
    public function all()
    {
        $repositories = [];
        while (true) {
            $repos = $this->getPagedRepositories($this->url);
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
