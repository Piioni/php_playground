<?php
include(__DIR__ . '/../../../config/bootstrap.php');

// Establecer el título antes de incluir el header
$title = 'Panel de Administración';

// Validación de autorización
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    $_SESSION['message'] = 'No tienes permiso para acceder a esta página.';
    $_SESSION['message_type'] = 'error';
    header('Location: /homepage');
    exit();
}

include(__DIR__ . '/../layouts/_header.php');
?>

<div class="container">
    <div class="main-content">
        <h1>Panel de Administración</h1>
        <p>Bienvenido, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Administrador') ?>.</p>

        <!-- Aquí puedes añadir contenido administrativo como gestión de usuarios -->
        <div class="admin-section">
            <h2>Gestión de Usuarios</h2>
            <!-- Aquí podrías incluir una tabla de usuarios o formularios de gestión -->
        </div>
    </div>
</div>

<?php include(__DIR__ . '/../layouts/_footer.php'); ?>
