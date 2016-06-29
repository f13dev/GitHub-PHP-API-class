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
    
    function getUserDetails()
    {
        $url = 'https://api.github.com/users/' . $this->user;
        return $this->getResults($url);
    }
    
    function getUserRepos()
    {
        $url = 'https://api.github.com/users/' . $this->user . '/repos';
        return $this->getResults($url);
    }
    
    function getUserRepo($repo)
    {
        $url = 'https://api.github.com/repos/' . $this->user . '/' . $repo;
        return $this->getResults($url);
    }
    
}