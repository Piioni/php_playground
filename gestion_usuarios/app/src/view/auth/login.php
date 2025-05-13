<?php
include(__DIR__ . '/../../../config/bootstrap.php');
require_once __DIR__ . '/../../controllers/AuthController.php';

$auth = new AuthController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifier = $_POST['identifier'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($auth->login($identifier, $password)) {
        $_SESSION['message'] = 'Usuario autenticado correctamente.';
        $_SESSION['message_type'] = 'success';
        header('Location: /admin_dashboard');
        exit();
    } else {
        $_SESSION['message'] = 'Usuario no autenticado.';
        $_SESSION['message_type'] = 'error';
    }
}

$title = 'Login';
include(__DIR__ . '/../layouts/_header.php');
?>

    <div class="auth-container">
        <div class="card">
            <div class="card-title">Iniciar Sesión</div>
            <form method="POST">
                <div class="form-group">
                    <label for="identifier">Usuario</label>
                    <input type="text" name="identifier" id="identifier" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-block">Ingresar</button>
            </form>
        </div>
    </div>

<?php
include(__DIR__ . '/../layouts/_footer.php');