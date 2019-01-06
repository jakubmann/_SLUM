<?php

class home_controller extends Controller {
  public function __construct() {
    $this->data['title'] = 'Home';
    $this->view = 'home';
  }
}
