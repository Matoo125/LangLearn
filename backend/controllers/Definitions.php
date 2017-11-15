<?php 

namespace m4\wordMaster\controllers;

use m4\m4mvc\core\Controller;
use m4\m4mvc\helper\Response;
use m4\m4mvc\helper\Request;
use m4\m4mvc\helper\Str;

class Definitions extends Controller
{
  public function __construct ()
  {
    $this->model = $this->getModel('Definition');
  }

  public function index ()
  {
    $this->data[] = 'hello definitions';
  }

  public function list ()
  {
    $data = Request::select('word_id');
    $this->data['definitions'] = $this->model->list($data);
  }

  public function find ()
  {

  }

  public function add ()
  {
    Request::forceMethod('post');
    Request::required('definition', 'word_id');
    $data = Request::select('definition', 'word_id');

    $duplicate = $this->model->find($data);
    if ($duplicate) Response::error('this definition already exists');

    $added = $this->model->add($data);
    $added ? 
    Response::success('definition has been added', ['id' => $added]) : 
    Response::error('definition adding failed');
  }
}