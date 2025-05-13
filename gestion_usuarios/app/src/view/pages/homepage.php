<?php
include(__DIR__ . '/../../../config/bootstrap.php');

$title = 'Homepage';
include(__DIR__ . '/../layouts/_header.php');
?>
    <div class="container">
        <div class="auth-container">
            <div class="card">
                <div class="card-title">
                    <h4>Bienvenido</h4>
                </div>
                <div class="text-center">
                    <p class="welcome-message">Estás actualmente conectado como
                        <?php if (isset($_SESSION['user_role'])): ?>
                            <strong><?= htmlspecialchars($_SESSION['user_role']) ?></strong>.
                        <?php else: ?>
                            <strong>invitado</strong>.
                        <?php endif; ?>
                    </p>
                    <a href="/logout" class="btn">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>


<?php
include(__DIR__ . '/../layouts/_footer.php');
