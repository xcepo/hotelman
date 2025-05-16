<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['usertype_id'] != 2) {
    echo '<script>alert("You do not have permission to access this page.");</script>';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
?>



<?php
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
                echo 'Error deleting reservation record.';
            }
        } else {
            echo 'Error updating room status.';
        }
    } else {
        echo 'Error fetching room ID.';
    }
}

// Handle search
$searchFname = isset($_POST['search_fname']) ? $_POST['search_fname'] : '';
$searchLname = isset($_POST['search_lname']) ? $_POST['search_lname'] : '';

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

if ($result && mysqli_num_rows($result) > 0) {
    echo '<h2>Your Reservations and Payments</h2>';
    echo '<form method="POST" action="">';
    echo 'Search by First Name: <input type="text" name="search_fname" value="' . $searchFname . '">';
    echo 'Search by Last Name: <input type="text" name="search_lname" value="' . $searchLname . '">';
    echo '<input type="submit" value="Search">';
    echo '</form>';
    echo '<table border="1">';
    echo '<tr><th>First Name</th><th>Last Name</th><th>Room Type</th><th>Room Rate</th><th>Room Status</th><th>Check-in Date</th><th>Check-out Date</th><th>Payment Amount</th><th>Payment Method</th><th>Payment Status</th><th>Action</th></tr>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . ($row['fname'] ?? 'N/A') . '</td>';
        echo '<td>' . ($row['lname'] ?? 'N/A') . '</td>';
        echo '<td>' . ($row['room_type'] ?? 'N/A') . '</td>';
        echo '<td>' . ($row['roomrate'] ?? 'N/A') . '</td>';
        echo '<td>' . ($row['room_status'] ?? 'N/A') . '</td>';
        echo '<td>' . $row['checkin_date'] . '</td>';
        echo '<td>' . $row['checkout_date'] . '</td>';
        echo '<td>' . ($row['payment_amount'] ?? 'N/A') . '</td>';
        echo '<td>' . ($row['payment_method'] ?? 'N/A') . '</td>';
        echo '<td>' . ($row['payment_status'] ?? 'N/A') . '</td>';
        echo '<td>';
        
        // Display the "Cancel Reservation" button only if the room status is reserved (2)
        if ($row['roomstatus_id'] == 2) {
            echo '<form action="" method="POST">';
            echo '<input type="hidden" name="reservation_id" value="' . $row['id'] . '">';
            echo '<input type="submit" name="deleteNow" value="Checked out">';
            echo '</form>';
        } else {
            echo 'Room Not Available';
        }

        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No reservations found.';
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation Request</title>
</head>
<body>
    <a href="front.php">Back</a>
</body>
</html>
