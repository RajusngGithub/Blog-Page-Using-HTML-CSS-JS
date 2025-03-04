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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $original_heading = $_POST["original_heading"];
    $new_heading = $_POST["heading"];
    $aboutplace = $_POST["aboutplace"];
    $image = '';

    // Handle file upload if a new file is provided
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowed = ["jpg" => "image/jpeg", "jpeg" => "image/jpeg", "png" => "image/png"];
        $filename = $_FILES["image"]["name"];
        $filetype = $_FILES["image"]["type"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!array_key_exists($ext, $allowed)) {
            die("<script>alert('Error: Please select a valid file format.');
            window.location = 'edit_blog.php';</script>");
        }

        if (in_array($filetype, $allowed)) {
            $uniqueFilename = uniqid() . "_" . $filename;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $uniqueFilename)) {
                $image = "uploads/" . $uniqueFilename;
            } else {
                die("Error: There was a problem uploading your file. Please try again.");
            }
        } else {
            die("Error: Invalid file type. Please upload an image.");
        }
    }

    // Prepare an update statement
    if ($image) {
        $sql = "UPDATE user_blog SET heading = ?, aboutplace = ?, image = ? WHERE heading = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $new_heading, $aboutplace, $image, $original_heading);
        }
    } else {
        $sql = "UPDATE user_blog SET heading = ?, aboutplace = ? WHERE heading = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $new_heading, $aboutplace, $original_heading);
        }
    }

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('The blog has been successfully updated.'); window.location = 'viewblog4.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
