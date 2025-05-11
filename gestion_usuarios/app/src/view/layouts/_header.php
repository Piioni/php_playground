<?php
require_once(__DIR__ . '/../../../config/bootstrap.php');
require_once(__DIR__ . '/../../../config/config.php');

$title = "";

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo htmlspecialchars($title, ENT_QUOTES) ?></title>
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<body>
<div>
    <nav class="navbar navbar-expand-lg bg-light justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route('/homepage') ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route('/login') ?>">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route('/register') ?>">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route('/user_dashboard') ?>">User Dashboard</a>
            </li>
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo route('admin_dashboard') ?>)">Admin Dashboard</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php
include __DIR__ . '/../partials/_alerts.php';

