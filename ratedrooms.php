<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Room Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .feedback-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Room Feedback</h1>

    <?php
    // Include your database configuration file
    require('config.php');

    // Fetch all data from the roomfeedback table
    $query = "SELECT roomfeedback.*, rooms.room_number, stars.name AS star_name
              FROM roomfeedback
              INNER JOIN rooms ON roomfeedback.rooms_id = rooms.id
              INNER JOIN stars ON roomfeedback.stars_id = stars.id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="feedback-box">';
                echo '<p><strong>Room Number:</strong> ' . $row['room_number'] . '</p>';
                echo '<p><strong>Stars:</strong> ' . $row['star_name'] . '</p>';
                echo '<p><strong>Comment:</strong> ' . $row['contents'] . '</p>';
                // You can display other feedback information here

                echo '</div>';
            }
        } else {
            echo 'No feedback found.';
        }
    } else {
        echo 'Error: ' . $query . '<br>' . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>

</body>
</html>
