<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database\Database;
use PDO;

/**
 * Modèle User
 */
class User {
    /**
     * Récupère un utilisateur par son identifiant.
     * 
     * @param int $id
     * @return array|false
     */
    public static function find(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM User WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}