<?php

// Emojis list

$emoji_list = array();
for ($i = 0x1F600; $i <= 0x1F64F; $i++) {
    $emoji_list[] = '&#x' . dechex($i) . ';';
}

function replaceEmojiUnicodeWithExpressions($text) {
    // Array containing the Unicode code points for emojis and their corresponding expressions
    $emojis = array(
        '\u{1F600}' =>  'GRINNING FACE' ,
        '\u{1F601}' => 'GRINNING FACE WITH SMILING EYES' ,
        '\u{1F602}' => 'FACE WITH TEARS OF JOY' ,
        '\u{1F603}' => 'SMILING FACE WITH OPEN MOUTH',
        '\u{1F604}' => 'SMILING FACE WITH OPEN MOUTH AND SMILING EYES' ,
        '\u{1F605}' => 'SMILING FACE WITH OPEN MOUTH AND COLD SWEAT' ,
        '\u{1F606}' => 'SMILING FACE WITH OPEN MOUTH AND TIGHTLY-CLOSED EYES' ,
        '\u{1F607}' => 'SMILING FACE WITH HALO' ,
        '\u{1F608}' => 'SMILING FACE WITH HORNS' ,
        '\u{1F609}' => 'WINKING FACE' , 
        '\u{1F60A}' => 'SMILING FACE WITH SMILING EYES' ,
        '\u{1F60B}' => 'FACE SAVOURING DELICIOUS FOOD' ,
        '\u{1F60C}' => 'RELIEVED FACE' ,
        '\u{1F60D}' => 'SMILING FACE WITH HEART-SHAPED EYES' ,
        '\u{1F60E}' => 'SMILING FACE WITH SUNGLASSES' ,
        '\u{1F60F}' => 'SMIRKING FACE' ,
        '\u{1F610}' => 'NEUTRAL FACE' ,
        '\u{1F611}' => 'EXPRESSIONLESS FACE' ,
        '\u{1F612}' => 'UNAMUSED FACE' ,
        '\u{1F613}' => 'FACE WITH COLD SWEAT' ,
        '\u{1F614}' => 'PENSIVE FACE' ,
        '\u{1F615}' => 'CONFUSED FACE' ,
        '\u{1F616}' => 'CONFOUNDED FACE' ,
        '\u{1F617}' => 'KISSING FACE' ,
        '\u{1F618}' => 'FACE THROWING A KISS' ,
        '\u{1F619}' => 'KISSING FACE WITH SMILING EYES' ,
        '\u{1F61A}' => 'KISSING FACE WITH CLOSED EYES' ,
        '\u{1F61B}' => 'FACE WITH STUCK-OUT TONGUE' ,
        '\u{1F61C}' => 'FACE WITH STUCK-OUT TONGUE AND WINKING EYE' ,
        '\u{1F61D}' => 'FACE WITH STUCK-OUT TONGUE AND TIGHTLY-CLOSED EYES' ,
        '\u{1F61E}' => 'DISAPPOINTED FACE' ,
        '\u{1F61F}' => 'WORRIED FACE' ,
        '\u{1F620}' => 'ANGRY FACE' ,
        '\u{1F621}' => 'POUTING FACE' ,
        '\u{1F622}' => 'CRYING FACE' ,
        '\u{1F623}' => 'PERSEVERING FACE' ,
        '\u{1F624}' => 'FACE WITH LOOK OF TRIUMPH' ,
        '\u{1F625}' => 'DISAPPOINTED BUT RELIEVED FACE' ,
        '\u{1F626}' => 'FROWNING FACE WITH OPEN MOUTH' ,
        '\u{1F627}' => 'ANGUISHED FACE' ,
        '\u{1F628}' => 'FEARFUL FACE' ,
        '\u{1F629}' => 'WEARY FACE' ,
        '\u{1F62A}' => 'SLEEPY FACE' ,
        '\u{1F62B}' => 'TIRED FACE' ,
        '\u{1F62C}' => 'GRIMACING FACE' ,
        '\u{1F62D}' => 'LOUDLY CRYING FACE' ,
        '\u{1F62E}' => 'FACE WITH OPEN MOUTH' ,
        '\u{1F62F}' => 'HUSHED FACE' ,
        '\u{1F630}' => 'FACE WITH OPEN MOUTH AND COLD SWEAT' ,
        '\u{1F631}' => 'FACE SCREAMING IN FEAR' ,
        '\u{1F632}' => 'ASTONISHED FACE' ,
        '\u{1F633}' => 'FLUSHED FACE' ,
        '\u{1F634}' => 'SLEEPING FACE' ,
        '\u{1F635}' => 'DIZZY FACE' ,
        '\u{1F636}' => 'FACE WITHOUT MOUTH' ,
        '\u{1F637}' => 'FACE WITH MEDICAL MASK' ,
        '\u{1F638}' => 'GRINNING CAT FACE WITH SMILING EYES' ,
        '\u{1F639}' => 'CAT FACE WITH TEARS OF JOY' ,
        '\u{1F63A}' => 'SMILING CAT FACE WITH OPEN MOUTH' ,
        '\u{1F63B}' => 'SMILING CAT FACE WITH HEART-SHAPED EYES' ,
        '\u{1F63C}' => 'CAT FACE WITH WRY SMILE' ,
        '\u{1F63D}' => 'KISSING CAT FACE WITH CLOSED EYES' ,
        '\u{1F63E}' => 'POUTING CAT FACE' ,
        '\u{1F63F}' => 'CRYING CAT FACE' ,
        '\u{1F640}' => 'WEARY CAT FACE' ,
        '\u{1F641}' => 'SLIGHTLY FROWNING FACE' ,
        '\u{1F642}' => 'SLIGHTLY SMILING FACE' ,
        '\u{1F643}' => 'UPSIDE-DOWN FACE' ,
        '\u{1F644}' => 'FACE WITH ROLLING EYES' ,
        '\u{1F645}' => 'FACE WITH NO GOOD GESTURE' ,
        '\u{1F646}' => 'FACE WITH OK GESTURE' ,
        '\u{1F647}' => 'PERSON BOWING DEEPLY' ,
        '\u{1F648}' => 'SEE-NO-EVIL MONKEY' ,
        '\u{1F649}' => 'HEAR-NO-EVIL MONKEY' ,
        '\u{1F64A}' => 'SPEAK-NO-EVIL MONKEY' ,
        '\u{1F64B}' => 'HAPPY PERSON RAISING ONE HAND' ,
        '\u{1F64C}' => 'PERSON RAISING BOTH HANDS IN CELEBRATION' ,
        '\u{1F64D}' => 'PERSON FROWNING' ,
        '\u{1F64E}' => 'PERSON WITH POUTING FACE' ,
        '\u{1F64F}' => 'PERSON WITH FOLDED HANDS'
    );

    // Regular expression pattern to match Unicode code points for emojis
    $pattern = '/\\\\u\{([0-9a-fA-F]+)\}/u';

    // Replace Unicode code points with expressions using a callback function
    $result = preg_replace_callback($pattern, function($match) use ($emojis) {
        return $emojis[$match[0]];
    }, $text);

    return $result;
}

