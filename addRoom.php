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
	<title>Add a room</title>
</head>
<body>
	<h1>ADD A ROOM</h1>
	<form action="config.php" method="POST" enctype="multipart/form-data">
		<label for="number">Room Number:</label>
		<input type="text" id="roomnumber" name="roomnumber" placeholder="Room Number" required><br><br>

		<label for="cars">Room Type:</label>
        <select name="roomtype" id="roomtype" required>
            <option disabled selected value="--Select Room Type--">--Select Room Type--</option>
            <?php
                require('config.php');

                $query = "SELECT * FROM roomtype";
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

    <label for="rate">Room Rate:</label>
	<input type="number" id="roomrate" name="roomrate" placeholder="Room Rate" required><br><br>

	<label for="cars">Room Status:</label>
        <select name="roomstatus" id="roomstatus" required>
            <option disabled selected value="--Select Room Status--">--Select Room Status--</option>
            <?php
                require('config.php');

                $query = "SELECT * FROM roomstatus";
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

    <<label for="car">Room Image:</label>
	<input type="file" id="image" name="image" accept="image/*" placeholder="Room Image" required><br><br>


	<input type="submit" name="addRoom" value="Add Room">
	</form><br>

	<a href="admin.php">Back</a>

</body>
</html>