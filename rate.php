<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate a Room</title>
    <style>
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f5f5f5;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    .room-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        max-width: 1200px;
        margin: auto;
    }

    .room-box {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: transform 0.2s ease;
    }

    .room-box:hover {
        transform: translateY(-5px);
    }

    .room-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .room-details p {
        margin: 6px 0;
        font-size: 14px;
        color: #444;
    }

    .rate-button {
        display: inline-block;
        margin-top: 10px;
        padding: 8px 16px;
        font-size: 14px;
        text-decoration: none;
        color: #fff;
        background-color: #007BFF;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .rate-button:hover {
        background-color: #0056b3;
    }

    .back-button {
        display: inline-block;
        margin: 30px auto 0;
        padding: 10px 20px;
        background-color: #6c757d;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 15px;
        text-align: center;
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

    <h1>All Rooms</h1>

    <div class="room-container">
        <?php
        require('config.php');

        $query = "SELECT rooms.id, rooms.room_number, roomtype.name AS room_type, rooms.roomrate, rooms.image_path
                  FROM rooms
                  INNER JOIN roomtype ON rooms.roomtype_id = roomtype.id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="room-box">';
                echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="Room Image" class="room-image">';
                echo '<div class="room-details">';
                echo '<p><strong>Room Number:</strong> ' . htmlspecialchars($row['room_number']) . '</p>';
                echo '<p><strong>Room Type:</strong> ' . htmlspecialchars($row['room_type']) . '</p>';
                echo '<p><strong>Room Rate:</strong> ₱' . number_format($row['roomrate'], 2) . '</p>';
                echo '</div>';
                echo '<a href="rateroom.php?id=' . $row['id'] . '" class="rate-button">Rate Room</a>';
                echo '</div>';
            }
        } else {
            echo '<p class="center">No rooms found.</p>';
        }

        mysqli_close($conn);
        ?>
    </div>

    <div class="center">
        <a href="home.php" class="back-button">← Back to Home</a>
    </div>

</body>

</html>