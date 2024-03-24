<?php

class Database
{
    private ?PDO $db = null;
    private static ?Database $instance = null;

    private function __construct()
    {
        try {
            $this->db = new PDO('sqlite:../database.db');
            $this->db->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->db;
    }
}
