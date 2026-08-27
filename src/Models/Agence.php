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

    /**
     * Trouve une agence par son ID.
     * 
     * @param int $id
     * @return array|false
     */
    public static function find(int $id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM Agences WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée une nouvelle agence.
     * 
     * @param string $ville
     * @return bool
     */
    public static function create(string $ville): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO Agences (Ville) VALUES (?)");
        return $stmt->execute([$ville]);
    }

    /**
     * Met à jour une agence existante.
     * 
     * @param int $id
     * @param string $ville
     * @return bool
     */
    public static function update(int $id, string $ville): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE Agences SET Ville = ? WHERE id = ?");
        return $stmt->execute([$ville, $id]);
    }

    /**
     * Supprime une agence.
     * 
     * @param int $id
     * @return bool
     */
    public static function destroy(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM Agences WHERE id = ?");
        return $stmt->execute([$id]);
    }
}