<?php

/**
 * Point d'entrée de l'application (Front Controller)
 * 
 * @author Philip Gabel
 * @version 1.0
 */

// Démarrage des sessions PHP
session_start();

// Chargement de l'autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

use Buki\Router\Router;
use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models\Trajet;
use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Controllers\AuthController;

$router = new Router();

// Routes principales de l'application
$router->get('/', function() {
    $trajets = Trajet::allWithDetails();
    require_once __DIR__ . '/../src/Views/home.php';
});

$router->get('/trajets', function() {
    echo "<h1>Liste des covoiturages</h1>";
});

$router->get('/connexion', function() {
    echo "<h1>Connexion</h1>";
});

// Routes utilitaires pour les tests de session
$router->get('/login-test', function() {
    AuthController::login('alexandre.martin@email.fr');
});

$router->get('/logout', function() {
    AuthController::logout();
});

// Lancement du routeur
$router->run();