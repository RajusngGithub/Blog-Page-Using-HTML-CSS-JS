<?php
$servername = "localhost";//localhost
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
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM user_login WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $email, $password);

    // Execute the statement
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email and password match
        echo "<script>
                alert('Login successful!');
                window.location.href = 'Blog.html';
              </script>";
    } else {
        // Email and password do not match
        echo "<script>
                alert('Wrong user credentials');
                window.location.href = 'login.html';
              </script>";
    }

    // Close statement
    $stmt->close();
}

$conn->close();
?>
