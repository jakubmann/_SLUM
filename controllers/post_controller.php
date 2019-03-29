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

  public function edit($id) {
      $posts = new Posts();
      $post = $posts->getPost($id);
      $postdata = $post->getContent();
      $this->data['post_id'] = $id;
      if ($_SESSION['user_id'] == $postdata['author']) {
           parent::__construct();
          $this->view->render('layout', 'edit');
      }
      else {
          header('Location: /error');
      }
  }

  public function delete() {
      $posts = new Posts();
      $post = $posts->getPost($_POST['id']);
      $postdata = $post->getContent();
      if ($_SESSION['user_id'] == $postdata['author']) {
          $post->delete($_POST['id']);
      }
      else {
          header('Location: /error');
      }
  }

  public function getTitle() {
        $posts = new Posts();
        $post = $posts->getPost($_POST['id']);
        $postdata = $post->getContent();
        echo $postdata['title'];
  }

  public function getBody() {
      $posts = new Posts();
      $post = $posts->getPost($_POST['id']);
      $postdata = $post->getContent();
      echo $postdata['body'];
  }

  public function changeContent() {
      $this->post = new Post();
      if ($_POST) {
          $id = $_POST['id'];
          $title = $_POST['title'];
          $body = $_POST['body'];
          $this->post->edit($id, $title, $body);
      }
  }
}
