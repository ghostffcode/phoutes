# phoutes - Simple PHP routes Handler

##How to run:

clone the script:

```bash
git clone
```
And navigate to the public directory in the phoutes folder with your browser, mine is:

```bash
http://localhost/phoutes/public
```
* You might want to create a virtual host in your dev environment.

## Adding Route Handler
open phoutes/App/routes.php in your favorite code editor and create a new route using:

```php
// get route handler
$route->get('/home', function() {
 echo "I got Home";
});

// post route handler
$route->post('/home', function() {
 echo "I got a post request";
});

// update route handler
$route->update('/home', function() {
 echo "I got an update request";
});

// delete route handler
$route->post('/home', function() {
 echo "I got a delete request";
});

// all route handler, for any request type
$route->all('/home', function() {
 echo "I can handle all request types";
});
```

## To handle url variables:
```php
// the variable in the url is :user
$route->get('/user/:user/', function($user) {
  echo $user;
});
```

try it out visit:
```bash
http://localhost/phoutes/public/user/Bliss
```
The page echoes out:
Bliss
