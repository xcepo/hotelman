<?php
session_start();

if (isset($_SESSION['id'])) {
    $loggedInUserId = $_SESSION['id'];
    require('config.php');

    if (isset($_GET['id'])) {
        $roomId = $_GET['id'];

        $query = "SELECT rooms.room_number, roomtype.name AS room_type, rooms.roomrate,
                  reservation.checkin_date, reservation.checkout_date, reservation.id AS reservation_id
                  FROM reservation
                  INNER JOIN rooms ON reservation.rooms_id = rooms.id
                  INNER JOIN roomtype ON rooms.roomtype_id = roomtype.id
                  WHERE reservation.login_id = '$loggedInUserId' AND reservation.rooms_id = '$roomId'";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $reservationDetails = mysqli_fetch_assoc($result);

            // Calculate total amount
            $checkinDate = new DateTime($reservationDetails['checkin_date']);
            $checkoutDate = new DateTime($reservationDetails['checkout_date']);
            $duration = $checkoutDate->diff($checkinDate)->days;
            $roomRate = $reservationDetails['roomrate'];
            $totalAmount = $duration * $roomRate + 1000;

            // Display reservation details and total amount in Philippine Peso
            echo '<p><strong>Room Number:</strong> ' . $reservationDetails['room_number'] . '</p>';
            echo '<p><strong>Room Type:</strong> ' . $reservationDetails['room_type'] . '</p>';
            echo '<p><strong>Check-in Date:</strong> ' . $reservationDetails['checkin_date'] . '</p>';
            echo '<p><strong>Check-out Date:</strong> ' . $reservationDetails['checkout_date'] . '</p>';
            echo '<p><strong>Reservation Fee:</strong> Php 1,000.00';
            echo '<p><strong>Total Amount:</strong> Php ' . number_format($totalAmount, 2) . '</p>';

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payNow'])) {
                // Process payment method
                $paymentMethod = $_POST['method'];

                // Update pstatus_id based on payment method
                $pstatusId = ($paymentMethod == 1) ? 2 : 1;

                // Insert into payment table
                $insertPaymentQuery = "INSERT INTO payment (reservation_id, amount, method_id, pstatuts_id)
                       VALUES ('{$reservationDetails['reservation_id']}', $totalAmount, $paymentMethod, $pstatusId)";


                $insertPaymentResult = mysqli_query($conn, $insertPaymentQuery);

                if ($insertPaymentResult) {
                    echo '<script>alert("Payment details added to the payment table.");</script>';
                    echo '<script>window.location.href = "home.php";</script>';
                } else {
                    echo '<script>alert("Error inserting payment details into the payment table.");</script>';
                }
            }
        } else {
            echo 'Error fetching reservation details.';
        }
    } else {
        echo 'Room ID not specified.';
    }

    mysqli_close($conn);
} else {
    echo 'User not logged in.';
}
?>

<form action="payment.php?id=<?php echo $roomId; ?>" method="POST">
    <label for="method">Payment Method:</label>
    <select name="method" id="method" required>
        <option disabled selected value="--Select Payment Method--">--Select Payment Method--</option>
        <?php
            require('config.php');

            $query = "SELECT * FROM method";
            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        ?>
    </select><br><br>

    <input type="submit" name="payNow" value="Process Payment">
</form><br>

<a href="home.php">Back Home</a>

