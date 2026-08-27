<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database\Database;
use PDO;

/**
 * Modèle Trajet
 */
class Trajet {
    /**
     * Récupère tous les trajets avec les noms des villes de départ, d'arrivée et de l'auteur.
     * 
     * @return array
     */
    public static function allWithDetails(): array {
        $db = Database::getConnection();
        $sql = "SELECT t.*, 
                       a1.Ville AS ville_depart_nom, 
                       a2.Ville AS ville_arrivee_nom,
                       u.Nom AS auteur_nom,
                       u.Prénom AS auteur_prenom
                FROM Trajet t
                JOIN Agences a1 ON t.Ville_départ = a1.id
                JOIN Agences a2 ON t.Ville_arrivée = a2.id
                JOIN User u ON t.auteur = u.id";
        
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}