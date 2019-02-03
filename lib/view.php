<?php

class View
{
    private $controller;
    public function __construct($data, $controller, $model = null)
    {
        $this->data = $data;
        $this->controller = $controller;
        $this->model = $model;
    }

    public function render($layout = null, $file)
    {
        $filename = 'template/' . $file . '.phtml';
        extract($this->data);
        if (!is_null($layout)) {
            $layout = 'template/' . $layout . '.phtml';
            require $layout;
        } else {
            $layout = 'template/layout_none.phtml';
            require $layout;
        }
    }
}
