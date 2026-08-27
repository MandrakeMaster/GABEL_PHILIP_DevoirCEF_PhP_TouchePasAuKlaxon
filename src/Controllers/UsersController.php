<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Controllers;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models\User;

/**
 * Contrôleur de gestion des utilisateurs pour l'administration.
 */
class UsersController {

    /**
     * Vérifie si l'utilisateur connecté est bien un administrateur.
     * 
     * @return void
     */
    private function checkAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_admin']) || $_SESSION['user_admin'] != 1) {
            $_SESSION['flash_message'] = "Accès refusé. Droits d'administrateur requis.";
            header('Location: /');
            exit;
        }
    }

    /**
     * Affiche la liste de tous les utilisateurs (Page d'administration en lecture seule).
     * 
     * @return void
     */
    public function index() {
        $this->checkAdmin();
        
        $utilisateurs = User::all();
        require_once __DIR__ . '/../Views/admin/utilisateurs.php';
    }
}