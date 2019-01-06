<?php

class Posts {
  public function getPosts($postCount) {
    $posts = array();
    $sql = 'SELECT id, title, body
    FROM text
    ORDER BY post_date DESC
    LIMIT :count';

    $parameters = array(
      ':count' => $postCount
    );

    $stmt = Db::query($sql, $parameters);

    $result = $stmt->fetchAll();
    foreach ($result as $row) {
      $post = new Post($row['title'], $row['body']);
      array_push($posts, $post);
    }
    return $posts;
  }

  public function getPost($id) {
    $sql = 'SELECT id, title, body
    FROM text
    WHERE id = :id';

    $parameters = array(
      ':id' => $id
    );

    $stmt = Db::query($sql, $parameters);

    $result = $stmt->fetchAll();
    foreach ($result as $row) {
      $post = new Post($row['title'], $row['body']);
    }
    return $post;
  }
}
