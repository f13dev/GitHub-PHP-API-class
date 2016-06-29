<?php
// Load the GitHubAPI class
require_once('GitHubAPI.class.php');

// Create a new instance of the GitHubAPI, stored in $apiTest
// giving the username 'f13dev' as the argument
$apiTest = new GitHubAPI('f13dev');

/*
The getUserDetails() function returns an array like so:
{
    [login],                The username
    [id],                   A numeric GitHub ID
    [avatar_url],           URL of your avatar
    [gravatar_id],          The users Gravatar ID
    [url],                  The URL used to retrieve the API call
    [html_url],             The URL of the users profile
    [followers_url],        The API URL to call the users followers
    [following_url],        The API URL to call the users following
    [gists_url],            The API URL to call the users gists
    [starred_url],          The API URL to call the users starred
    [subscriptions_url],    The API URL to call the users subscriptions
    [organizations_url],    The API URL to call the users organizations
    [repos_url],            The API URL to call the users repos
    [events_url],           The API URL to call the users events
    [received_events_url],  The API URL to call the users received events
    [type],                 User, Admin etc...
    [site_admin],           Whether the user is a GitHub admin (true or false)
    [name],                 The users real name
    [company],              The users company
    [blog],                 The users website URL
    [location],             The users geographical location
    [email],                The users email address (returns null if email is hidden)
    [hireable],             Whether the user is hireable (true or false, returns null if not set)
    [bio],                  The users bio
    [public_repos],         The number of public repos for the user
    [public_gists],         The number of public gists for the user
    [followers],            The number of followers for the user
    [following],            The number of following for the user
    [created_at],           When the user profile was created
    [updated_at]            When the usre profile was last updated
}
*/
// Store the user details array in $apiTestUser
$apiTestUser = $apiTest->getUserDetails();
// Echo the users GitHub ID number
echo 'Testing getUserDetails(): ' . $apiTestUser['id'] . '<br/><br/>';

// Store the users repos array in $apiTestRepos
$apiTestRepos = $apiTest->getUserRepos();

echo 'Testing getUserRepos():';
echo '<ol>';
for ($i = 0; $i < count($apiTestRepos); $i++)
{
    // For each repo for the user, show a list item containing it's name
    echo '<li>' . $apiTestRepos[$i]['name'] . '</li>';
}
echo '</ol>';

$apiTestRepo = $apiTest->getUserRepo($apiTestRepos[0]['name']);
echo 'Testing getUserRepo(aRepo)<br/>';
echo $apiTestRepo['name'];