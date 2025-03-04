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

$heading = '';
$image = '';
$aboutplace = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit"])) {
    $heading = $_POST["heading"];

    // Fetch the current data for the blog post
    $sql = "SELECT image, aboutplace FROM user_blog WHERE heading = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $heading);
        $stmt->execute();
        $stmt->bind_result($image, $aboutplace);
        $stmt->fetch();
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link rel="stylesheet" href="edit.css">
    <script>
        function validateForm() {
            var aboutplace = document.getElementById("aboutplace").value;
            var wordCount = aboutplace.trim().split(/\s+/).length;
            if (wordCount < 30) {
                alert("The 'About Place' section must contain at least 30 words.");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    
    <div class="container">
    <h1>Edit Blogs</h1>
    <form method="POST" action="update_blog.php" enctype="multipart/form-data">
        <input type="hidden" name="original_heading" value="<?php echo $heading; ?>">
        <label for="heading">Heading:</label>
        <input type="text" id="heading" name="heading" value="<?php echo $heading; ?>" required><br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image"><br>
        <label for="aboutplace">About Place:</label>
        <textarea id="aboutplace" name="aboutplace" required><?php echo $aboutplace; ?></textarea><br>
        <button type="submit" name="update">Update</button>
    </form>
    </div>

</body>

</html>
