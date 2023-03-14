<?php

$original_data = null;
$processed_data = null;

if (isset($_POST["submit"])) {
    // Retrieve the uploaded file
    $file = $_FILES["csv_file"]["tmp_name"];

    // Parse the CSV data into an array
    $original_data = array_map('str_getcsv', file($file));

    // Remove emojis and hashtags, and non-Arabic letters from the second column of each row
    $processed_data = array();
    foreach ($original_data as $row) {

        // Remove non-Arabic letters
        $row = preg_replace('/[^\x{0600}-\x{06FF}]/u', ' ', $row);

        $processed_data[] = $row;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Pre-Processing of Dialectal Arabic Tweets</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        function showOriginalTweets() {
            document.getElementById("original_tweets").style.display = "block";
            document.getElementById("processed_tweets").style.display = "none";
        }
        function showProcessedTweets() {
            document.getElementById("original_tweets").style.display = "none";
            document.getElementById("processed_tweets").style.display = "block";
        }
    </script>
</head>
<body>
    <?php if ($original_data): ?>
        <h2>Original Tweets</h2>
        <button onclick="showOriginalTweets()">Show Original Tweets</button>
        <table border="1" id="original_tweets">
            <thead>
                <tr>
                    <th>tweet</th>
                </tr>
            </thead>
            <?php foreach ($original_data as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
    <?php if ($processed_data): ?>
        <h2>Preprocessed Tweets</h2>
        <button onclick="showProcessedTweets()">Show Preprocessed Tweets</button>
        <table border="1" id="processed_tweets" style="display: none;">
            <thead>
                <tr>
                    <th>tweet</th>
                </tr>
            </thead>
            <?php foreach ($processed_data as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row[0], ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>