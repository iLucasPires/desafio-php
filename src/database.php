<?php
const DATABASE_NAME = 'database.db';
class Database
{
    private $db = null;
    private static $instance = null;

    private function __construct()
    {
        try {
            $this->db = new PDO('sqlite:' . DATABASE_NAME);
            $this->db->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT
            );
        } catch (PDOException $e) {
            
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->db;
    }
}
