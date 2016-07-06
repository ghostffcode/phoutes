<?php

$route->get('/home', function() {
 echo "I got Home <br />";
});

$route->get('/:user/', function($user) {
  // sample use of a controller
 $profile = new ctrlProfile();
 $profile->name($user);
});

$route->all('/', function () {
  view::render();
});

$route->get('/user/:id', function($user, $id) {
 echo "I got your id: ". $id;
});


$route->Error404(function () {
  view::render('404');
});

 ?>
