<?php
require('config.php');

// Check if staff ID is provided in the URL
if (isset($_GET['id'])) {
    $staffId = mysqli_real_escape_string($conn, $_GET['id']);

    // Perform the deletion
    $deleteQuery = "DELETE FROM staff WHERE id = '$staffId'";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        echo '<script>alert("Staff member has been fired successfully.");</script>';
    } else {
        echo '<script>alert("Error firing staff member. Please try again.");</script>';
    }
} else {
    echo '<script>alert("Invalid request. Please provide a staff ID.");</script>';
}

// Redirect back to the page displaying all staff members
echo '<script>window.location.href="allStaff.php";</script>';

mysqli_close($conn);
?>
