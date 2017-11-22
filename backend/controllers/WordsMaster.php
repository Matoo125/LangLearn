<?php 

namespace m4\wordMaster\controllers;

use m4\m4mvc\core\Controller;
use m4\m4mvc\helper\Response\Request;
use m4\m4mvc\helper\Response;

class WordMaster extends Controller 
{
  public function __construct ()
  {
    $this->model = $this->getModel('vWordMaster');
  }

  public function list ()
  {
    Response::required('lang_1', 'lang_2');
    $data = Response::select('lang_1', 'lang_2');
    
  }
}