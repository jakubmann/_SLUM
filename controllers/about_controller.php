<?php

class about_controller extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'About';
    }

    public function index()
    {
        parent::__construct();
        $this->view->render('layout', 'about');
    }
    public function submit()
    {
        if ($_POST) {
            $submission = new Submission();
            $submission->submit($_POST['subject'], $_POST['description']);
         }
    }
}
