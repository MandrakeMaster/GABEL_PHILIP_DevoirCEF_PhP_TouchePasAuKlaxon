<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Controllers;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models\Agence;

/**
 * Contrôleur de gestion des agences pour l'administration.
 */
class AgenceController {
    /**
     * Vérifie si l'utilisateur connecté est administrateur.
     * 
     * @return void
     */
    private static function checkAdmin() {
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_admin']) || $_SESSION['user_admin'] != 1) {
            $_SESSION['flash_message'] = "Erreur : accès réservé à l'administrateur.";
            header('Location: /');
            exit;
        }
    }

    /**
     * Affiche la liste des agences dans le dashboard admin.
     * 
     * @return void
     */
    public static function index() {
        self::checkAdmin();
        $agences = Agence::all();
        require_once __DIR__ . '/../Views/admin/agences.php';
    }

    /**
     * Enregistre une nouvelle agence.
     * 
     * @return void
     */
    public static function store() {
        self::checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ville = trim($_POST['ville'] ?? '');

            if (empty($ville)) {
                $_SESSION['flash_message'] = "Erreur : le nom de la ville ne peut pas être vide.";
                header('Location: /admin/agences');
                exit;
            }

            $success = Agence::create($ville);

            if ($success) {
                $_SESSION['flash_message'] = "L'agence a été créée avec succès !";
            } else {
                $_SESSION['flash_message'] = "Erreur lors de la création de l'agence.";
            }

            header('Location: /admin/agences');
            exit;
        }
    }

    /**
     * Met à jour une agence existante.
     * 
     * @return void
     */
    public static function update() {
        self::checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id'] ?? '');
            $ville = trim($_POST['ville'] ?? '');

            if (empty($id) || empty($ville)) {
                $_SESSION['flash_message'] = "Erreur : informations invalides pour la modification.";
                header('Location: /admin/agences');
                exit;
            }

            $success = Agence::update((int)$id, $ville);

            if ($success) {
                $_SESSION['flash_message'] = "L'agence a été modifiée avec succès !";
            } else {
                $_SESSION['flash_message'] = "Erreur lors de la modification de l'agence.";
            }

            header('Location: /admin/agences');
            exit;
        }
    }

    /**
     * Supprime une agence.
     * 
     * @return void
     */
    public static function destroy() {
        self::checkAdmin();

        $id = $_GET['id'] ?? null;

        if (empty($id)) {
            $_SESSION['flash_message'] = "Erreur : ID d'agence introuvable.";
            header('Location: /admin/agences');
            exit;
        }

        $success = Agence::destroy((int)$id);

        if ($success) {
            $_SESSION['flash_message'] = "L'agence a été supprimée avec succès.";
        } else {
            $_SESSION['flash_message'] = "Erreur lors de la suppression de l'agence.";
        }

        header('Location: /admin/agences');
        exit;
    }
}