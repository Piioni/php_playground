<?php
include(__DIR__ . '/../../../config/bootstrap.php');
include(__DIR__ . '/../../controllers/UserController.php');

// Establecer título antes de incluir el header
$title = 'Panel de Usuario';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = 'Debes iniciar sesión para acceder a esta página.';
    $_SESSION['message_type'] = 'error';
    header('Location: /login');
    exit();
}

$userController = new UserController();
$userData = $userController->getUserById($_SESSION['user_id']);
if (!$userData) {
    $_SESSION['message'] = 'Usuario no encontrado.';
    $_SESSION['message_type'] = 'error';
    header('Location: /login');
    exit();
}

$inputs = [
    'name' => $userData['name'],
    'username' => $userData['username'],
    'email' => $userData['email']
];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Filtrar y validar entradas
    $inputs['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $inputs['username'] = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $inputs['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
    $password = filter_input(INPUT_POST, 'password') ?? '';
    $new_password = filter_input(INPUT_POST, 'new_password') ?? '';
    $confirm_password = filter_input(INPUT_POST, 'confirm_password') ?? '';

    // Validación de campos obligatorios
    if (empty($inputs['name'])) {
        $errors['name'] = 'El nombre es obligatorio.';
    } elseif (strlen($inputs['name']) < 3) {
        $errors['name'] = 'El nombre debe tener al menos 3 caracteres.';
    }

    if (empty($inputs['username'])) {
        $errors['username'] = 'El nombre de usuario es obligatorio.';
    } elseif (strlen($inputs['username']) < 3 || strlen($inputs['username']) > 20) {
        $errors['username'] = 'El nombre de usuario debe tener entre 3 y 20 caracteres.';
    }

    if (empty($inputs['email'])) {
        $errors['email'] = 'El correo electrónico es obligatorio.';
    } elseif (!filter_var($inputs['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'El formato del correo electrónico no es válido.';
    }

    // Flag para controlar si se debe actualizar la contraseña
    $updatePassword = false;

    // Si hay contraseña actual, verificamos si es correcta
    if (!empty($password)) {
        if (!password_verify($password, $userData['password'])) {
            $errors['password'] = 'La contraseña actual es incorrecta.';
        } else {
            // Sí se proporciona nueva contraseña, validarla
            if (!empty($new_password)) {
                if (strlen($new_password) < 8) {
                    $errors['new_password'] = 'La nueva contraseña debe tener al menos 8 caracteres.';
                } elseif ($new_password !== $confirm_password) {
                    $errors['confirm_password'] = 'Las contraseñas no coinciden.';
                } else {
                    $updatePassword = true;
                }
            }
        }
    } else if (!empty($new_password) || !empty($confirm_password)) {
        // Si no se proporciona contraseña actual, pero sí nueva contraseña
        $errors['password'] = 'Debes proporcionar tu contraseña actual para realizar cambios.';
    }

    // Si no hay errores, actualizar el perfil
    if (empty($errors)) {
        try {
            $success = $userController->updateUser($_SESSION['user_id'], $inputs['name'], $inputs['username'], $inputs['email']);

            if ($updatePassword && $success) {
                $success = $userController->updateUserPassword($_SESSION['user_id'], $new_password);
            }

            if ($success) {
                $_SESSION['message'] = 'Tu perfil ha sido actualizado correctamente.';
                $_SESSION['message_type'] = 'success';

                // Actualizar los datos de sesión
                $_SESSION['user_name'] = $inputs['username'];
                $_SESSION['user_email'] = $inputs['email'];

                // Redireccionar para evitar reenvío del formulario
                header('Location: /user_dashboard');
                exit();
            } else {
                $errors['general'] = 'Error al actualizar el perfil. Es posible que el nombre de usuario o correo ya estén en uso.';
            }
        } catch (Exception $e) {
            // Registrar el error en un log
            error_log('Error en actualización de usuario: ' . $e->getMessage());
            $errors['general'] = 'Ha ocurrido un error al procesar la solicitud.';
        }
    }
}

// Incluir la vista después de procesar la lógica
include(__DIR__ . '/../layouts/_header.php');
?>

    <div class="container">
        <div class="auth-container">
            <div class="card">
                <h2 class="card-title">Panel de Usuario</h2>

                <div class="text-center">
                    <p class="welcome-message">Estás actualmente conectado como
                        <strong><?= htmlspecialchars($userData['role'] ?? 'usuario') ?></strong>
                    </p>
                </div>

                <?php if (!empty($errors['general'])): ?>
                    <div class="alert alert-error"><?= htmlspecialchars($errors['general']) ?></div>
                <?php endif; ?>

                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert <?= $_SESSION['message_type'] === 'error' ? 'alert-error' : 'alert-success' ?>">
                        <?= htmlspecialchars($_SESSION['message']) ?>
                    </div>
                    <?php
                    unset($_SESSION['message']);
                    unset($_SESSION['message_type']);
                    ?>
                <?php endif; ?>

                <form method="POST">
                    <div class="form-group">
                        <label for="name">Nombre completo</label>
                        <div class="input-wrapper">
                            <input value="<?= htmlspecialchars($inputs['name']) ?>" type="text" name="name" id="name"
                                   class="form-control <?= !empty($errors['name']) ? 'is-invalid' : '' ?>" required>
                            <?php if (!empty($errors['name'])): ?>
                                <div class="error-message"><?= htmlspecialchars($errors['name']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username">Nombre de usuario</label>
                        <div class="input-wrapper">
                            <input value="<?= htmlspecialchars($inputs['username']) ?>" type="text" name="username"
                                   id="username"
                                   class="form-control <?= !empty($errors['username']) ? 'is-invalid' : '' ?>" required>
                            <?php if (!empty($errors['username'])): ?>
                                <div class="error-message"><?= htmlspecialchars($errors['username']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <div class="input-wrapper">
                            <input value="<?= htmlspecialchars($inputs['email']) ?>" type="email" name="email"
                                   id="email"
                                   class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" required>
                            <?php if (!empty($errors['email'])): ?>
                                <div class="error-message"><?= htmlspecialchars($errors['email']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <hr class="section-divider">

                    <h3 class="section-title">Cambiar contraseña</h3>
                    <p class="section-info">Completa estos campos solo si deseas cambiar tu contraseña</p>

                    <div class="form-group">
                        <label for="current_password">Contraseña actual</label>
                        <div class="input-wrapper">
                            <input type="password" name="password" id="current_password"
                                   class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?>">
                            <?php if (!empty($errors['password'])): ?>
                                <div class="error-message"><?= htmlspecialchars($errors['password']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new_password">Nueva contraseña</label>
                        <div class="input-wrapper">
                            <input type="password" name="new_password" id="new_password"
                                   class="form-control <?= !empty($errors['new_password']) ? 'is-invalid' : '' ?>">
                            <?php if (!empty($errors['new_password'])): ?>
                                <div class="error-message"><?= htmlspecialchars($errors['new_password']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirmar contraseña</label>
                        <div class="input-wrapper">
                            <input type="password" name="confirm_password" id="confirm_password"
                                   class="form-control <?= !empty($errors['confirm_password']) ? 'is-invalid' : '' ?>">
                            <?php if (!empty($errors['confirm_password'])): ?>
                                <div class="error-message"><?= htmlspecialchars($errors['confirm_password']) ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block">Actualizar Datos</button>
                </form>
            </div>
        </div>
    </div>

<?php
include(__DIR__ . '/../layouts/_footer.php');
