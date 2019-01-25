<?php

class post_controller extends Controller {
  public function __construct() {
    $this->data['title'] = 'Post';
  }
  public function id($id = null) {
    if ($id == null) {
      $this->redirect('error');
    }
    else {
      $posts = new Posts();
      $post = $posts->getPost($id);
      $this->data['content'] = $post->getContent();
      parent::__construct();
      $this->view->render('layout', 'singlepost');
    }
  }
}