// Example usage
$text = "I'm feeling \\u{1F600} today!";
$result = replaceEmojiUnicodeWithExpressions($text);
echo $result;

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

$i = 1;
// read the file line by line
while(($line = fgetcsv($fp)) !== FALSE) {
    // create an array to store the words in each tweet
    $words = array();
    //word count
    $word_count = 0;
    // split the line into an array of words
    $words = preg_split('/\s+/', $line[0]);
    // loop through the words
    foreach($words as $word) {
        // write the word to the file
        // check if the word is emoji or not
        if (strlen($word)>1){
            fputcsv($fp2, array($i.",".$word));
            $word_count++;
        }
    }
    $lines[] = $words;
    // count the number of words in each tweet
    $num_words[] = $word_count;
    $i++;
}

// close the files
fclose($fp);
fclose($fp2);
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
    <button id="show_btn" onclick="showWords()">Show Words</button>
    <button id="hide_btn" onclick="hideWords()" style="display: none;">Hide Words</button>
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
                    <?php 
                        echo '['.'';
                        foreach($lines[$i] as $word): 
                    ?>
                        <?php
                            if (strlen($word)>1){
                                echo $word.';'; 
                            } 
                        ?>
                    <?php 
                    endforeach; 
                    echo ']'.'';
                    ?>
                </td>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>

<a href="normalize.php">Normalize</a>
</body>
</html>