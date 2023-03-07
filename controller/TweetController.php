<?php


use tweets_pre\model\TweetModel;
use tweets_pre\preprocess\Tokenizer;
use tweets_pre\preprocess\Normalizer;

header('Content-Type: text/html; charset=UTF-8');

require_once 'model/TweetModel.php';


class TweetController {
    private $tweetModel;
    private $normalizer;
    private $tokenizer;
    
    public function __construct() {
        $this->tweetModel = new TweetModel();
        $this->normalizer = new Normalizer();
        $this->tokenizer = new Tokenizer();
    }
    
    public function index() {
        // Get all tweets from the database
        $tweets = $this->tweetModel->getAllTweets();
        
        // Load the view to display the tweets
        include('view/index.php');
    }
    
    public function create() {
        // Load the view to display the tweet creation form
        include('view/preprocessing.php');
    }
    
    public function store() {
        // Get the input tweet from the form
        $inputTweet = $_POST['tweet'];
        
        // Normalize and tokenize the tweet
        $normalizedTweet = $this->normalizer->normalize($inputTweet);
        $tokenizedTweet = $this->tokenizer->tokenize($normalizedTweet);
        
        // Save the tokenized tweet to the database
        $this->tweetModel->createTweet($tokenizedTweet);
        
        // Redirect back to the index page
        header('Location: ' . APP_URL);
    }
    
    public function delete($id) {
        // Delete the tweet with the given ID from the database
        $this->tweetModel->deleteTweet($id);
        
        // Redirect back to the index page
        header('Location: ' . APP_URL);
    }
}
?>
