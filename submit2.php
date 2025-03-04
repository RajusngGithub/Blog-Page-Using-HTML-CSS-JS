<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($newPassword !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Insert into user_details
    $sql_details = "INSERT INTO user_details (`First Name`, `Middle Name`, `Last Name`, `Email Id`, `Phone Number`, `DOB`, `Gender`, `New Password`, `Confirm Password`)
                    VALUES ('$firstName', '$middleName', '$lastName', '$email', $phoneNumber, '$dob', '$gender', '$newPassword', '$confirmPassword')";

    // Insert into user_login
    $sql_login = "INSERT INTO user_login (Email, Password) VALUES ('$email', '$newPassword')";

    if ($conn->query($sql_details) === TRUE && $conn->query($sql_login) === TRUE) {
        // Redirect to 'firstBlog.html' on successful record creation
        header("Location: firstBlog.html");
        exit(); // Make sure to call exit after header to stop the script execution
    } else {
        echo "Error: " . $sql_details . "<br>" . $conn->error;
        echo "Error: " . $sql_login . "<br>" . $conn->error;
    }
}

$conn->close();
?>
