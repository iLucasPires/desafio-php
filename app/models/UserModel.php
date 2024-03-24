<?php

class UserCreateDTO
{
    public readonly string $email;
    public readonly string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}

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
    static public function createTable(): void
    {
        try {
            $db = Database::getConnection();
            $db->exec('CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT NOT NULL,
                hashed_password TEXT NOT NULL,
                created_at TEXT DEFAULT CURRENT_TIMESTAMP
            )');
        } catch (PDOException $e) {
            throw new Exception('Failed to create table: ' . $e->getMessage());
        }
    }

    static public function createUser(UserCreateDTO $user): bool
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare('INSERT INTO users (email, hashed_password) VALUES (:email, :hashed_password)');
            $stmt->execute([
                ':email' => $user->email,
                ':hashed_password' => $user->password
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception('Failed to create user: ' . $e->getMessage());
        }
    }

    static public function getUserByEmail(string $email): ?UserDTO
    {
        try {
            $db = Database::getConnection();
            $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->execute([':email' => $email]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$userData) {
                return null;
            }

            return new UserDTO(
                $userData['id'],
                $userData['email'],
                $userData['hashed_password'],
                $userData['created_at']
            );
        } catch (PDOException $e) {
            echo 'Failed to fetch user: ' . $e->getMessage();
            return null;
        }
    }
}
