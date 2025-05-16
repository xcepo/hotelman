<?php
session_start();

// Only admin (usertype_id = 1) allowed
if (!isset($_SESSION['id']) || $_SESSION['usertype_id'] != 1) {
    echo '<script>alert("You do not have permission to access this page.");</script>';
    echo '<script>window.location.replace("index.php");</script>';
    exit();
}

require('config.php');

// Get staff ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo 'No staff ID specified.';
    exit();
}

$staffId = intval($_GET['id']);
$error = '';
$success = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $mname = mysqli_real_escape_string($conn, $_POST['mname']);
    $gender_id = intval($_POST['gender_id']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contactnum = mysqli_real_escape_string($conn, $_POST['contactnum']);
    $department_id = intval($_POST['department_id']);

    // Basic validation (you can expand this)
    if (empty($lname) || empty($fname) || empty($gender_id) || empty($department_id)) {
        $error = 'Please fill in all required fields.';
    } else {
        // Update query
        $updateQuery = "
            UPDATE staff SET
            lname = '$lname',
            fname = '$fname',
            mname = '$mname',
            gender_id = $gender_id,
            address = '$address',
            email = '$email',
            contactnum = '$contactnum',
            department_id = $department_id
            WHERE id = $staffId
        ";

        if (mysqli_query($conn, $updateQuery)) {
            $success = 'Staff information updated successfully.';
        } else {
            $error = 'Error updating staff: ' . mysqli_error($conn);
        }
    }
}

// Fetch existing staff data
$query = "SELECT * FROM staff WHERE id = $staffId LIMIT 1";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo 'Staff member not found.';
    exit();
}

$staff = mysqli_fetch_assoc($result);
//yeah
// Fetch genders for dropdown
$gendersResult = mysqli_query($conn, "SELECT id, name FROM gender ORDER BY name ASC");

// Fetch departments for dropdown
$departmentsResult = mysqli_query($conn, "SELECT id, name FROM department ORDER BY name ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Staff Member</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f7f7f7;
        padding: 20px;
    }

    .container {
        max-width: 600px;
        background: white;
        padding: 20px;
        margin: auto;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    form label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    form input[type="text"],
    form input[type="email"],
    form select {
        width: 100%;
        padding: 8px;
        margin-top: 4px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
    }

    form button {
        margin-top: 20px;
        background-color: #007BFF;
        color: white;
        padding: 10px 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
    }

    form button:hover {
        background-color: #0056b3;
    }

    .message {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 6px;
    }

    .error {
        background-color: #f8d7da;
        color: #842029;
    }

    .success {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .back-link {
        display: block;
        margin-top: 15px;
        text-align: center;
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
        <h1>Edit Staff Member</h1>

        <?php if ($error): ?>
        <div class="message error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
        <div class="message success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="lname">Last Name *</label>
            <input type="text" id="lname" name="lname" value="<?= htmlspecialchars($staff['lname']) ?>" required />

            <label for="fname">First Name *</label>
            <input type="text" id="fname" name="fname" value="<?= htmlspecialchars($staff['fname']) ?>" required />

            <label for="mname">Middle Name</label>
            <input type="text" id="mname" name="mname" value="<?= htmlspecialchars($staff['mname']) ?>" />

            <label for="gender_id">Gender *</label>
            <select id="gender_id" name="gender_id" required>
                <option value="">Select Gender</option>
                <?php while ($gender = mysqli_fetch_assoc($gendersResult)): ?>
                <option value="<?= $gender['id'] ?>" <?= $gender['id'] == $staff['gender_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($gender['name']) ?>
                </option>
                <?php endwhile; ?>
            </select>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?= htmlspecialchars($staff['address']) ?>" />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($staff['email']) ?>" />

            <label for="contactnum">Contact Number</label>
            <input type="text" id="contactnum" name="contactnum"
                value="<?= htmlspecialchars($staff['contactnum']) ?>" />

            <label for="department_id">Department *</label>
            <select id="department_id" name="department_id" required>
                <option value="">Select Department</option>
                <?php while ($department = mysqli_fetch_assoc($departmentsResult)): ?>
                <option value="<?= $department['id'] ?>"
                    <?= $department['id'] == $staff['department_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($department['name']) ?>
                </option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Update Staff</button>
        </form>

        <a href="allStaff.php" class="back-link">← Back to All Staff</a>
    </div>
</body>

</html>