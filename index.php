<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BugTrackr - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    body {
      background: linear-gradient(to right, #e0eafc, #cfdef3);
      color: #222;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .hero {
      padding: 100px 20px 60px;
      text-align: center;
    }

    .hero h1 {
      font-size: 3.2rem;
      font-weight: 700;
      color: #003366;
    }

    .hero p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto;
      color: #444;
    }

    .navbar {
      background-color: #ffffffcc !important;
      backdrop-filter: blur(10px);
    }

    .navbar-brand {
      font-weight: bold;
      font-size: 1.5rem;
      color: #0077b6;
    }

    .card {
      background: rgba(255, 255, 255, 0.85);
      border: none;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-radius: 15px;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .card h5 {
      font-weight: 600;
      color: #005f73;
    }

    footer {
      background-color: #f8f9fa;
      border-top: 1px solid #dee2e6;
      font-size: 0.9rem;
      color: #666;
    }

    .btn-primary {
      background-color: #0077b6;
      border: none;
    }

    .btn-outline-primary {
      border-color: #0077b6;
      color: #0077b6;
    }

    .btn-outline-primary:hover {
      background-color: #0077b6;
      color: white;
    }

    .container h2 {
      font-weight: 700;
      color: #023e8a;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">DefectDesk</a>
    <div class="d-flex">
      <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
      <a href="register.php" class="btn btn-primary">Register</a>
    </div>
  </div>
</nav>

<section class="hero">
  <div class="container">
    <h1>Welcome to DefectDesk</h1>
    <p>A secure platform to report and manage software bugs with role-based access control.</p>
  </div>
</section>

<section class="container mb-5">
  <h2 class="text-center mb-4">Key Features</h2>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card p-4">
        <h5>Instant Developer Alerts</h5>
        <p>When a user reports a bug, all developers are instantly notified via email — ensuring quick visibility and faster response times.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <h5>Secure Bug Reporting</h5>
        <p>Bug data is safely stored using secure form validation and prepared SQL statements to protect against injection attacks.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-4">
        <h5>Role-Based Dashboards</h5>
        <p>Admins, developers, and users each have their own dashboard views, providing access only to what’s relevant for their role.</p>
      </div>
    </div>
  </div>
</section>


<footer class="text-center py-3">
  &copy; 2025  Project. All rights reserved.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
