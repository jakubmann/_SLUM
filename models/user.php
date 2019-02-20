<?php

class User
{
    public function createUser($username, $firstname, $lastname, $email, $reg_date, $id)
    {
        $this->username = $username;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->reg_date = $reg_date;
        $this->id = $id;
    }

    public function getInfo()
    {
        return array(
      'username' => $this->username,
      'firstname' => $this->firstname,
      'lastname' => $this->lastname,
      'email' => $this->email,
      'reg_date' => $this->reg_date,
      'id' => $this->id
    );
    }

    public function login($username, $password, $token = null)
    {
        $password = hash('sha512', $password);
        try {
            $result = Db::query(
                'SELECT * FROM users WHERE username = :username OR email = :email',
            array(
                ':email' => $username,
                ':username' => $username
            )
            );


            $row = $result->fetch(PDO::FETCH_ASSOC);
            $count = $result->rowCount();
            $userid = $row['id'];

            if ($count > 0 && hash_equals($password, $row['password'])) {
                if ($row['status'] == "Y") {
                    echo '1'; //success
                    $_SESSION['user_id'] = $row['id'];
                } else {
                    if (isset($token)) {
                        $result = Db::query(
                            'SELECT * FROM confirm WHERE userid = :userid',
                        array(
                            ':userid' => $userid
                        )
                        );

                        $row = $result->fetch(PDO::FETCH_ASSOC);

                        if ($row['token'] == $token) {
                            $stmt = Db::getConn()->prepare("UPDATE users SET status = 'Y' WHERE id = :id;");
                            $stmt->bindParam(":id", $userid);

                            if ($stmt->execute()) {
                                echo '1'; //success
                                $_SESSION['user_id'] = $row['id'];
                            } else {
                                echo 'Query couldn\'t execute.';
                            }
                        } else {
                            echo '4';
                        }
                    } else {
                        echo '3';
                    }
                }
            } else {
                echo '2'; //error
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
    }

    public function register($username, $firstname, $lastname, $email, $password, $reg_date)
    {
        try {
            $result = Db::query(
            'SELECT * FROM users WHERE email = :email',
            array(
                ':email' => $email
                )
            );

            $count = $result->rowCount();

            if ($count == 0) {
                $result = Db::query('SELECT * FROM users WHERE username = :username', array(':username' => $username));
                $count = $result->rowCount();

                if ($count == 0) {
                    $stmt = Db::getConn()->prepare(
              'INSERT INTO users(username, firstname, lastname, email, password, reg_date)
              VALUES(:username, :firstname, :lastname, :email, :password, :reg_date)'
            );
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':firstname', $firstname);
                    $stmt->bindParam(':lastname', $lastname);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':reg_date', $reg_date);

                    if ($stmt->execute()) {
                        $stmt = Db::getConn()->prepare(
                            'INSERT INTO confirm(userid, token, email)
                            VALUES (:userid, :token, :email)'
                        );
                        $userid = Db::getConn()->lastInsertId();
                        $token = hash('sha512', $reg_date . $email);
                        $stmt->bindParam(':userid', $userid);
                        $stmt->bindParam(':token', $token);
                        $stmt->bindParam(':email', $email);
                        if ($stmt->execute()) {
                            $link = "https://www.slumpoetry.cz/login?token=" . $token;

                            $to = $email;
                            $message = "Confirm your email here: " . $link;
                            $subject = 'Your registration at www.slumpoetry.cz';
                            $headers = 'From: slum@slumpoetry.cz' . "\r\n" .
                                'Reply-To: support@slumpoetry.cz' . "\r\n" .
                                'X-Mailer: PHP/' . phpversion();
                            mail($to, $subject, $message, $headers);

                            echo 'registered';
                        } else {
                            echo 'Query couldn\'t execute!';
                        }
                    } else {
                        echo 'Query couldn\'t execute!';
                    }
                } else {
                    echo '2';
                }
            } else {
                echo '1'; //email not available
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
