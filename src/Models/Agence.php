<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database\Database;
use PDO;

/**
 * Modèle Agence
 */
class Agence {
    /**
     * Récupère toutes les agences/villes.
     * 
     * @return array
     */
    public static function all(): array {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM Agences");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}