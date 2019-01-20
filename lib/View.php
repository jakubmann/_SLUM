<?php

class View {

  public function __construct($data) {
    $this->data = $data;
  }

  public function render($layout = NULL, $file) {
    $filename = 'template/' . $file . '.phtml';
    extract($this->data);
    if (!is_null($layout)){
      $layout = 'template/' . $layout . '.phtml';
      require $layout;
    }
  }
}
