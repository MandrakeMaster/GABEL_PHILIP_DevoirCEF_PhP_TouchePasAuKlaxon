<?php

namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Tests;

use PHPUnit\Framework\TestCase;
use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models\Agence;

class AgenceUpdateTest extends TestCase
{
    public function testModifierAgence(): void
    {
        $villeInitiale = "VilleTestModif";
        $villeModifiee = "VilleTestModifiee";

        // 1. Préparation : création d'une agence
        Agence::create($villeInitiale);

        $agences = Agence::all();
        $idAgence = null;
        foreach ($agences as $ag) {
            if ($ag['Ville'] === $villeInitiale) {
                $idAgence = $ag['id'];
                break;
            }
        }
        $this->assertNotNull($idAgence);

        // 2. Test d'écriture (Modification / UPDATE)
        $updateResult = Agence::update($idAgence, $villeModifiee);
        $this->assertTrue($updateResult, "La modification de l'agence a échoué.");

        // 3. Vérification de la mise à jour
        $agenceMaj = Agence::find($idAgence);
        $this->assertEquals($villeModifiee, $agenceMaj['Ville']);

        // 4. Nettoyage
        Agence::destroy($idAgence);
    }
}