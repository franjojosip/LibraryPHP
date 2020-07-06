<?php

//Base Controller
//Loads the models and views

class Controller
{
  // Load model
  public function model($model)
  {
    // Require model file
    require_once '../app/models/' . $model . '.php';

    // Retun model instance
    return new $model();
  }

  // Load view
  public function view($view, $data = [])
  {
    // Check for view file
    if (file_exists($_SERVER["DOCUMENT_ROOT"].'/app/views/' . $view . '.php')) {
      require_once($_SERVER["DOCUMENT_ROOT"].'/app/views/' . $view . '.php');
    } else {
      /// View does not exists
      die('View does not exists');
    }
  }
}
