<?php

include_once('../lib/app.php');
include_once('../lib/db.php');

session_start();

$app = App::getInstance();
$db = Db::getInstance();

//$db::connect('localhost', 'slum', '5SbtycTh4R7a3nQp', 'slum');
$db::connect("md39.wedos.net", "w213391_slum", "ftVhW2Dx", "d213391_slum");

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
                    $stmt = $db->getConn()->prepare(
                        'INSERT INTO confirm(userid, token, email)
                        VALUES (:userid, :token, :email)'
                    );
                    $userid = $db->getConn()->lastInsertId();
                    $token = hash('sha512', $reg_date . $email);
                    $stmt->bindParam(':userid', $userid);
                    $stmt->bindParam(':token', $token);
                    $stmt->bindParam(':email', $email);
                    if ($stmt->execute()) {
                        $link = "https://www.slumpoetry.cz/login/token/" . $token;

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
