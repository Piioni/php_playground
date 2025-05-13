<?php
include(__DIR__ . '/../../../config/bootstrap.php');
require_once __DIR__ . '/../../controllers/AuthController.php';

$auth = new AuthController();
$errors = [];
$input = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger y sanitizar los datos del formulario
    $input["identifier"] = filter_input(INPUT_POST, 'identifier', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $input['password'] = filter_input(INPUT_POST, 'password') ?? '';

    // Validación básica
    if (empty($input["identifier"])) {
        $errors['identifier'] = 'El usuario o email es obligatorio.';
    }

    if (empty($input['password'])) {
        $errors['password'] = 'La contraseña es obligatoria.';
    }

    // Si no hay errores, intentar iniciar sesión
    if (empty($errors)) {
        if ($auth->login($input["identifier"], $input['password'])) {
            $_SESSION['message'] = 'Usuario autenticado correctamente.';
            $_SESSION['message_type'] = 'success';
            header('Location: /user_dashboard');
            exit();
        } else {
            $_SESSION['message'] = 'El usuario o contraseña son incorrectos.';
            $_SESSION['message_type'] = 'error';
        }
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
                <div class="input-wrapper">
                    <input type="text" name="identifier" id="identifier" class="form-control" required>
                    <?php if (!empty($errors['identifier'])) : ?>
                        <div class="error-message">
                            <?= htmlspecialchars($errors['identifier']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="password" class="form-control" required>
                    <?php if (!empty($errors['password'])) : ?>
                        <div class="error-message">
                            <?= htmlspecialchars($errors['password']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-block">Ingresar</button>
            <div class="text-center mt-3">
                ¿No tienes cuenta? <a href="/register" class="text-link">Regístrate</a>
            </div>
        </form>
    </div>
</div>

<?php include(__DIR__ . '/../layouts/_footer.php'); ?>
