<?php

// used for autoloading controller classes and model classes
spl_autoload_register(function ($class) {
  $local = substr($class, 0, 4);
  $newclass = substr($class, 4, strlen($class));
  if ($local == 'ctrl') {
    // get a controller class first
    include 'Controllers/' . $newclass . '.php';
    class_alias($newclass, $class);
  } else {
    // else, get a model class
    include 'Controllers/' . $newclass . '.php';
  }

});

 ?>
