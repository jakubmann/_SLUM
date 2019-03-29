<?php

class Posts
{
    public function getPages($postCount)
    {
        $sql = "SELECT COUNT(*) FROM text";
        $stmt = Db::getConn()->prepare($sql);
        if ($stmt->execute()) {
            $result = $stmt->fetchAll();
            return ceil($result[0][0] / $postCount);
        }
    }

    public function getPosts($postCount = null, $previousCount = null)
    {
        $posts = array();
        if (!is_null($postCount)) {
            if (!is_null($previousCount)) {
               $sql = 'SELECT title, body, id, author, post_date
               FROM text
               ORDER BY post_date DESC
               LIMIT :previous, :count';

               $parameters = array(
                   ':previous' => $previousCount,
                   ':count' => $postCount
               );

               $stmt = Db::query($sql, $parameters);
            }
            else {
                $sql = 'SELECT title, body, id, author, post_date
                FROM text
                ORDER BY post_date DESC
                LIMIT :count';

                $parameters = array(
                  ':count' => $postCount
                );

                $stmt = Db::query($sql, $parameters);
            }
        }
        else {
            $sql = 'SELECT title, body, id, author, post_date
            FROM text
            ORDER BY post_date DESC';

            $stmt = Db::query($sql);
        }


        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            $body = $row['body'];
            $post = new Post();
            $post->createPost($row['title'], $body, $row['id'], $row['author'], $row['post_date']);
            array_push($posts, $post);
        }
        return $posts;
    }

    public function getUserPosts($userid) {
        $posts = array();

        $sql = 'SELECT title, body, id, author, post_date
            FROM text
            WHERE author = :userid
            ORDER BY post_date DESC';

        $parameters = array(
          ':userid' => $userid
        );

        $stmt = Db::query($sql, $parameters);

        $result = $stmt->fetchAll();

        foreach ($result as $row) {
            $body = $row['body'];
            $post = new Post();
            $post->createPost($row['title'], $body, $row['id'], $row['author'], $row['post_date']);
            array_push($posts, $post);
        }
        return $posts;
    }

    public function getPost($id)
    {
        $sql = 'SELECT title, body, id, author, post_date
    FROM text
    WHERE id = :id';

        $parameters = array(
            ':id' => $id
        );

        $result = Db::query($sql, $parameters);
        if ($result->rowCount() == 0) {
            header('Location: /error');
            header('Connection: close');
            exit;
        } else {
            $result = $result->fetchAll();

            foreach ($result as $row) {
                $post = new Post();
                $post->createPost($row['title'], $row['body'], $row['id'], $row['author'], $row['post_date']);
            }
            return $post;
        }
    }
}
