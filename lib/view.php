<?php

class View {
  private $controller;
  public function __construct($data, $controller) {
    $this->data = $data;
    $this->controller = $controller;
  }

  public function render($layout = NULL, $file) {
    $filename = 'template/' . $file . '.phtml';
    extract($this->data);
    if (!is_null($layout)){
      $layout = 'template/' . $layout . '.phtml';
      require $layout;
    }
    else {
        $layout = 'template/layout_none.phtml';
        require $layout;
    }
  }
}
