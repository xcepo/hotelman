<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['usertype_id'] != 2) {
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
	<title>Front Desk</title>
</head>
<body>
<form>
	<h1>Welcome to Front Desk</h1>
	<a href="rr.php">Reservation request</a><br>
	<a href="reserved.php">Reserved Rooms</a><br>
	<a href="logout.php">Logout</a>
	</form>
</body>
</html>