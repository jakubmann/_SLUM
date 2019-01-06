<?php
function autoload($class) {
  if (file_exists('lib/' . $class . '.php')) {
    require('lib/' . $class . '.php');
  }
}

spl_autoload_register('autoload');

$app = new App();
$app->run();
