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
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Heading Styles */
.signup-form h2 {
    font-size: 30px;
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

.signup-form .hint-text {
    font-size: 14px;
    color: #777;
    text-align: center;
    margin-bottom: 30px;
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

/* Row for Name Fields */
.signup-form .row .col {
    padding-right: 10px;
    padding-left: 10px;
}

.signup-form .row .form-control {
    margin-bottom: 0;
}

/* File Upload */
.signup-form input[type="file"] {
    border-radius: 4px;
    border: 1px solid #ccc;
    padding: 12px;
    font-size: 16px;
    background-color: #f9f9f9;
}

/* Checkbox */
.signup-form .form-check-label {
    font-size: 14px;
    color: #555;
}

.signup-form .form-check-input {
    margin-top: 3px;
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

/* Links */
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

    .signup-form .form-control {
        padding: 12px;
    }

    .signup-form input[type="file"] {
        padding: 12px;
    }
}

</style>

</head>
<body>
<div class="signup-form">
    <form action="register_a.php" method="post" enctype="multipart/form-data">
		<h2>Register</h2>
		<p class="hint-text">Create your account</p>
        <div class="form-group">
			<div class="row">
				<div class="col"><input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"></div>
				<div class="col"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
			</div>        	
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="pass" placeholder="Password" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="cpass" placeholder="Confirm Password" required="required">
        </div>
        <div class="form-group">
            <input type="file" name="file" required>
            <!-- <input type="submit" name="upload" value="Upload" class="btn"> -->
        </div>        
        <div class="form-group">
			<label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> & <a href="#">Privacy Policy</a></label>
		</div>
		<div class="form-group">
            <button type="submit" name="save" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
        <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
    </form>
	
</div>
</body>
</html>