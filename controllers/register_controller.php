<?php

class register_controller extends Controller
{
    public function __construct()
    { 
        $this->data['title'] = 'Register';
    }

    public function index()
    {
        parent::__construct();
        $this->view->render('layout', 'register');
    }

    public function register()
    {
        $user = new User();
        if ($_POST) {
            $username = $_POST['username'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = hash('SHA512', $_POST['password']);
            $reg_date = date('Y-m-d H:i:s');

            $user->register($username, $firstname, $lastname, $email, $password, $reg_date);
        }
    }
}
