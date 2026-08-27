<?php

namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Tests;

use PHPUnit\Framework\TestCase;
use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models\User;
use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database\Database;

class UserUpdateTest extends TestCase
{
    public function testUpdateUser(): void
    {
        $db = Database::getConnection();
        $email = "test.update.user@example.com";

        // Insertion préalable pour pouvoir tester la modification
        $stmt = $db->prepare("INSERT INTO User (Nom, Prénom, email, téléphone, is_admin) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(["NomInit", "PrenomInit", $email, "0600000000", 0]);
        
        $userTrouve = User::findByEmail($email);
        $this->assertNotFalse($userTrouve);
        $userId = $userTrouve['id'];

        // Test de la modification (UPDATE via le modèle)
        $nouveauNom = "NomModifieParTest";
        $updated = User::update((int)$userId, $nouveauNom, "PrenomInit", $email, "0600000000", 0);
        
        $this->assertTrue($updated, "La modification de l'utilisateur a échoué.");
    }
}