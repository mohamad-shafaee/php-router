<?php

include_once 'Request.php';
include_once 'Router.php';
$router = new Router(new Request);

$router->get('/PhpTour/routing1/index.php/', function() {
  return <<<HTML
  <h1>Hello world</h1>
HTML;
});


$router->get('/PhpTour/routing1/index.php/profile', function($request) {
  
//echo "This is the request:  {$request->requestUri}";
  return <<<HTML
  <h1>  Profile for request: "This is the request:  {$request->requestUri}" </h1>
HTML;


});

$router->post('/data', function($request) {

  return json_encode($request->getBody());
});

//$router->resolve();

?>