<?php
	namespace Core;
	
	class Route
	{
		private $method;
		private $path;
		private $controller;
		private $action;
		
		public function __construct($methodSpacePath, $controllerAtAction)
		{
      parseMethodPath($methodSpacePath);
      parseControllerAction($controllerAction);
		}
		
    private function parseMethodPath($methodSpacePath)
    {
      preg_match("#^(<$method>.*) (<$path>.*)?#", $methodSpacePath, $matches);
      $this->method = $matches['method'];
			$this->path = $matches['path'];
    }
    
    private function parseControllerAction($controllerAtAction)
    {
      preg_match("#^(<$controller>.*)@(<$action>.*)?#", $controllerAtAction, $matches);
      $this->method = $matches['controller'];
			$this->path = $matches['action'];
    }
		public function __get($property)
		{
			return $this->$property;
		}
	}
?>
