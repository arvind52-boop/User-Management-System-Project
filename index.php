<?php
// Check if session is already active to prevent accessing login page again
session_start();
if (isset($_SESSION['role'])) {
    header('Location: dashboard.php'); // Redirect to dashboard if already logged in
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Options</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Select Your Role to Login</h1>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="login.php?role=admin" class="btn btn-primary btn-lg w-100 mb-3">Admin Login</a>
                <a href="login.php?role=employee" class="btn btn-success btn-lg w-100">Employee Login</a>
            </div>
        </div>
    </div>
</body>
</html>
