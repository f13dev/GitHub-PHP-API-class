<?php
// Load the GitHubAPI class
require_once('GitHubAPI.class.php');

// Create a new instance of the GitHubAPI, stored in $apiTest
// giving the username 'f13dev' as the argument
$api = new GitHubAPI('f13dev');

// Get Username
echo 'Login: ' . $api->getLogin() . '<br/>';
// Get Github ID
echo 'ID: ' . $api->getID() . '<br/>';
// Get avatar URL
echo 'Avatar URL: ' . $api->getAvatarURL() . '<br/>';
// Get Gravatar ID
echo 'Gravatar ID: ' . $api->getGravatarID() . '<br/>';
// Get profile url
echo 'Profile URL: ' . $api->getProfileURL() . '<br/>';
// Get name
echo 'Name: ' . $api->getName() . '<br/>';
// Get company
echo 'Company: ' . $api->getCompany() . '<br/>';
// Get blog or user website
echo 'Blog: ' . $api->getBlog() . '<br/>';
// Get user location
echo 'Location: ' . $api->getLocation() . '<br/>';
// Get user email (may not work with all users as it may be hiddne)
echo 'Email: ' . $api->getEmail() . '<br/>';
// Get hierable (returns boolean or null if not set)
echo 'Hierable: ' . $api->getHierable() . '<br/>';
// Get user bio
echo 'Bio: ' . $api->getBio() . '<br/>';
// Get the number of public repos the user has
echo 'Number of repos: ' . $api->getNumberRepos() . '<br/>';
// Get the number of public gists the user has
echo 'Number of gists: ' . $api->getNumberGists() . '<br/>';
// Get the number of followers of the user
echo 'Number of followers: ' . $api->getNumberFollowers() . '<br/>';
// Get the number of users that the user is following
echo 'Number of following: ' . $api->getNumberFollowing() . '<br/>';
// Get the time and date that the user account was created
echo 'Creation date/time: ' . $api->getProfileCreationTime() . '<br/>';
// Get the time and date that the user profile was last updated
echo 'Last updated: ' . $api->getProfileUpdateTime() . '<br/>';


// Show the number of remaining API calls before the rate limit is reached
$api->getRateLimit();
echo 'Rate limit: ' . $api->rateLimit['resources']['core']['remaining'];