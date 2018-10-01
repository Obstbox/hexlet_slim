<?php

use Slim\Views\PhpRenderer;

require '../vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new Slim\App(['settings' => $config]);

$app->get('/', function() {
    return 'Main page';
});

$app->get('/about', function($request, $response, $args) {
    return $this->renderer->render($response, "/about.phtml", $args);
});


$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("../templates");

$app->get('/pdotest', function() {
    $conn = new PDO('mysql:host=localhost;dbname=hexlet', 'root', '1');
    $result = $conn->query("SELECT * FROM ads");
    foreach ($result as $row) {
        echo $row['id'] . '<br>';
        echo $row['title'] . '<br>';
        echo $row['telephone'] . '<br>';
        echo '<br>';
    }
});

$app->get('/hello/{name}', function($request, $response, $args) {
    return $response->getBody()->write("Hello, " . $args['name']);
});

$app->run();

?>
