<?php 
$conn = mysqli_connect('localhost','root','','hotel');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['loginBtn'])) {
    $username = $_POST['username'];
    $pass = $_POST['psw'];

    $sql = mysqli_query($conn, "SELECT * FROM login WHERE `username` ='$username'");
    $fetch = mysqli_fetch_assoc($sql);
    $id = $fetch['id'];
    $pw = $fetch['password'];
    $usertype = $fetch['usertype_id'];
    $row = mysqli_num_rows($sql);

    if ($row > 0) {
        if ($pass == $pw) {
            $_SESSION['id'] = $id;
            $_SESSION['usertype_id'] = $usertype;

            if ($usertype == '1') {
                header('location: admin.php');
                exit();
            } elseif ($usertype == '2') {
                header('location: front.php');
                exit();
            } elseif ($usertype == '3') {
                header('location: home.php');
                exit();
            } else {
                echo "<script>alert('Invalid user type. Please contact support.');</script>";
                echo "<script>window.location.href='index.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Wrong password/USN. Please try again.');</script>";
            echo "<script>window.location.href='index.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid credentials. Please try again.');</script>";
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }
}

if (isset($_POST['regBtn'])) {
    $username = $_POST['username'];
    $password = $_POST['pw'];
    $confirm = $_POST['confirm'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mname = $_POST['mname'];
    $bday = $_POST['bday'];
    $contactnum = $_POST['contactnum'];
    $email = $_POST['email'];
    $genderId = $_POST['gender'];
    $regionId = $_POST['region'];
    $provinceId = $_POST['province'];
    $cityId = $_POST['city'];
    $brgyId = $_POST['brgy'];

    $sqlCheckUsername = mysqli_query($conn, "SELECT * FROM login WHERE username ='$username'");
    $row = mysqli_num_rows($sqlCheckUsername);

    if ($row > 0) {
        echo "<script>alert('Username already used. Please try again.');</script>";
        echo "<script>window.location.href='registration.php';</script>";
    } else {
        if ($password == $confirm) {
            mysqli_query($conn, "INSERT INTO login (`username`, `password`, `usertype_id`) VALUES ('$username', '$password', '3')");
            $userId = mysqli_insert_id($conn);

            mysqli_query($conn, "INSERT INTO profile (`fname`, `lname`, `mname`, `bday`, `contactnum`, `email`, `gender_id`, `login_id`, `region_id`, `province_id`, `city_id`, `brgy_id`) 
                                 VALUES ('$fname', '$lname', '$mname', '$bday', '$contactnum','$email', '$genderId', '$userId', '$regionId', '$provinceId', '$cityId', '$brgyId')");

            echo "<script>alert('" . $username . " registered successfully.');</script>";
            echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Passwords do not match. Please try again.');</script>";
            echo "<script>window.location.href='registration.php';</script>";
        }
    }
}

if (isset($_POST['addRoom'])) {
    $roomNumber = $_POST['roomnumber'];
    $roomType = $_POST['roomtype'];
    $roomRate = $_POST['roomrate'];
    $roomStatus = $_POST['roomstatus'];

    $targetDir = "uploads/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $query = "INSERT INTO rooms (room_number, roomtype_id, roomrate, roomstatus_id, image_path) 
                      VALUES ('$roomNumber', '$roomType', '$roomRate', '$roomStatus', '$targetFilePath')";

            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Room added successfully.');</script>";
                echo "<script>window.location.href='admin.php';</script>";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Error uploading file.');</script>";
        }
    } else {
        echo "<script>alert('Invalid file format.');</script>";
    }
}

if (isset($_POST['addStaff'])) {
    $lastName = mysqli_real_escape_string($conn, $_POST['lname']);
    $firstName = mysqli_real_escape_string($conn, $_POST['fname']);
    $middleName = mysqli_real_escape_string($conn, $_POST['mname']);
    $genderId = $_POST['gender'];
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactnum']);
    $departmentId = $_POST['department'];

    $query = "INSERT INTO staff (lname, fname, mname, gender_id, address, email, contactnum, department_id)
              VALUES ('$lastName', '$firstName', '$middleName', '$genderId', '$address', '$email', '$contactNumber', '$departmentId')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Staff added successfully.');</script>";
        echo "<script>window.location.href='admin.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>