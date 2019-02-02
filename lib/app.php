<?php

class App
{
    private static $instance = null;
    protected static $router;

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
            self::$instance = new App();
        }
        return self::$instance;
    }
    public function run()
    {
        self::$router = Router::getInstance();
    }
    public function getRouter()
    {
        return self::$router;
    }
}
