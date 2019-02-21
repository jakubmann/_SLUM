<?php

class Admin {

    public function __construct() {
        $this->passwords = array(
            'Jakub' => hash('sha512', 'okurka')
        );
    }

    public function login($password) {
        if (in_array($password, $this->passwords)) {
            $_SESSION['admin'] = true;
        }
        else {
            echo "Bad Login";
        }
    }

    public function submissions() {
        if ($_SESSION['admin']) {
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
