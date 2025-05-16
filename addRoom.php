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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add a Room</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f9f9f9;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
            max-width: 500px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a.back-btn {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a.back-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Add a Room</h1>
    <form action="config.php" method="POST" enctype="multipart/form-data">
        <label for="roomnumber">Room Number:</label>
        <input type="text" id="roomnumber" name="roomnumber" placeholder="Room Number" required>

        <label for="roomtype">Room Type:</label>
        <select name="roomtype" id="roomtype" required>
            <option disabled selected value="">--Select Room Type--</option>
            <?php
                require('config.php');
                $query = "SELECT * FROM roomtype";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</option>";
                    }
                }
                mysqli_close($conn);
            ?>
        </select>

        <label for="roomrate">Room Rate:</label>
        <input type="number" id="roomrate" name="roomrate" placeholder="Room Rate" required min="0" step="any">

        <label for="roomstatus">Room Status:</label>
        <select name="roomstatus" id="roomstatus" required>
            <option disabled selected value="">--Select Room Status--</option>
            <?php
                require('config.php');
                $query = "SELECT * FROM roomstatus";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['name']) . "</option>";
                    }
                }
                mysqli_close($conn);
            ?>
        </select>

        <label for="image">Room Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <input type="submit" name="addRoom" value="Add Room">
    </form>

    <a href="admin.php" class="back-btn">Back</a>
</body>
</html>
