<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Feedback</title>
    <style>
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f0f2f5;
    }

    .container {
        max-width: 900px;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }

    .feedback-box {
        border: 1px solid #dee2e6;
        background-color: #f8f9fa;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
    }

    .feedback-box p {
        margin: 8px 0;
        font-size: 15px;
    }

    .feedback-box strong {
        color: #495057;
    }

    .back-button {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        padding: 10px 20px;
        background-color: #6c757d;
        color: white;
        border-radius: 6px;
        transition: background-color 0.2s ease;
    }

    .back-button:hover {
        background-color: #5a6268;
    }

    .center {
        text-align: center;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Room Feedback</h1>

        <?php
        require('config.php');

        $query = "SELECT roomfeedback.*, rooms.room_number, stars.name AS star_name
                  FROM roomfeedback
                  INNER JOIN rooms ON roomfeedback.rooms_id = rooms.id
                  INNER JOIN stars ON roomfeedback.stars_id = stars.id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="feedback-box">';
                    echo '<p><strong>Room Number:</strong> ' . htmlspecialchars($row['room_number']) . '</p>';
                    echo '<p><strong>Stars:</strong> ' . htmlspecialchars($row['star_name']) . '</p>';
                    echo '<p><strong>Comment:</strong> ' . htmlspecialchars($row['contents']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No feedback found.</p>';
            }
        } else {
            echo '<p>Error: ' . $query . '<br>' . mysqli_error($conn) . '</p>';
        }

        mysqli_close($conn);
        ?>

        <div class="center">
            <a href="home.php" class="back-button">← Back to Home</a>
        </div>
    </div>
</body>

</html>