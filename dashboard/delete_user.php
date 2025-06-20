<?php
require '../includes/config.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prevent admin from deleting their own account
    if ($id == $_SESSION['user_id']) {
        echo "<h4>You cannot delete your own account!</h4>";
        echo "<a href='manage_users.php'>Back to Manage Users</a>";
        exit();
    }

    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: manage_users.php");
    exit();
} else {
    echo "Invalid user ID.";
}
?>
