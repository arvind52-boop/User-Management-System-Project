<?php
extract($_POST);
include("dbconnect.php");

// Check if the database connection is successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if email already exists
$email = mysqli_real_escape_string($conn, $email);
$sql = mysqli_query($conn, "SELECT * FROM register WHERE Email='$email'");

if (mysqli_num_rows($sql) > 0) {
    echo "Email ID Already Exists";
    exit;
} else if (isset($_POST['save'])) {
    // Handle file upload
    $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $folder = "upload/";
    $new_file_name = strtolower($file);
    $final_file = str_replace(' ', '-', $new_file_name);

    // Validate file type and size
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = pathinfo($file, PATHINFO_EXTENSION);
    $file_size = $_FILES['file']['size'];

    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Invalid file type. Please upload an image (jpg, jpeg, png, gif).";
        exit;
    }
    if ($file_size > 2000000) { // 2MB max size
        echo "File size exceeds the limit of 2MB.";
        exit;
    }

    if (move_uploaded_file($file_loc, $folder . $final_file)) {
        // Hash the password
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

        // Escape all inputs before inserting into the database
        $first_name = mysqli_real_escape_string($conn, $first_name);
        $last_name = mysqli_real_escape_string($conn, $last_name);

        $query = "INSERT INTO register (First_Name, Last_Name, Email, Password, File) 
                  VALUES ('$first_name', '$last_name', '$email', '$hashed_password', '$final_file')";
        $sql = mysqli_query($conn, $query) or die("Could Not Perform the Query");

        if ($sql) {
            header("Location: login.php?status=success");
        } else {
            echo "Error: Unable to register. Please try again.";
        }
    } else {
        echo "Error: File upload failed. Please try again.";
    }
}
?>
