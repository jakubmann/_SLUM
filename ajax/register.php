<?php

include_once('../lib/app.php');
include_once('../lib/db.php');

session_start();

$app = App::getInstance();
$db = Db::getInstance();
$db::connect('localhost', 'slum', '5SbtycTh4R7a3nQp', 'slum');

if ($_POST) {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = hash('SHA512', $_POST['password']);
    $reg_date = date('Y-m-d H:i:s');

    try {
        $result = $db->query(
        'SELECT * FROM users WHERE email = :email',
    array(
        ':email' => $email
    )
    );
        $count = $result->rowCount();

        if ($count == 0) {
            $result = $db->query('SELECT * FROM users WHERE username = :username', array(':username' => $username));
            $count = $result->rowCount();

            if ($count == 0) {
                $stmt = $db->getConn()->prepare(
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
                    echo 'registered';
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
