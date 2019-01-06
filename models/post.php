<?php

class Post {
  public function __construct($title, $body) {
    $this->title = $title;
    $this->body = $body;
  }
  public function getContent() {
    return array(
      'title' => $this->title,
      'body' => $this->body
    );
  }
}
