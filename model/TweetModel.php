<?php


use tweets_pre\helper\Utility;

header('Content-Type: text/html; charset=UTF-8');

class TweetModel {
    private $id;
    private $tweet;
    private $preprocessedTweet;
    
    public function __construct($id, $tweet) {
        $this->id = $id;
        $this->tweet = $tweet;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getTweet() {
        return $this->tweet;
    }
    
    public function setPreprocessedTweet($preprocessedTweet) {
        $this->preprocessedTweet = $preprocessedTweet;
    }
    
    public function getPreprocessedTweet() {
        return $this->preprocessedTweet;
    }
    
    public function preprocess() {
        // Use the Tokenizer and Normalizer classes to preprocess the tweet
        $tokenizer = new Tokenizer();
        $tokens = $tokenizer->tokenize($this->tweet);
        
        $normalizer = new Normalizer();
        $preprocessedTweet = $normalizer->normalize($tokens);
        
        $this->preprocessedTweet = $preprocessedTweet;
    }
}

?>