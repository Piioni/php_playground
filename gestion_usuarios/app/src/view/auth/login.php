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

    <h1>Login</h1>
    <div>
        <form method="post">
            <div>
                <label for="identifier">
                    Email or Username:
                </label>
                <input type="text" id="identifier" name="identifier">
            </div>
            <div>
                <label for="password">
                    Password:
                </label>
                <input type="password" id="password" name="password">
            </div>
            <button type="submit">Login</button>
        </form>
        <p> Don't have an account? <a href=<?= route("/register") ?>>>Register here!</a></p>
    </div>

<?php
include(__DIR__ . '/../layouts/_footer.php');