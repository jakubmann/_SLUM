<?php

class post_controller extends Controller {
  public function __construct() {
    $this->data['title'] = 'Post';
    $this->view = 'post';
  }
  public function show($id = null) {
    if ($id == null) {
      $this->redirect('error');
    }
    else {
      $this->model = new Posts();
      $post = $this->model->getPost($id);
      $this->data['content'] = $post->getContent();
      parent::__construct();
      $this->view->render('layout', 'post');
    }
  }
}
