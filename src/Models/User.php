<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database\Database;
use PDO;

/**
 * Modèle User
 */
class User {
    public static function find(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM User WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findByEmail(string $email) {
        $db = Database::getConnection();
        // On nettoie l'email saisi pour éviter les espaces invisibles
        $email = trim($email);
        $stmt = $db->prepare("SELECT * FROM User WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}