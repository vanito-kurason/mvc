<?php
namespace Core;

class Page
{
  private $layout;
  private $title;
  private $view;
  private $content;

  public function __construct($layout, $title, $view = NULL, $content = '')
  {
    $this->layout = $layout;
    $this->title = $title;
    $this->view = $view;
    $this->content = $content;
  }

  public function __get($property)
  {
    return $this->$property;
  }
}
