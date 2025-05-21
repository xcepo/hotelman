<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>All Rooms</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f7f8;
        margin: 0;
        padding: 20px;
        color: #333;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    .nav-links {
        max-width: 800px;
        margin: 0 auto 40px auto;
        text-align: center;
    }

    .nav-links a {
        display: inline-block;
        margin: 0 10px 10px;
        padding: 10px 18px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        font-weight: 600;
        border-radius: 6px;
        transition: background-color 0.3s ease;
        user-select: none;
    }

    .nav-links a:hover {
        background-color: #0056b3;
    }

    /* Logout button style */
    .logout-button {
        background-color: #dc3545 !important;
        border: 1px solid #dc3545 !important;
    }

    .logout-button:hover {
        background-color: #c82333 !important;
        border-color: #bd2130 !important;
    }

    .rooms-container {
        max-width: 900px;
        margin: 0 auto;
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        justify-content: center;
    }

    .room-box {
        background: white;
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 260px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.2s ease;
    }

    .room-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .room-image {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .room-info p {
        margin: 6px 0;
        font-size: 15px;
        width: 100%;
    }

    .room-info strong {
        color: #555;
    }

    .available {
        color: #28a745;
        font-weight: 700;
    }

    .unavailable {
        color: #dc3545;
        font-weight: 700;
    }

    .buttons {
        margin-top: 15px;
        display: flex;
        gap: 10px;
        width: 100%;
        justify-content: center;
    }

    .button {
        padding: 10px 16px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        flex: 1;
        transition: background-color 0.3s ease;
        user-select: none;
    }

    .reserve-button {
        background-color: #007bff;
        border: 1px solid #007bff;
        color: white;
    }

    .reserve-button:hover {
        background-color: #0056b3;
    }

    .reserve-button.disabled {
        background-color: #ccc;
        border-color: #ccc;
        cursor: not-allowed;
        color: #666;
    }
    </style>
</head>

<body>
    <h1>All Rooms</h1>

    <div class="nav-links">
        <a href="logout.php" class="logout-button">Logout</a>
        <a href="rules.php">Rules</a>
        <a href="rate.php">Rate Rooms</a>
        <a href="ratedrooms.php">Rated Rooms</a>
    </div>

    <div class="rooms-container">
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
                    $statusClass = (strtolower($row['room_status']) == 'available') ? 'available' : 'unavailable';
                    echo '<div class="room-box">';
                    echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="Room Image" class="room-image">';
                    echo '<div class="room-info">';
                    echo '<p><strong>Room Number:</strong> ' . htmlspecialchars($row['room_number']) . '</p>';
                    echo '<p><strong>Room Type:</strong> ' . htmlspecialchars($row['room_type']) . '</p>';
                    echo '<p><strong>Room Rate:</strong> ' . htmlspecialchars($row['roomrate']) . '</p>';
                    echo '<p><strong>Room Status:</strong> <span class="' . $statusClass . '">' . htmlspecialchars($row['room_status']) . '</span></p>';
                    echo '</div>';

                    echo '<div class="buttons">';
                    if (strtolower($row['room_status']) == 'available') {
                        echo '<a href="reserve.php?id=' . $row['id'] . '" class="button reserve-button">Reserve Now</a>';
                    } else {
                        echo '<span class="button reserve-button disabled">Not Available</span>';
                    }
                    echo '</div>';

                    echo '</div>';
                }
            } else {
                echo '<p style="text-align:center; width:100%;">No rooms found.</p>';
            }
        } else {
            echo '<p style="color:red; text-align:center;">Error: ' . mysqli_error($conn) . '</p>';
        }

        mysqli_close($conn);
        ?>
    </div>
</body>

</html>