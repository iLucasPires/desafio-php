<?php

class UserDTO
{
    public readonly int $id;
    public readonly string $email;
    public readonly string $password;
    public readonly string $createdAt;

    public function __construct(int $id, string $email, string $password, string $createdAt)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = $createdAt;
    }
}

class UserModel
{
    private PDO $db;

    private function createTable(): void
    {
        try {
            $this->db->exec('
                CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT NOT NULL,
                hashed_password TEXT NOT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            )');

        } catch (PDOException $e) {
            throw new Exception('Failed to create user table: ' . $e->getMessage());
        }
    }

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->createTable();
    }

    public function create($email, $password)
    {
        $stmt = $this->db->prepare('
            INSERT INTO users (email, hashed_password)
            VALUES (:email, :hashed_password)
        ');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([
            ":email" => $email,
            ":hashed_password" => $hashedPassword,
        ]);

        return $this->db->lastInsertId();
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([":email" => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }
        
        return [
            'id' => $user['id'],
            'email' => $user['email'],
            'hashed_password' => $user['hashed_password'],
            'created_at' => $user['created_at'],
        ];
    }
}
