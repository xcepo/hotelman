<?php
    session_start();
    if(isset($_SESSION['id'])) {
        echo "Session ID: " . $_SESSION['id'];
    } else {
        echo "No session started.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <h1>Registration</h1>
    <form action="config.php" method="POST" onsubmit="return validateForm();">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" placeholder="Username" required><br><br>

        <label for="fname">First Name: </label>
        <input type="text" id="fname" name="fname" placeholder="First Name:" required><br><br>

        <label for ="lname">Last Name: </label>
        <input type="text" id="lname" name="lname" placeholder="Last Name:" required>
        <br><br>

        <label for ="mname">Middle Name: </label>
        <input type="text" id="mname" name="mname" placeholder="Middle Name (Optional):">
        <br><br>

        <label for ="bday">Birthday: </label>
        <input type="date" id="bday" name="bday" placeholder="Birthday:" required>
        <br><br>

        <label for ="contactnum">Contact Number:</label>
        <input type="number" id="contactnum" name="contactnum" placeholder="Contact Number:" required>
        <br><br>

        <label for ="email">Email:</label>
        <input type="text" id="email" name="email" placeholder="Email:" required>
        <br><br>

       <label for="cars">Gender:</label>
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

        <label for="cars">Region:</label>
        <select name="region" id="region" required>
            <option disabled selected value="--Select Region--">--Select Region--</option>
            <?php
                require('config.php');

                $query = "SELECT * FROM region";
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

        <label for="cars">Province:</label>
        <select name="province" id="province" required>
            <option disabled selected value="--Select Province--">--Select Province--</option>
            <?php
                require('config.php');

                $query = "SELECT * FROM province";
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

        <label for="cars">City:</label>
        <select name="city" id="city">
            <option disabled selected value="--Select City--">--Select City--</option>
            <?php
                require('config.php');

                $query = "SELECT * FROM city";
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

        <label for="cars">Barangay:</label>
        <select name="brgy" id="brgy" required>
            <option disabled selected value="--Select Brgy--">--Select Brgy--</option>
            <?php
                require('config.php');

                $query = "SELECT * FROM brgy";
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

        <label for="pw">Password: </label>
        <input type="password" id="pw" name="pw" placeholder="Password" required><br><br>

        <label for="confirm">Confirm Password: </label>
        <input type="password" id="confirm" name="confirm" placeholder="Password" required><br><br>

        <input type="submit" name="regBtn" value="Register">
    </form>
    <a href="index.php">Login here</a>

    <script>
        function validateForm() {
            var gender = document.getElementById("gender").value;
            var region = document.getElementById("region").value;
            var province = document.getElementById("province").value;
            var brgy = document.getElementById("brgy").value;

            if (gender === "--Select Gender--" || region === "--Select Region--" || province === "--Select Province--" || brgy === "--Select Brgy--") {
                alert("Please select all dropdown options.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
