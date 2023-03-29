<?php

// open the file that we uploaded and read it
$fp = fopen('../uploads/tweets-ar.csv', 'r');

// create a new file to write the tokens to
$fp2 = fopen('../uploads/tokens.csv', 'w');

// count the number of lines in the file to know how many tweets we have
$linecount = 0;
while(!feof($fp)){
    $line = fgets($fp);
    $linecount++;
}

// create an array to count the number of words in each tweet
$num_words = array();


// create an array to contain the lines of the file
$lines = array();

// go back to the beginning of the file
rewind($fp);

// read the file line by line
while(($line = fgetcsv($fp)) !== FALSE) {
    // create an array to store the words in each tweet
    $words = array();
    // split the line into an array of words
    $words = preg_split('/\s+/', $line[0]);
    // loop through the words
    foreach($words as $word) {
        // write the word to the file
        fputcsv($fp2, array($word));    
    }
    $lines[] = $words;
    // count the number of words in each tweet
    $num_words[] = count($words);
}

// close the files
fclose($fp);
fclose($fp2);
echo $linecount;
for ($i = 0; $i < $linecount-1; $i++) {
    echo $num_words[$i];
    foreach($lines[$i] as $word) {
        echo $word.' ';
    }
    echo '<br>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tokenizing</title>
    <script>
        function showWords() {
            document.getElementById("show_btn").style.display = "none";
            document.getElementById("words").style.display = "block";
            document.getElementById("hide_btn").style.display = "block";
        }
        function hideWords() {
            document.getElementById("show_btn").style.display = "block";
            document.getElementById("words").style.display = "none";
            document.getElementById("hide_btn").style.display = "none";
        }
    </script>
</head>
<body>
    <h2>Preprocessed Tweets</h2>
    <table border="1">
        <thead>
            <tr>
                <th>tweet</th>
                <th>number of words</th>
                <th>words</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < $linecount-1; $i++): ?>
                <tr>
                    <td><?php echo htmlspecialchars($i+1, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($num_words[$i], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <button onclick="showWords()" id="show_btn">Show Words</button>
                        <button id="hide_btn" onclick="hideWords()" style="display: none;">Hide Words</button>
                        <div id="words" style="display: none;">
                            <?php foreach($lines[$i] as $word): ?>
                                <?php echo $word.' '; ?><br>
                            <?php endforeach; ?>
                        </div>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</body>
</html>