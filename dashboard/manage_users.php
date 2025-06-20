<?php
require '../includes/config.php';
session_start();

// Redirect non-admin users
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

$stmt = $pdo->query("SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users - BugTrackr</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f4f6f9;
    }
    .container {
      margin-top: 60px;
    }
    .card {
      animation: fadeIn 0.5s ease;
      border-radius: 12px;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .table th {
      background-color: #343a40;
      color: white;
    }
    .btn-action {
      margin-right: 5px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card shadow p-4">
    <h3 class="mb-4">👥 Manage Users</h3>
    <table class="table table-hover table-bordered align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Role</th>
          <th>Joined</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($users) > 0): ?>
          <?php foreach ($users as $user): ?>
            <tr>
              <td><?= $user['id'] ?></td>
              <td><?= htmlspecialchars($user['username']) ?></td>
              <td><?= htmlspecialchars($user['email']) ?></td>
              <td><span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'editor' ? 'warning text-dark' : 'primary') ?>">
                <?= ucfirst($user['role']) ?>
              </span></td>
              <td><?= date('Y-m-d', strtotime($user['created_at'])) ?></td>
              <td>
                <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                  </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="6" class="text-center">No users found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
    <a href="admin.php" class="btn btn-secondary mt-3">⬅ Back to Dashboard</a>
  </div>
</div>

</body>
</html>
