<?php

class GitHubAPI 
{
    
    // Variable to contain the GitHub user name
    var $user;
    
    /*
     * Creates a new instance of the GitHub API
     */
    function GitHubAPI($aUser)
    {
        $this->user = $aUser;
    }
    
    /**
      * Returns an array of items relating to the GitHub API url
      * given in the argument.
      */
    function getResults($url)
    {
        // Start curl
        $curl = curl_init();
        // Set curl options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPGET, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json'
        ));
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
        $url = 'https://api.github.com/users/' . $this->user;
        return $this->getResults($url);
    }
    
    /*
     * Returns an array of repos relating to the GitHub user
     * for which an object was created, each containing an array 
     * of details about each repository.
     */
    function getRepos()
    {
        $url = 'https://api.github.com/users/' . $this->user . '/repos';
        return $this->getResults($url);
    }
    
    /*
     * Returns an array of details relating to the repository provided
     * as the argument, associated with the user for which an object
     * was created.
     */
    function getRepo($repo)
    {
        $url = 'https://api.github.com/repos/' . $this->user . '/' . $repo;
        return $this->getResults($url);
    }
    
    /*
     * Returns an array of details relating to followers of the GitHubAPI
     * user for which an object was created.
     */
    function getFollowers()
    {
        $url = 'https://api.github.com/users/' . $this->user . '/followers';
        return $this->getResults($url);
    }
    
    /*
     * Returns an array of details relating to the users that are followed
     * by the user for which an object was created.
     */
    function getFollowing()
    {
        $url = 'https://api.github.com/users/' . $this->user . '/following';
        return $this->getResults($url);
    }
    
    /*
     * Returns an array of information relating to the public gists by the
     * user for which an object was created.
     */
    function getGists()
    {
        $url = 'https://api.github.com/users/' . $this->user . '/gists';
        return $this->getResults($url);
    }
    
    /*
     * Returns an array of information relating to the repos starred by the
     * user for which an object was created.
     */
    function getStarred()
    {
        $url = 'https://api.github.com/users/' . $this->user . '/starred';
        return $this->getResults($url);
    }
    
    /*
     * Returns an array of information relating to the subscriptions for the 
     * user for which an object was created.
     */
    function getSubscriptions()
    {
        $url = 'https://api.github.com/users/' . $this->user . '/subscriptions';
        return $this->getResults($url);
    }
    
    /*
     * Returns an array of information relating to the organizations which
     * are linked to the user for which an object was created.
     */
    function getOrganizations()
    {
        $url = 'https://api.github.com/users/' . $this->user . '/orgs';
        return $this->getResults($url);
    }
    
    /*
     * Returns an array of information relating to the events which are
     * linked to the user for which an object was created.
     */
    function getEvents()
    {
        $url = 'https://api.github.com/users/' . $this->user . '/events';
        return $this->getResults($url);
    }
    
    /*
     * Returns an array of information relating to the received events which
     * are linked to the user for which an object was created.
     */
    function getReceivedEvents()
    {
        $url = 'https://api.github.com/users/' . $this->user . '/received_events';
        return $this->getResults($url);
    }
}