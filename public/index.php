<?php
/**
 * Point d'entrée de l'application (Front Controller)
 * 
 * @author Philip Gabel
 * @version 1.0
 */

// Chargement de l'autoloader de Composer
require_once __DIR__ . '/../vendor/autoload.php';

use Buki\Router\Router;

// Instanciation du routeur
$router = new Router();

// Route de la page d'accueil
$router->get('/', function() {
    echo "<h1>Bienvenue sur Touche pas au klaxon !</h1>";
    echo "<p>Page d'accueil en cours de construction.</p>";
});

// Route pour la liste des trajets
$router->get('/trajets', function() {
    echo "<h1>Liste des covoiturages</h1>";
    echo "<p>Ici s'affichera la liste des trajets disponibles.</p>";
});

// Route pour la page de connexion
$router->get('/connexion', function() {
    echo "<h1>Connexion</h1>";
    echo "<p>Formulaire de connexion à venir.</p>";
});

// Lancement du routeur
$router->run();