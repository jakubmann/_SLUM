<?php

class User {
  public function __construct($username, $firstname, $lastname, $email, $reg_date, $id) {
    $this->username = $username;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->email = $email;
    $this->reg_date = $reg_date;
    $this->id = $id;
  }
  public function getInfo() {
    return array(
      'username' => $this->username,
      'firstname' => $this->firstname,
      'lastname' => $this->lastname,
      'email' => $this->email,
      'reg_date' => $this->reg_date,
      'id' => $this->id
    );
  }
}
