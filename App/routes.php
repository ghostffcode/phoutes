<?php

$route->get('/user/:user/', function($user) {
 echo "I got your username: ". $user;
});

$route->get('/user/:user/:id', function($user, $id) {
 echo "I got your username: ". $user ." and id: ". $id;
});

$route->get('/home', function() {
 echo "I got Home <br />";
});

$route->post('/', function() {
 echo "Post request to homepage";
});

 ?>
