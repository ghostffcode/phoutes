<?php

namespace bliss\Route;

require_once 'App.php';

use bliss\App as App;


class Route extends App {
  private $route = '',
          $req = '';

  function __construct($route, $request) {
    // gets the route that the user has called and explode into Array
    $route = explode('/',trim($route, '/'));
    $this->route = $route;  // assign route to route variable
    $this->req = $request;
  }

  public function get($route, $cb) {
    //check if the route matches the one from the user
    $route = explode('/',trim($route, '/'));
    $validRoute = $this->validRoutes($route, 'get');
    if ($validRoute['0']) {
      $Args = array();
        if ($validRoute['1'] !== '') {
          foreach($validRoute['1'] as $k => &$arg){
              $Args[$k] = &$arg;
          }
        }
      $callback = &$cb;
      call_user_func_array($callback, $Args);
    }
  }

  public function post($route, $callback) {
    //check if the route matches the one from the user
    $route = explode('/',trim($route, '/'));
    $validRoute = $this->validRoutes($route, 'post');
    if ($validRoute['0']) {
      $Args = array();
        if ($validRoute['1'] !== '') {
          foreach($validRoute['1'] as $k => &$arg){
              $Args[$k] = &$arg;
          }
        }
      $callback = &$cb;
      call_user_func_array($callback, $Args);
    }
  }

  public function put($route, $callback) {
    //check if the route matches the one from the user
    $route = explode('/',trim($route, '/'));
    $validRoute = $this->validRoutes($route, 'update');
    if ($validRoute['0']) {
      $Args = array();
        if ($validRoute['1'] !== '') {
          foreach($validRoute['1'] as $k => &$arg){
              $Args[$k] = &$arg;
          }
        }
      $callback = &$cb;
      call_user_func_array($callback, $Args);
    }
  }

  public function delete($route, $callback) {
    //check if the route matches the one from the user
    $route = explode('/',trim($route, '/'));
    $validRoute = $this->validRoutes($route, 'delete');
    if ($validRoute['0']) {
      $Args = array();
        if ($validRoute['1'] !== '') {
          foreach($validRoute['1'] as $k => &$arg){
              $Args[$k] = &$arg;
          }
        }
      $callback = &$cb;
      call_user_func_array($callback, $Args);
    }
  }

  // check if the route is valid
  private function validRoutes($route, $reqType) {
    $res = array(false, '');
    $argval = array();
    // Filter arrays to remove empty values
    $route = array_filter($route);
    $this->route = array_filter($this->route);
    // Validates and checks if it is the right route
    if ((empty($route) && empty($this->route)) && ($this->req == $reqType)) {
      $res['0'] = true;
    } else if (($route === $this->route) && ($this->req == $reqType)) {
      $res['0'] = true;
    } else if ((count($route) === count($this->route)) && (!empty($route['0']) && !empty($this->route['0'])) && ($this->req == $reqType)) {
      // check if the only array that stands out is the one that has the url variable
      $diff = array_diff($route, $this->route);
      foreach ($diff as $key => $param) {
        preg_match("/:(.+)/", $param, $output);
        array_push($argval, $this->route[$key]);
      }
      if (count($argval) !== 0) {
        $res['0'] = true;
        $res['1'] = $argval;
      }
    } else {
      $res['0'] = false;
    }
    return $res;
  }

}

 ?>
