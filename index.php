<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
  
  require_once $_SERVER['DOCUMENT_ROOT'] . '/articles/config/connection.php';
  
  //require 'vendor/autoload.php';
  require_once 'core/Controller.php';
  require_once 'core/Dispatcher.php';
  require_once 'articles/controllers/ArticlesController.php';
  require_once 'core/Route.php';
  require_once 'core/Router.php';
  require_once 'core/Track.php';
  require_once 'core/Page.php';
  require_once 'core/View.php';
  
  use \Core\Router;
  use Core\View;
  
  $routes = require $_SERVER['DOCUMENT_ROOT'] . '/articles/config/routes.php';
   
  $track = (new Router)->handleRequest($routes);
  
  $page = (new \Core\Dispatcher())->getPage($track);
  
  echo (new View())->render($page);
