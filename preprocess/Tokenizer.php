<?php


header('Content-Type: text/html; charset=UTF-8');

class Tokenizer {
    public function tokenize($tweet) {
        // Remove any non arabic letters
        $tweet = preg_replace('/[^\x{0600}-\x{06FF}]/u', ' ', $row);

        // Split the tweet into words using whitespace and punctuation as delimiters
        $tokens = preg_split('/[\s\p{P}]+/u', $tweet, -1, PREG_SPLIT_NO_EMPTY);
        
        // Convert all tokens to lowercase
        $tokens = array_map('mb_strtolower', $tokens);
        
        return $tokens;
    }
}

?>
