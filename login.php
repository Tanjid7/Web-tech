<?php
session_start();

$timeout_duration = 3;

if (isset($_SESSION['username'])) {
    if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time']) > $timeout_duration) {
        // Session expired
        session_unset();
        session_destroy();
        header("Location: login.php?expired=1");
        exit();
    } else {
        $_SESSION['login_time'] = time();
        header("Location: wlc.php");
        exit();
    }
}

// Database connection
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "book_review_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$errors = [];
$username = "";

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username)) {
        $errors['username'] = "Please enter your username or email.";
    }
    if (empty($password)) {
        $errors['password'] = "Please enter your password.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE firstname = :username OR email = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['firstname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['login_time'] = time();

            header("Location: wlc.php");
            exit();
        } else {
            $errors['general'] = "Invalid username/email or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Book Review</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #e0f2f1;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            box-sizing: border-box;
        }

        .wrapper {
            display: flex;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 700px;
            max-width: 100%;
            box-sizing: border-box;
        }

        .logo-container {
            background-color: #1d785fff;
            width: 40%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
        }

        .logo-container img {
            width: 150px;
            height: auto;
            max-width: 100%;
            border-radius: 8px;
            display: block;
        }

        .form-container {
            width: 60%;
            padding: 25px 35px;
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
        p.signup-link {
            text-align: center;
            font-size: 14px;
            margin-top: 18px;
            color: #555;
        }
        p.signup-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }
        p.signup-link a:hover { text-decoration: underline; }
        @media(max-width: 768px) {
            body { height: auto; }
            .wrapper { flex-direction: column; width: 100%; margin: 25px auto; }
            .logo-container, .form-container { width: 100%; }
            .logo-container { padding: 20px 0; }
            .form-container { padding: 20px 15px; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Logo Section -->
        <div class="logo-container">
            <img src="logo.jpg" alt="Website Logo">
        </div>

        <!-- Login Form Section -->
        <div class="form-container">
            <h1>Shelf Talk</h1>
            <h2>Sign In</h2>

            <?php if (isset($errors['general'])): ?>
                <div class="error-text" style="text-align:center;"><?php echo $errors['general']; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username or Email</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    <?php if (isset($errors['username'])): ?><span class="error-text"><?php echo $errors['username']; ?></span><?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <?php if (isset($errors['password'])): ?><span class="error-text"><?php echo $errors['password']; ?></span><?php endif; ?>
                </div>

                <button type="submit">Login</button>
            </form>

            <p class="signup-link">New to Shelf Talk? <a href="reg.php">Sign Up</a></p>
        </div>
    </div>
</body>
</html>