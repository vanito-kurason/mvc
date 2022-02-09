<?php
namespace Core;

class Track
{
  private $controllerNamespace;
  private $controller;
  private $action;
  private $params;

  public function __construct($controllerNamespace, $controller, $action, $params)
  {
    $this->controllerNamespace = $controllerNamespace;
    $this->controller = $controller;
    $this->action = $action;
    $this->params = $params;
  }

  public function __get($property)
  {
    return $this->$property;
  }
}
