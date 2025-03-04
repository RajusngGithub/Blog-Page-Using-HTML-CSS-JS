<?php
ob_start(); // Start output buffering

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
    // Check if the file was uploaded without errors
    if (isset($_FILES["File"]) && $_FILES["File"]["error"] == 0) {
        $allowed = ["jpg" => "image/jpeg", "jpeg" => "image/jpeg", "png" => "image/png"];
        $filename = $_FILES["File"]["name"];
        $filetype = $_FILES["File"]["type"];

        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            die("<script>alert('Error: Please select a valid file format.');
            window.location = 'Writeablog.html';</script>");
        }

        // Verify file type
        if (in_array($filetype, $allowed)) {
            // Generate a unique file name
            $uniqueFilename = uniqid() . "_" . $filename;

            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($_FILES["File"]["tmp_name"], "uploads/" . $uniqueFilename)) {
                $image = "uploads/" . $uniqueFilename;
                $heading = $_POST['Text'];
                $about_place = $_POST['textArea'];

                // Check if the heading already exists
                $sql = "SELECT COUNT(*) as count FROM user_blog WHERE heading = ?";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("s", $heading);
                    $stmt->execute();
                    $stmt->bind_result($count);
                    $stmt->fetch();
                    $stmt->close();

                    if ($count > 0) {
                        // Display an alert and redirect
                        echo "<script>alert('Error: The heading already exists. Please choose a different heading.'); window.location = 'Writeablog.html';</script>";
                        exit;
                    }
                } else {
                    echo "Error preparing statement: " . $conn->error;
                }

                // Prepare an insert statement
                $sql = "INSERT INTO user_blog (image, heading, aboutplace) VALUES (?, ?, ?)";

                if ($stmt = $conn->prepare($sql)) {
                    // Bind variables to the prepared statement as parameters
                    $stmt->bind_param("sss", $image, $heading, $about_place);

                    // Execute the statement
                    if ($stmt->execute()) {
                        // Close statement
                        $stmt->close();

                        // Close connection
                        $conn->close();

                        // Alert and redirect using JavaScript
                        echo "<script>alert('Your blog has been successfully uploaded.'); window.location = 'Writeablog.html';</script>";
                        exit;
                    } else {
                        echo "Error: " . $stmt->error;
                    }

                    // Close statement
                    $stmt->close();
                } else {
                    echo "Error preparing statement: " . $conn->error;
                }
            } else {
                echo "Error: There was a problem uploading your file. Please try again.";
            }
        } else {
            echo "Error: Invalid file type. Please upload an image.";
        }
    } else {
        echo "Error: There was a problem with the file upload.";
    }
}

// Close connection
$conn->close();
ob_end_flush(); // End output buffering and flush the buffer
?>
