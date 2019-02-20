<?php

class Post
{
    private function getAuthorName($id)
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
}
