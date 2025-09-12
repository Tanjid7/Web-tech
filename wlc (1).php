<?php
// Redirect to login page if the user is not logged in
if (!isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit();
}

// Get the user's name from the cookie
$username = $_COOKIE['username'];

// Display the welcome message
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome - Book Review</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .welcome-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            text-align: center;
            backdrop-filter: blur(8px);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        p {
            font-size: 16px;
            color: #444;
        }

        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

    <div class="welcome-container">
        <h1>Welcome to ShelfTalk, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>You are now logged in.</p>

        <!-- Logout button -->
        <form method="POST" action="logout.php">
            <button type="submit">Logout</button>
        </form>
    </div>

</body>
</html>
