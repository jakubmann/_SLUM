<?php

class Post
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

    public function getAuthorName($id)
    {
        $result = Db::query('SELECT username FROM users WHERE id = :id', array(':id' => $id));
        foreach ($result as $row) {
            return $row['username'];
        }
    }

    private function formatTime()
    {
        return [
      'date' => date('j. n. Y', strtotime($this->post_date)),
      'time' => date('H:i', strtotime($this->post_date))
    ];
    }

    public function createPost($title, $body, $id, $author, $post_date)
    {
        $this->title = $title;
        $this->body = $body;
        $this->id = $id;
        $this->author = $author;
        $this->authorName = $this->getAuthorName($author);
        $this->post_date = $post_date;
    }

    public function getContent()
    {
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

    public function submit($title, $body, $post_date)
    {
        $stmt = Db::getConn()->prepare('SELECT * FROM text WHERE body = :body');
        $stmt->execute(array(':body' => $body));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (trim($body) == trim($row['body'])) {
            $plagiature = true;
        } else {
            $plagiature = false;
        }
        if (!$plagiature) {
            try {
                $stmt = Db::getConn()->prepare(
                    'INSERT INTO text(author, title, body, post_date)
                    VALUES(:author, :title, :body, :post_date)'
                );

                $title = htmlspecialchars($title);
                $body = htmlspecialchars($body);
                $post_date = htmlspecialchars($post_date);

                $stmt->bindParam(':author', $_SESSION['user_id']);

                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':body', $body);
                $stmt->bindParam(':post_date', $post_date);
                if ($stmt->execute()) {
                    echo '0';
                } else {
                    echo '4'; //not posted
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            echo '1'; //plagiature
        }
    }

    public function render($isMobile)
    {
        $postdata = $this->getcontent();
        if ($isMobile) {
            $chars = 500;
        }
        else {
            $chars = 1000;
        }
        if (strlen($postdata['body']) > $chars) {
            $postdata['body'] = $this->trim_text($postdata ['body'], $chars);
            $postdata['readmore'] = true;
        }
        else {
            $postdata['readmore'] = false;
        }
        require 'template/post.phtml';
    }

    public function edit($id, $title, $body) {
        $stmt = Db::getConn()->prepare(
            'UPDATE text SET title = :title, body=:body WHERE id=:id'
        );

        $title = htmlspecialchars($title);
        $body = htmlspecialchars($body);

        if ($stmt->execute(array(':title' => $title, ':body' => $body, ':id' => $id))) {
            echo '0';
        }
    }

    public function delete($id) {
        $stmt = Db::getConn()->prepare(
            'DELETE FROM text WHERE id = :id'
        );

        if ($stmt->execute(array(':id' => $id))) {
            echo '0';
        }

    }
}
