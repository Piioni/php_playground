<?php
include(__DIR__ . '/../../../config/bootstrap.php');

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: /user_dashboard');
    exit();
}

$title = 'Admin Dashboard';
include(__DIR__ . '/../layouts/_header.php');
?>



<?php
include(__DIR__ . '/../layouts/_footer.php');