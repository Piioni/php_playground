<?php
include(__DIR__ . '/../../../config/bootstrap.php');
require_once __DIR__ . '/../../controllers/AuthController.php';
require_once __DIR__ . '/../../../config/config.php';

$auth = new AuthController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifier = $_POST['identifier'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($auth->login($identifier, $password)) {
        $_SESSION['message'] = 'Usuario autenticado correctamente.';
        header('Location: ' . route("/admin_dashboard"));
        exit();
    } else {
        $_SESSION['message'] = 'Usuario no autenticado.';
    }
}


$title = 'Login';
include(__DIR__ . '/../layouts/_header.php');
?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Iniciar Sesión</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="identifier" class="form-label">Usuario</label>
                                <input type="text" name="identifier" id="identifier" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include(__DIR__ . '/../layouts/_footer.php');