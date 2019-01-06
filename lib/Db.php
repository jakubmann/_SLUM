<?php

class Db {
  private static $conn;

  private static $settings = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    PDO::ATTR_EMULATE_PREPARES => false
  );

  public static function connect($host, $user, $password, $database) {
    if (!isset(self::$conn)) {
      self::$conn = new PDO (
        "mysql:host=$host;dbname=$database",
        $user,
        $password,
        self::$settings
      );
    }
  }

  public function getConn() {
    return self::$conn;
  }

  public static function query($sql, $parameters = array()) {
    $stmt = self::$conn->prepare($sql);
    $stmt->execute($parameters);
    return $stmt;
  }
}
