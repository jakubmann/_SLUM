<?php

class Posts
{
    private function trim_text($input, $length, $ellipses = true, $strip_html = true)
    {
        if ($strip_html) {
            $input = strip_tags($input);
        }

        if (strlen($input) <= $length) {
            return $input;
        }

        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);

        if ($ellipses) {
            $trimmed_text .= '...';
        }

        return $trimmed_text;
    }
    
    public function getPosts($postCount)
    {
        $posts = array();
        $sql = 'SELECT title, body, id, author, post_date
    FROM text
    ORDER BY post_date DESC
    LIMIT :count';

        $parameters = array(
      ':count' => $postCount
    );

        $stmt = Db::query($sql, $parameters);

        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            $body = $this->trim_text($row['body'], 1000);
            $post = new Post($row['title'], $body, $row['id'], $row['author'], $row['post_date']);
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
                $post = new Post($row['title'], $row['body'], $row['id'], $row['author'], $row['post_date']);
            }
            return $post;
        }
    }
}
