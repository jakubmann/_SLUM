<?php

class home_controller extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Home';
        $this->model = new Posts();
        $this->data['posts'] = $this->model->getPosts();
    }

    public function index()
    {
        parent::__construct();
        $this->view->render('layout', 'home');
        $this->view->model = $this->model;
    }

    public function submitPost()
    {
        $post = new Post();
        if ($_POST)
        {
            if (isset($_POST['body']) && isset($_POST['title'])) {
                if (isset($_SESSION['user_id'])) {
                    $title = $_POST['title'];
                    $body = $_POST['body'];

                    $post_date = date('Y-m-d H:i:s');
                    $post->submit($title, $body, $post_date);
                } else {
                    echo '3'; //not logged in
                }
            } else {
                echo '2'; //empty text field
            }
        }
    }
}
