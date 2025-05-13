<?php
require_once(__DIR__ . '/../../../config/bootstrap.php');

$title = "";

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo htmlspecialchars($title, ENT_QUOTES) ?></title>
        <link rel="stylesheet" href="/assets/css/styles.css"> <!-- Cambiado a nuestro archivo CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<body>
<header>
    <nav class="navbar">
        <div class="navbar-title">Gestor de Usuarios</div>
        <div class="navbar-links">
            <a href="/homepage">Home</a>
            <a href="/login">Login</a>
            <a href="/register">Register</a>
            <a href="/user_dashboard">User Dashboard</a>
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') : ?>
                <a href="/admin_dashboard">Admin Dashboard</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<?php
include __DIR__ . '/../partials/_alerts.php';