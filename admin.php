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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hotel Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Hotel Admin</a>
            <div class="d-flex">
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Welcome, Admin!</h1>
            <p class="lead">Manage your hotel efficiently using the links below.</p>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <a href="allRoom.php" class="text-decoration-none">
                    <div class="card shadow-sm h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Show All Rooms</h5>
                            <p class="card-text">View a list of all available rooms.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="addRoom.php" class="text-decoration-none">
                    <div class="card shadow-sm h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Add Room</h5>
                            <p class="card-text">Add a new room to the system.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="addStaff.php" class="text-decoration-none">
                    <div class="card shadow-sm h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Add Staff</h5>
                            <p class="card-text">Register new staff members.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="allStaff.php" class="text-decoration-none">
                    <div class="card shadow-sm h-100 text-center">
                        <div class="card-body">
                            <h5 class="card-title">All Staff</h5>
                            <p class="card-text">View and manage all staff members.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional for dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>