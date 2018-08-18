<?php
// use \Psr\Http\Message\ServerRequestInterface as Request;
// use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../config/database.php';

// $app = new \Slim\App;
// $app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
//     $name = $args['name'];
//     $response->getBody()->write("Hello, $name");
//
//     return $response;
// });


require '../routes/api.php';
// require '../routes/web.php';
$app->run();
