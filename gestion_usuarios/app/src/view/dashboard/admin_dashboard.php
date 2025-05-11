<?php
include(__DIR__ . '/../../../config/bootstrap.php');

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    $message = 'You do not have permission to access this page.';
    header('Location: ' . route('/pages/user_dashboard'));
    exit();
}

$title = 'Admin Dashboard';
include(__DIR__ . '/../layouts/_header.php');
?>

<h1>Admin Dashboard</h1>
<div>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</h2>
    <p>You are logged in as an admin.</p>
    <h3>All Users</h3>

