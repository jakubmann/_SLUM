<?php

include_once('../lib/app.php');
include_once('../lib/db.php');

session_start();

$app = App::getInstance();
$db = Db::getInstance();
$db::connect('localhost', 'slum', '5SbtycTh4R7a3nQp', 'slum');

if ($_POST) {
    $input_username = trim($_POST['username']);
    $input_email = trim($_POST['username']);
    $input_password = hash('SHA512', $_POST['password']);

    try {
        $result = $db->query('SELECT * FROM users WHERE username = :username OR email = :email',
        array(
            ':email' => $input_email,
            ':username' => $input_username
        ));


        $row = $result->fetch(PDO::FETCH_ASSOC);
        $count = $result->rowCount();

        if (hash_equals($input_password, $row['password'])) {
            echo '1'; //success
            $_SESSION['user_id'] = $row['id'];
        }
        else {
            echo '2'; //error
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
}
