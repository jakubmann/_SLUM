<?php

class Admin {
    public function __construct() {
        if (isset($_SESSION['user_id'])) {
            $result = Db::query(
                'SELECT * FROM users WHERE id = :userid',
            array(
                    ':userid' => $_SESSION['user_id']
                )
            );

            $row = $result->fetch(PDO::FETCH_ASSOC);
            if ($row['class'] == '1') {
                $_SESSION['admin'] = true;
            }
            else {
                $_SESSION['admin'] = false;
            }
        }
    }

    public function submissions() {
        if (isset($_SEESION['admin']) && $_SESSION['admin'] == true) {
            $sql = "SELECT * FROM submission";
            $stmt = Db::getConn()->prepare($sql);
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                $submissions = array();
                foreach($result as $row) {
                    $submission = new Submission();
                    $submission->createSubmission($row['id'], $row['subject'], $row['description'], $row['status']);
                    array_push($submissions, $submission);
                }
                return $submissions;
            }
        }
        else {
            echo "Not logged in.";
        }
    }

}
