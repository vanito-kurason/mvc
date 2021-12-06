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
      preg_match("#^(.+) (.+?)$#", $methodSpacePath, $matches);
      $this->method = $matches[1];
			$this->path = $matches[2];
      
      preg_match("#^(.+)@(.+?)$#", $controllerAtAction, $matches);
      $this->controller = $matches[1];
			$this->action = $matches[2];
		}

		public function __get($property)
		{
			return $this->$property;
		}
	}
?>
