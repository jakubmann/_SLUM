<?php
function autoload($class) {
  if (file_exists('lib/' . strtolower($class) . '.php')) {
    require('lib/' . strtolower($class) . '.php');
  }
}

spl_autoload_register('autoload');

Db::connect('localhost', 'slum', '5SbtycTh4R7a3nQp', 'slum');

$app = new App();
$app->run();
$router = $app->getRouter();

