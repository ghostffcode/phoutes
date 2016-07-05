<?php

$route->get('/user/:user/', function($user) {
 echo "I got your username: ". $user;
 //view::render();
});

$route->get('/home', function() {
 echo "I got Home <br />";
});

$route->get('/', function () {
  echo 'This is homepage <br />';
  $profile = new ctrlProfile();
  $profile->name();
});

$route->get('/user/:id', function($user, $id) {
 echo "I got your id: ". $id;
});


$route->Error404(function () {
  view::render('404');
});

 ?>
