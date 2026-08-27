<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Controllers;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models\User;

/**
 * Contrôleur de gestion de l'authentification.
 */
class AuthController {
    /**
     * Traite la tentative de connexion via le formulaire (POST).
     * 
     * @return void
     */
    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');

            // Recherche de l'utilisateur par son email en BDD
            $user = User::findByEmail($email);

            if ($user) {
                // Stockage des informations de l'utilisateur dans la session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nom'] = $user['Nom'];
                $_SESSION['user_prenom'] = $user['Prénom'];
                $_SESSION['user_admin'] = $user['is_admin'];

                // Message de succès stocké en session
                $_SESSION['flash_success'] = "Connexion réussie ! Bienvenue " . $user['Prénom'] . " " . $user['Nom'] . ".";

                header('Location: /');
                exit;
            } else {
                // En cas d'échec, message d'erreur en session et retour à l'accueil
                $_SESSION['flash_error'] = "Adresse email introuvable ou incorrecte.";
                header('Location: /');
                exit;
            }
        }
    }

    /**
     * Déconnecte l'utilisateur en détruisant la session.
     * 
     * @return void
     */
    public static function logout() {
        session_destroy();
        header('Location: /');
        exit;
    }
}