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
    <title>All Staff</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        #search-bar {
            margin-bottom: 20px;
        }

        .fire-button {
            background-color: #f44336;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .fire-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

    <h1>All Staff</h1>
   
    <!-- Search bar -->
    <form action="" method="GET" id="search-form">
        <label for="search">Search by Department:</label>
        <input type="text" id="search" name="search" placeholder="Enter department name">
        <input type="submit" value="Search">
    </form>

    <?php
    require('config.php');

    // Check if the search form is submitted
    if (isset($_GET['search'])) {
        $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
        $searchQuery = " AND department.name LIKE '%$searchTerm%'";
    } else {
        $searchQuery = '';
    }

    $query = "SELECT staff.*, department.name AS department_name, gender.name AS gender_name
              FROM staff
              INNER JOIN department ON staff.department_id = department.id
              INNER JOIN gender ON staff.gender_id = gender.id
              WHERE 1 $searchQuery";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr>';
            echo '<th>Last Name</th>';
            echo '<th>First Name</th>';
            echo '<th>Middle Name</th>';
            echo '<th>Gender</th>';
            echo '<th>Address</th>';
            echo '<th>Email</th>';
            echo '<th>Contact Number</th>';
            echo '<th>Department</th>';
            echo '<th>Action</th>';
            echo '</tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['lname'] . '</td>';
                echo '<td>' . $row['fname'] . '</td>';
                echo '<td>' . $row['mname'] . '</td>';
                echo '<td>' . $row['gender_name'] . '</td>';
                echo '<td>' . $row['address'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['contactnum'] . '</td>';
                echo '<td>' . $row['department_name'] . '</td>';
                echo '<td><button class="fire-button" onclick="confirmFire(' . $row['id'] . ')">Fire</button></td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo 'No staff members found.';
        }
    } else {
        echo 'Error: ' . $query . '<br>' . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>

    <a href="admin.php">Back</a>

    <script>
        function confirmFire(staffId) {
            var confirmDelete = confirm("Are you sure you want to fire this staff member?");
            if (confirmDelete) {
                // Redirect to delete script or perform AJAX delete
                window.location.href = 'delete_staff.php?id=' + staffId;
            }
        }
    </script>
</body>
</html>
