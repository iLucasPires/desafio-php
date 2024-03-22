<?php

require_once '../database.php';

class UserDTO
{
    public readonly int $id;
    public readonly string $name;
    public readonly string $email;
    public readonly string $password;
    public readonly string $created_at;
}

class User
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db->getConnection();
        $this->createTable();
    }
    
    private function createTable()
    {
        $this->db->exec('CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            hashed_password TEXT NOT NULL,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP
        )');
    }


    public function addUsers(UserDTO $user)
    {
        $query = 'INSERT INTO users (name, email, hashed_password) VALUES (:name, :email, :hashed_password)';
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':name' => $user->name,
            ':email' => $user->email,
            ':hashed_password' => password_hash($user->password, PASSWORD_DEFAULT)
        ]);
    }
}
