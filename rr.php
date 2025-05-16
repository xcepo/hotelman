<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['usertype_id'] != 2) {
    echo '<script>alert("You do not have permission to access this page.");</script>';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}

require('config.php');

if (isset($_POST['reserveNow'])) {
    $reservationId = $_POST['reservation_id'];

    // Update the room status to 2 (unavailable)
    $updateRoomStatusQuery = "UPDATE rooms SET roomstatus_id = 2 WHERE id IN (
        SELECT rooms_id FROM reservation WHERE id = '$reservationId'
    )";

    $updateRoomStatusResult = mysqli_query($conn, $updateRoomStatusQuery);

    if ($updateRoomStatusResult) {
        echo '<script>alert("Room reserved successfully.");</script>';
        echo '<meta http-equiv="refresh" content="0">';
    } else {
        echo '<p style="color:red;">Error updating room status.</p>';
    }
}

$query = "SELECT reservation.*, 
                 rooms.room_number, roomtype.name AS room_type, rooms.roomrate, rooms.roomstatus_id, roomstatus.name AS room_status,
                 login.username,
                 payment.amount AS payment_amount, method.name AS payment_method, pstatus.name AS payment_status
          FROM reservation
          LEFT JOIN rooms ON reservation.rooms_id = rooms.id
          LEFT JOIN roomtype ON rooms.roomtype_id = roomtype.id
          LEFT JOIN roomstatus ON rooms.roomstatus_id = roomstatus.id
          LEFT JOIN login ON reservation.login_id = login.id
          LEFT JOIN payment ON reservation.id = payment.reservation_id
          LEFT JOIN method ON payment.method_id = method.id
          LEFT JOIN pstatus ON payment.pstatuts_id = pstatus.id";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reservation Request</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9fafb;
        margin: 20px;
    }

    h2 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: center;
        vertical-align: middle;
    }

    th {
        background-color: #007BFF;
        color: white;
        font-weight: 600;
    }

    tr:nth-child(even) {
        background-color: #f2f6fc;
    }

    input[type="submit"] {
        padding: 8px 16px;
        background-color: #28a745;
        border: none;
        border-radius: 5px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #218838;
    }

    a.back-link {
        display: inline-block;
        margin-top: 20px;
        text-decoration: none;
        color: #007BFF;
        font-weight: 600;
    }

    a.back-link:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>

    <?php
if ($result && mysqli_num_rows($result) > 0) {
    echo '<h2>Your Reservations and Payments</h2>';
    echo '<table>';
    echo '<tr>
            <th>Room Number</th>
            <th>Room Type</th>
            <th>Room Rate</th>
            <th>Room Status</th>
            <th>Check-in Date</th>
            <th>Check-out Date</th>
            <th>User Name</th>
            <th>Payment Amount</th>
            <th>Payment Method</th>
            <th>Payment Status</th>
            <th>Action</th>
          </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . ($row['room_number'] ?? 'N/A') . '</td>';
        echo '<td>' . ($row['room_type'] ?? 'N/A') . '</td>';
        echo '<td>' . ($row['roomrate'] ?? 'N/A') . '</td>';
        echo '<td>' . ($row['room_status'] ?? 'N/A') . '</td>';
        echo '<td>' . $row['checkin_date'] . '</td>';
        echo '<td>' . $row['checkout_date'] . '</td>';
        echo '<td>' . ($row['username'] ?? 'N/A') . '</td>';
        echo '<td>' . ($row['payment_amount'] ?? 'N/A') . '</td>';
        echo '<td>' . ($row['payment_method'] ?? 'N/A') . '</td>';
        echo '<td>' . ($row['payment_status'] ?? 'N/A') . '</td>';
        echo '<td>';
        if ($row['roomstatus_id'] == 1) {
            echo '<form action="" method="POST" style="margin:0;">';
            echo '<input type="hidden" name="reservation_id" value="' . $row['id'] . '">';
            echo '<input type="submit" name="reserveNow" value="Reserve">';
            echo '</form>';
        } else {
            echo 'Room Not Available';
        }
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p style="text-align:center; color:#666;">No reservations found.</p>';
}

mysqli_close($conn);
?>

    <a href="front.php" class="back-link">← Back to Front Desk</a>

</body>

</html>