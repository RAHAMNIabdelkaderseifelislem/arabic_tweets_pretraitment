<!DOCTYPE html>
<html>
<head>
    <title>Preprocessing Results</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Preprocessing Results</h1>
    <?php if ($preprocessingError): ?>
        <p>Error: <?= $preprocessingError ?></p>
    <?php else: ?>
        <p>Preprocessing completed successfully!</p>
        <p>Processed <?= $numTweets ?> tweets:</p>
        <ul>
        <?php foreach ($processedTweets as $tweet): ?>
            <li><?= $tweet ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
