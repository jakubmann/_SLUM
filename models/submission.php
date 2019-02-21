<?php

class Submission {

    public function createSubmission($id, $subject, $description, $status) {
        $this->id = $id;
        $this->subject = $subject;
        $this->description = $description;
        $this->status = $status;
    }


    public function getContent()
    {
        return array(
            'id' => $this->id,
            'subject' => $this->subject,
            'description' => $this->description,
            'status' => $this->status
        );
    }

    public function submit($subject, $description) {
        try {
            $sql = "INSERT INTO submission(subject, description)
                    VALUES (:subject, :description)";
            $stmt = Db::getConn()->prepare($sql);
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':description', $description);
            if ($stmt->execute()) {
                echo "1";
            }
            else {
                echo "2";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function render() {
        $submission = $this->getContent();
        require 'template/submission.phtml';
    }

    public function resolve($outcome, $id) {
        if ($outcome == "0") {
            $sql = "UPDATE submission SET status = '0' WHERE submission.id = :id;";
        }
        else if ($outcome == "1") {
            $sql = "UPDATE submission SET status = '1' WHERE submission.id = :id;";
        }
        else {
            echo "2"; //bad input
        }
        $stmt = Db::query($sql, array(':id' => $id));
        if ($stmt->execute()) {
            echo '1';
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM submission WHERE submission.id = :id";
        $stmt = Db::getConn()->prepare($sql);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            echo '1';
        }
    }
}
