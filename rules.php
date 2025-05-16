<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rules</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
    </style>
</head>
<body>

<h1>Hotel Rules</h1>

<?php
// Include your database configuration file
require('config.php');

// Fetch all rules from the database
$query = "SELECT * FROM rules";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo '<ul>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li>' . $row['content'] . '</li>';
        }
        echo '</ul>';
    } else {
        echo 'No rules found.';
    }
} else {
    echo 'Error: ' . $query . '<br>' . mysqli_error($conn);
}

mysqli_close($conn);
?>
<a href="home.php">Back</a>
</body>
</html>
