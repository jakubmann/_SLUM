<?php

class Db
{
    private static $conn;
    private static $instance = null;

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new Exception('Serialization not supported.');
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    private static $settings = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_EMULATE_PREPARES => false
  );

    public static function connect($host, $user, $password, $database)
    {
        if (!isset(self::$conn)) {
            try {
                self::$conn = new PDO(
                "mysql:host=$host;dbname=$database",
                $user,
                $password,
                self::$settings
            );
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    public function getConn()
    {
        return self::$conn;
    }

    public static function query($sql, $parameters = array())
    {
        if (self::$conn) {
            $stmt = self::$conn->prepare($sql);
            $stmt->execute($parameters);
            return $stmt;
        }
    }
}
