<?php

class Database
{
    private ?PDO $db = null;
    private static ?Database $instance = null;

    private function __construct()
    {
        $dbHost = getenv('DB_HOST');
        $dbPort = getenv('DB_PORT');
        $dbDatabase = getenv('DB_DATABASE');
        $dbUsername = getenv('DB_USERNAME');
        $dbPassword = getenv('DB_PASSWORD');

        try {
     
            $dns = "pgsql:host=$dbHost;port=$dbPort;dbname=$dbDatabase";

            $this->db = new PDO($dns, $dbUsername, $dbPassword);
            
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("USE $dbDatabase");
            $this->db->exec("SET NAMES utf8");
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
