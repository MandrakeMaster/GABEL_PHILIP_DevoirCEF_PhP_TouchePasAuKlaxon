<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database\Database;
use PDO;

/**
 * Modèle Trajet
 */
class Trajet {
    /**
     * Récupère tous les trajets futurs et disponibles avec les noms des villes et de l'auteur.
     * 
     * @return array
     */
    public static function allWithDetails(): array {
        $db = Database::getConnection();
        $sql = "SELECT t.*, 
                       a1.Ville AS ville_depart_nom, 
                       a2.Ville AS ville_arrivee_nom,
                       u.Nom AS auteur_nom,
                       u.Prénom AS auteur_prenom,
                       u.Email AS auteur_email,
                       u.Téléphone AS auteur_telephone
                FROM Trajet t
                JOIN Agences a1 ON t.Ville_départ = a1.id
                JOIN Agences a2 ON t.Ville_arrivée = a2.id
                JOIN User u ON t.auteur = u.id
                WHERE t.Date_départ >= NOW() AND t.places_restantes > 0
                ORDER BY t.Date_départ ASC";
        
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}