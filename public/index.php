<?php
/**
 * Point d'entrée de l'application (Front Controller)
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Buki\Router\Router;
// On importe notre classe Database avec son namespace exact
use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database\Database;

$router = new Router();

$router->get('/', function() {
    echo "Le routeur fonctionne parfaitement ! Va sur /test-db pour tester la BDD.";
});

$router->run();