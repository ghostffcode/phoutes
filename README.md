# phoutes - Simple PHP routes Handler

![Phoutes - Simple PHP Routes Handler](http://i.imgur.com/4DZEpFU.jpg?1)

##How to run:

clone the script:

```bash
git clone https://github.com/ghostffcode/phoutes.git
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

## Using Controllers in routes
You can add a new controller in phoutes/App/Controllers/ directory (name of controller needs to match the controller class name)

To use a controller, prefix the class instance name with 'ctrl'

```php
// create a get route that take a url variable user and passes it to the Profile controller
$route->get('/:user/', function($user) {
  // sample use of a controller
 $profile = new ctrlProfile();
 $profile->name($user);
});
```

## Rendering a view file
The view directory is "Phoutes/App/Views/"
You can place your html or php files in that directory

To render a view file in your code, use
```php
view::render($filename, $data);
```

The static view method, takes two arguments:
* The first is the view file name Eg. index or user/profile (Default is index).
* The second (optional) is the data to be passed into the view file.

Example of rendering a view file:
```php
$route->all('/', function () {
  view::render('profile');  // renders profile.php file
});
```

## Rules  (A few fixes I need to do in coming versions)

* If a static route and a url variable route are of the same length, the static route call comes first in your routes.php file.
* The arguments of a callback function of a url variable route must be in the same order as the url variables.


## Disclaimer
I started this as a fun project but I might take it really serious in the coming weeks. That said, I don't think you should use it for production yet.

## Want to Help?
Thank you for trying to out, if there is something you will like to add, do make a pull request.

Don't forget to star this!
