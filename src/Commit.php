<?php

namespace BitbucketWrapper;

use Carbon\Carbon;

class Commit extends Base
{
    protected $url = 'https://api.bitbucket.org/2.0/repositories/';
    protected $client;

    /**
     * @param $repoSlug
     * @return mixed
     */
    public function getPagedCommitsForRepo(string $repoSlug)
    {
        if (strpos($this->url, config('bitbucket.bitbucket.account')) || (strpos($this->url,
            config('bitbucket.bitbucket.account')) && strpos($this->url, $repoSlug))) {
            $url = $this->url;
        } else {
            $url = $this->url.config('bitbucket.bitbucket.account').'/'.$repoSlug.'/commits';
        }

        $request = $this->request($url);
        $this->url = $request->next ?? $this->url;

        return $request;
    }

    /**
     * @return bool|string
     */
    public function getNextPage()
    {
        $nextPage = $this->request($this->url);
        $this->url = $nextPage->next ?? false;

        return $this->url;
    }

    /**
     * @param $repoSlug
     * @return array
     */
    public function all(string $repoSlug)
    {
        $commits = [];
        while (true) {
            $pagedCommits = $this->getPagedCommitsForRepo($repoSlug);

            foreach ($pagedCommits->values as $commit) {
                $commits[] = $commit;
            }

            if (isset($pagedCommits->next)) {
                $this->url = $pagedCommits->next;
            } else {
                break;
            }
        }

        return $commits;
    }

    /**
     * @param $repoSlug
     * @param $date
     * @return array
     */
    public function getCommitsFromDate(string $repoSlug, string $date)
    {
        $commits = [];
        $date = Carbon::parse($date);

        while (true) {
            $pagedCommits = $this->getPagedCommitsForRepo($repoSlug);

            foreach ($pagedCommits->values as $commit) {
                if (! Carbon::parse($commit->date)->gte($date)) {
                    $break = true;
                    break;
                } else {
                    $commits[] = $commit;
                }
            }
            $this->url = $pagedCommits->next ?? $this->url;
            if (! isset($commit->next) || isset($break)) {
                break;
            }
        }

        return $commits;
    }

    /**
     * @param $repoSlug
     * @param $date
     * @return array
     */
    public function getCommitsByDate(string $repoSlug, string $date)
    {
        $date = Carbon::parse($date)->startOfDay();
        $commits = [];
        while (true) {
            $pagedCommits = $this->getPagedCommitsForRepo($repoSlug);
            foreach ($pagedCommits->values as $commit) {
                $commitDate = Carbon::parse($commit->date)->startOfDay();
                if ($date->equalTo($commitDate)) {
                    $commits[] = $commit;
                } elseif ($commitDate->lessThan($date)) {
                    $break = true;
                    break;
                }
            }

            $this->url = $pagedCommits->next ?? $this->url;
            if (isset($break)) {
                break;
            }
        }

        return $commits;
    }
}
