<?php
require_once 'config/constants.php';
require_once 'helper/utility.php';
require_once 'controller/TweetController.php';


header('Content-Type: text/html; charset=UTF-8');

// Get the CSV file path from the query string parameter
$csvFile = isset($_GET['csv']) ? $_GET['csv'] : '';

// Initialize the TweetController and fetch tweets from the CSV file
$tweetController = new TweetController();
$tweets = $tweetController->fetchTweetsFromCSV($csvFile);

// Render the tweet list view
include 'view/index.php';

?>