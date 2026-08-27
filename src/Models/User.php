<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database\Database;
use PDO;

/**
 * Modèle User
 */
class User {
    
    /**
     * Récupère tous les utilisateurs.
     * 
     * @return array
     */
    public static function all(): array {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM User ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Trouve un utilisateur par son ID.
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

    /**
     * Trouve un utilisateur par son email.
     * 
     * @param string $email
     * @return array|false
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
     * Met à jour les informations d'un utilisateur.
     * 
     * @param int $id
     * @param string $nom
     * @param string $prenom
     * @param string $email
     * @param string $telephone
     * @param int $isAdmin
     * @return bool
     */
    public static function update(int $id, string $nom, string $prenom, string $email, string $telephone, int $isAdmin): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE User SET Nom = ?, Prénom = ?, email = ?, téléphone = ?, is_admin = ? WHERE id = ?");
        return $stmt->execute([$nom, $prenom, $email, $telephone, $isAdmin, $id]);
    }

    /**
     * Supprime un utilisateur par son ID.
     * 
     * @param int $id
     * @return bool
     */
    public static function delete(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM User WHERE id = ?");
        return $stmt->execute([$id]);
    }
}