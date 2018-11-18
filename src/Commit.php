<?php

namespace BitbucketWrapper;


use GuzzleHttp\Client;

class Commit extends Base
{
    protected $url = 'https://api.bitbucket.org/2.0/repositories/';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getPagedCommitsForRepo($repoSlug)
    {
        if(strpos($this->url, config('bitbucket.bitbucket.account')) || (strpos($this->url, config('bitbucket.bitbucket.account')) && strpos($this->url, $repoSlug))) {
            $url = $this->url;
        } else {
            $url = $this->url . config('bitbucket.bitbucket.account'). '/' . $repoSlug . '/commits';
        }
        return $this->request($url);
    }

    public function all($repoSlug)
    {
        $commits = [];
        while(true) {
            $pagedCommits = $this->getPagedCommitsForRepo($repoSlug);

            foreach($pagedCommits->values as $commit) {
                $commits[] = $commit;
            }

            if(isset($pagedCommits->next))
            {
                $this->url = $pagedCommits->next;
            } else {
                break;
            }
        }
        return $commits;
    }

    public function getCommitsFromDate($repoSlug, $date)
    {

    }

}
