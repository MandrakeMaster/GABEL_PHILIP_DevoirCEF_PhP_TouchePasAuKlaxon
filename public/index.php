<?php
/**
 * Point d'entrée de l'application (Front Controller)
 */

// Chargement de l'autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

use Buki\Router\Router;

$router = new Router();

$router->get('/', function() {
    echo "Le routeur fonctionne parfaitement !";
});

$router->run();