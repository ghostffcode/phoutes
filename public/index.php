<?php

require_once '../App/handler.php';

use bliss\Route\Route as Route;

if (isset($_GET['url'])) {
  $reqType = strtolower($_SERVER['REQUEST_METHOD']);
  $url = $_GET['url'];   // assign url variable
  $route = new Route($url, $reqType);
  include '../App/routes.php';
} else {
  $url = '/';
  $reqType = strtolower($_SERVER['REQUEST_METHOD']);
  $route = new Route($url, $reqType);
  include '../App/routes.php';
}

 ?>
