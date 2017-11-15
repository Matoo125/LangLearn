<?php 

namespace m4\wordMaster\controllers;

use m4\m4mvc\core\Controller;
use m4\m4mvc\helper\Response;
use m4\m4mvc\helper\Request;
use m4\m4mvc\helper\Str;

class Translations extends Controller
{
  protected $word;

  public function __construct ()
  {
    $this->model = $this->getModel('Words2Translation');
  }

  public function index ()
  {
    $this->data[] = 'hello translations';
  }

  public function list ()
  {
  }

  public function find ()
  {

  }

  public function add ()
  {
    Request::forceMethod('post');
    Request::required('word_1_id', 'word_2_id');
    $data = Request::select('word_1_id', 'word_2_id');

    $duplicate = $this->model->find($data);
    if ($duplicate) Response::error('this translation already exists');

    $added = $this->model->add($data);
    $added ? 
    Response::success('translation has been added', ['id' => $added]) : 
    Response::error('error while adding translation');
  }
}