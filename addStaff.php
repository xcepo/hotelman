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
    <title>Add Staff - Hotel Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">Hotel Admin</a>
            <div class="d-flex">
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Add a New Staff Member</h3>
            </div>
            <div class="card-body">
                <form action="config.php" method="POST" onsubmit="return validateForm();">
                    <div class="mb-3">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="mname" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender" required>
                            <option disabled selected value="">--Select Gender--</option>
                            <?php
                                require('config.php');
                                $query = "SELECT * FROM gender";
                                $result = mysqli_query($conn, $query);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                    }
                                } else {
                                    echo "<option>Error loading genders</option>";
                                }
                                mysqli_close($conn);
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="mb-3">
                        <label for="contactnum" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="contactnum" name="contactnum"
                            placeholder="Contact Number" required>
                    </div>

                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select" name="department" id="department" required>
                            <option disabled selected value="">--Select Department--</option>
                            <?php
                                require('config.php');
                                $query = "SELECT * FROM department";
                                $result = mysqli_query($conn, $query);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                    }
                                } else {
                                    echo "<option>Error loading departments</option>";
                                }
                                mysqli_close($conn);
                            ?>
                        </select>
                    </div>

                    <button type="submit" name="addStaff" class="btn btn-primary w-100">Hire Staff</button>
                </form>
                <div class="mt-3">
                    <a href="admin.php" class="btn btn-secondary">← Back to Admin Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>