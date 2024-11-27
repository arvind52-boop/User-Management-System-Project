<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Welcome to Finance Portal</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assests/css/style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
    /* General Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f7f7f7;
    padding: 0;
    margin: 0;
}

/* Signup Form Styles */
.signup-form {
    width: 100%;
    max-width: 400px;
    margin: 50px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Heading Styles */
.signup-form h2 {
    font-size: 28px;
    margin-bottom: 10px;
    color: #333;
    text-align: center;
}

.signup-form .hint-text {
    font-size: 14px;
    color: #777;
    text-align: center;
    margin-bottom: 25px;
}

/* Input Fields */
.signup-form .form-group {
    margin-bottom: 20px;
}

.signup-form .form-control {
    border-radius: 4px;
    border: 1px solid #ccc;
    padding: 15px;
    font-size: 16px;
    background-color: #f9f9f9;
    transition: border-color 0.3s ease;
}

.signup-form .form-control:focus {
    border-color: #66afe9;
    outline: none;
}

/* Button Styles */
.signup-form .btn {
    font-size: 16px;
    padding: 15px;
    border-radius: 4px;
    border: none;
    transition: background-color 0.3s ease;
}

.signup-form .btn-success {
    background-color: #28a745;
    color: #fff;
}

.signup-form .btn-success:hover {
    background-color: #218838;
}

/* Link Styles */
.signup-form .text-center {
    font-size: 14px;
    margin-top: 20px;
    text-align: center;
}

.signup-form .text-center a {
    color: #28a745;
    font-weight: 600;
    text-decoration: none;
}

.signup-form .text-center a:hover {
    text-decoration: underline;
}

/* Media Queries for Responsiveness */
@media (max-width: 768px) {
    .signup-form {
        padding: 20px;
        margin: 20px;
    }

    .signup-form h2 {
        font-size: 24px;
    }
}

</style>

</head>
<body>
<div class="signup-form">
    <form action="loginProcess.php" method="post" enctype="multipart/form-data">
		<h2>Login</h2>
		<p class="hint-text">Enter Login Details</p>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="pass" placeholder="Password" required="required">
        </div>
		<div class="form-group">
            <button type="submit" name="save" class="btn btn-success btn-lg btn-block">Login</button>
        </div>
        <div class="text-center">Don't have an account? <a href="register.php">Register Here</a></div>
    </form>

    <div>
        <p>admin <h6>email:-admin@gmail.com </h6> 
    <h7>passwd :- admin</h7></p>
        <p>employee <h6>email:- e1@gmail.com</h6> 
    <h6>passwd :- abc</h6></p>
    </div>
</div>
</body>
</html>