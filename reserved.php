<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['usertype_id'] != 2) {
    echo '<script>alert("You do not have permission to access this page.");</script>';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}

require('config.php');

if (isset($_POST['deleteNow'])) {
    $reservationId = $_POST['reservation_id'];

    // Get room ID associated with the reservation
    $getRoomIdQuery = "SELECT rooms_id FROM reservation WHERE id = '$reservationId'";
    $roomIdResult = mysqli_query($conn, $getRoomIdQuery);

    if ($roomIdResult && mysqli_num_rows($roomIdResult) > 0) {
        $row = mysqli_fetch_assoc($roomIdResult);
        $roomId = $row['rooms_id'];

        // Update the room status to available (1)
        $updateRoomStatusQuery = "UPDATE rooms SET roomstatus_id = 1 WHERE id = '$roomId'";
        $updateRoomStatusResult = mysqli_query($conn, $updateRoomStatusQuery);

        if ($updateRoomStatusResult) {
            // Delete the reservation record
            $deleteReservationQuery = "DELETE FROM reservation WHERE id = '$reservationId'";
            $deleteReservationResult = mysqli_query($conn, $deleteReservationQuery);

            if ($deleteReservationResult) {
                echo '<script>alert("Room reservation canceled successfully.");</script>';
                echo '<meta http-equiv="refresh" content="0">';
            } else {
                echo '<p style="color:red;">Error deleting reservation record.</p>';
            }
        } else {
            echo '<p style="color:red;">Error updating room status.</p>';
        }
    } else {
        echo '<p style="color:red;">Error fetching room ID.</p>';
    }
}

// Handle search input safely
$searchFname = isset($_POST['search_fname']) ? mysqli_real_escape_string($conn, $_POST['search_fname']) : '';
$searchLname = isset($_POST['search_lname']) ? mysqli_real_escape_string($conn, $_POST['search_lname']) : '';

$query = "SELECT reservation.*, 
                 rooms.room_number, roomtype.name AS room_type, rooms.roomrate, rooms.roomstatus_id, roomstatus.name AS room_status,
                 profile.fname, profile.lname,
                 payment.amount AS payment_amount, method.name AS payment_method, pstatus.name AS payment_status
          FROM reservation
          LEFT JOIN rooms ON reservation.rooms_id = rooms.id
          LEFT JOIN roomtype ON rooms.roomtype_id = roomtype.id
          LEFT JOIN roomstatus ON rooms.roomstatus_id = roomstatus.id
          LEFT JOIN login ON reservation.login_id = login.id
          LEFT JOIN profile ON login.id = profile.login_id
          LEFT JOIN payment ON reservation.id = payment.reservation_id
          LEFT JOIN method ON payment.method_id = method.id
          LEFT JOIN pstatus ON payment.pstatuts_id = pstatus.id
          WHERE profile.fname LIKE '%$searchFname%' AND profile.lname LIKE '%$searchLname%'";

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
        background-color: #f7f9fc;
        padding: 20px;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    form.search-form {
        margin-bottom: 20px;
        text-align: center;
    }

    form.search-form input[type="text"] {
        padding: 7px 10px;
        margin: 0 10px 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 180px;
    }

    form.search-form input[type="submit"] {
        padding: 7px 18px;
        background-color: #007BFF;
        border: none;
        border-radius: 4px;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form.search-form input[type="submit"]:hover {
        background-color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
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
        background-color: #f9fbfd;
    }

    input[type="submit"].cancel-btn {
        background-color: #dc3545;
        padding: 7px 15px;
        border-radius: 4px;
        border: none;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"].cancel-btn:hover {
        background-color: #a71d2a;
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

    <h2>Your Reservations and Payments</h2>

    <form method="POST" class="search-form" action="">
        <input type="text" name="search_fname" placeholder="Search by First Name"
            value="<?php echo htmlspecialchars($searchFname); ?>">
        <input type="text" name="search_lname" placeholder="Search by Last Name"
            value="<?php echo htmlspecialchars($searchLname); ?>">
        <input type="submit" value="Search">
    </form>

    <?php
if ($result && mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Room Type</th>
            <th>Room Rate</th>
            <th>Room Status</th>
            <th>Check-in Date</th>
            <th>Check-out Date</th>
            <th>Payment Amount</th>
            <th>Payment Method</th>
            <th>Payment Status</th>
            <th>Action</th>
          </tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['fname'] ?? 'N/A') . '</td>';
        echo '<td>' . htmlspecialchars($row['lname'] ?? 'N/A') . '</td>';
        echo '<td>' . htmlspecialchars($row['room_type'] ?? 'N/A') . '</td>';
        echo '<td>' . htmlspecialchars($row['roomrate'] ?? 'N/A') . '</td>';
        echo '<td>' . htmlspecialchars($row['room_status'] ?? 'N/A') . '</td>';
        echo '<td>' . htmlspecialchars($row['checkin_date']) . '</td>';
        echo '<td>' . htmlspecialchars($row['checkout_date']) . '</td>';
        echo '<td>' . htmlspecialchars($row['payment_amount'] ?? 'N/A') . '</td>';
        echo '<td>' . htmlspecialchars($row['payment_method'] ?? 'N/A') . '</td>';
        echo '<td>' . htmlspecialchars($row['payment_status'] ?? 'N/A') . '</td>';
        echo '<td>';
        
        if ($row['roomstatus_id'] == 2) {
            echo '<form action="" method="POST" style="margin:0;">';
            echo '<input type="hidden" name="reservation_id" value="' . $row['id'] . '">';
            echo '<input type="submit" name="deleteNow" value="Checked out" class="cancel-btn">';
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

    <a href="front.php" class="back-link">← Back</a>

</body>

</html>