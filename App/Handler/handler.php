<?php

require_once '../App/Common/App.php';
require_once '../App/Common/view.php';


require_once '../App/init.php';


class Route extends App {
  private $route = '', $req = '', $final = false;

  function __construct($route, $request) {
    // gets the route that the user has called and explode into Array
    $route = explode('/',trim($route, '/'));
    $this->route = $route;  // assign route to route variable
    $this->req = $request;
  }

  public function get($route, $cb) {
    $this->handler($route, $cb, 'get');
  }

  public function post($route, $cb) {
    $this->handler($route, $cb, 'post');
  }

  public function update($route, $cb) {
    $this->handler($route, $cb, 'update');
  }

  public function delete($route, $cb) {
    $this->handler($route, $cb, 'delete');
  }

  public function all($route, $cb) {
    $this->handler($route, $cb, 'all');
  }


  private function handler ($route, $cb, $method) {
    //check if the route matches the one from the user
    $route = explode('/',trim($route, '/'));
    $validRoute = $this->validRoutes($route, $method);
    if ($validRoute['0']) {
      $Args = array();
        if ($validRoute['1'] !== '') {
          foreach($validRoute['1'] as $k => &$arg){
              $Args[$k] = &$arg;
          }
        }
      $callback = &$cb;
      //call_user_func_array($callback, $Args);
      call_user_func_array($callback, $Args);
      $this->final = true;
      die();
    }
  }

  // Not implemented yet
  private function cbArgNames($funcName) {
    $f = new ReflectionFunction($funcName);
    $result = array();
    foreach ($f->getParameters() as $param) {
        $result[] = $param->name;
    }
    return $result;
  }

  // check if the route is valid
  private function validRoutes($route, $reqType) {
    $res = array(false, '');
    $argval = array();
    // Filter arrays to remove empty values
    $route = array_filter($route);
    $this->route = array_filter($this->route);
    // Validates and checks if it is the right route
    if ((empty($route) && empty($this->route)) && ($this->req == $reqType || $reqType == 'all')) {
      $res['0'] = true;
    } else if (($route === $this->route) && ($this->req == $reqType || $reqType == 'all')) {
      $res['0'] = true;
    } else if ((count($route) === count($this->route)) && (!empty($route['0']) && ($this->diffArray($route, $this->route)) && !empty($this->route['0'])) && ($this->req == $reqType || $reqType == 'all')) {
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

  public function diffArray($r, $nr) {
    // Check the array difference values
    $diff = array_diff($r, $nr);
    $diff = array_values($diff);
    $sub = substr($diff[0], 0, 1);

    if ($sub == ':') {
      return true;
    } else {
      return false;
    }
  }

  public function Error404($cb = '') {
    if (is_callable($cb)) {
      $cb();
    } else if (is_string($cb)) {
      echo $cb;
    }
  }

  function __destruct() {
    // check if a route worked
    if (!$this->final) {
      $this->Error404();
    }
  }

}

 ?>
