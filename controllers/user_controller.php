<?php

class user_controller extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'User';
        $this->model = new Users();
    }
    public function id($id)
    {
        $this->data['user'] = $this->model->getUser($id)->getInfo();
        parent::__construct();
        $this->view->render('layout', 'user');
    }
}
