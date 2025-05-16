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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>All Rooms</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        background: #f9f9f9;
    }

    h1 {
        margin-bottom: 20px;
    }

    .room-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .room-box {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        width: 250px;
        box-shadow: 0 2px 5px rgb(0 0 0 / 0.1);
        transition: box-shadow 0.3s ease;
    }

    .room-box:hover {
        box-shadow: 0 4px 12px rgb(0 0 0 / 0.15);
    }

    .room-image {
        max-width: 100%;
        max-height: 150px;
        border-radius: 4px;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .room-info p {
        margin: 6px 0;
        font-size: 0.9rem;
    }

    .room-info strong {
        color: #333;
    }

    .available {
        color: green;
        font-weight: bold;
    }

    .unavailable {
        color: red;
        font-weight: bold;
    }

    a.back-btn {
        display: inline-block;
        margin-top: 30px;
        padding: 8px 16px;
        background: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    a.back-btn:hover {
        background: #0056b3;
    }

    @media (max-width: 600px) {
        .room-box {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <h1>All Rooms</h1>
    <div class="room-container">
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
                $statusClass = (strtolower($row['room_status']) == 'available') ? 'available' : 'unavailable';

                echo '<div class="room-box">';
                echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="Room Image" class="room-image">';
                echo '<div class="room-info">';
                echo '<p><strong>Room Number:</strong> ' . htmlspecialchars($row['room_number']) . '</p>';
                echo '<p><strong>Room Type:</strong> ' . htmlspecialchars($row['room_type']) . '</p>';
                echo '<p><strong>Room Rate:</strong> $' . htmlspecialchars($row['roomrate']) . '</p>';
                echo '<p><strong>Room Status:</strong> <span class="' . $statusClass . '">' . htmlspecialchars($row['room_status']) . '</span></p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No rooms found.</p>';
        }
    } else {
        echo '<p>Error: ' . $query . '<br>' . mysqli_error($conn) . '</p>';
    }

    mysqli_close($conn);
    ?>
    </div>
    <a href="admin.php" class="back-btn">Back</a>
</body>

</html>