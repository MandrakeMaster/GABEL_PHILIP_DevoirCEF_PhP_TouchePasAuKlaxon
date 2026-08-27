<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Controllers;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models\User;

/**
 * Contrôleur de gestion de l'authentification.
 */
class AuthController {
    /**
     * Traite la connexion d'un utilisateur par son email.
     * 
     * @param string $email
     * @return void
     */
    public static function login(string $email) {
        $user = User::findByEmail($email);

        if ($user) {
            // Stockage des informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nom'] = $user['Nom'];
            $_SESSION['user_prenom'] = $user['Prénom'];
            $_SESSION['user_admin'] = $user['is_admin'];

            echo "Connexion réussie ! Bienvenue " . $user['Prénom'] . " " . $user['Nom'] . ".";
            if ($user['is_admin'] == 1) {
                echo " (Profil Administrateur)";
            }
        } else {
            echo "Utilisateur introuvable.";
        }
    }

    /**
     * Déconnecte l'utilisateur en détruisant la session.
     * 
     * @return void
     */
    public static function logout() {
        session_destroy();
        echo "Déconnexion réussie.";
    }
}