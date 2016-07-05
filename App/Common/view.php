<?php

/**
 * For use with the view engine
 */
class view extends App {

  public function render($x = 'index', $data = []) {
    include '../App/Views/'. $x .'.php';
  }
}



 ?>
