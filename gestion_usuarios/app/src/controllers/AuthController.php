<?php
require_once __DIR__ . '/../Model/User.php';
require_once __DIR__ . '/../../config/bootstrap.php';

class AuthController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login($identifier, $password): bool
    {
        $user = $this->userModel->findByEmailOrUsername($identifier);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];
            return true;
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

    public function logout() : void
    {
        session_destroy();
        header('Location: /login');
        exit();
    }

}
