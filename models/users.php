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
        $sql = 'SELECT username, id
                FROM users
                WHERE id IN (SELECT author FROM text)
                ORDER BY username ASC';
        $stmt = Db::getConn()->prepare($sql);

        if ($stmt->execute()) {
            $result = $stmt->fetchAll();
            $authors = array();
            foreach ($result as $row)
            {
                $authors[$row['username']] = $row['id'];
            }
            foreach ($authors as $author => $id)
            {
                $username = $author;
                $userid = $id;
                require 'template/top_three.phtml';
            }
        }
    }
}
