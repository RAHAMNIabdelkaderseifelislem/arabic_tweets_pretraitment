<?php


header('Content-Type: text/html; charset=UTF-8');

class Normalizer {
    public function normalize($tweet) {
        // Remove diacritics (tashkeel) from the tweet
        $tweet = preg_replace('/\p{M}/u', '', $tweet);
        
        // Normalize characters (harakat)
        $tweet = str_replace(['ٍ','ٌ','ً','َ','ُ','ِ','ّ','ْ'], '', $tweet);
        $tweet = str_replace(['آ','أ','إ'], 'ا', $tweet);
        $tweet = str_replace('ى', 'ي', $tweet);
        $tweet = str_replace('ؤ', 'و', $tweet);
        
        return $tweet;
    }
}

?>
