<?php
include(__DIR__ . '/../../../config/bootstrap.php');
require_once __DIR__ . '/../../controllers/AuthController.php';

$auth = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $error = '';

    if ($auth->register($nombre, $username, $email, $password)) {
        $_SESSION['message'] = 'Usuario registrado correctamente. Por favor, inicia sesión.';
        header('Location: /login');
        exit();
    } else {
        $error = 'El email o el nombre de usuario ya están en uso.';
    }
}

$title = 'Register';
include(__DIR__ . '/../layouts/_header.php');
?>

    <div class="auth-container">
        <div class="card">
            <div class="card-title">Registro</div>
            <?php if (!empty($error)): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre completo</label>
                    <div class="input-wrapper">
                        <input type="text" id="nombre" name="nombre" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username">Nombre de usuario</label>
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmar</label>
                    <div class="input-wrapper">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-block">Registrarse</button>
                <div class="text-center mt-3">
                    ¿Ya tienes cuenta? <a href="/login" class="text-link">Inicia sesión</a>
                </div>
            </form>
        </div>
    </div>

<?php
include(__DIR__ . '/../layouts/_footer.php');
