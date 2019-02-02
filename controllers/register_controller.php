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
        $this->view->render(null, 'register');
    }
}
