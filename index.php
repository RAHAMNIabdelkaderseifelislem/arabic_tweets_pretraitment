<!DOCTYPE html>
<html>
<head>
	<title>CSV Reader</title>
	<meta charset="UTF-8">
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		<input type="file" name="csv_file" id="csv_file" style="display:none" />
		<button type="button" onclick="document.getElementById('csv_file').click();">Choose File</button>
		<button type="submit" name="submit">Upload</button>
		<br>
		<br>
		<input type="hidden" name="delete_emoji" value="true">
		<button type="submit" name="delete_emoji">Delete Emoji</button>
	</form>

	<?php

	function removeEmojis($string) {
		// Remove emojis from the string using regex
		$regex = '/[\x{1F600}-\x{1F64F}]|[\x{1F300}-\x{1F5FF}]|[\x{1F680}-\x{1F6FF}]|[\x{2600}-\x{26FF}]|[\x{2700}-\x{27BF}]/u';
		$clean_string = preg_replace($regex, '', $string);
		
		return $clean_string;
	}

	if (isset($_POST["submit"]) || isset($_POST["delete_emoji"])) {
		// Check if the "delete_emoji" button was clicked
		$delete_emoji = isset($_POST["delete_emoji"]);

		// Retrieve the uploaded file
		$file = $_FILES["csv_file"]["tmp_name"];

		// Parse the CSV data into an array
		$data = array_map('str_getcsv', file($file));

		// Split each cell in the CSV data into two separate columns
		foreach ($data as &$row) {
			$row = explode(';', $row[0]);
		}

		// Generate an HTML table from the modified CSV data
		echo '<table border="1"><thead><tr><th>Number</th><th>tweet</th></tr></thead>';
		foreach ($data as $row) {
			echo "<tr>";
			foreach ($row as $cell) {
				if ($delete_emoji) {
					$cell = removeEmojis($cell);
				}
				echo "<td>" . htmlspecialchars($cell, ENT_QUOTES, 'UTF-8') . "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	?>

</body>
</html>
