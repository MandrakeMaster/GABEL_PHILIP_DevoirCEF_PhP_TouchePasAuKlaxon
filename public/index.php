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

$router = new Router();

// Routes principales de l'application
$router->get('/', function() {
    echo "<h1>Bienvenue sur Touche pas au klaxon !</h1>";
});

$router->get('/trajets', function() {
    echo "<h1>Liste des covoiturages</h1>";
});

$router->get('/connexion', function() {
    echo "<h1>Connexion</h1>";
});

// Lancement du routeur
$router->run();