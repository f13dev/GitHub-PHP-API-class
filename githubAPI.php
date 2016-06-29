<?php
function githubAPI($url)
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
    Returns an array containing:
    login - username
    id - user id number
    avatar_url
    gravatar_id
    url
    html_url
    followers_url
    following_url
    gists_url
    starred_url
    subscriptions_url
    organizations_url
    repos_url
    events_url
    received_events_url
    type (user, org etc...)
    site_admin (true or false)
    name (real name)
    company (company name)
    blog (your url)
    location
    email
    hireable
    bio
    public_repos (count of repositories)
    piblic_gists (count of gists)
    followers (count)
    following (count)
    created_at
    updated_at
*/
function githubAPI_user($user)
{
    return githubAPI('https://api.github.com/users/' . $user);
}

function githubAPI_allrepos($user)
{
    return githubAPI('https://api.github.com/users/' . $user . '/repos');
}

$githubUserData = githubAPI_user('f13dev');

echo $githubUserData['login'] . '<br/>';
echo $githubUserData['id'] . '<br/><br/>';
echo $githubUserData['public_repos'] . ' repositories<br/>';

echo '<ol>';

$githubRepos = githubAPI_allrepos('f13dev');

for ($i = 0; $i < count($githubRepos); $i++)
{
    echo '<li>' . $githubRepos[$i]['name'] . '</li>';
}

echo '</ol>';