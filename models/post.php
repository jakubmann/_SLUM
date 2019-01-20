<?php

class Post {
  private function getAuthorName($id) {
    $result = Db::query('SELECT firstname, lastname FROM users WHERE id = :id', array(':id' => $id));
    foreach($result as $row) {
      return $row['firstname'] . ' ' . $row['lastname'];
    }
  }

  public function __construct($title, $body, $id, $author) {
    $this->title = $title;
    $this->body = $body;
    $this->id = $id;
    $this->author = $author;
    $this->authorName = $this->getAuthorName($author);
  }
  public function getContent() {
    return array(
      'title' => $this->title,
      'body' => $this->body,
      'id' => $this->id,
      'author' => $this->author,
      'authorName' => $this->authorName
    );
  }
}
