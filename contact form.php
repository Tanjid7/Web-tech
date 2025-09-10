 <?php
 // Initialize variables
 $errors = [];
 $name = $email = $website = $comment = $gender = "";
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // Validate name
 if (empty($_POST["name"])) {
 $errors["name"] = "Name is required";
 } else {
 $name = sanitizeInput($_POST["name"]);
 if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
 $errors["name"] = "Only letters and white space allowed";
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
 // Validate website (optional)
 if (!empty($_POST["website"])) {
 $website = sanitizeInput($_POST["website"]);
 if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0
9+&@#\/%=~_|]/i", $website)) {
 $errors["website"] = "Invalid URL format";
 }
 }
 // Validate comment (optional)
 if (!empty($_POST["comment"])) {
 $comment = sanitizeInput($_POST["comment"]);
 }
 // Validate gender
 if (empty($_POST["gender"])) {
 $errors["gender"] = "Gender is required";
}
 } else {
 $gender = sanitizeInput($_POST["gender"]);
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
 <title>Contact Form</title>
 <style>
 .error { color: red; }
 .form-group { margin-bottom: 15px; }
 </style>
 </head>
 <body>
 <h2>Contact Form</h2>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
 <div class="form-group">
 <label>Name: *</label>
 <input type="text" name="name" value="<?php echo $name; ?>">
 <?php if (isset($errors["name"])): ?>
 <span class="error"><?php echo $errors["name"]; ?></span>
 <?php endif; ?>
 </div>
 <div class="form-group">
 <label>Email: *</label>
 <input type="email" name="email" value="<?php echo $email; ?>">
 <?php if (isset($errors["email"])): ?>
 <span class="error"><?php echo $errors["email"]; ?></span>
 <?php endif; ?>
 </div>
 <div class="form-group">
 <label>Website:</label>
 <input type="text" name="website" value="<?php echo $website; ?>">
 <?php if (isset($errors["website"])): ?>
 <span class="error"><?php echo $errors["website"]; ?></span>
 <?php endif; ?>
 </div>
 <div class="form-group">
 <label>Comment:</label>
 <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
 </div>
 <div class="form-group">
 <label>Gender: *</label><br>
 <input type="radio" name="gender" value="female"
 <?php if (isset($gender) && $gender == "female") echo "checked"; ?>> Female
 <input type="radio" name="gender" value="male"
 <?php if (isset($gender) && $gender == "male") echo "checked"; ?>> Male
 <input type="radio" name="gender" value="other"
<?php if (isset($gender) && $gender == "other") echo "checked"; ?>> Other
 <?php if (isset($errors["gender"])): ?>
 <span class="error"><?php echo $errors["gender"]; ?></span>
 <?php endif; ?>
 </div>
 <input type="submit" value="Submit">
 </form>
 </body>
 </html>