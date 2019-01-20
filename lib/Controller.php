<?php

abstract class Controller {
  protected $data = array();
  protected $view;
  protected $model;

  public function __construct() {
    if (isset($this->data)) {
      $this->view = new View($this->data);
    }
  }

  public function redirect($url) {
    header('Location: /' . $url);
    header('Connection: close');
    exit;
  }
}
