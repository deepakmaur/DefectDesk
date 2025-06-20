<?php
require 'includes/config.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM bugs ORDER BY created_at DESC");
    $stmt->execute();
    $bugs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching bugs: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Bugs - BugTrackr</title>
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
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .btn-secondary {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Reported Bugs</h2>
    <?php if (count($bugs) > 0): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Submitted By</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bugs as $bug): ?>
                    <tr>
                        <td><?= htmlspecialchars($bug['id']) ?></td>
                        <td><?= htmlspecialchars($bug['title']) ?></td>
                        <td><?= nl2br(htmlspecialchars($bug['description'])) ?></td>
                        <td><?= htmlspecialchars($bug['submitted_by']) ?></td>
                        <td><?= htmlspecialchars($bug['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">No bugs reported yet.</p>
    <?php endif; ?>
    <div class="text-center mt-4">
        <a href="dashboard/<?= htmlspecialchars($_SESSION['role']) ?>.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
