<?php

class Users {

  public function getUser($id) {
    $sql = 'SELECT username, firstname, lastname, email, reg_date, id
    FROM users
    WHERE id = :id';

    $parameters = array(
      ':id' => $id
    );

    $result = Db::query($sql, $parameters);
    if ($result->rowCount() == 0) {
      header('Location: /error' );
      header('Connection: close');
      exit;
    }
    else {
      $result = $result->fetchAll();
      foreach ($result as $row) {
        $user = new User($row['username'], $row['firstname'], $row['lastname'], $row['email'], $row['reg_date'], $row['id']);
      }
      return $user;
    }
  }
}
