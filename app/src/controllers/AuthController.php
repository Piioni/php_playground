<?php
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../../config/bootstrap.php';
require_once __DIR__ . '/../Model/Access_log.php';

class AuthController
{
    private User $userModel;
    private Access_log $accessLogModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->accessLogModel = new Access_log();
    }

    public function login($identifier, $password): bool
    {
        $user = $this->userModel->findByEmailOrUsername($identifier);

        if (!$user) {
            $this->accessLogModel->create(null, $identifier, $_SERVER['REMOTE_ADDR'], 0);
            return false; // Usuario no encontrado
        }

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];

            // Verificar que la contraseña necesite re hash
            if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $this->userModel->updatePassword($user['id'], $newHash);
            }

            // Registrar el acceso exitoso
            $this->accessLogModel->create($user['id'], $identifier, $_SERVER['REMOTE_ADDR'], 1);
            return true;
        } else {
            $this->accessLogModel->create($user['id'], $identifier, $_SERVER['REMOTE_ADDR'], 0);
        }
        return false;
    }

    public function register($nombre, $username, $email, $password): bool
    {
        if ($this->userModel->findByEmail($email) || $this->userModel->findByUsername($username)) {
            return false; // El email o el nombre de usuario ya están en uso
        }
        return $this->userModel->create($nombre, $username, $email, $password);
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function logout() : void
    {
        session_destroy();
        header('Location: /login');
        exit();
    }

}
