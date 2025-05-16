<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rate a room</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .room-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            display: inline-block;
        }

        .room-image {
            max-width: 200px;
            max-height: 200px;
        }

        .rate-button {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            border: 1px solid #007BFF;
            border-radius: 5px;
            cursor: pointer;
        }

        .rate-button.disabled {
            background-color: #ccc;
            border: 1px solid #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<h1>All Rooms</h1>

<?php
// Include your database configuration file
require('config.php');

// Fetch all rooms from the database
$query = "SELECT rooms.id, rooms.room_number, roomtype.name AS room_type, rooms.roomrate, rooms.image_path
          FROM rooms
          INNER JOIN roomtype ON rooms.roomtype_id = roomtype.id";
$result = mysqli_query($conn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="room-box">';
            echo '<p><strong>Room Number:</strong> ' . $row['room_number'] . '</p>';
            echo '<p><strong>Room Type:</strong> ' . $row['room_type'] . '</p>';
            echo '<p><strong>Room Rate:</strong> ' . $row['roomrate'] . '</p>';
            echo '<img src="' . $row['image_path'] . '" alt="Room Image" class="room-image"><br>';
            
            echo '<a href="rateroom.php?id=' . $row['id'] . '" class="rate-button">Rate Room</a>';

            echo '</div>';
        }
    } else {
        echo 'No rooms found.';
    }
} else {
    echo 'Error: ' . $query . '<br>' . mysqli_error($conn);
}

mysqli_close($conn);
?>
<form>
	<a href="home.php">Back</a>
</form>
</body>
</html>
