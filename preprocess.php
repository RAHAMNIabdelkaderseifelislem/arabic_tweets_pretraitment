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

if (isset($_POST["save"])) {
    // Retrieve the processed data
    $processed_data = json_decode($_POST["processed_data"], true);

    // Create the uploads directory if it doesn't exist
    if (!is_dir("uploads")) {
        mkdir("uploads");
    }

    // Save the processed data to a file
    $file = fopen("uploads/tweets-ar.csv", "w");
    foreach ($processed_data as $row) {
        fputcsv($file, $row);
    }
    fclose($file);

    // Redirect to the original page with a success message
    header("Location: preprocess.php?success=1");
    exit;
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
        <p><a href="uploads/tweets-ar.csv" download>Download processed data</a></p>
    <?php endif; ?>
    <?php if (!$processed_data && isset($_GET["success"])): ?>
        <p>Data has been processed and saved successfully!</p>
    <?php endif; ?>
    <h2>Upload CSV file</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="csv_file">
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
    <?php if ($processed_data): ?>
        <h2>Save Preprocessed Data</h2>
        <form method="post">
            <input type="hidden" name="processed_data" value="<?php echo htmlspecialchars(json_encode($processed_data), ENT_QUOTES, 'UTF-8'); ?>">
            <input type="submit" name="save" value="Save Preprocessed Data">
        </form>
    <?php endif; ?>
</body>
</html>