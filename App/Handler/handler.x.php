<?php

require_once '../App/Common/App.php';


class Route extends App {
  private $route = '',
          $req = '';

  private $getRoute = array();
  private $Args = array();

  function __construct($route, $request) {
    // trim the user's entered route and store
    $this->route = trim($route, '/');  // assign route to route variable
    $this->req = $request;

    // set 404 page error
    $this->getRoute['404'] = array(function () {
      echo '404: Page not found';
    }, '');
  }

  public function get($route, callable $cb) {
    $route = trim($route, '/');
    $this->getRoute[$route][0] = $cb;
    $this->getRoute[$route][1] = $this->getArgs($route);
    //$callback = &$cb;
  }

  public function getArgs($route) {
    $route = explode('/', $route);
    $userroute = explode('/', $this->route);
    $argval = array();
    // Filter arrays to remove empty values
    $route = array_filter($route);
    $userroute = array_filter($userroute);
    // this will get the arguments
    if ((count($route) === count($userroute)) && (!empty($route['0']) && !empty($userroute['0'])) ) {
      // check if the only array that stands out is the one that has the url variable
      $diff = array_diff($route, $userroute);
      foreach ($diff as $key => $param) {
        preg_match("/:(.+)/", $param, $output);
        array_push($argval, $userroute[$key]);
      }
      $argval = array_filter($argval);
      if (count($argval) !== 0) {
        return $argval;
      } else {
        return '';
      }
    }
  }

  // create the distructor that handles the checking
  function __destruct () {
    $routeType = $this->req. 'Route';
    ($this->$routeType[$this->route] ?? $this->$routeType['404'])[0]($this->getRoute[$this->route][1]);
  }

}

 ?>
