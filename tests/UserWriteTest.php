<?php

namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Tests;

use PHPUnit\Framework\TestCase;
use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database\Database;
use PDO;

class UserWriteTest extends TestCase
{
    public function testInsertionUser(): void
    {
        $db = Database::getConnection();
        $email = "test.write.user@example.com";

        $stmt = $db->prepare("INSERT INTO User (Nom, Prénom, email, téléphone, is_admin) VALUES (?, ?, ?, ?, ?)");
        $inserted = $stmt->execute(["NomWrite", "PrenomWrite", $email, "0600000000", 0]);
        
        $this->assertTrue($inserted, "L'insertion de l'utilisateur a échoué.");
    }
}