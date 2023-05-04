<?php
require __DIR__ . '/vendor/autoload.php';

require_once 'vendor/khaled.alshamaa/ar-php/src/Arabic.php';

use ArPHP\I18N\Arabic;
// initialize the class
$Arabic = new Arabic('Ar');

// get the text from the form subitted
$original_data = null;
$processed_data = null;

if (isset($_POST["submit"])) {
    // Retrieve the uploaded file
    $file = $_FILES["csv_file"]["tmp_name"];

    // Parse the CSV data into an array
    $original_data = array_map('str_getcsv', file($file));

    // Remove emojis and hashtags, and non-Arabic letters from the second column of each row
    $processed_data = array();

    // preparing the array for the processed data to be saved in a csv file
    // Create the uploads directory if it doesn't exist
    if (!is_dir("uploads")) {
        mkdir("uploads");
    }

    // Save the processed data to a file
    $file = fopen("uploads/tweets-ar.csv", "w");

    foreach ($original_data as $row) {

        // Remove non-Arabic letters
        $row = preg_replace('/[^\x{0600}-\x{06FF}]/u', ' ', $row);

        fputcsv($file, $row);
        $processed_data[] = $row;
    }
}
// open the file that we uploaded and read it
$fp = fopen('uploads/tweets-ar.csv', 'r');

// create a new file to write the tokens to
$fp2 = fopen('uploads/tokens.csv', 'w');

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
// prepare the array for sentiment analysis that save the word and its probability in the same array
$words_prob = array();

// close the files
fclose($fp);
fclose($fp2);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحليل المشاعر</title>
    <!-- import styles -->
    <link rel="stylesheet" href="./assets/css/style.css">
     <!-- Font Awesome Icons -->
     <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    />
    <!-- Google Font -->
    <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins&display=swap"
    />
    <!-- import scripts -->
    <script src="./assets/js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- import charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-colorschemes"></script>
    <script>
        var probabilities = []
        var positive = 0
        var negative = 0
        var word_prob = []
    </script>
