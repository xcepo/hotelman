<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Rules</title>
    <style>
    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #343a40;
        margin-bottom: 20px;
    }

    ul {
        padding-left: 20px;
    }

    li {
        margin-bottom: 10px;
        font-size: 16px;
        color: #333;
        line-height: 1.6;
    }

    .back-button {
        display: inline-block;
        margin-top: 30px;
        padding: 10px 20px;
        background-color: #6c757d;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-size: 15px;
        text-align: center;
        transition: background-color 0.2s ease;
    }

    .back-button:hover {
        background-color: #5a6268;
    }

    .center {
        text-align: center;
    }
    </style>
</head>

<body>

    <div class="container">
        <h1>Hotel Rules</h1>

        <?php
        require('config.php');

        $query = "SELECT * FROM rules";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo '<ul>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li>' . htmlspecialchars($row['content']) . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>No rules found.</p>';
            }
        } else {
            echo '<p>Error: ' . $query . '<br>' . mysqli_error($conn) . '</p>';
        }

        mysqli_close($conn);
        ?>

        <div class="center">
            <a href="home.php" class="back-button">← Back to Home</a>
        </div>
    </div>

</body>

</html>