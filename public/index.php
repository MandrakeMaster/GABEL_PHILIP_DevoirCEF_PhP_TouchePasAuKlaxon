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
use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Controllers\TrajetController;

$router = new Router();

// Routes principales de l'application (Page d'accueil)
$router->get('/', function() {
    $trajets = Trajet::allWithDetails();
    require_once __DIR__ . '/../src/Views/home.php';
});

$router->get('/trajets', function() {
    echo "<h1>Liste des covoiturages</h1>";
});

// Route d'authentification : Traitement de la soumission du formulaire de connexion (POST)
$router->post('/login-submit', function() {
    AuthController::login();
});

// Route de déconnexion de l'utilisateur
$router->get('/logout', function() {
    AuthController::logout();
});

// Route pour enregistrer un nouveau trajet (POST depuis la modale)
$router->post('/trajet-store', function() {
    TrajetController::store();
});

// Route pour mettre à jour un trajet (POST depuis la modale de modification)
$router->post('/trajet-update', function() {
    TrajetController::update();
});

// Route pour supprimer un trajet (GET avec ID)
$router->get('/trajets/supprimer', function() {
    TrajetController::destroy();
});

// Lancement du routeur
$router->run();