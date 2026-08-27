<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database\Database;
use PDO;

/**
 * Modèle User
 */
class User {
    
    /**
     * Récupère tous les utilisateurs
     */
    public static function all() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM User ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Trouve un utilisateur par son ID
     */
    public static function find(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM User WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Trouve un utilisateur par son email
     */
    public static function findByEmail(string $email) {
        $db = Database::getConnection();
        // On nettoie l'email saisi pour éviter les espaces invisibles
        $email = trim($email);
        $stmt = $db->prepare("SELECT * FROM User WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Met à jour les informations d'un utilisateur
     */
    public static function update(int $id, string $nom, string $prenom, string $email, string $telephone, int $isAdmin) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE User SET Nom = ?, Prénom = ?, email = ?, téléphone = ?, is_admin = ? WHERE id = ?");
        return $stmt->execute([$nom, $prenom, $email, $telephone, $isAdmin, $id]);
    }

    /**
     * Supprime un utilisateur par son ID
     */
    public static function delete(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM User WHERE id = ?");
        return $stmt->execute([$id]);
    }
}