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
	<title>Add Staff</title>
</head>
<body>
	<h1>ADD A STAFF</h1>
	 <form action="config.php" method="POST" onsubmit="return validateForm();">
		<label for="">Last Name:</label><br>
		<input type="text" id="lname" name="lname" placeholder="Lastname" required><br><br>

		<label for="">First Name:</label><br>
		<input type="text" id="fname" name="fname" placeholder="Firstname" required><br><br>

		<label for="">Middle Name:</label><br>
		<input type="text" id="mname" name="mname" placeholder="Middlename" required><br><br>

		<label for="cars">Gender:</label><br>
        <select name="gender" id="gender" required>
            <option disabled selected value="--Select Gender--">--Select Gender--</option>
            <?php
                require('config.php');

                $query = "SELECT * FROM gender";
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

		<label for="">Address:</label><br>
		<input type="text" id="address" name="address" placeholder="Address" required><br><br>

		<label for="">Email:</label><br>
		<input type="text" id="email" name="email" placeholder="Email" required><br><br>

		<label for="">Contact Number:</label><br>
		<input type="number" id="contactnum" name="contactnum" placeholder="Contact" required><br><br>

		<label for="cars">Gender:</label><br>
        <select name="department" id="department" required>
            <option disabled selected value="--Select Department--">--Select Department--</option>
            <?php
                require('config.php');

                $query = "SELECT * FROM department";
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

        <input type="submit" name="addStaff" value="Hire">

	</form><br>
<a href="admin.php">Back</a>
</body>
</html>