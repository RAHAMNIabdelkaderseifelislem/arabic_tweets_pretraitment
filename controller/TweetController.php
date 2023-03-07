<?php

namespace tweets_pre\Controller;

use tweets_pre\Model\TweetModel;
use tweets_pre\Preprocess\Tokenizer;
use tweets_pre\Preprocess\Normalizer;

class TweetController {
    private $tweetModel;
    private $tokenizer;
    private $normalizer;
    
    public function __construct() {
        $this->tweetModel = new TweetModel();
        $this->tokenizer = new Tokenizer();
        $this->normalizer = new Normalizer();
    }
    
    public function index() {
        // Get all tweets from the database
        $tweets = $this->tweetModel->getAllTweets();
        
        // Pass tweets to the view for display
        include_once 'view/index.php';
    }
    
    public function preprocess() {
        // Get all tweets from the database
        $tweets = $this->tweetModel->getAllTweets();
        
        // Preprocess each tweet
        foreach ($tweets as $tweet) {
            // Tokenize tweet into words
            $words = $this->tokenizer->tokenize($tweet['text']);
            
            // Normalize each word in the tweet
            $normalized_words = array();
            foreach ($words as $word) {
                $normalized_word = $this->normalizer->normalize($word);
                array_push($normalized_words, $normalized_word);
            }
            
            // Update the tweet in the database with the preprocessed text
            $this->tweetModel->updateTweet($tweet['id'], implode(' ', $normalized_words));
        }
        
        // Redirect to the index page
        header('Location: ' . APP_URL);
    }
}

?>