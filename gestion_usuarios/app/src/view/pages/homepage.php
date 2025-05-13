<?php
include(__DIR__ . '/../../../config/bootstrap.php');

$title = 'Homepage';
include(__DIR__ . '/../layouts/_header.php');
?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Bienvenido</h4>
                    </div>
                    <div class="card-body text-center">
                        <p>Estás actualmente conectado como
                            <?php if (isset($_SESSION['user_role'])): ?>
                                <strong><?= htmlspecialchars($_SESSION['user_role']) ?></strong>.
                            <?php else: ?>
                                <strong>invitado</strong>.
                            <?php endif; ?>
                        </p>
                        <a href="/logout" class="btn btn-danger">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
include(__DIR__ . '/../layouts/_footer.php');
