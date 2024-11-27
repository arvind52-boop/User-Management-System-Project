<?php
session_start();

if (isset($_POST['save'])) {
    extract($_POST);
    include 'dbconnect.php';

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("
        SELECT r.ID, r.Email, r.Password, r.First_Name, r.Last_Name, ar.Role 
        FROM register r
        LEFT JOIN assign_role ar ON r.ID = ar.User_ID
        WHERE r.Email = ?
    ");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && password_verify($pass, $row['Password'])) { // Verify hashed password
        // Store session variables
        $_SESSION["ID"] = $row['ID'];
        $_SESSION["Email"] = $row['Email'];
        $_SESSION["First_Name"] = $row['First_Name'];
        $_SESSION["Last_Name"] = $row['Last_Name'];
        $_SESSION["Role"] = $row['Role'];

        // Define role-based redirection
        $roleRedirects = [
            'Admin' => 'home.php',
            'Editor' => 'user_website.php',
            'Viewer' => 'user_website.php'
            // 'Manager' => 'manager_dashboard.php',
            // 'HR' => 'hr_portal.php',
            // 'Customer' => 'customer_home.php'
        ];

        // Redirect based on role or show contact message
        if (array_key_exists($row['Role'], $roleRedirects)) {
            header("Location: " . $roleRedirects[$row['Role']]);
        } else {
            echo "Contact the admin panel for role assignment!";
        }
        exit;
    } else {
        echo "Invalid Email ID/Password";
    }

    $stmt->close();
    $conn->close();
}
?>
