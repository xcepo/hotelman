<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['usertype_id'] != 2) {
    echo '<script>alert("You do not have permission to access this page.");</script>';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Front Desk</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    form {
        background: #fff;
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 320px;
    }

    h1 {
        margin-bottom: 25px;
        color: #333;
        font-weight: 700;
    }

    a {
        display: block;
        margin: 15px 0;
        padding: 12px 0;
        text-decoration: none;
        color: #fff;
        background-color: #007BFF;
        border-radius: 6px;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    a:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <form>
        <h1>Welcome to Front Desk</h1>
        <a href="rr.php">Reservation Requests</a>
        <a href="reserved.php">Reserved Rooms</a>
        <a href="logout.php">Logout</a>
    </form>
</body>

</html>