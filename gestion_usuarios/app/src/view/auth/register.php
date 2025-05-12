<?php
include(__DIR__ . '/../../../config/bootstrap.php');
require_once __DIR__ . '/../../controllers/AuthController.php';
require_once __DIR__ . '/../../../config/config.php';

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
        header('Location: ' . route("/login"));
        exit();
    } else {
        $error = 'El email o el nombre de usuario ya están en uso.';
    }
}

$title = 'Register';
include(__DIR__ . '/../layouts/_header.php');
?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Registro</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            <div class="mb-3">
                                <label for="username" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirmar contraseña</label>
                                <input type="password" class="form-control" id="confirm_password"
                                       name="confirm_password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Registrarse</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>


<?php
include(__DIR__ . '/../layouts/_footer.php');