</head>
<body id="top">
    <!-- form to upload .csv file -->
    <nav>
        <div class="logo">
            <a href="#top"><h4>تحليل المشاعر</h4></a>
        </div>
        <ul class="nav-links">
            <li><a href="#upload">الرئيسية</a></li>
            <li class ="dropdown">
                <a href="#res">النتيجة</a>
                <div class="dropdown-content">
                    <a href="#original">التغريدات الأصلية</a>
                    <a href="#processed">التغريدات المعالجة</a>
                    <a href="#tokenize">ترميز التغريدات</a>
                    <a href="#analysis_words">تحليل الكلمات</a>
                    <a href="#analysis">تحليل المشاعر</a>
                </div>
            </li>
            <li class ="dropdown">
                <a href="#graph">الرسوم البيانية</a>
                <div class="dropdown-content">
                    <a href="#numWordsChart">عدد الكلمات</a>
                    <a href="#sentimentChart">المشاعر</a>
                    <a href="#probabilityChart">الاحتمالات</a>
                </div>
            </li>
        </ul>
    </nav>
    <br><br>
    <div class="container">
        <div id="upload" class="upl">
            <br><br>
            <form method="post" enctype="multipart/form-data">
                    <input type="file" name="csv_file" id="upload-button" accept=".csv" />
                    <label for="upload-button"><i class="fa-solid fa-upload"></i>&nbsp; اختر ملف للمعالجة</label>
                    <div id="error"></div>
                    <div id="image-display"></div>
                <button type="submit" name="submit">يُقدِّم</button>
            </form>
        </div>
        <br><br>
        <!-- display the results -->
        <div class="result" id="res" style = "<?php
                    if (isset($_POST["submit"])) {
                        echo "display: block;";
                    } else {
                        echo "display: none;";
                    }
                ?>">
        <center>
            <h1>النتيجة</h1>
            <br><br><br>
            <button id="showDataButton" onclick="showData()">إظهار كافة البيانات</button>
            <button id="hideDataButton" onclick="hideData()" style="display: none;">إخفاء كافة البيانات</button>
            <br><br>
            <?php if ($original_data): ?>
            <div id="original" style = "<?php
                    if (isset($_POST["submit"])) {
                        echo "display: block;";
                    } else {
                        echo "display: none;";
                    }
                ?>">
                <h2 >التغريدات الأصلية</h2>
                <br><br>    
                <button id="showOriginalTweetsButton" onclick="showOriginalTweets()">إظهار التغريدات الأصلية</button>
                <button id="hideOriginalTweetsButton" onclick="hideOriginalTweets()" style="display: none;">إخفاء التغريدات الأصلية</button>
                <br><br>
                <table id="original_tweets" style="display: none;">
                    <thead>
                        <tr>
                            <th>التغريدة</th>
                        </tr>
                    </thead>
                    <?php foreach ($original_data as $row): ?>
                        <tr>
                            <td class="styledbyfile"><?php echo htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
            </div>
            <?php if ($processed_data): ?>
            <div id="processed" style = "<?php
                    if (isset($_POST["submit"])) {
                        echo "display: block;";
                    } else {
                        echo "display: none;";
                    }
                ?>">
                <h2 >التغريدات المعالجة</h2>
                <br><br>
                <button id="showProcessedTweetsButton" onclick="showProcessedTweets()">إظهار التغريدات المعالجة</button>
                <button id="hideProcessedTweetsButton" onclick="hideProcessedTweets()" style="display: none;">إخفاء التغريدات المعالجة</button>
                <br><br>
                <table id="processed_tweets" style="display: none;">
                    <thead>
                        <tr>
                            <th> التغريدة الاصلية</th>
                            <th>التغريدة المعالجة</th>
                        </tr>
                    </thead>
                    <?php for($i = 0; $i < count($processed_data); $i++): ?>
                        <tr>
                            <td class="styledbyfile"><?php echo htmlspecialchars($original_data[$i][0], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="styledbyfile"><?php echo htmlspecialchars($processed_data[$i][0], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endfor; ?>
                </table>
            <?php endif; ?>
            </div>
            <div id="tokenize" style = "<?php
                    if (isset($_POST["submit"])) {
                        echo "display: block;";
                    } else {
                        echo "display: none;";
                    }
                ?>">
                <h2>ترميز التغريدات</h2>
                <br><br>
                <button id="showTokenizedTweetsButton" onclick="showTokenizedTweets()">إظهار الترميز</button>
                <button id="hideTokenizedTweetsButton" onclick="hideTokenizedTweets()" style="display: none;">إخفاء الترميز</button>
                <br><br>
                <table id ="tokenized_tweets" style="display: none;">
                    <thead>
                        <tr>
                            <th>التغريدة</th>
                            <th>عدد الكلمات</th>
                            <th>الكلمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $linecount-1; $i++): ?>
                            <tr>
                                <td class="styledbyfile"><?php echo htmlspecialchars($i+1, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="styledbyfile"><?php echo htmlspecialchars($num_words[$i], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="styledbyfile">
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
            </div>
            <br><br>

            <?php
            if(isset($_POST["submit"])){
                $i = 1;
                // add sentiment analysis and save it in .json files
                foreach ($original_data as $review) {
                        $analysis = $Arabic->arSentiment($review[0]);
                        
                        $word_sentiment = $analysis['dict'];

                        $probability = sprintf('%0.1f', round(100 * $analysis['probability'], 1));
                        if ($analysis['isPositive']){
                            $sentiment = 'إيجابي';
                        } else {
                            $sentiment = 'سلبي';
                        }
                        // encode the data of the tweet in json format with tweet id, tweet text, sentiment, probability, and word sentiment add utf8_encode to fix arabic encoding
                        $tweet_data = json_encode(array('id' => $i, 'text' => $review[0], 'sentiment' => $sentiment, 'probability' => $probability, 'word_sentiment' => $word_sentiment),JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                        
                        // save it into a .json file at uploads folder check if the folder exists if not create it and create the tweets folder inside it
                        if (!file_exists('uploads/tweets')) {
                            mkdir('uploads/tweets', 0777, true);
                        }
                        file_put_contents('uploads/tweets/tweet'.$i.'.json', $tweet_data);


                        $i++;
                    }
            }
            ?>

        <br><br>
        <div id="analysis_words" style = "<?php
                if (isset($_POST["submit"])) {
                    echo "display: block;";
                } else {
                    echo "display: none;";
                }
            ?>">
            <!-- print the words and there sentiment and score -->
            <?php
            echo <<< END
            <h2>تحليل المشاعر لكل كلمة</h2>
            <br><br>
            <button id="showArabicSentimentWordsButton" onclick="showArabicSentimentWords()">إظهار تحليل المشاعر لكل كلمة</button>
            <button id="hideArabicSentimentWordsButton" onclick="hideArabicSentimentWords()" style="display: none;">إخفاء تحليل المشاعر لكل كلمة</button>
            <div style="display: none;" id="arabic_sentiment_words">
            <center>
            <table border="0" cellspacing="2" cellpadding="5">
                <tr>
                <th  align="center">
                    <b><font>التغريدة</font></b>
                </th>
                <th  align="center">
                    <b><font>الكلمة</font></b>
                </th>
                <th align="center">
                    <b><font>المشاعر</font></b>
                </th>
                <th align="center">
                    <b><font>الاحتمال</font></b>
                </th>
                </tr>
            END;
            // read the tweets from the tweets folder file by file
            $files = glob('uploads/tweets/*.json');
            // loop through the files
            $i = 0;
            foreach ($files as $file) {
                // get the file content
                $json = file_get_contents($file);
                // decode the json file
                $tweet = json_decode($json, true);
                
                $j = 0;
                // count the number of words in the tweet
                $count = count($tweet['word_sentiment']);
                // get the sentiment of each tweet
                $tweet_sentiment = $tweet['sentiment'];
                if ($tweet_sentiment == 'إيجابي') {
                    $bgcolor   = '#E0F0FF';
                } else {
                    $bgcolor   = '#FFF0FF';
                }
                echo '<tr><td bgcolor="'.$bgcolor.'" align="center" rowspan="'.$count.'"> <font face="Tahoma">'.$tweet['id'].'</font></td>';
                echo '<script>
                        var word_probability = [];
                    </script>';
                foreach ($tweet['word_sentiment'] as $word => $sentiment) {
                    if($sentiment['score']>= 0){
                        $sentiments = 'ايجابي';
                        $bgcolor   = '#E0F0FF';
                    } else {
                        $sentiments = 'سلبي';
                        $bgcolor   = '#FFF0FF';
                    }
                    echo '<td bgcolor="'.$bgcolor.'" align="center">'.$word.'</td>';
                    echo '<td bgcolor="'.$bgcolor.'" align="center">'.$sentiments.'</td>';
                    $probability = sprintf('%0.1f', round(100 * $sentiment['score'], 1));
                    echo '<td bgcolor="'.$bgcolor.'" align="center" style="direction: ltr;">'.$probability.' % </td></tr>';
                    echo '<script>
                            word_probability.push('.round(100 * $sentiment['score'], 1).');
                        </script>';
                    

                    $j++;
                }
                echo '<script>
                        // assign the word probabilities to the tweet probabilities array
                        word_prob.push(word_probability);
                    </script>';
                $i++;
            }
            echo '</table></center></div>';
            ?>
        </div>
            <div id="analysis" style = "<?php
                        if (isset($_POST["submit"])) {
                            echo "display: block;";
                        } else {
                            echo "display: none;";
                        }
                    ?>">
                <?php 
                
                echo <<< END
                <h2>تحليل المشاعر</h2>
                <br><br>
                <button id="showArabicSentimentButton" onclick="showArabicSentiment()">إظهار تحليل المشاعر</button>
                <button id="hideArabicSentimentButton" onclick="hideArabicSentiment()" style="display: none;">إخفاء تحليل المشاعر </button>
                <div style="display: none;" id="arabic_sentiment">
                <center>
                <table border="0" cellspacing="2" cellpadding="5">
                    <tr>
                    <th  align="center" width="50%">
                        <b><font>التغريدة</font></b>
                    </th>
                    <th align="center" width="25%">
                        <b><font>المشاعر</font></b>
                    </th>
                    <th align="center" width="25%">
                        <b><font>الاحتمال</font></b>
                    </th>
                    </tr>
                END;
                // read the tweets from the tweets folder file by file
                $files = glob('uploads/tweets/*.json');
                // loop through the files
                $i = 0;
                foreach ($files as $file) {
                    // get the file content
                    $json = file_get_contents($file);
                    // decode the json file
                    $tweet = json_decode($json, true);
                    
                    // get the sentiment of each tweet
                    $tweet_sentiment = $tweet['sentiment'];
                    if ($tweet_sentiment == 'إيجابي') {
                        $bgcolor   = '#E0F0FF';
                        echo '<script>
                                // add 1 to positive tweets
                                positive++;
                                // assign positive probability to positive probabilities array
                                probabilities.push('.round(100 * $tweet['probability'], 1).');
                            </script>';
                    } else {
                        $bgcolor   = '#FFF0FF';
                        echo '<script>
                                // add 1 to negative tweets
                                negative++;
                                // assign negative probability to negative probabilities array
                                probabilities.push('.(-1)*(round(100 * $tweet['probability'], 1)).');
                            </script>';
                    }
                    // print the tweet text, sentiment, and probability
                    echo <<< END
                    <tr bgcolor="$bgcolor">
                        <td align="center" width="50%">
                            <font>$tweet[text]</font>
                        </td>
                        <td align="center" width="25%">
                            <font>$tweet_sentiment</font>
                        </td>
                        <td align="center" width="25%" style = "direction:ltr;">
                            <font>$tweet[probability] %</font>
                        </td>
                    </tr>
                    END;
                    $i++;
                }
                echo '</table></center></div>';
                ?>
                </div>
            </center>
            </div>
        <br><br>
        <div class="graphs" id="graph" style = "<?php
                    if (isset($_POST["submit"])) {
                        echo "display: block;";
                    } else {
                        echo "display: none;";
                    }
                ?>">
            <center>
                <br><br>
            <h2>الرسوم البيانية</h2>
            <button id="showGraphsButton" onclick="showGraphs()">إظهار الرسوم البيانية</button>
            <button id="hideGraphsButton" onclick="hideGraphs()" style="display: none;">إخفاء الرسوم البيانية</button>
            <br><br>    
            <!-- display graphs -->
            <div class="numwords" id="numWordsChart">
                <h3>عدد الكلمات في كل تغريدة</h3>
                <button id="showNumWordsButton" onclick="showNumWords()">إظهار الرسم البياني</button>
                <button id="hideNumWordsButton" onclick="hideNumWords()" style="display: none;">إخفاء الرسم البياني</button>
                <div id="numWords" style=" display: none;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
            <br><br>
            <div class="pieChart" id="sentimentChart">
                <h3>المشاعر</h3>
                <button id="showPieSentimentButton" onclick="showPieSentiment()">إظهار الرسم البياني</button>
                <button id="hidePieSentimentButton" onclick="hidePieSentiment()" style="display: none;">إخفاء الرسم البياني</button>
                <div id="pieSentiment" style="display: none;">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
            <br><br>
            <div class="probabilities" id="probabilityChart">
                <h3>الاحتمالات</h3>
                <button id="showProbabilitiesButton" onclick="showProbabilities()">إظهار الرسم البياني</button>
                <button id="hideProbabilitiesButton" onclick="hideProbabilities()" style="display: none;">إخفاء الرسم البياني</button>
                <div id="probabilities" style="display: none;">
                    <canvas id="barProbabilitiesChart"></canvas>
                </div>
            </div>
            <br><br>
            <div class="wordsSentiment" id="wordsSentiment">
                <h3>الكلمات والمشاعر</h3>
                <div id="wordsSentiment" >
                    <select id="displaywordsgraph" onchange="displaygraph()">
                        <!-- get options from tweets folder -->
                        <?php
                        $files = glob('uploads/tweets/*.json');
                        foreach ($files as $file) {
                            // get the file content
                            $json = file_get_contents($file);
                            // decode the json file
                            $tweet = json_decode($json, true);
                            // get the id of each tweet
                            $tweet_id = $tweet['id'];
                            // print the tweet
                            echo <<< END
                            <option value="$tweet_id">التغريدة $tweet_id</option>
                            END;
                        }
                        ?>
                        <button id="showWordsSentimentButton" onclick="showWordsSentiment()">إظهار الرسم البياني</button>
                        <button id="hideWordsSentimentButton" onclick="hideWordsSentiment()" style="display: none;">إخفاء الرسم البياني</button>

                    </select>
                    <script>
                        // get the selected tweet id
                        var tweet_id = document.getElementById("displaywordsgraph").value;
                        // get the file content
                        var json = $.ajax({
                            url: 'uploads/tweets/tweet' + tweet_id + '.json',
                            dataType: 'json',
                            async: false
                        }).responseText;
                        // decode the json file
                        var tweet = JSON.parse(json);
                        // get the words and sentiments
                        var words = tweet['word_sentiment'];
                        /*example of content of words array
                            "عاجل": {
                                "score": 0.028
                            },
                            "منظمه": {
                                "score": 0.38
                            }
                        */
                       // change the scores to % by multiplying it to 100
                       
                    </script>
                </div>
            </div>
            <script>
                function showGraphs() {
                    document.getElementById("numWords").style.display = "block";
                    document.getElementById("pieSentiment").style.display = "block";
                    document.getElementById("probabilities").style.display = "block";
                    document.getElementById("showGraphsButton").style.display = "none";
                    document.getElementById("hideGraphsButton").style.display = "block";
                    document.getElementById("showNumWordsButton").style.display = "none";
                    document.getElementById("hideNumWordsButton").style.display = "block";
                    document.getElementById("showPieSentimentButton").style.display = "none";
                    document.getElementById("hidePieSentimentButton").style.display = "block";
                    document.getElementById("showProbabilitiesButton").style.display = "none";
                    document.getElementById("hideProbabilitiesButton").style.display = "block";
                }

                function hideGraphs() {
                    document.getElementById("showGraphsButton").style.display = "block";
                    document.getElementById("hideGraphsButton").style.display = "none";
                    document.getElementById("numWords").style.display = "none";
                    document.getElementById("pieSentiment").style.display = "none";
                    document.getElementById("probabilities").style.display = "none";
                    document.getElementById("showNumWordsButton").style.display = "block";
                    document.getElementById("hideNumWordsButton").style.display = "none";
                    document.getElementById("showPieSentimentButton").style.display = "block";
                    document.getElementById("hidePieSentimentButton").style.display = "none";
                    document.getElementById("showProbabilitiesButton").style.display = "block";
                    document.getElementById("hideProbabilitiesButton").style.display = "none";
                }

                function showNumWords() {
                var y = document.getElementById("pieSentiment").style.display;
                var z = document.getElementById("probabilities").style.display;
                //check if the other charts are hidden or not
                if (y == "block" && z == "block") {
                    document.getElementById("showGraphsButton").style.display = "none";
                    document.getElementById("hideGraphsButton").style.display = "block";
                }
                    document.getElementById("numWords").style.display = "block";
                    document.getElementById("showNumWordsButton").style.display = "none";
                    document.getElementById("hideNumWordsButton").style.display = "block";
                }

                function hideNumWords() {
                var y = document.getElementById("pieSentiment").style.display;
                var z = document.getElementById("probabilities").style.display;
                //check if the other charts are hidden or not
                if (y == "none" && z == "none") {
                    document.getElementById("showGraphsButton").style.display = "block";
                    document.getElementById("hideGraphsButton").style.display = "none";
                }
                    document.getElementById("numWords").style.display = "none";
                    document.getElementById("showNumWordsButton").style.display = "block";
                    document.getElementById("hideNumWordsButton").style.display = "none";
                }

                function showPieSentiment() {
                var y = document.getElementById("numWords").style.display;
                var z = document.getElementById("probabilities").style.display;
                //check if the other charts are hidden or not
                if (y == "block" && z == "block") {
                    document.getElementById("showGraphsButton").style.display = "none";
                    document.getElementById("hideGraphsButton").style.display = "block";
                }
                    document.getElementById("pieSentiment").style.display = "block";
                    document.getElementById("showPieSentimentButton").style.display = "none";
                    document.getElementById("hidePieSentimentButton").style.display = "block";
                }

                function hidePieSentiment() {
                var y = document.getElementById("numWords").style.display;
                var z = document.getElementById("probabilities").style.display;
                //check if the other charts are hidden or not
                if (y == "none" && z == "none") {
                    document.getElementById("showGraphsButton").style.display = "block";
                    document.getElementById("hideGraphsButton").style.display = "none";
                }
                    document.getElementById("pieSentiment").style.display = "none";
                    document.getElementById("showPieSentimentButton").style.display = "block";
                    document.getElementById("hidePieSentimentButton").style.display = "none";
                }

                function showProbabilities() {
                var y = document.getElementById("numWords").style.display;
                var z = document.getElementById("pieSentiment").style.display;
                //check if the other charts are hidden or not
                if (y == "block" && z == "block") {
                    document.getElementById("showGraphsButton").style.display = "none";
                    document.getElementById("hideGraphsButton").style.display = "block";
                }
                    document.getElementById("probabilities").style.display = "block";
                    document.getElementById("showProbabilitiesButton").style.display = "none";
                    document.getElementById("hideProbabilitiesButton").style.display = "block";
                }

                function hideProbabilities() {
                var y = document.getElementById("numWords").style.display;
                var z = document.getElementById("pieSentiment").style.display;
                //check if the other charts are hidden or not
                if (y == "none" && z == "none") {
                    document.getElementById("showGraphsButton").style.display = "block";
                    document.getElementById("hideGraphsButton").style.display = "none";
                }
                    document.getElementById("probabilities").style.display = "none";
                    document.getElementById("showProbabilitiesButton").style.display = "block";
                    document.getElementById("hideProbabilitiesButton").style.display = "none";
                }
  
                // Get the number of words in each tweet from the PHP code
                var numWords = <?php echo json_encode($num_words); ?>;

                // Get the canvas element and create a new chart
                var ctx = document.getElementById('barChart').getContext('2d');
                // store labels
                var labels = Array.from(Array(numWords.length).keys());

                // add 1 to each label
                labels = labels.map(function(label) {
                    return label + 1;
                });

                // change the labels to strings adding "التغريدة" to each label
                labels = labels.map(function(label) {
                    return 'التغريدة ' + label;
                });

                // create the chart data
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'عدد الكلمات في كل تغريدة',
                            data: numWords,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
            <script>
                // Get the canvas element and create a new chart
                var ctx = document.getElementById('pieChart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['إيجابي', 'سلبي'],
                        datasets: [{
                            label: 'تحليل المشاعر',
                            data: [positive, negative],
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(255, 99, 132, 0.2)'
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            colorschemes: {
                                scheme: 'brewer.Paired12' // Use a color scheme from the chartjs-plugin-colorschemes library
                            }
                        }
                    }
                });
            </script>
            <script>
                // get the canvas element
                var ctx = document.getElementById('barProbabilitiesChart').getContext('2d');

                // store labels
                var labels = Array.from(Array(numWords.length).keys());

                // add 1 to each label
                labels = labels.map(function(label) {
                    return label + 1;
                });

                // change the labels to strings adding "التغريدة" to each label
                labels = labels.map(function(label) {
                    return 'التغريدة ' + label;
                });

                // create the chart data
                var chartData = {
                    labels: labels,
                    datasets: [{
                        label: 'احتمالات التحليلات',
                        data: probabilities,
                        backgroundColor: probabilities.map(function(p) {
                          return p < 0 ? '#ff6384' : '#36a2eb';
                        })
                    }]
                };

                // create the chart options
                var chartOptions = {
                    scales: {
                        xAxes: [{
                            gridLines: {
                                zeroLineColor: 'red',
                                zeroLineWidth: 20
                            },
                            ticks: {
                                callback: function(value, index, values) {
                                    // replace the labels with your custom labels
                                    return '$' + (index + 1);
                                }
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                max: 1,
                                min: -1
                            }
                        }]
                    }
                };

                // create the chart
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: chartData,
                    options: chartOptions
                });

            </script>
            </center>
        </div>
    </div>
</body>
</html>