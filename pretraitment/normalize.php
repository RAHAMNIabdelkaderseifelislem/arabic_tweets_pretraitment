<?php

// read the tokens file
$fp = fopen('../uploads/tokens.csv', 'r');
$fp2 = fopen('../uploads/tweets-ar.csv', 'r');
// count the number of lines in the file to know how many tweets we have
$linecount = 0;
while(!feof($fp2)){
    $line = fgets($fp2);
    $linecount++;
}

// create an array to count the number of words in each tweet
$num_words = array();


// go back to the beginning of the file
rewind($fp2);

$i = 1;
// read the file line by line
while(($line = fgetcsv($fp2)) !== FALSE) {
    // create an array to store the words in each tweet
    $words = array();
    //word count
    $word_count = 0;
    // split the line into an array of words
    $words = preg_split('/\s+/', $line[0]);
    // loop through the words
    foreach($words as $word) {
        // write the word to the file
        if (strlen($word)>1){
            $word_count++;
        }
    }
    $lines[] = $words;
    // count the number of words in each tweet
    $num_words[] = $word_count;
    $i++;
}
// close the file
fclose($fp2);

// create an array to store the term frequencies
$term_freq = array();

// create an array to store the inverse document frequencies
$inv_doc_freq = array();

// count the number of tweets
$num_tweets = $linecount;

// read the file line by line
while (($line = fgetcsv($fp)) !== FALSE) {
    // get the tweet ID and the word
    $parts = explode(",", $line[0]);
    $tweet_id = $parts[0];
    $word = $parts[1];

    // calculate the term frequency for this word in this tweet
    if (!isset($term_freq[$tweet_id])) {
        $term_freq[$tweet_id] = array();
    }
    if (!isset($term_freq[$tweet_id][$word])) {
        $term_freq[$tweet_id][$word] = 0;
    }
    $term_freq[$tweet_id][$word]++;

    // calculate the inverse document frequency for this word
    if (!isset($inv_doc_freq[$word])) {
        $inv_doc_freq[$word] = 0;
    }
    $inv_doc_freq[$word]++;
}

// close the file
fclose($fp);

// calculate the tf-idf for each word in each tweet
$tf_arr = array();
$idf_arr = array();
$tf_idf = array();
foreach ($term_freq as $tweet_id => $words) {
    foreach ($words as $word => $freq) {
        $tf = $freq / $num_words[$tweet_id - 1];
        $idf = log($num_tweets / $inv_doc_freq[$word]);
        $tf_arr[$tweet_id][$word] = $tf;
        $idf_arr[$word] = $idf;
        $tf_idf[$tweet_id][$word] = $tf * $idf;
    }
}

// print the term frequency values in a table
echo "<table border='1'>";
echo "<thead>";
echo "<tr><th>tweet</th><th>word</th><th>term frequency</th></tr>";
echo "</thead>";
echo "<tbody>";
foreach ($term_freq as $tweet_id => $words) {
    foreach ($words as $word) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($tweet_id, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($word, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($tf_arr[$tweet_id][$word], ENT_QUOTES, 'UTF-8') . "</td>";        
        echo "</tr>";
    }
}
echo "</tbody>";
echo "</table>";
// print the inverse document frequency values in a table
echo "<table border='1'>";
echo "<thead>";
echo "<tr><th>word</th><th>inverse document frequency</th></tr>";
echo "</thead>";
echo "<tbody>";
foreach ($inv_doc_freq as $word) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($word, ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($idf_arr[$word], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";

// print the tf-idf values in a table
echo "<table border='1'>";
echo "<thead>";
echo "<tr><th>tweet</th><th>word</th><th>tf-idf</th></tr>";
echo "</thead>";
echo "<tbody>";
foreach ($tf_idf as $tweet_id => $words) {
    foreach ($words as $word => $tf_idf_val) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($tweet_id, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($word, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($tf_idf_val, ENT_QUOTES, 'UTF-8') . "</td>";
        echo "</tr>";
    }
}
echo "</tbody>";
echo "</table>";

?>