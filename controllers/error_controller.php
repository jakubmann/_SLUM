<?php

class error_controller extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Error 404';
        $this->data['message'] = 'Error 404';
        parent::__construct();
        $this->view->render('layout', 'error');
        exit();
    }
}
