<?php

class error_controller extends Controller {
  public function __construct() {
    $this->data['title'] = 'Error 404';
    $this->view = 'error';
  }
}
