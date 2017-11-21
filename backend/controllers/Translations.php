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
    $this->model = $this->getModel('Translation');
  }

  public function index ()
  {
    $this->data[] = 'hello translations';
  }

  public function list ()
  {
    $data = Request::select('word_id');
    $this->data['translations'] = $this->model->list($data);
  }

  public function find ()
  {

  }

  public function add ()
  {
    Request::forceMethod('post');
    Request::required('word_id', 'lang', 'translation');
    $data = Request::select('word_id', 'lang', 'translation');

    $added = $this->model->add($data);
    $added ? 
    Response::success('translation has been added', ['id' => $added]) : 
    Response::error('error while adding translation');
  }
}