<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['usertype_id'] != 1) {
    echo '<script>alert("You do not have permission to access this page.");</script>';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Staff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
    }

    .container {
        max-width: 1100px;
        margin: 40px auto;
        padding: 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h1 {
        margin-bottom: 20px;
        font-size: 28px;
        text-align: center;
    }

    form {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-bottom: 20px;
    }

    input[type="text"] {
        padding: 8px;
        width: 250px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    input[type="submit"] {
        padding: 8px 16px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        overflow-x: auto;
    }

    th,
    td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
        font-size: 14px;
    }

    th {
        background-color: #f1f1f1;
    }

    .fire-button {
        background-color: #dc3545;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 13px;
    }

    .fire-button:hover {
        background-color: #bd2130;
    }

    .edit-button {
        background-color: #28a745;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 13px;
        margin-left: 6px;
        display: inline-block;
    }

    .edit-button:hover {
        background-color: #218838;
    }

    .back-link {
        display: inline-block;
        margin-top: 20px;
        color: #007BFF;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>All Staff</h1>

        <!-- Search Bar -->
        <form action="" method="GET" id="search-form">
            <input type="text" id="search" name="search" placeholder="Search by Department">
            <input type="submit" value="Search">
        </form>

        <?php
    require('config.php');

    // Check if search query exists
    $searchQuery = '';
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
        $searchQuery = " AND department.name LIKE '%$searchTerm%'";
    }

    $query = "SELECT staff.*, department.name AS department_name, gender.name AS gender_name
              FROM staff
              INNER JOIN department ON staff.department_id = department.id
              INNER JOIN gender ON staff.gender_id = gender.id
              WHERE 1 $searchQuery";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Department</th>
                <th>Action</th>
              </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['lname']) . '</td>';
            echo '<td>' . htmlspecialchars($row['fname']) . '</td>';
            echo '<td>' . htmlspecialchars($row['mname']) . '</td>';
            echo '<td>' . htmlspecialchars($row['gender_name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['address']) . '</td>';
            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['contactnum']) . '</td>';
            echo '<td>' . htmlspecialchars($row['department_name']) . '</td>';
            echo '<td>';
            echo '<button class="fire-button" onclick="confirmFire(' . $row['id'] . ')">Fire</button> ';
            echo '<a href="edit_staff.php?id=' . $row['id'] . '" class="edit-button">Edit</a>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No staff members found.</p>';
    }

    mysqli_close($conn);
    ?>

        <a href="admin.php" class="back-link">← Back to Admin Panel</a>
    </div>

    <script>
    function confirmFire(staffId) {
        if (confirm("Are you sure you want to fire this staff member?")) {
            window.location.href = 'delete_staff.php?id=' + staffId;
        }
    }
    </script>

</body>

</html>