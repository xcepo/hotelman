<?php
session_start();

if (isset($_SESSION['id'])) {
    $loggedInUserId = $_SESSION['id'];

    if (isset($_POST['reserveNow'])) {
        require('config.php');

        $checkinDate = $_POST['checkin'];
        $checkoutDate = $_POST['checkout'];
        $roomId = $_GET['id']; // <-- Make sure 'id' is set in the URL

        $query = "INSERT INTO reservation (login_id, rooms_id, checkin_date, checkout_date, reservation) 
                  VALUES ('$loggedInUserId', '$roomId', '$checkinDate', '$checkoutDate', CURRENT_TIMESTAMP)";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Room reserved successfully.');</script>";
            echo "<script>window.location.href='payment.php?id=" . $roomId . "';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
} 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserve Now</title>
</head>
<body>
    <form action="reserve.php?id=<?php echo $_GET['id']; ?>" method="POST" onsubmit="return validateForm();">
        <label for="checkin">Check-in: </label><br>
        <input type="date" id="checkin" name="checkin" required>
        <br><br>

        <label for="checkout">Check-out: </label><br>
        <input type="date" id="checkout" name="checkout" required>
        <br><br>

        <input type="submit" name="reserveNow" value="Reserve">
    </form><br>
    <a href="home.php">Back Home</a>
</body>
</html>
