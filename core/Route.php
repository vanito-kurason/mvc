<?php
	namespace Core;
	
	class Route
	{
		private $method;
		private $path;
		private $controller;
		private $action;
		
		public function __construct($method, $path, $controller, $action)
		{
			$this->method = $method;
			$this->path = $path;
			$this->controller = $controller;
			$this->action = $action;
		}
		
		public function __get($property)
		{
			return $this->$property;
		}
	}
?>
