<?php

class home_controller extends Controller {
  public function __construct() {
    $this->data['title'] = 'Home';
    $this->model = new Posts();
    $this->data['posts'] = $this->model->getPosts(3);
  }
  function index() {
    parent::__construct();
    $this->view->render('layout', 'home');
  }
}
