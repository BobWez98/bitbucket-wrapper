#Documentation

##Repositories
Get all repositories
````php
use BitbucketWrapper\Repository;

$repository = new Repository();

$repository->all();
````

Get paged repositories
````php
use BitbucketWrapper\Repository;

$repository = new Repository();

$repository->getPagedRepositories();
````

Get Next page
````php
$repository->getNextpage();
````

## Commits
Get all commits for a repository
````php
use BitbucketWrapper\Commit;

$commit = new Commit();

$commit->all($repoSlug);
````

Get paged commits
````php
use BitbucketWrapper\Commit;

$commit = new Commit();

$commit->getPagedCommitsForRepo($repoSlug);
````

Get next page
````php
$commit->getNextPage();
````

Get all commits after specific date
```php
use BitbucketWrapper\Commit;

$commit = new Commit();

$commit->getCommitsFromDate($repoSlug, $date);
```

Get all commits on a specific date
```php
user BitbucketWrapper\Commit;

$commit = new Commit();

$commit->getCommitsByDate($repoSlug, $date);
```

#Pullrequests

Get all users pullrequests
```php
use BitbucketWrapper\PullRequest;

$pullrequest = new PullRequest();

$pullrequest->getUsersPullRequests($username);
```

#Teams
Get all users in team
```php
use BitbucketWrapper\Teams;

$teams = new Teams();

$teams->getUsersInTeam();
```

Get teams profile
```php
use BitbucketWrapper\Teams;

$teams = new Teams();

$teams->getTeamProfile();
```

Get Teams followers
```php
use BitbucketWrapper\Teams;

$teams = new Teams();

$teams->getTeamFollowers();
```

Get Team members

```php
use BitbucketWrapper\Teams;

$teams = new Teams();

$teams->getMembers();
```

#User
Get current User
```php
use BitbucketWrapper\User;

$user = new User();

$user->get();
```
