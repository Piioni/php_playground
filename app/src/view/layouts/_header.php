<?php
require_once(__DIR__ . '/../../../config/bootstrap.php');

// Inicializar $title con un valor predeterminado
$title = $title ?? "Gestor de Usuarios";

// Variable para el título de la barra de navegación
$navTitle = "Gestor de Usuarios";

// Sí estamos en el panel de administración, cambiar el título
if (str_contains($_SERVER['REQUEST_URI'], 'admin_dashboard') || isset($isAdminPage)) {
    $navTitle = "Panel de Administración";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title, ENT_QUOTES) ?></title>
    <link rel="stylesheet" href="/assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<header>
    <nav class="navbar">
        <div class="navbar-title"><?= htmlspecialchars($navTitle) ?></div>
        <div class="navbar-links">
            <a href="/homepage" class="btn">Home</a>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') : ?>
                    <a href="/admin_dashboard" class="btn">Admin</a>
                <?php else : ?>
                    <a href="/user_dashboard" class="btn">Panel</a>
                <?php endif; ?>
                <a href="/logout" class="btn">Cerrar Sesión</a>
            <?php else : ?>
                <a href="/login" class="btn">Iniciar Sesión</a>
                <a href="/register" class="btn">Registrarse</a>
            <?php endif; ?>
        </div>
    </nav>
</header>

<?php include __DIR__ . '/../partials/_alerts.php'; ?>
