<?php

class Post {
  private function getAuthorName($id) {
    $result = Db::query('SELECT firstname, lastname FROM users WHERE id = :id', array(':id' => $id));
    foreach($result as $row) {
      return $row['firstname'] . ' ' . $row['lastname'];
    }
  }

  private function formatTime() {
    return [
      'date' => date('j. n. Y',strtotime($this->post_date)),
      'time' => date('H:i',strtotime($this->post_date))
    ];
  }

  public function __construct($title, $body, $id, $author, $post_date) {
    $this->title = $title;
    $this->body = $body;
    $this->id = $id;
    $this->author = $author;
    $this->authorName = $this->getAuthorName($author);
    $this->post_date = $post_date;
  }
  public function getContent() {
    return array(
      'title' => $this->title,
      'body' => $this->body,
      'id' => $this->id,
      'author' => $this->author,
      'authorName' => $this->authorName,
      'post_date'=> $this->formatTime($this->post_date)['date'],
      'post_time'=> $this->formatTime($this->post_date)['time']
    );
  }
}
