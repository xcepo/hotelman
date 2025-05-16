<?php
session_start();

if (isset($_SESSION['id']) && isset($_POST['payNow'])) {
    $loggedInUserId = $_SESSION['id'];
    require('config.php');

    if (isset($_GET['id'])) {
        $roomId = $_GET['id'];

        // Retrieve the selected payment method
        $selectedPaymentMethod = $_POST['method'];

        // Update reservation based on payment method
        $pstatusId = ($selectedPaymentMethod == 1) ? 2 : 1;

        $updateQuery = "UPDATE reservation SET pstatus_id = '$pstatusId' WHERE login_id = '$loggedInUserId' AND rooms_id = '$roomId'";

        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>alert('Payment processed successfully.');</script>";
            echo "<script>window.location.href='home.php';</script>";
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error updating reservation status: " . mysqli_error($conn);
        }
    } else {
        echo 'Room ID not specified.';
    }

    mysqli_close($conn);
} else {
    echo 'User not logged in or payment not submitted.';
}
?>
