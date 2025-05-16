<?php
session_start(); 

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
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
            color: green;
            font-weight: bold;
        }

        .unavailable {
            color: red;
            font-weight: bold;
        }

        .reserve-button {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
            border: 1px solid #007BFF;
            border-radius: 5px;
            cursor: pointer;
        }

        .reserve-button.disabled {
            background-color: #ccc;
            border: 1px solid #ccc;
            cursor: not-allowed;
        }

        .rate-button {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            background-color: #28a745;
            border: 1px solid #28a745;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px; /* Add margin to separate the buttons */
        }
    </style>
</head>
<body>
    <h1>All Rooms</h1>
    <form>
        <a href="logout.php">Logout</a>
        <a href="rules.php">Rules</a>
        <a href="rate.php" class="rate-button">Rate rooms</a>
        <a href="ratedrooms.php" class="rate-button">Rated Rooms</a>
    </form><br>

    <?php
    require('config.php');

    $query = "SELECT rooms.id, rooms.room_number, roomtype.name AS room_type, rooms.roomrate, roomstatus.name AS room_status, rooms.image_path
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
                echo '<img src="' . $row['image_path'] . '" alt="Room Image" class="room-image"><br>';
                
                // Check if the room status is available for reservation
                if (strtolower($row['room_status']) == 'available') {
                    // Add "Reserve Now" button with a link to reserve.php and passing id as a parameter
                    echo '<a href="reserve.php?id=' . $row['id'] . '" class="reserve-button">Reserve Now</a>';
                } else {
                    echo '<span class="reserve-button disabled">Not Available</span>';
                }

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
