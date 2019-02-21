<?php

class Users
{
    public function getUser($id)
    {
        $sql = 'SELECT username, firstname, lastname, email, reg_date, id
                FROM users
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
                $user = new User();
                $user->createUser($row['username'], $row['firstname'], $row['lastname'], $row['email'], $row['reg_date'], $row['id']);
            }
            return $user;
        }
    }

    public function getUsersByPosts()
    {
        $post = new Post();
        $sql = 'SELECT author, post_date
                FROM text
                WHERE post_date > :now';
        $stmt = Db::getConn()->prepare($sql);

        $twoweeks = (date("Y-m-d H:i:s", strtotime('-1month')));

        $stmt->bindParam(':now', $twoweeks);


        if ($stmt->execute()) {
            $result = $stmt->fetchAll();
            $authors = array();
            foreach ($result as $row)
            {
                array_push($authors, $row['author']);
            }
            $best = array_count_values($authors);
            arsort($best);
            $i = 0;
            foreach ($best as $user => $count)
            {
                $i++;
                $username = $post->getAuthorName($user);
                $userid = $user;
                require 'template/top_three.phtml';
                if ($i >= 3)
                {
                    break;
                }
            }
        }
    }
}
