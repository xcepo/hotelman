<?php
session_start();

if (isset($_SESSION['id'])) {
    $loggedInUserId = $_SESSION['id'];

    if (isset($_POST['reserveNow'])) {
        require('config.php');

        $checkinDate = $_POST['checkin'];
        $checkoutDate = $_POST['checkout'];
        $roomId = $_GET['id']; // Make sure 'id' is set in URL

        $query = "INSERT INTO reservation (login_id, rooms_id, checkin_date, checkout_date, reservation) 
                  VALUES ('$loggedInUserId', '$roomId', '$checkinDate', '$checkoutDate', CURRENT_TIMESTAMP)";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Room reserved successfully.');</script>";
            echo "<script>window.location.href='payment.php?id=" . $roomId . "';</script>";
            exit();
        } else {
            echo "<p style='color:red; text-align:center;'>Error: " . mysqli_error($conn) . "</p>";
        }

        mysqli_close($conn);
    }
} else {
    // Redirect to login if not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reserve Room</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f7f8;
        margin: 0;
        padding: 40px 20px;
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .reservation-form {
        background: white;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        max-width: 400px;
        width: 100%;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #007bff;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
    }

    input[type="date"] {
        width: 100%;
        padding: 10px 12px;
        font-size: 16px;
        border: 1.8px solid #ddd;
        border-radius: 6px;
        margin-bottom: 20px;
        transition: border-color 0.3s ease;
    }

    input[type="date"]:focus {
        border-color: #007bff;
        outline: none;
    }

    input[type="submit"] {
        width: 100%;
        background-color: #007bff;
        color: white;
        font-weight: 700;
        font-size: 18px;
        padding: 12px 0;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 25px;
        color: #007bff;
        font-weight: 600;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 480px) {
        body {
            padding: 20px 10px;
        }

        .reservation-form {
            padding: 20px 25px;
        }
    }
    </style>
    <script>
    function validateForm() {
        const checkin = document.getElementById('checkin').value;
        const checkout = document.getElementById('checkout').value;

        if (!checkin || !checkout) {
            alert('Please select both check-in and check-out dates.');
            return false;
        }

        if (checkout <= checkin) {
            alert('Check-out date must be after check-in date.');
            return false;
        }

        return true;
    }
    </script>
</head>

<body>
    <form class="reservation-form" action="reserve.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="POST"
        onsubmit="return validateForm();">
        <h2>Reserve Room</h2>

        <label for="checkin">Check-in Date:</label>
        <input type="date" id="checkin" name="checkin" required />

        <label for="checkout">Check-out Date:</label>
        <input type="date" id="checkout" name="checkout" required />

        <input type="submit" name="reserveNow" value="Reserve Now" />
        <a href="home.php" class="back-link">Back to Home</a>
    </form>
</body>

</html>