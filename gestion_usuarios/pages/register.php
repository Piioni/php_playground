<?php
include(__DIR__ . '/../src/config/bootstrap.php');
require_once __DIR__ . '/../src/controllers/AuthController.php';

$auth = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($auth->register($nombre, $username, $email, $password)) {
        header('Location: ' . route('/pages/login'));
        exit();
    } else {
        $error = 'El email o el nombre de usuario ya están en uso.';
    }
}

$title = 'Register';
include(__DIR__ . '/../src/view/layouts/_header.php');
?>

<h1> Registro de usuarios </h1>
<div class="container">
    <form method="post">
        <div>
            <label for="nombre">
                Nombre:
            </label>
            <input type="text" id="nombre" name="nombre">
        </div>
        <div>
            <label for="email">
                Email:
            </label>
            <input type="email" id="email" name="email">
        </div>
        <div>
            <label for="password">
                Contraseña:
            </label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit">Registrar</button>
    </form>
    <p> Ya tienes cuenta? <a href="login.php">¡Inicia session aquí! </a></p>
</div>

<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>


<?php
include(__DIR__ . '/../src/view/layouts/_footer.php');