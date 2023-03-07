<?php header('Content-Type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dialectal Arabic Tweet Preprocessor</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Dialectal Arabic Tweet Preprocessor</h1>
    <p>This web app pre-processes dialectal Arabic tweets by normalizing and tokenizing them.</p>
    <form action="preprocess.php" method="post" enctype="multipart/form-data">
        <label for="csvFile">CSV File:</label>
        <input type="file" id="csvFile" name="csvFile" accept=".csv" required>
        <br>
        <br>
        <input type="submit" value="Pre-process Tweets">
    </form>
</body>
</html>
