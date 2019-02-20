<?php
include_once('../lib/app.php');
include_once('../lib/db.php');

session_start();

$app = App::getInstance();
$db = Db::getInstance();

$db::connect('localhost', 'slum', '5SbtycTh4R7a3nQp', 'slum');
//$db::connect("md39.wedos.net", "w213391_slum", "ftVhW2Dx", "d213391_slum");

if ($_POST) {
    $title = $_POST['title'];
    $body = $_POST['body'];

    $post_date = date('Y-m-d H:i:s');
    if (isset($_POST['body']) && isset($_POST['title'])) {
        if (isset($_SESSION['user_id'])) {
            $stmt = $db->getConn()->prepare('SELECT * FROM text WHERE body = :body');
            $stmt->execute(array(':body' => $body));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (trim($body) == trim($row['body'])) {
                $plagiature = true;
            } else {
                $plagiature = false;
            }
            if (!$plagiature) {
                try {
                    $stmt = $db->getConn()->prepare(
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
        else {
            echo '3'; //not logged in
        }
    } else {
        echo '2'; //empty text field
    }
}
