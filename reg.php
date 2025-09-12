<?php
// Database connection setup
$servername = "localhost";
$db_username = "root";  
$db_password = "";      
$dbname = "book_review_db";

$message = "";
$message_type = "";
$errors = [];

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Sanitize function
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$firstname = $lastname = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = sanitizeInput($_POST['firstname']);
    $lastname = sanitizeInput($_POST['lastname']);
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Validation
    if (empty($firstname)) {
        $errors["firstname"] = "First name is required";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
        $errors["firstname"] = "Only letters and spaces allowed";
    }

    if (empty($lastname)) {
        $errors["lastname"] = "Last name is required";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
        $errors["lastname"] = "Only letters and spaces allowed";
    }

    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    if (empty($password)) {
        $errors["password"] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors["password"] = "Password must be at least 8 characters";
    } elseif (!preg_match("/[@#$%]/", $password)) {
        $errors["password"] = "Password must contain at least one special character (@, #, $, %)";
    }

    if (empty($password_confirm)) {
        $errors["password_confirm"] = "Please confirm your password";
    } elseif ($password !== $password_confirm) {
        $errors["password_confirm"] = "Passwords do not match";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetchColumn() > 0) {
            $errors["email"] = "Email is already registered. Please use another.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO user (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
            $success = $stmt->execute([$firstname, $lastname, $email, $hashed_password]);

            if ($success) {
                $message = "Registration successful! You can now <a href='login.php'>login</a>.";
                $message_type = "success";
                $firstname = $lastname = $email = "";
            } else {
                $message = "Registration failed. Please try again.";
                $message_type = "error";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - Book Review</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #e0f2f1; /* light page background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
            min-width: 0;
        }

        .wrapper {
            display: flex;
            background-color: #ffffff; /* form div background */
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 700px;
            max-width: 100%;
            box-sizing: border-box;
            min-width: 0;
        }

        .logo-container {
            background-color: #1d785fff; /* logo div background */
            width: 40%;
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 0;
            box-sizing: border-box;
        }

        .logo-container img {
            width: 150px;
            height: auto;
            max-width: 100%;
        }

        .form-container {
            width: 60%;
            padding: 25px 35px;
            min-width: 0;
            box-sizing: border-box;
        }

        h1, h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            font-weight: 600;
            display: block;
            color: #444;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid #ccc;
            border-radius: 12px;
            font-size: 15px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
        }

        .error-text {
            color: red;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            padding: 14px;
            margin-bottom: 20px;
            border-radius: 12px;
            text-align: center;
            font-weight: 600;
            font-size: 15px;
        }

        .message.success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .message.error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        p.login-link {
            text-align: center;
            font-size: 14px;
            margin-top: 18px;
            color: #555;
        }

        p.login-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }

        p.login-link a:hover { text-decoration: underline; }

        @media(max-width: 768px) {
            body {
                height: auto;
                min-width: 0;
            }
            .wrapper {
                flex-direction: column;
                width: 100%;
                max-width: 100%;
                margin: 25px auto;
                box-sizing: border-box;
                min-width: 0;
            }
            .logo-container, .form-container {
                width: 100%;
                min-width: 0;
                box-sizing: border-box;
            }
            .logo-container {
                padding: 20px 0;
            }
            .form-container {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Logo Section -->
        <div class="logo-container">
            <img src="logo.jpg" alt="Website Logo">
        </div>

        <!-- Registration Form Section -->
        <div class="form-container">
            <h1>Shelf Talk</h1>
            <h2>Create Your Account</h2>

            <?php if (!empty($message)): ?>
                <div class="message <?php echo $message_type; ?>"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="form-group">
                    <label for="firstname">First name</label>
                    <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>">
                    <?php if (isset($errors["firstname"])): ?><span class="error-text"><?php echo $errors["firstname"]; ?></span><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="lastname">Last name</label>
                    <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>">
                    <?php if (isset($errors["lastname"])): ?><span class="error-text"><?php echo $errors["lastname"]; ?></span><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <?php if (isset($errors["email"])): ?><span class="error-text"><?php echo $errors["email"]; ?></span><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <?php if (isset($errors["password"])): ?><span class="error-text"><?php echo $errors["password"]; ?></span><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password_confirm">Re-enter password</label>
                    <input type="password" id="password_confirm" name="password_confirm">
                    <?php if (isset($errors["password_confirm"])): ?><span class="error-text"><?php echo $errors["password_confirm"]; ?></span><?php endif; ?>
                </div>

                <button type="submit">Create account</button>
            </form>

            <p class="login-link">Already have an account? <a href="login.php">Sign in</a></p>
        </div>
    </div>
</body>
</html>