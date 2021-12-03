<?php
  namespace Core;
  
  class Controller
  {
    protected $layout = 'default';
    protected $title = '';

    protected function render($view, $content)
    {
      return new Page($this->layout, $this->title, $view, $content);
    }
  }
?>
