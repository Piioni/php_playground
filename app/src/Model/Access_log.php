<?php
require_once __DIR__ . '/Database.php';
class Access_log
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function create($user_id, $identifier, $ip_address, $result): bool {
        $stmt = $this->pdo->prepare("INSERT INTO access_log (user_id, identifier, ip, result) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$user_id, $identifier, $ip_address, $result]);
    }

}