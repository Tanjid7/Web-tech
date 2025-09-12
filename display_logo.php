<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "book_review_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the latest logo (or you can add WHERE if you want a specific one)
    $stmt = $pdo->query("SELECT imageType, imageData FROM logo ORDER BY id DESC LIMIT 1");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        header("Content-Type: " . $row['imageType']);
        echo $row['imageData'];
    } else {
        // If no logo in DB, fallback image
        header("Content-Type: image/png");
        readfile("default_logo.png"); 
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
