<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Controllers;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models\Trajet;
use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database\Database;
use PDO;

/**
 * Contrôleur de gestion des trajets.
 */
class TrajetController {
    /**
     * Affiche la liste de tous les trajets.
     * 
     * @return void
     */
    public static function index() {
        $trajets = Trajet::allWithDetails();
        header('Content-Type: application/json');
        echo json_encode($trajets, JSON_PRETTY_PRINT);
    }

    /**
     * Enregistre un nouveau trajet (Simulation d'ajout).
     * 
     * @return void
     */
    public static function store() {
        // Vérification que l'utilisateur est bien connecté
        if (!isset($_SESSION['user_id'])) {
            echo "Accès refusé : vous devez être connecté pour publier un trajet.";
            return;
        }

        // Pour l'exemple, on simule l'insertion d'un trajet posté par l'utilisateur connecté
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO Trajet (Ville_départ, Ville_arrivée, Date_départ, Date_arrivée, places_restantes, auteur) VALUES (?, ?, ?, ?, ?, ?)");
        
        // Exemple : De Strasbourg (ID 7) à Paris (ID 1)
        $success = $stmt->execute([
            7, 
            1, 
            '2026-09-01 08:00:00', 
            '2026-09-01 12:00:00', 
            3, 
            $_SESSION['user_id']
        ]);

        if ($success) {
            echo "Trajet publié avec succès par " . $_SESSION['user_prenom'] . " " . $_SESSION['user_nom'] . " !";
        } else {
            echo "Erreur lors de la publication du trajet.";
        }
    }
}