<?php

namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Tests;

use PHPUnit\Framework\TestCase;
use PDO;

class TrajetUpdateTest extends TestCase
{
    private ?PDO $pdo = null;

    protected function setUp(): void
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=touche_pas_au_klaxon;charset=utf8mb4', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function testModifierTrajet(): void
    {
        $agenceStmt = $this->pdo->query("SELECT id FROM Agences LIMIT 2");
        $agences = $agenceStmt->fetchAll(PDO::FETCH_COLUMN);
        $this->assertGreaterThanOrEqual(2, count($agences));

        $userStmt = $this->pdo->query("SELECT id FROM User LIMIT 1");
        $auteur = $userStmt->fetchColumn();

        // 1. Insertion initiale
        $stmtInsert = $this->pdo->prepare("
            INSERT INTO Trajet (Ville_départ, Ville_arrivée, Date_départ, Date_arrivée, places_restantes, auteur) 
            VALUES (?, ?, '2026-11-01 08:00:00', '2026-11-01 12:00:00', 3, ?)
        ");
        $stmtInsert->execute([$agences[0], $agences[1], $auteur]);
        $trajetId = $this->pdo->lastInsertId();

        // 2. Test d'écriture : Modification (UPDATE) du nombre de places
        $nouveauPlaces = 5;
        $stmtUpdate = $this->pdo->prepare("UPDATE Trajet SET places_restantes = ? WHERE id = ?");
        $updateResult = $stmtUpdate->execute([$nouveauPlaces, $trajetId]);

        $this->assertTrue($updateResult, "La modification du trajet a échoué.");

        // 3. Vérification
        $stmtCheck = $this->pdo->prepare("SELECT places_restantes FROM Trajet WHERE id = ?");
        $stmtCheck->execute([$trajetId]);
        $this->assertEquals($nouveauPlaces, $stmtCheck->fetchColumn());

        // 4. Nettoyage
        $this->pdo->exec("DELETE FROM Trajet WHERE id = $trajetId");
    }
}