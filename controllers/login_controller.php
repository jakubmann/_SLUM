<?php

class login_controller extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Login';
    }

    public function index()
    {
        parent::__construct();
        $this->view->render('layout', 'login');
    }

    public function login()
    {
        $user = new User();
        if ($_POST) {
                $username = trim($_POST['username']);
                $password = $_POST['password'];
                if (isset($_POST['token'])) {
                    $token = $_POST['token'];
                } else {
                    $token = null;
                }
                $user->login($username, $password, $token);
        }
    }
    public function logout() {
        $user = new User();
        $user->logout();
    }
}
