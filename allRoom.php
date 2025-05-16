<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['usertype_id'] != 1) {
    echo '<script>alert("You do not have permission to access this page.");</script>';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Rooms</title>
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

        /* Styling for room status */
        .available {
            color: green; /* Change color to green */
            font-weight: bold;
        }

        .unavailable {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>All Rooms</h1>
    <form><a href="admin.php">Back</a></form><br>

    <?php
    require('config.php');

    $query = "SELECT rooms.room_number, roomtype.name AS room_type, rooms.roomrate, roomstatus.name AS room_status, rooms.image_path
              FROM rooms
              INNER JOIN roomtype ON rooms.roomtype_id = roomtype.id
              INNER JOIN roomstatus ON rooms.roomstatus_id = roomstatus.id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Set the class based on room status
                $statusClass = (strtolower($row['room_status']) == 'available') ? 'available' : 'unavailable';

                echo '<div class="room-box">';
                echo '<p><strong>Room Number:</strong> ' . $row['room_number'] . '</p>';
                echo '<p><strong>Room Type:</strong> ' . $row['room_type'] . '</p>';
                echo '<p><strong>Room Rate:</strong> ' . $row['roomrate'] . '</p>';
                echo '<p><strong>Room Status:</strong> <span class="' . $statusClass . '">' . $row['room_status'] . '</span></p>';
                echo '<img src="' . $row['image_path'] . '" alt="Room Image" class="room-image">';
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

</body>
</html>
