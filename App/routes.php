<?php

$route->get('/user/:user/', function($user) {
 echo "I got your username: ". $user;
 view::render();
});

$route->get('/', function () {
  echo 'This is homepage';
});

$route->get('/user/:id', function($user, $id) {
 echo "I got your id: ". $id;
});

$route->get('/home', function() {
 echo "I got Home <br />";
});

$route->post('/', function() {
 echo "Post request to homepage";
});

 ?>
