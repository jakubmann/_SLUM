<?php

class App {
  protected $router;
  public function run() {
    $this->router = new Router();
    Db::connect('127.0.0.1', 'slum', '5SbtycTh4R7a3nQp', 'slum');
  }
}
