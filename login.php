<?php
require 'includes/config.php'; 
session_start();

$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        try {
            // Use prepared statement to prevent SQL injection
            $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on user role
                switch ($user['role']) {
                    case 'admin':
                        header("Location: dashboard/admin.php");
                        break;
                    case 'editor':
                        header("Location: dashboard/editor.php");
                        break;
                    default:
                        header("Location: dashboard/user.php");
                        break;
                }
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - BugTrackr</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
  body {
    background: linear-gradient(135deg, #667eea, #764ba2);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .login-box {
    width: 100%;
    max-width: 420px;
    padding: 40px 30px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: 16px;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
    animation: slideDown 0.5s ease-out;
    color: #fff;
  }

  .login-box h2 {
    margin-bottom: 25px;
    text-align: center;
    font-weight: 700;
    color: #ffffff;
  }

  .form-label {
    color: #f0f0f0;
    font-weight: 500;
  }

  .form-control {
    border-radius: 8px;
    border: none;
    padding: 10px 14px;
    font-size: 0.95rem;
    background-color: rgba(255, 255, 255, 0.9);
  }

  .form-control:focus {
    border: 2px solid #5f9df7;
    box-shadow: 0 0 0 0.15rem rgba(95, 157, 247, 0.3);
  }

  .btn-primary {
    background-color: #4f46e5;
    border: none;
    padding: 10px;
    font-weight: 600;
    border-radius: 8px;
  }

  .btn-primary:hover {
    background-color: #3b37c1;
  }

  .alert-danger {
    font-size: 0.9rem;
    border-radius: 8px;
    padding: 10px;
  }

  p a {
    color: #cce4ff;
    text-decoration: underline;
  }

  @keyframes slideDown {
    from {
      transform: translateY(-30px);
      opacity: 0;
    }
    to {
      transform: translateY(0);
      opacity: 1;
    }
  }
</style>

</head>
<body>

<div class="login-box">
  <h2>Login to BugTrackr</h2>
  
  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" required/>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required/>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
    <p class="text-center mt-3">Don't have an account? <a href="register.php">Register</a></p>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
