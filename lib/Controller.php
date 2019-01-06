<?php

abstract class Controller {
  protected $data = array();
  protected $view = "";

  public function renderView() {
    if ($this->view) {
      ob_start();
      extract($this->data);
      $template = 'views/template.phtml';
      $view_data = 'views/' . $this->view . '.phtml';
      require $template;
      ob_end_flush();
    }
  }

  public function redirect($url) {
    header('Location: /' . $url);
    header('Connection: close');
    exit;
  }
}
