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
}
