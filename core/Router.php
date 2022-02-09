<?php
namespace Core;

class Router
{
  private $controllerNamespace;
  private $controller;
  private $action;
  private $params;

  private static function getRealMethod(): string
    {
      if (isset($_POST['real_method']))
      {
        if ($_POST['real_method'] === 'PULL' or $_POST['real_method'] === 'DELETE')
        {
          $method = $_POST['real_method'];
        } else {
          echo 'неверный метод real_method!';
          die();
        }
      } else {
        $method = $_SERVER['REQUEST_METHOD'];
      }
      return $method;  
    }

  public function handleRequest(array $routes): Track
  {
    $method = self::getRealMethod();
    $uri = $_SERVER['REQUEST_URI'];

    foreach ($routes as $key => $value) {
      if ($key === 'controllerNamespace') {
        $this->controllerNamespace = $value;
      } elseif ($key === 'routes') {
          foreach ($value as $route) {
            $pattern = $this->createPattern($route->path);
            
            if (preg_match($pattern, $uri, $params) && "$route->method" === "$method") {
              $this->controller = $route->controller;
              $this->action = $route->action;
              $this->params = $this->clearParams($params);
            }
          }
      } else {
        echo "Ошибка в конфигурационном файле routes.php";
          die();
      }
    }

    if (isset($this->controller) && isset($this->action) && isset($this->controllerNamespace)) {
      return new Track($this->controllerNamespace, $this->controller, $this->action, $this->params);
    } else {
      echo "404: Страница не найдена!";
      die();
    }
  }
  
  private function createPattern($path)
		{
			return '#^' . preg_replace('#/:([^/]+)#', '/(?<$1>[^/]+)', $path) . '/?$#';
		}
		
  private function clearParams($params)
  {
    $result = [];

    foreach ($params as $key => $param) {
      if (!is_int($key)) {
        $result[$key] = $param;
      }
    }

    return $result;
  }
  
  public function __get($property)
  {
    return $this->$property;
  }
}
?>
