<?php 

namespace m4\wordMaster\controllers;

use m4\m4mvc\core\Controller;
use m4\m4mvc\helper\Response;
use m4\m4mvc\helper\Request;
use m4\m4mvc\helper\Str;

class Sentences extends Controller
{
  public function __construct ()
  {
    $this->model = $this->getModel('Sentence');
  }

  public function index ()
  {
    $this->data[] = 'hello sentences';
  }

  public function list ()
  {
    $data = Request::select('word_id');
    $this->data['sentences'] = $this->model->list($data);
  }

  public function add ()
  {
    Request::forceMethod('post');
    Request::required('sentence', 'word_id');
    $data = Request::select('sentence', 'word_id');

    $duplicate = $this->model->find($data);
    if ($duplicate) Response::error('this sentence already exists');

    $added = $this->model->add($data);
    $added ? 
    Response::success('sentence has been added', ['id' => $added]) : 
    Response::error('sentence adding failed');
  }
}