<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database;

use PDO;
use PDOException;

/**
 * Classe Database
 * 
 * Gère la connexion centralisée à la base de données en utilisant le pattern Singleton 
 * et l'extension PDO de manière sécurisée.
 * 
 * @author Philip Gabel
 * @version 1.0
 */
class Database {
    /**
     * Instance unique de la connexion PDO (Pattern Singleton).
     * 
     * @var PDO|null
     */
    private static ?PDO $instance = null;

    /**
     * Récupère l'instance unique de connexion PDO.
     * 
     * Si aucune connexion n'existe, elle l'initialise en chargeant le fichier de configuration.
     * 
     * @return PDO L'instance de connexion à la base de données.
     * @throws PDOException En cas d'échec de la connexion.
     */
    public static function getConnection(): PDO {
        if (self::$instance === null) {
            // Chargement du fichier de configuration externe
            $config = require __DIR__ . '/../../config/database.php';

            try {
                $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
                
                self::$instance = new PDO($dsn, $config['username'], $config['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                // Arrêt du script et affichage d'un message sécurisé en cas d'erreur critique
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}