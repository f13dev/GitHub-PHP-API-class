<?php
// Load the GitHubAPI class
require_once('GitHubAPI.class.php');

// Create a new instance of the GitHubAPI, stored in $apiTest
// giving the username 'f13dev' as the argument
$api = new GitHubAPI('f13dev');

// Echo a header for the user details
echo '<h1>User Details</h1>';
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

// Create header for repo
echo '<h1>Repo AlbumSystem</h1>';
// Get the repo ID
echo 'Repo ID: ' . $api->getRepoID('AlbumSystem') . '<br/>';
// Get the repo name
echo 'Repo name: ' . $api->getRepoName('AlbumSystem') . '<br/>';
// Get the repo full name
echo 'Repo full name: ' . $api->getRepoFullName('AlbumSystem') . '<br/>';
// Get the repo URL
echo 'Repo URL: ' . $api->getRepoURL('AlbumSystem') . '<br/>';
// Get the repo description
echo 'Repo description: ' . $api->getRepoDescription('AlbumSystem') . '<br/>';
// Show if the repo is a fork
echo 'Repo is a fork: ' . $api->getRepoIsFork('AlbumSystem') . '<br/>';
// Show the creation time for the repo
echo 'Repo created at: ' . $api->getRepoCreationTime('AlbumSystem') . '<br/>';
// Show the latest push time for the repo
echo 'Latest push: ' . $api->getRepoPushTime('AlbumSystem') . '<br/>';
// Show latest update time for the repo
echo 'Latest update: ' . $api->getRepoUpdateTime('AlbumSystem') . '<br/>';
// Show the URL to the git file for the repo
echo 'Git file: ' . $api->getRepoGitURL('AlbumSystem') . '<br/>';
// Show the SSH URL for the repo
echo 'SSH URL: ' . $api->getRepoSSHURL('AlbumSystem') . '<br/>';
// Show the Clone URL for the repo
echo 'Clone URL: ' . $api->getRepoCloneURL('AlbumSystem') . '<br/>';
// Show the SVN URL for the repo
echo 'SVN URL: ' . $api->getRepoSVNURL('AlbumSystem') . '<br/>';
// Show the repo homepage
echo 'Homepage: ' . $api->getRepoHomepage('AlbumSystem') . '<br/>';
// Show the repo size
echo 'Size: ' . $api->getRepoSize('AlbumSystem') . '<br/>';
// Show the number of stargazers for the repo
echo 'Stargazers: ' . $api->getRepoNumberStargazers('AlbumSystem') . '<br/>';
// Show the number of watchers for the repo
echo 'Stargazers: ' . $api->getRepoNumberWatchers('AlbumSystem') . '<br/>';
// Get the programming language for the repo
echo 'Language: ' . $api->getRepoLanguage('AlbumSystem') . '<br/>';






echo '<h1>Rate Limit</h1>';
// Show the number of remaining API calls before the rate limit is reached
$api->getRateLimit();
echo 'Rate limit: ' . $api->rateLimit['resources']['core']['remaining'];