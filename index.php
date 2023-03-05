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
	</form>

	<?php
	if (isset($_POST["submit"])) {
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
				echo "<td>" . htmlspecialchars($cell, ENT_QUOTES, 'UTF-8') . "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	?>

</body>
</html>
