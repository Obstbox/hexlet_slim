<?php

use Slim\Views\PhpRenderer;

require '../vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new Slim\App(['settings' => $config]);

$app->get('/', function() {
    return 'Main page';
});

/*
$app->get('/about', function() {
    return 'About page';
});
 */

$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("../templates");

$app->get('/about', function($request, $response, $args) {
    return $this->renderer->render($response, "/about.phtml", $args);
});

$app->get('/hello/{name}', function($request, $response, $args) {
    return $response->getBody()->write("Hello, " . $args['name']);
});

$app->run();

?>
