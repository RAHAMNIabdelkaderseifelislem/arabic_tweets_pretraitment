<?php
require_once 'config/constants.php';

if (isset($_POST["submit"])) {
	// Retrieve the uploaded file
	$file = $_FILES["csv_file"]["tmp_name"];

	// Parse the CSV data into an array
	$data = array_map('str_getcsv', file($file));

	// Remove emojis and hashtags, and non-Arabic letters from the second column of each row
	foreach ($data as &$row) {
		// Remove emojis
		$row[1] = preg_replace(EMOJI_PATTERN, '', $row[1]);

		// Remove hashtags
		$row[1] = preg_replace(HASHTAG_PATTERN, '', $row[1]);

		// Remove non-Arabic letters
		$row[1] = preg_replace('/[^\x{0600}-\x{06FF}]/u', ' ', $row[1]);
	}

	// Generate an HTML table from the modified CSV data
	echo "<table>";
	foreach ($data as $row) {
		echo "<tr>";
		foreach ($row as $cell) {
			echo "<td>" . htmlspecialchars($cell, ENT_QUOTES, 'UTF-8') . "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pre-Processing of Dialectal Arabic Tweets</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		<input type="file" name="csv_file" accept=".csv">
		<button type="submit" name="submit">Submit</button>
	</form>
</body>
</html>
