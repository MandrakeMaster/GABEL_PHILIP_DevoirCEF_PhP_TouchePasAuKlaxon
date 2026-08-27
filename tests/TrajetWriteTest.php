<?php

namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Tests;

use PHPUnit\Framework\TestCase;
use PDO;

class TrajetWriteTest extends TestCase
{
    private ?PDO $pdo = null;

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=touche_pas_au_klaxon;charset=utf8mb4', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function testInsertionEtSuppressionTrajet(): void
    {
        // Récupération dynamique des clés étrangères valides
        $agenceStmt = $this->pdo->query("SELECT id FROM Agences LIMIT 2");
        $agences = $agenceStmt->fetchAll(PDO::FETCH_COLUMN);
        $this->assertGreaterThanOrEqual(2, count($agences));

        $userStmt = $this->pdo->query("SELECT id FROM User LIMIT 1");
        $auteur = $userStmt->fetchColumn();
        $this->assertNotFalse($auteur);

        // 1. Test d'écriture (Insertion d'un trajet)
        $stmtInsert = $this->pdo->prepare("
            INSERT INTO Trajet (Ville_départ, Ville_arrivée, Date_départ, Date_arrivée, places_restantes, auteur) 
            VALUES (:depart, :arrivee, :date_dep, :date_arr, :places, :auteur)
        ");

        $result = $stmtInsert->execute([
            'depart' => $agences[0],
            'arrivee' => $agences[1],
            'date_dep' => '2026-10-01 08:00:00',
            'date_arr' => '2026-10-01 12:00:00',
            'places' => 3,
            'auteur' => $auteur
        ]);

        $this->assertTrue($result, "L'insertion du trajet a échoué.");

        // 2. Nettoyage de la base de données
        $lastId = $this->pdo->lastInsertId();
        $deleteResult = $this->pdo->exec("DELETE FROM Trajet WHERE id = $lastId");
        
        $this->assertNotFalse($deleteResult, "Le nettoyage du trajet de test a échoué.");
    }
}