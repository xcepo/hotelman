<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['usertype_id'] != 1) {
    echo '<script>alert("You do not have permission to access this page.");</script>';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
</head>
<body>
    <form>
        <h1>Welcome Admin!</h1>
        <a href="allRoom.php">Show all rooms</a><br>
        <a href="addRoom.php">Add Room</a><br>
        <a href="addStaff.php">Add Staff</a><br>
        <a href="allStaff.php">All Staff</a><br>
        <a href="logout.php">Logout</a>
    </form>
</body>
</html>
