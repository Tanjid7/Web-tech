 <?php
 // Initialize variables
 $errors = [];
 $username = $email = $password = $confirmPassword = "";
 $success = false;
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // Validate username
 if (empty($_POST["username"])) {
 $errors["username"] = "Username is required";
 } else {
 $username = sanitizeInput($_POST["username"]);
 if (strlen($username) < 5) {
 $errors["username"] = "Username must be at least 5 characters";
 } elseif (!preg_match("/^[a-zA-Z0-9._-]+$/", $username)) {
 $errors["username"] = "Username can only contain letters, numbers, periods, dashes, or
 underscores";
 }
 }
 // Validate email
 if (empty($_POST["email"])) {
 $errors["email"] = "Email is required";
 } else {
 $email = sanitizeInput($_POST["email"]);
 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 $errors["email"] = "Invalid email format";
 }
 }
 // Validate password
 if (empty($_POST["password"])) {
 $errors["password"] = "Password is required";
 } else {
 $password = $_POST["password"];
 if (strlen($password) < 8) {
 $errors["password"] = "Password must be at least 8 characters";
 } elseif (!preg_match("/[@#$%]/", $password)) {
 $errors["password"] = "Password must contain at least one special character (@, #, $,
 %)";
 }
 }
 // Validate confirm password
 if (empty($_POST["confirmPassword"])) {
$errors["confirmPassword"] = "Please confirm your password";
 } else {
 $confirmPassword = $_POST["confirmPassword"];
 if ($password !== $confirmPassword) {
 $errors["confirmPassword"] = "Passwords do not match";
 }
 }
 // If no errors, process the form
 if (empty($errors)) {
 $success = true;
 // Here you would typically save to database
 }
 }
 function sanitizeInput($data) {
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 return $data;
 }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 <title>User Registration</title>
 <style>
 .error { color: red; }
 .success { color: green; }
 .form-group { margin-bottom: 15px; }
 </style>
 </head>
 <body>
 <h2>User Registration Form</h2>
 <?php if ($success): ?>
 <div class="success">Registration successful!</div>
 <?php endif; ?>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
 <div class="form-group">
 <label>Username:</label>
 <input type="text" name="username" value="<?php echo $username; ?>">
 <?php if (isset($errors["username"])): ?>
 <span class="error"><?php echo $errors["username"]; ?></span>
 <?php endif; ?>
 </div>
 <div class="form-group">
 <label>Email:</label>
 <input type="email" name="email" value="<?php echo $email; ?>">
 <?php if (isset($errors["email"])): ?>
 <span class="error"><?php echo $errors["email"]; ?></span>
 <?php endif; ?>
 </div>
 <div class="form-group">
 <label>Password:</label>
 <input type="password" name="password">
 <?php if (isset($errors["password"])): ?>
 <span class="error"><?php echo $errors["password"]; ?></span>
<?php endif; ?>
 </div>
 <div class="form-group">
 <label>Confirm Password:</label>
 <input type="password" name="confirmPassword">
 <?php if (isset($errors["confirmPassword"])): ?>
 <span class="error"><?php echo $errors["confirmPassword"]; ?></span>
 <?php endif; ?>
 </div>
 <input type="submit" value="Register">
 </form>
 </body>
 </html>