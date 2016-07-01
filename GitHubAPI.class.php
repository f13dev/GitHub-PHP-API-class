<?php
class GitHubAPI 
{    
    // Variable to contain the GitHub user name
    private $user;
    
    // Store the Oauth key
    private $token = '';
    
    // Variables to store API calls to reduce call cycles
    var $details;
    var $repos;
    var $repo;
    var $followers;
    var $following;
    var $gists;
    var $starred;
    var $subscriptions;
    var $organizations;
    var $events;
    var $receivedEvents;
    var $rateLimit;
    
    /*
     * Creates a new instance of the GitHub API
     */
    function GitHubAPI($aUser)
    {
        // Set the user variable to the argument aUser
        $this->user = $aUser;
        // Set the API variables to null
        $this->details = null;
        $this->repos = null;
        $this->repo = null;
        $this->followers = null;
        $this->following = null;
        $this->gists = null;
        $this->starred = null;
        $this->subscriptions = null;
        $this->organizations = null;
        $this->events = null;
        $this->receivedEvents = null;
        $this->rateLimit = null;
    }
    
    /**
      * Returns an array of items relating to the GitHub API url
      * given in the argument.
      */
    private function getResults($url)
    {
        // Start curl
        $curl = curl_init();
        // Set curl options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPGET, true);
        
        // Check if a token is set
        if (preg_replace('/\s+/', '', $this->token) != '' || $this->token != null)
        {
            // If a token is set attempt to send it in the header
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: token ' . $this->token
            ));
        }
        else 
        {
            // If no token is set, send the header as unauthenticated,
            // some features may not work and a lower rate limit applies.
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Accept: application/json'
            ));
        }
        // Set the user agent
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        // Set curl to return the response, rather than print it
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Get the results
        $result = curl_exec($curl);

        // Close the curl session
        curl_close($curl);

        // Decode the results
        $result = json_decode($result, true);

        // Return the results
        return $result;
    }
    
    /*
     * Returns an array of items relating to the GitHub user
     * for which an object was created
     */
    function getDetails()
    {
        if ($this->details == null)
        {
            $url = 'https://api.github.com/users/' . $this->user;
            $this->details = $this->getResults($url);
        }
    }
    
    /*
     * Returns an array of repos relating to the GitHub user
     * for which an object was created, each containing an array 
     * of details about each repository.
     */
    function getRepos()
    {
        if ($this->repos == null)
        {
            $url = 'https://api.github.com/users/' . $this->user . '/repos';
            $this->repos = $this->getResults($url);
        }
    }
    
    /*
     * Returns an array of details relating to the repository provided
     * as the argument, associated with the user for which an object
     * was created.
     */
    function getRepo($repo)
    {
        // Check if the currently stored repo has the same name
        if ($this->repo['name'] != $repo)
        {
            echo '<h3>Getting repo info for: ' . $repo .'</h3>';
            $url = 'https://api.github.com/repos/' . $this->user . '/' . $repo;
            $this->repo = $this->getResults($url);
        }
    }
    
    /*
     * Returns an array of details relating to followers of the GitHubAPI
     * user for which an object was created.
     */
    function getFollowers()
    {
        if($this->followers == null)
        {
            $url = 'https://api.github.com/users/' . $this->user . '/followers';
            $this->followers = $this->getResults($url);
        }
    }
    
    /*
     * Returns an array of details relating to the users that are followed
     * by the user for which an object was created.
     */
    function getFollowing()
    {
        if ($this->following == null)
        {
            $url = 'https://api.github.com/users/' . $this->user . '/following';
            $this->following = $this->getResults($url);
        }
    }
    
    /*
     * Returns an array of information relating to the public gists by the
     * user for which an object was created.
     */
    function getGists()
    {
        if ($this->gists == null)
        {
            $url = 'https://api.github.com/users/' . $this->user . '/gists';
            $this->gists = $this->getResults($url);
        }
    }
    
    /*
     * Returns an array of information relating to the repos starred by the
     * user for which an object was created.
     */
    function getStarred()
    {
        if ($this->starred == null)
        {
            $url = 'https://api.github.com/users/' . $this->user . '/starred';
            $this->starred = $this->getResults($url);
        }
    }
    
    /*
     * Returns an array of information relating to the subscriptions for the 
     * user for which an object was created.
     */
    function getSubscriptions()
    {
        if ($this->subscriptions == null)
        {
            $url = 'https://api.github.com/users/' . $this->user . '/subscriptions';
            $this->subscriptions = $this->getResults($url);
        }
    }
    
    /*
     * Returns an array of information relating to the organizations which
     * are linked to the user for which an object was created.
     */
    function getOrganizations()
    {
        if ($this->organizations == null)
        {
            $url = 'https://api.github.com/users/' . $this->user . '/orgs';
            $this->subscriptions = $this->getResults($url);
        }
    }
    
    /*
     * Returns an array of information relating to the events which are
     * linked to the user for which an object was created.
     */
    function getEvents()
    {
        if ($this->events == null)
        {
            $url = 'https://api.github.com/users/' . $this->user . '/events';
            $this->events = $this->getResults($url);
        }
    }
    
    /*
     * Returns an array of information relating to the received events which
     * are linked to the user for which an object was created.
     */
    function getReceivedEvents()
    {
        if ($this->receivedEvents == null)
        {
            $url = 'https://api.github.com/users/' . $this->user . '/received_events';
            $this->receivedEvents = $this->getResults($url);
        }
    }
    
    /*
     * Returns an aray of information relating to the rate limit for the IP
     * address, or OAUTH key being used.
     */
    function getRateLimit()
    {
        if ($this->rateLimit == null)
        {
            $url = 'https://api.github.com/rate_limit';
            $this->rateLimit = $this->getResults($url);
        }
    }
    
    // Start of getDetails functions
    
    /*
     * Returns the login name
     */
    function getLogin()
    {
        $this->getDetails();
        return $this->details['login'];
    }
    
    /*
     * Returns the GitHub numeric ID
     */
    function getID()
    {
        $this->getDetails();
        return $this->details['id'];
    }
    
    /*
     * Returns the avatar URL
     */
    function getAvatarURL()
    {
        $this->getDetails();
        return $this->details['avatar_url'];
    }
    
    /*
     * Returns the gravatar ID
     */
    function getGravatarID()
    {
        $this->getDetails();
        return $this->details['gravatar_id'];
    }
    
    /*
     * Returns the URL of the users profile
     */
    function getProfileURL()
    {
        $this->getDetails();
        return $this->details['html_url'];
    }
    
    /*
     * Returns the users name
     */
    function getName()
    {
        $this->getDetails();
        return $this->details['name'];
    }
    
    /*
     * Returns the users company
     */
    function getCompany()
    {
        $this->getDetails();
        return $this->details['company'];
    }
    
    /*
     * Returns the users website URL
     */
    function getBlog()
    {
        $this->getDetails();
        return $this->details['blog'];
    }
    
    /*
     * Returns the users location
     */
    function getLocation()
    {
        $this->getDetails();
        return $this->details['location'];
    }
    
    /*
     * Returns the users email address
     */
    function getEmail()
    {
        $this->getDetails();
        return $this->details['email'];
    }
    
    /*
     * Returns the users hierable status (true, false or null)
     */
    function getHierable()
    {
        $this->getDetails();
        return $this->details['hierable'];
    }
    
    /*
     * Returns the users bio
     */
    function getBio()
    {
        $this->getDetails();
        return $this->details['bio'];
    }
    
    /*
     * Returns the number of public repos
     */
    function getNumberRepos()
    {
        $this->getDetails();
        return $this->details['public_repos'];
    }
    
    /*
     * Returns the number of public gists
     */
    function getNumberGists()
    {
        $this->getDetails();
        return $this->details['public_gists'];
    }
    
    /*
     * Returns the number of followers
     */
    function getNumberFollowers()
    {
        $this->getDetails();
        return $this->details['followers'];
    }
    
    /*
     * Returns the number of following
     */
    function getNumberFollowing()
    {
        $this->getDetails();
        return $this->details['following'];
    }
    
    /*
     * Returns the date and time that the profile was created
     */
    function getProfileCreationTime()
    {
        $this->getDetails();
        return $this->details['created_at'];
    }
    
    /*
     * Returns the date and time that the profile was last updated
     */
    function getProfileUpdateTime()
    {
        $this->getDetails();
        return $this->details['updated_at'];
    }
    
    // Start of get Repo functions
    
    /*
     * Returns the ID of the repository
     */
    function getRepoID($repo)
    {
        $this->getRepo($repo);
        return $this->repo['id'];
    }
    
    /*
     * Returns the name of the repository
     */
    function getRepoName($repo)
    {
        $this->getRepo($repo);
        return $this->repo['name'];
    }
    
    /*
     * Returns the full name of the repository user/repo
     */
    function getRepoFullName($repo)
    {
        $this->getRepo($repo);
        return $this->repo['full_name'];
    }
    
    /*
     * Returns the URL of the repository
     */
    function getRepoURL($repo)
    {
        $this->getRepo($repo);
        return $this->repo['html_url'];
    }
    
    /*
     * Returns the description of the repository
     */
    function getRepoDescription($repo)
    {
        $this->getRepo($repo);
        return $this->repo['description'];
    }
    
    /*
     * Returns true if the repo is a fork, otherwise false
     */
    function getRepoIsFork($repo)
    {
        $this->getRepo($repo);
        return $this->repo['fork'];
    }
    
    /*
     * Returns the date and time the repo was created
     */
    function getRepoCreationTime($repo)
    {
        $this->getRepo($repo);
        return $this->repo['created_at'];
    }
    
    /*
     * Retuns the date and time of the last push for a repo
     */
    function getRepoPushTime($repo)
    {
        $this->getRepo($repo);
        return $this->repo['pushed_at'];
    }
    
    /*
     * Returns the date and time that the repo was last updated
     */
    function getRepoUpdateTime($repo)
    {
        $this->getRepo($repo);
        return $this->repo['updated_at'];
    }
    
    /*
     * Returns the Git URL for the repo
     */
    function getRepoGitURL($repo)
    {
        $this->getRepo($repo);
        return $this->repo['git_url'];
    }
    
    /*
     * Returns the SSH URL for the repo
     */
    function getRepoSSHURL($repo)
    {
        $this->getRepo($repo);
        return $this->repo['ssh_url'];
    }
    
    /*
     * Returns the clone Git URL for the repo
     */
    function getRepoCloneURL($repo)
    {
        $this->getRepo($repo);
        return $this->repo['clone_url'];
    }
    
    /*
     * Returns the SVN URL for the repo
     */
    function getRepoSVNURL($repo)
    {
        $this->getRepo($repo);
        return $this->repo['svn_url'];
    }
    
    /*
     * Returns the homepage for the repo, null if not set
     */
    function getRepoHomepage($repo)
    {
        $this->getRepo($repo);
        return $this->repo['homepage'];
    }
    
    /*
     * Returns the size of the repo
     */
    function getRepoSize($repo)
    {
        $this->getRepo($repo);
        return $this->repo['size'];
    }
    
    /*
     * Returns the number of stargazers for the repo
     */
    function getRepoNumberStargazers($repo)
    {
        $this->getRepo($repo);
        return $this->repo['stargazers_count'];
    }
    
    /*
     * Returns the number of watchers for the repo
     */
    function getRepoNumberWatchers($repo)
    {
        $this->getRepo($repo);
        return $this->repo['watchers_count'];
    }
    
    /*
     * Get the language of the repo (Java, PHP etc...)
     */
    function getRepoLanguage($repo)
    {
        $this->getRepo($repo);
        return $this->repo['language'];
    }
    
    /*
     * Returns the boolean value whether the repo has an issues page
     */
    function getRepoHasIssues($repo)
    {
        $this->getRepo($repo);
        return $this->repo['has_issues'];
    }
    
    /*
     * Returns the boolean value whether the repo has downloads
     */
    function getRepoHasDownloads($repo)
    {
        $this->getRepo($repo);
        return $this->repo['has_downloads'];
    }
    
    /*
     * Returns the boolean value whether the repo has a wiki page
     */
    function getRepoHasWiki($repo)
    {
        $this->getRepo($repo);
        return $this->repo['has_wiki'];
    }
    
    /*
     * Returns the boolean value whether the repo has pages
     */
    function getRepoHasPages($repo)
    {
        $this->getRepo($repo);
        return $this->repo['has_pages'];
    }
    
    /*
     * Returns the number of forks of the repo
     */
    function getRepoNumberForks($repo)
    {
        $this->getRepo($repo);
        return $this->repo['forks_count'];
    }
    
    /*
     * Returns the mirror url for the repo, if none is set null is returned
     */
    function getRepoMirrorURL($repo)
    {
        $this->getRepo($repo);
        return $this->repo['mirror_url'];
    }
    
    /*
     * Returns the number of open issues for the repo
     */
    function getRepoNumberIssues($repo)
    {
        $this->getRepo($repo);
        return $this->repo['open_issues_count'];
    }
    
    /*
     * Returns the number of subscribers for the repo
     */
    function getRepoNumberSubscribers($repo)
    {
        $this->getRepo($repo);
        return $this->repo['subscriber_count'];
    }
}