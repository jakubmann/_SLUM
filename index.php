<?php
function autoload($class) {
  if (file_exists('lib/' . $class . '.php')) {
    require('lib/' . $class . '.php');
  }
}

spl_autoload_register('autoload');

Db::connect('127.0.0.1', 'slum', '5SbtycTh4R7a3nQp', 'slum');

$app = new App();
$app->run();
