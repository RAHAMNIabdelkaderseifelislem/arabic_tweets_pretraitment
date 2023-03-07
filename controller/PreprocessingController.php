<?php

namespace tweets_pre\Controller;

use tweets_pre\Preprocess\Normalizer;
use tweets_pre\Preprocess\Tokenizer;

class PreprocessingController {
    private $normalizer;
    private $tokenizer;
    
    public function __construct() {
        $this->normalizer = new Normalizer();
        $this->tokenizer = new Tokenizer();
    }
    
    public function preprocess() {
        // Get the path to the CSV file from the input form
        $filePath = $_POST['filePath'];
        
        // Open the CSV file and read its contents into an array
        $data = array_map('str_getcsv', file($filePath));
        
        // Pre-process each tweet in the array
        $preprocessedData = array();
        foreach ($data as $row) {
            $tweet = $row[0];
            $normalizedTweet = $this->normalizer->normalize($tweet);
            $tokenizedTweet = $this->tokenizer->tokenize($normalizedTweet);
            $preprocessedData[] = $tokenizedTweet;
        }
        
        // Return the pre-processed data as a CSV file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="preprocessed_data.csv"');
        $output = fopen('php://output', 'w');
        foreach ($preprocessedData as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
    }
}

?>