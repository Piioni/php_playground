<?php
require_once __DIR__ . '/../Model/User.php';

class UserController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();

    }

    public function getAllUsers(): array
    {
        return $this->userModel->findAll();
    }

    public function getUserById($id)
    {
        return $this->userModel->findById($id);
    }

    public function updateUser($id, $name, $username, $email): bool
    {
        return $this->userModel->update($id, $name, $username, $email);
    }

    public function updateUserPassword($id, $password): bool
    {
        return $this->userModel->updatePassword($id, $password);
    }

    public function deleteUser($id): bool
    {
        return $this->userModel->delete($id);
    }
}
