<?php 

namespace m4\wordMaster\controllers;

use m4\m4mvc\core\Controller;

class Home extends Controller
{
  public function index ()
  {
    $this->data[] = 'hello';
  }
}