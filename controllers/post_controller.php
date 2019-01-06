<?php

class post_controller extends Controller {
  public function __construct() {
    $this->data['title'] = 'Post';
    $this->view = 'post';
  }
  public function id($id = null) {
    if ($id == null) {
      $this->redirect('error');
    }
    else {
      $posts = new Posts();
      $post = $posts->getPost($id);
      $this->data['content'] = $post->getContent();
    }
  }
}
