<?php
if (isset($_POST["save"])) {
    $processed_data = json_decode($_POST["processed_data"]);

    // Save the processed data to a file named 'tweets-ar.csv'
    $file_path = "uploads/tweets-ar.csv";
    $file = fopen($file_path, "w");
    foreach ($processed_data as $row) {
        fwrite($file, $row[0] . "\n");
    }
    fclose($file);

    // Redirect back to the original PHP file
    header("Location: index.php");
    exit();
}
?>