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
    <title>Sunday</title>
</head>
<body>
    <h1>Login</h1>
    <form action="config.php" method="POST">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" placeholder="Username" required><br><br>
        
        <label for="psw">Password: </label>
        <input type="password" id="psw" name="psw" placeholder="Password" required><br><br>
        
        <input type="submit" name="loginBtn" value="Login">
    </form>
    <a href="registration.php">Register here</a>
</body>
</html>