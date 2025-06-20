<?php
$host = 'localhost';     // Database host
$port = '3307';          // Default MySQL port; change to '3307' if needed
$db   = 'bugtrackr';     // Your database name
$user = 'root';          // Default XAMPP DB username
$pass = '';              // Default XAMPP DB password is empty

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional: uncomment to confirm connection
    echo " Connected to DB successfully";
} catch (PDOException $e) {
    die(" Database connection failed: " . $e->getMessage());
}
?>
