// logout.php
<?php
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit();
?>


// dashboard/user.php
<?php
require '../includes/config.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit();
}