<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #ede7f6;
    }
    .dashboard {
      max-width: 600px;
      margin: 100px auto;
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }
    .dashboard:hover {
      transform: scale(1.01);
    }
    .btn-custom {
      transition: all 0.3s ease-in-out;
    }
    .btn-custom:hover {
      transform: scale(1.05);
    }
  </style>
</head>
<body>

<div class="dashboard text-center">
  <h3>Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> 👑</h3>
  <p class="text-muted">This is your <strong>Admin</strong> Dashboard.</p>
  
  <a href="../view_bug.php" class="btn btn-success w-100 btn-custom my-2">View All Bugs</a>
 <a href="manage_users.php" class="btn btn-warning w-100 btn-custom my-2">Manage Users</a>
  <a href="../logout.php" class="btn btn-danger w-100 btn-custom mt-3">Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
