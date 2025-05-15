<?php
include(__DIR__ . '/../../../config/bootstrap.php');

$title = 'Inicio - Gestor de Usuarios';
include(__DIR__ . '/../layouts/_header.php');
?>
<div class="auth-container">
    <div class="card">
        <h2 class="card-title">Bienvenido</h2>
        <div class="text-center">
            <p class="welcome-message">
                <?php if (isset($_SESSION['user_id'])): ?>
                    Hola, <strong><?= htmlspecialchars($_SESSION['user_name'] ?? 'Usuario') ?></strong>.
                    Estás conectado como <strong><?= htmlspecialchars($_SESSION['user_role'] ?? 'usuario') ?></strong>.
                <?php else: ?>
                    Bienvenido a nuestro sistema de gestión de usuarios.
                <?php endif; ?>
            </p>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="button-group">
                    <a href="/<?= $_SESSION['user_role'] === 'admin' ? 'admin' : 'user' ?>_dashboard" class="btn">Ir al Panel</a>
                </div>
            <?php else: ?>
                <div class="button-group">
                    <a href="/login" class="btn">Iniciar Sesión</a>
                    <a href="/register" class="btn">Registrarse</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include(__DIR__ . '/../layouts/_footer.php'); ?>
