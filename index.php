<?php
require "vendor/autoload.php";

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$container['render'] = new \Twig\Environment($loader, [
    "cache" => false
]);
$container['debug'] = false;
$container['database'] = function () {
    $pdo = new PDO('mysql:dbname='.$_ENV['DB_NAME'].';host='.$_ENV['DB_HOST'], $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
    return $pdo;
};
$container['db'] = function ($container) {
    return new \App\Controller\DatabaseController($container);
};


$router = new App\Router\Router($_GET["url"], $container);

/*
 * Available routes method :
 * GET - POST
 * $router->METHOD(PATH :OPTIONS, CALLABLE, NAME)->with(PARAM, REGEX)
 */



$router->get('/', "Home#welcome" );

$router->post('/password', "Password#postPassword" );

$router->run();
