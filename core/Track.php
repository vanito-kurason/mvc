<?php
namespace Core;

class Track
{
  private $controllerNamespace;
  private $controller;
  private $action;

  public function __construct($controllerNamespace, $controller, $action)
  {
    $this->controllerNamespace = $controllerNamespace;
    $this->controller = $controller;
    $this->action = $action;
  }

  public function __get($property)
  {
    return $this->$property;
  }
}
