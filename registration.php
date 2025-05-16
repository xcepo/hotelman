<?php
    session_start();
    if(isset($_SESSION['id'])) {
        echo "Session ID: " . $_SESSION['id'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registration Form</title>
    <style>
    /* Page background and font */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f7f8;
        color: #333;
        padding: 20px;
    }

    /* Center the form on the page with shadow */
    form {
        max-width: 600px;
        margin: 40px auto;
        background: white;
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    /* Form title styling */
    h1 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
    }

    /* Labels */
    label {
        display: block;
        margin-top: 15px;
        font-weight: 600;
        color: #444;
    }

    /* Inputs and selects */
    input,
    select {
        width: 100%;
        padding: 10px 12px;
        margin-top: 6px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
        transition: border-color 0.3s ease;
        box-sizing: border-box;
    }

    input:focus,
    select:focus {
        border-color: #007BFF;
        outline: none;
    }

    /* Password requirements box */
    /* #password-requirements {
        margin-top: 15px;
        max-width: 300px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 6px;
        background-color: #f9f9f9;
        color: #444;
    } */

    /* Each requirement line with icon */
    #password-requirements div {
        margin: 6px 0;
        display: flex;
        align-items: center;
    }

    /* Red cross icon */
    #password-requirements span {
        display: inline-block;
        width: 20px;
        font-weight: bold;
        color: #d9534f;
        margin-right: 8px;
    }

    /* Green check icon when valid */
    #password-requirements .valid span {
        color: #5cb85c;
    }

    /* Submit button styling */
    input[type="submit"] {
        margin-top: 25px;
        background-color: #007BFF;
        color: white;
        font-weight: bold;
        border: none;
        padding: 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Link below form */
    a {
        display: block;
        margin-top: 20px;
        text-align: center;
        color: #007BFF;
        text-decoration: none;
        font-weight: 600;
    }

    a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <h1>Registration</h1>
    <form action="config.php" method="POST" onsubmit="return validateForm();">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" placeholder="Username" required>

        <label for="fname">First Name: </label>
        <input type="text" id="fname" name="fname" placeholder="First Name:" required>

        <label for="lname">Last Name: </label>
        <input type="text" id="lname" name="lname" placeholder="Last Name:" required>

        <label for="mname">Middle Name: </label>
        <input type="text" id="mname" name="mname" placeholder="Middle Name (Optional):">

        <label for="bday">Birthday: </label>
        <input type="date" id="bday" name="bday" required>

        <label for="contactnum">Contact Number:</label>
        <input type="number" id="contactnum" name="contactnum" placeholder="Contact Number:" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" placeholder="Email:" required>

        <label for="gender">Gender:</label>
        <select name="gender" id="gender" required>
            <option disabled selected value="--Select Gender--">--Select Gender--</option>
            <?php
                require('config.php');
                $query = "SELECT * FROM gender";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                mysqli_close($conn);
            ?>
        </select>

        <label for="region">Region:</label>
        <select name="region" id="region" required>
            <option disabled selected value="--Select Region--">--Select Region--</option>
            <?php
                require('config.php');
                $query = "SELECT * FROM region";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                mysqli_close($conn);
            ?>
        </select>

        <label for="province">Province:</label>
        <select name="province" id="province" required>
            <option disabled selected value="--Select Province--">--Select Province--</option>
            <?php
                require('config.php');
                $query = "SELECT * FROM province";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                mysqli_close($conn);
            ?>
        </select>

        <label for="city">City:</label>
        <select name="city" id="city">
            <option disabled selected value="--Select City--">--Select City--</option>
            <?php
                require('config.php');
                $query = "SELECT * FROM city";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                mysqli_close($conn);
            ?>
        </select>

        <label for="brgy">Barangay:</label>
        <select name="brgy" id="brgy" required>
            <option disabled selected value="--Select Brgy--">--Select Brgy--</option>
            <?php
                require('config.php');
                $query = "SELECT * FROM brgy";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                mysqli_close($conn);
            ?>
        </select>

        <label for="pw">Password: </label>
        <input type="password" id="pw" name="pw" placeholder="Password" required oninput="checkPasswordRequirements()">

        <label for="confirm">Confirm Password: </label>
        <input type="password" id="confirm" name="confirm" placeholder="Confirm Password" required>

        <div id="password-requirements">
            <p>Password must contain:</p>
            <div id="length"><span>✗</span>At least 6 characters</div>
            <div id="lowercase"><span>✗</span>At least 1 lowercase letter</div>
            <div id="uppercase"><span>✗</span>At least 1 uppercase letter</div>
            <div id="number"><span>✗</span>At least 1 number</div>
            <div id="special"><span>✗</span>At least 1 special character</div>
        </div>

        <input type="submit" name="regBtn" value="Register">
    </form>

    <a href="index.php">Login here</a>

    <script>
    function checkPasswordRequirements() {
        const pw = document.getElementById('pw').value;

        const lengthCheck = pw.length >= 6;
        const lowercaseCheck = /[a-z]/.test(pw);
        const uppercaseCheck = /[A-Z]/.test(pw);
        const numberCheck = /[0-9]/.test(pw);
        const specialCheck = /[^A-Za-z0-9]/.test(pw);

        updateRequirement('length', lengthCheck);
        updateRequirement('lowercase', lowercaseCheck);
        updateRequirement('uppercase', uppercaseCheck);
        updateRequirement('number', numberCheck);
        updateRequirement('special', specialCheck);
    }

    function updateRequirement(id, isValid) {
        const elem = document.getElementById(id);
        const span = elem.querySelector('span');
        if (isValid) {
            elem.classList.add('valid');
            elem.classList.remove('invalid');
            span.textContent = '✓';
        } else {
            elem.classList.add('invalid');
            elem.classList.remove('valid');
            span.textContent = '✗';
        }
    }

    function validateForm() {
        const gender = document.getElementById('gender').value;
        const region = document.getElementById('region').value;
        const province = document.getElementById('province').value;
        const brgy = document.getElementById('brgy').value;

        if (
            gender === '--Select Gender--' ||
            region === '--Select Region--' ||
            province === '--Select Province--' ||
            brgy === '--Select Brgy--'
        ) {
            alert('Please select all dropdown options.');
            return false;
        }

        const pw = document.getElementById('pw').value;
        if (
            pw.length < 6 ||
            !/[a-z]/.test(pw) ||
            !/[A-Z]/.test(pw) ||
            !/[0-9]/.test(pw) ||
            !/[^A-Za-z0-9]/.test(pw)
        ) {
            alert('Password does not meet all requirements.');
            return false;
        }

        const confirm = document.getElementById('confirm').value;
        if (pw !== confirm) {
            alert('Passwords do not match.');
            return false;
        }

        return true;
    }

    // Run once on page load to initialize checks
    window.onload = checkPasswordRequirements;
    </script>
</body>

</html>