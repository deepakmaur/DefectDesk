<?php
require 'includes/config.php';
require 'includes/functions.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $submitted_by = $_SESSION['username'];

    if (!empty($title) && !empty($description)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO bugs (title, description, submitted_by, created_at) VALUES (:title, :description, :submitted_by, NOW())");
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':submitted_by' => $submitted_by
            ]);
            $message = " Bug submitted successfully!";
            sendBugNotification($title, $description, $submitted_by);
        } catch (PDOException $e) {
            $message = " Database error: " . $e->getMessage();
        }
    } else {
        $message = " Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Bug - BugTrackr</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            color: #fff;
        }
        .container {
            margin-top: 50px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.6s ease-in-out;
            color: #000;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .alert {
            text-align: center;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>🐞 Submit a Bug</h2>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Bug Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Bug Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit Bug</button>
        <a href="dashboard/<?= htmlspecialchars($_SESSION['role']) ?>.php" class="btn btn-secondary w-100 mt-2">Back to Dashboard</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
