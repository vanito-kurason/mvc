<?php
namespace Core;

class Router
{
  private $controllerNamespace;
  private $controller;
  private $action;

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
    $url = $_SERVER['REQUEST_URI'];

    foreach ($routes as $key => $value) {
      if ($key === 'controllerNamespace') {
        $this->controllerNamespace = $value;
      } elseif ($key === 'routes') {
          foreach ($value as $route) {
            if ("$route->method $route->path" === "$method $url") {
              $this->controller = $route->controller;
              $this->action = $route->action;
            }
          }
      } else {
        echo "Ошибка в конфигурационном файле routes.php";
          die();
      }
    }

    if (isset($this->controller) && isset($this->action) && isset($this->controllerNamespace)) {
      return new Track($this->controllerNamespace, $this->controller, $this->action);
    } else {
      echo "404: Страница не найдена!";
      die();
    }
  }

  public function __get($property)
  {
    return $this->$property;
  }
}
?>
