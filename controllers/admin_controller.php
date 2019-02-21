<?php

class admin_controller extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Admin';
        $this->admin = new Admin();
    }
    public function login($password)
    {
        $this->admin->login($password);
        echo "Logged in.";
    }
    public function submissions()
    {
        $this->data['submissions'] = $this->admin->submissions();
        parent::__construct();
        $this->view->render(null, 'submissions');
    }

    public function resolve()
    {
        if ($_POST) {
            $submission = new Submission();
            $submission->resolve($_POST['outcome'], $_POST['id']);
        }
        else {
            echo 'error';
        }
    }

    public function delete()
    {
        if ($_POST) {
            $submission = new Submission();
            $submission->delete($_POST['id']);
        }
    }
}
