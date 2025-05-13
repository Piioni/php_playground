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

    // Validar cada campo
    if (empty($input["identifier"])) {
        $errors['identifier'] = 'El nombre de usuario o correo electrónico es obligatorio.';
    } elseif (strlen($input["identifier"]) < 3) {
        $errors['identifier'] = 'El nombre de usuario o correo electrónico debe tener al menos 3 caracteres.';
    }

    if (empty($input['password'])) {
        $errors['password'] = 'La contraseña es obligatoria.';
    } elseif (strlen($input['password']) < 8) {
        $errors['password'] = 'La contraseña debe tener al menos 8 caracteres.';
    }

    // Si no hay errores, intentar iniciar sesión
    if (empty($errors)) {
        if ($auth->login($input["identifier"], $input['password'])) {
            $_SESSION['message'] = 'Usuario autenticado correctamente.';
            $_SESSION['message_type'] = 'success';
            header('Location: /admin_dashboard');
            exit();
        } else {
            $_SESSION['message'] = 'El usuario o contraseña son incorrectos.';
            $_SESSION['message_type'] = 'error';
        }
    } else {
        $errors['general'] = 'Todos los campos son obligatorios.';
    }
}

$title = 'Login';
include(__DIR__ . '/../layouts/_header.php');
?>

    <div class="auth-container">
        <div class="card">
            <div class="card-title">Iniciar Sesión</div>
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-error">
                    <?php echo htmlspecialchars($errors['general'] ?? '', ENT_QUOTES); ?>
                </div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="identifier">Usuario</label>
                    <input type="text" name="identifier" id="identifier" class="form-control" required>
                    <?php if (!empty($errors['identifier'])) : ?>
                        <div class="alert alert-error">
                            <?php echo htmlspecialchars($errors['identifier'], ENT_QUOTES); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <?php if (!empty($errors['password'])) : ?>
                        <div class="alert alert-error">
                            <?php echo htmlspecialchars($errors['password'], ENT_QUOTES); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-block">Ingresar</button>
            </form>
        </div>
    </div>

<?php
include(__DIR__ . '/../layouts/_footer.php');