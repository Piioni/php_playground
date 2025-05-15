<?php
include(__DIR__ . '/../../../config/bootstrap.php');
include(__DIR__ . '/../../controllers/UserController.php');

// Validación de autorización
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    $_SESSION['message'] = 'No tienes permiso para realizar esta acción.';
    $_SESSION['message_type'] = 'error';
    header('Location: /homepage');
    exit();
}

// Verificar si se envió un ID de usuario válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = 'ID de usuario no válido.';
    $_SESSION['message_type'] = 'error';
    header('Location: /admin_dashboard');
    exit();
}

$userId = (int)$_GET['id'];

// Verificar que no se esté intentando eliminar al administrador
$userController = new UserController();
$userData = $userController->getUserById($userId);

if (!$userData) {
    $_SESSION['message'] = 'Usuario no encontrado.';
    $_SESSION['message_type'] = 'error';
    header('Location: /admin_dashboard');
    exit();
}

if ($userData['role'] === 'admin') {
    $_SESSION['message'] = 'No puedes eliminar un usuario administrador.';
    $_SESSION['message_type'] = 'error';
    header('Location: /admin_dashboard');
    exit();
}

// Si se confirma la eliminación
if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] === 'yes') {
    $success = $userController->deleteUser($userId);
    
    if ($success) {
        $_SESSION['message'] = 'Usuario eliminado correctamente.';
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = 'Error al eliminar el usuario.';
        $_SESSION['message_type'] = 'error';
    }
    
    header('Location: /admin_dashboard');
    exit();
}

// Si no se ha confirmado, mostrar la página de confirmación
include(__DIR__ . '/../../view/admin/confirm_delete.php');
