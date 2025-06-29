<?php
// public/index.php

// 1. Composer Autoloader laden
require_once __DIR__. '/../vendor/autoload.php';

use App\Core\Database;
use App\Core\Router;
use App\Controller\PageController;
use App\Repository\PdoPageRepository;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../');
$dotenv->load();

$pdo = Database::getInstance();
$repository = new PdoPageRepository($pdo);
$pageController = new PageController($repository);


$router = new Router();

// Routen definieren
$router->addRoute('GET', '/', []);

$router->addRoute('GET', '/[0-9]+/{id}', function($id) {
    echo "Anzeige des nummern mit der ID: ". htmlspecialchars($id);
});
$router->addRoute('GET', '/(hafenwelten|ratgeber)/{id}', function($id) {
    echo "Anzeige der Artikel mit der ID: ". htmlspecialchars($id);
});

$router->addRoute('GET', '/page', [$pageController, 'index']);
$router->addRoute('GET', '/page/{id}', [$pageController, 'show']);

try {
    $router->dispatch();
} catch (\Exception $e) {
    http_response_code(500);
    echo "Ein interner Fehler ist aufgetreten.";
    dd($e);
}