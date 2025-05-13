<?php
include(__DIR__ . '/../../../config/bootstrap.php');
require_once __DIR__ . '/../../controllers/AuthController.php';

$auth = new AuthController();
$errors = [];
$input = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger y sanitizar los datos del formulario
    $input['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $input['username'] = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $input['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
    $input['password'] = filter_input(INPUT_POST, 'password') ?? '';
    $input['confirm_password'] = filter_input(INPUT_POST, 'confirm_password') ?? '';

    // Validación simplificada
    if (empty($input['nombre'])) {
        $errors['nombre'] = 'El nombre es obligatorio.';
    }

    if (empty($input['username'])) {
        $errors['username'] = 'El usuario es obligatorio.';
    }

    if (empty($input['email'])) {
        $errors['email'] = 'El correo es obligatorio.';
    } elseif (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email inválido.';
    }

    if (empty($input['password'])) {
        $errors['password'] = 'La contraseña es obligatoria.';
    } elseif (strlen($input['password']) < 8) {
        $errors['password'] = 'Mínimo 8 caracteres.';
    }

    if ($input['password'] !== $input['confirm_password']) {
        $errors['confirm_password'] = 'Las contraseñas no coinciden.';
    }

    // Si no hay errores, intentar registrar
    if (empty($errors)) {
        if ($auth->register($input['nombre'], $input['username'], $input['email'], $input['password'])) {
            $_SESSION['message'] = 'Usuario registrado correctamente.';
            $_SESSION['message_type'] = 'success';
            header('Location: /login');
            exit();
        } else {
            $errors['general'] = 'El email o usuario ya están en uso.';
        }
    }
}

$title = 'Register';
include(__DIR__ . '/../layouts/_header.php');
?>

<div class="auth-container">
    <div class="card">
        <div class="card-title">Registro</div>
        <?php if (!empty($errors['general'])): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($errors['general']) ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <div class="input-wrapper">
                    <input type="text" id="nombre" name="nombre" class="form-control" 
                           value="<?= htmlspecialchars($input['nombre'] ?? '') ?>" required>
                    <?php if (!empty($errors['nombre'])): ?>
                        <div class="error-message"><?= htmlspecialchars($errors['nombre']) ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="username">Usuario</label>
                <div class="input-wrapper">
                    <input type="text" id="username" name="username" class="form-control"
                           value="<?= htmlspecialchars($input['username'] ?? '') ?>" required>
                    <?php if (!empty($errors['username'])): ?>
                        <div class="error-message"><?= htmlspecialchars($errors['username']) ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" class="form-control"
                           value="<?= htmlspecialchars($input['email'] ?? '') ?>" required>
                    <?php if (!empty($errors['email'])): ?>
                        <div class="error-message"><?= htmlspecialchars($errors['email']) ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" class="form-control" required>
                    <?php if (!empty($errors['password'])): ?>
                        <div class="error-message"><?= htmlspecialchars($errors['password']) ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmar</label>
                <div class="input-wrapper">
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    <?php if (!empty($errors['confirm_password'])): ?>
                        <div class="error-message"><?= htmlspecialchars($errors['confirm_password']) ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-block">Registrarse</button>
            <div class="text-center mt-3">
                ¿Ya tienes cuenta? <a href="/login" class="text-link">Inicia sesión</a>
            </div>
        </form>
    </div>
</div>

<?php include(__DIR__ . '/../layouts/_footer.php'); ?>
