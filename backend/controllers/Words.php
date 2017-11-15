<?php 

namespace m4\wordMaster\controllers;

use m4\m4mvc\core\Controller;
use m4\m4mvc\helper\Response;
use m4\m4mvc\helper\Request;
use m4\m4mvc\helper\Str;

class Words extends Controller
{
  public function __construct ()
  {
    $this->model = $this->getModel('Word');
  }

  public function index ()
  {
    print_r($this->model->getColumnNames());die;
    $this->data[] = 'hello words';
  }

  public function list ()
  {
    $this->data['words'] = $this->model->list();
  }

  public function find ()
  {
    $this->data['word'] = $this->model->find([
      'lang' => $_GET['lang'],
      'word' => $_GET['word']
    ]);
  }

  public function add ()
  {
    Request::forceMethod('post');
    Request::required('lang', 'word');
    $data = Request::select('lang', 'word');

    $duplicate = $this->model->find($data);
    if ($duplicate) Response::error('this word already exists');

    $added = $this->model->add([
      'lang' => $_POST['lang'],
      'slug' => Str::slugify($_POST['word']),
      'word' => $_POST['word'],
      'difficulty' => 1
    ]);

    $added ? 
    Response::success('word has been added', ['id' => $added]) : 
    Response::error('word adding failed');
  }
}