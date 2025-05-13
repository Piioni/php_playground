<?php
include(__DIR__ . '/../../../config/bootstrap.php');

if (!isset($_SESSION['user_id'])) {
    $message = 'You must be logged in to access this page.';
    header('Location: /login');
    exit();
}

$title = 'User Dashboard';
include(__DIR__ . '/../layouts/_header.php');
?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Panel de Usuario</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-center">Bienvenido al panel de usuario.</p>
                        <div class="d-flex justify-content-center">
                            <div class="card mb-3" style="width: 18rem;">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Perfil</h5>
                                    <p class="card-text">Edita tu información personal.</p>
                                    <a href="/user_profile'" class="btn btn-primary">Ir al
                                        Perfil</a>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="/logout'" class="btn btn-danger">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include(__DIR__ . '/../layouts/_footer.php');
