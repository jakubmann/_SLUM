<?php
session_start();
function autoload($class) {
  if (file_exists('lib/' . strtolower($class) . '.php')) {
    require('lib/' . strtolower($class) . '.php');
  }
}

spl_autoload_register('autoload');

//Db::connect('localhost', 'slum', '5SbtycTh4R7a3nQp', 'slum');
Db::connect("md39.wedos.net", "w213391_slum", "ftVhW2Dx", "d213391_slum");

$app = new App();
$app->run();
$router = $app->getRouter();
