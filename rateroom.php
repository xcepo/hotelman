<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rate this room</title>
</head>
<body>
    <?php
    // Check if the form is submitted
    if (isset($_POST['rateBtn'])) {
        require('config.php');

        // Get values from the form
        $starsId = $_POST['stars'];
        $comment = $_POST['comment'];

        // Assuming you have the room ID available, replace '1' with the actual room ID
        $roomId = 1;

        // Insert data into the roomfeedback table
        $insertQuery = "INSERT INTO roomfeedback (rooms_id, stars_id, contents) VALUES ('$roomId', '$starsId', '$comment')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            echo '<script>alert("Feedback submitted successfully.");</script>';
            echo '<script>window.location.href = "home.php";</script>';
            exit; // Stop further execution
        } else {
            echo 'Error: ' . $insertQuery . '<br>' . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    ?>

    <form method="post">
        <label for="stars">Rate:</label><br>
        <select name="stars" id="stars" required>
            <option disabled selected value="--Select Number of Stars--">--Select Number of Stars--</option>
            <?php
            // Fetch star options from the database
            require('config.php');
            $starsQuery = "SELECT * FROM stars";
            $starsResult = mysqli_query($conn, $starsQuery);

            if ($starsResult) {
                while ($row = mysqli_fetch_assoc($starsResult)) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
            } else {
                echo "Error: " . $starsQuery . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
            ?>
        </select><br><br>

        <label for="comment">Comment:</label><br>
        <textarea id="comment" name="comment" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" name="rateBtn" value="Send">
    </form>
</body>
</html>
