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
                    echo '<script>alert("Payment details added successfully."); window.location.href = "home.php";</script>';
                    exit();
                } else {
                    echo '<script>alert("Error inserting payment details.");</script>';
                }
            }
        } else {
            echo '<p class="error">Error fetching reservation details.</p>';
        }
    } else {
        echo '<p class="error">Room ID not specified.</p>';
    }

    mysqli_close($conn);
} else {
    echo '<p class="error">User not logged in.</p>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Payment</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    p {
        font-size: 1rem;
        margin: 10px 0;
        color: #555;
    }

    p strong {
        color: #222;
    }

    .error {
        color: red;
        font-weight: bold;
        text-align: center;
    }

    form {
        margin-top: 30px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    label {
        font-weight: 600;
        color: #444;
    }

    select {
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 1rem;
    }

    input[type="submit"] {
        background-color: #007BFF;
        border: none;
        padding: 12px;
        color: white;
        font-weight: bold;
        font-size: 1.1rem;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    a {
        display: block;
        margin-top: 20px;
        text-align: center;
        text-decoration: none;
        color: #007BFF;
        font-weight: 600;
    }

    a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>

    <h1>Payment Details</h1>

    <?php if (isset($reservationDetails)) : ?>
    <p><strong>Room Number:</strong> <?= htmlspecialchars($reservationDetails['room_number']) ?></p>
    <p><strong>Room Type:</strong> <?= htmlspecialchars($reservationDetails['room_type']) ?></p>
    <p><strong>Check-in Date:</strong> <?= htmlspecialchars($reservationDetails['checkin_date']) ?></p>
    <p><strong>Check-out Date:</strong> <?= htmlspecialchars($reservationDetails['checkout_date']) ?></p>
    <p><strong>Reservation Fee:</strong> Php 1,000.00</p>
    <p><strong>Total Amount:</strong> Php <?= number_format($totalAmount, 2) ?></p>

    <form action="payment.php?id=<?= urlencode($roomId) ?>" method="POST">
        <label for="method">Payment Method:</label>
        <select name="method" id="method" required>
            <option value="" disabled selected>--Select Payment Method--</option>
            <?php
                require('config.php');
                $methodQuery = "SELECT * FROM method";
                $methodResult = mysqli_query($conn, $methodQuery);

                if ($methodResult) {
                    while ($row = mysqli_fetch_assoc($methodResult)) {
                        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</option>";
                    }
                } else {
                    echo "<option disabled>Error loading methods</option>";
                }

                mysqli_close($conn);
            ?>
        </select>

        <input type="submit" name="payNow" value="Process Payment">
    </form>
    <?php endif; ?>

    <a href="home.php">Back Home</a>

</body>

</html>