<?php

namespace m4\wordMaster;

class Bootstrap 
{
  public $config;
  public $app;

  public function __construct ()
  {
    $this->defineConstants();    
    $this->requireFiles();
    $this->setErrorHandler();    
    $this->config = $this->parseConfig();
    $this->app = $this->createApp();
    $this->configureDbConnection();
    $this->registerModule();
  //  \m4\m4mvc\helper\Response::$errorCode = 200;
    $this->app->run();

  }

  protected function registerModule ()
  {
    \m4\m4mvc\core\Module::register([
      '' => [
        'render' => 'json'
      ]
    ]);
  }

  protected function configureDbConnection ()
  {
    $this->app->db([
      'DB_HOST'		  =>	$this->config['DB_HOST'],
      'DB_PASSWORD'	=>	$this->config['DB_PASS'],
      'DB_NAME'		  =>	$this->config['DB_NAME'],
      'DB_USER'		  =>	$this->config['DB_USER']
    ]);
  }

  protected function createApp ()
  {
    $app = new \m4\m4mvc\core\App;
    $app->settings['namespace'] = 'm4\wordMaster';
    $app->settings['renderFunction'] = 'json';
    $app->paths['app'] = 'backend';
    return $app;
  }

  protected function setErrorHandler ()
  {
    $whoops = new \Whoops\Run;
    //$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->pushHandler(new \Whoops\Handler\JsonResponseHandler);
    $whoops->register();
  }

  protected function requireFiles()
  {
    require_once(ROOT . DS . 'vendor' . DS . 'autoload.php');    
  }

  protected function defineConstants ()
  {
    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', dirname(__DIR__));
    define('BACKEND', dirname(__FILE__));
  }

  protected function parseConfig ()
  {
    return parse_ini_file(BACKEND . DS . 'config.ini');   
  }


}