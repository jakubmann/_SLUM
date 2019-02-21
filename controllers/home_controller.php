<?php

class home_controller extends Controller
{
    public function __construct()
    {
        $this->data['title'] = 'Home';
        $this->model = new Posts();
        $this->data['posts'] = $this->model->getPosts(3);
    }

    public function pageNumber()
    {
        if ($_POST) {
            echo $this->model->getPages($_POST['postCount']);
        }
    }

    public function index()
    {
        parent::__construct();
        $this->view->render('layout', 'home');
        $this->view->model = $this->model;
    }

    public function posts()
    {
        if ($_POST)
        {
            $postCount = $_POST['postCount'];
            $previousCount = $_POST['previousCount'];
            $posts = $this->model->getPosts($postCount, $previousCount);
            if (count($posts) > 0) {
                ob_start();
                foreach($posts as $post)
                {
                    $post->render();
                }
                ob_end_flush();
            }
        }
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

    public function bestUsers()
    {
        $this->users = new Users();
        $this->users->getUsersByPosts();
    }
}
