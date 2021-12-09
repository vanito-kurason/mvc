<?php
namespace Core;

class Dispatcher
{
  public function getPage(Track $track)
  {
    $fullName = ($track->controllerNamespace) . $track->controller;
    $action = $track->action;

    try {
      $controller = new $fullName;

      if (method_exists($controller, $action)) {
        $result = $controller->$action();

        if ($result) {
          return $result;
        } else {
          $title = $controller->getTitle();
          return new Page('default', $title);
        }
      } else {
        echo "Метод <b>{$track->action}</b> не найден в классе $fullName.";
        die();
      }
    } catch (\Exception $error) {
      echo $error->getMessage(); die();
    }
  }
}
