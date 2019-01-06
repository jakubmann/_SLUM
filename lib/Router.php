<?php
function classLoader($class) {
  if (preg_match('/_controller/', $class)) {
    require('controllers/' . $class . '.php');
  } 
}

spl_autoload_register('classLoader');

class Router {
  public function __construct() {
    //URL handling
    $url = isset($_GET['url']) ? $_GET['url'] : null;
    $url = rtrim($url, '/');
    $url = explode('/', $url);
    print_r($url);

    //setting variables
    $name = $url[0];
    if (isset($url[1])) {
      $method = $url[1];
      if (isset($url[2])) {
        $arg = $url[2];
      }
    }

    //creating a controller
    if (!empty($name)) {
      $name = $name . '_controller';
      $path = 'controllers/' . $name . '.php';
      if (file_exists($path)) {
        $controller = new $name();
      }
      else {
        $controller = new error_controller();
        $controller->renderView();
        exit;
      }
      if (isset($method)) {
        if (method_exists($controller, $method)) {
          if (isset($arg)) {
            $controller->{$method}($arg);
          }
          else {
            $controller->{$method}();
          }
        }
      }
    }
    else {
      $controller = new home_controller();
    }
    $controller->renderView();
  }
}
