<?php

namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Tests;

use PHPUnit\Framework\TestCase;
use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models\Agence;

class AgenceWriteTest extends TestCase
{
    public function testCreerEtSupprimerAgence(): void
    {
        $nomVille = "VilleTestUnit";

        // 1. Test d'écriture (Création)
        $created = Agence::create($nomVille);
        $this->assertTrue($created, "L'écriture de l'agence a échoué.");

        // 2. Récupération de l'ID pour le nettoyage
        $agences = Agence::all();
        $idAgence = null;
        foreach ($agences as $ag) {
            if ($ag['Ville'] === $nomVille) {
                $idAgence = $ag['id'];
                break;
            }
        }

        $this->assertNotNull($idAgence);

        // 3. Test d'écriture (Suppression)
        $deleted = Agence::destroy($idAgence);
        $this->assertTrue($deleted, "La suppression de l'agence a échoué.");
    }
}