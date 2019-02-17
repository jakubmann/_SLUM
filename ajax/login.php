<?php

include_once('../lib/app.php');
include_once('../lib/db.php');

session_start();

$app = App::getInstance();
$db = Db::getInstance();

//$db::connect('localhost', 'slum', '5SbtycTh4R7a3nQp', 'slum');
$db::connect("md39.wedos.net", "w213391_slum", "ftVhW2Dx", "d213391_slum");

if ($_POST) {
    $input_username = trim($_POST['username']);
    $input_email = trim($_POST['username']);
    $password = $_POST['password'];
    $input_password = hash('SHA512', $password);
    $token = $_POST['token'];

    try {
        $result = $db->query(
            'SELECT * FROM users WHERE username = :username OR email = :email',
        array(
            ':email' => $input_email,
            ':username' => $input_username
        )
        );


        $row = $result->fetch(PDO::FETCH_ASSOC);
        $count = $result->rowCount();
        $userid = $row['id'];

        if (hash_equals($input_password, $row['password'])) {
            if ($row['status'] == "Y") {
                echo '1'; //success
                $_SESSION['user_id'] = $row['id'];
            }
            else {
                if (isset($_POST['token'])) {
                    $result = $db->query(
                        'SELECT * FROM confirm WHERE userid = :userid',
                    array(
                        ':userid' => $userid
                    )
                    );

                    $row = $result->fetch(PDO::FETCH_ASSOC);

                    if ($row['token'] == $token) {

                        $stmt = $db->getConn()->prepare("UPDATE users SET status = 'Y' WHERE id = :id;");
                        $stmt->bindParam(":id", $userid);

                        if ($stmt->execute()) {
                            echo '1'; //success
                            $_SESSION['user_id'] = $row['id'];
                        }
                        else {
                            echo 'Query couldn\'t execute.';
                        }
                    }
                    else {
                        echo '4';
                    }
                }
                else {
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
