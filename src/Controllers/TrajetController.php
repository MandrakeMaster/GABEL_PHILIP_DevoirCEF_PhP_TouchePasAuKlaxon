<?php
namespace Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Controllers;

use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models\Trajet;
use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Database\Database;
use PDO;

/**
 * Contrôleur de gestion des trajets.
 */
class TrajetController {
    /**
     * Affiche la liste de tous les trajets.
     * 
     * @return void
     */
    public static function index() {
        $trajets = Trajet::allWithDetails();
        header('Content-Type: application/json');
        echo json_encode($trajets, JSON_PRETTY_PRINT);
    }

    /**
     * Enregistre un nouveau trajet depuis le formulaire de la modale.
     * 
     * @return void
     */
    public static function store() {
        // Vérification que l'utilisateur est bien connecté
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['flash_message'] = "Erreur : vous devez être connecté pour proposer un trajet.";
            header('Location: /');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $villeDepart = trim($_POST['ville_depart'] ?? '');
            $villeArrivee = trim($_POST['ville_arrivee'] ?? '');
            $dateDepart = trim($_POST['date_depart'] ?? '');
            $dateArrivee = trim($_POST['date_arrivee'] ?? '');
            $places = trim($_POST['places'] ?? '');

            // 1. Vérification que tous les champs sont remplis
            if (empty($villeDepart) || empty($villeArrivee) || empty($dateDepart) || empty($dateArrivee) || empty($places)) {
                $_SESSION['flash_message'] = "Erreur : tous les champs du formulaire doivent être remplis.";
                header('Location: /');
                exit;
            }

            // 2. Vérification que la ville de départ est différente de la ville d'arrivée
            if ($villeDepart === $villeArrivee) {
                $_SESSION['flash_message'] = "Erreur : la ville de départ et la ville d'arrivée doivent être différentes.";
                header('Location: /');
                exit;
            }

            // 3. Vérification des dates (pas dans le passé et arrivée après départ)
            $now = new \DateTime();
            $dateTimeDepart = new \DateTime($dateDepart);
            $dateTimeArrivee = new \DateTime($dateArrivee);

            if ($dateTimeDepart < $now) {
                $_SESSION['flash_message'] = "Erreur : la date et l'heure de départ ne peuvent pas être dans le passé.";
                header('Location: /');
                exit;
            }

            if ($dateTimeArrivee <= $dateTimeDepart) {
                $_SESSION['flash_message'] = "Erreur : la date et l'heure d'arrivée doivent être postérieures au départ.";
                header('Location: /');
                exit;
            }

            // Insertion en base de données
            $db = Database::getConnection();
            $stmt = $db->prepare("INSERT INTO Trajet (Ville_départ, Ville_arrivée, Date_départ, Date_arrivée, places_restantes, auteur) VALUES (?, ?, ?, ?, ?, ?)");
            
            $success = $stmt->execute([
                $villeDepart, 
                $villeArrivee, 
                $dateDepart, 
                $dateArrivee, 
                $places, 
                $_SESSION['user_id']
            ]);

            if ($success) {
                $_SESSION['flash_message'] = "Votre trajet a été publié avec succès !";
            } else {
                $_SESSION['flash_message'] = "Erreur lors de la publication du trajet en base de données.";
            }

            header('Location: /');
            exit;
        }
    }

    /**
     * Met à jour un trajet existant depuis la modale de modification.
     * 
     * @return void
     */
    public static function update() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['flash_message'] = "Erreur : vous devez être connecté.";
            header('Location: /');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id'] ?? '');
            $villeDepart = trim($_POST['ville_depart'] ?? '');
            $villeArrivee = trim($_POST['ville_arrivee'] ?? '');
            $dateDepart = trim($_POST['date_depart'] ?? '');
            $dateArrivee = trim($_POST['date_arrivee'] ?? '');
            $places = trim($_POST['places'] ?? '');

            if (empty($id) || empty($villeDepart) || empty($villeArrivee) || empty($dateDepart) || empty($dateArrivee) || empty($places)) {
                $_SESSION['flash_message'] = "Erreur : tous les champs doivent être remplis pour la modification.";
                header('Location: /');
                exit;
            }

            if ($villeDepart === $villeArrivee) {
                $_SESSION['flash_message'] = "Erreur : départ et arrivée identiques.";
                header('Location: /');
                exit;
            }

            $dateTimeDepart = new \DateTime($dateDepart);
            $dateTimeArrivee = new \DateTime($dateArrivee);

            if ($dateTimeArrivee <= $dateTimeDepart) {
                $_SESSION['flash_message'] = "Erreur : la date d'arrivée doit être postérieure au départ.";
                header('Location: /');
                exit;
            }

            $db = Database::getConnection();
            
            // Vérification des droits (auteur ou admin)
            $stmtCheck = $db->prepare("SELECT auteur FROM Trajet WHERE id = ?");
            $stmtCheck->execute([$id]);
            $trajet = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if (!$trajet || ($trajet['auteur'] != $_SESSION['user_id'] && (!isset($_SESSION['user_admin']) || $_SESSION['user_admin'] != 1))) {
                $_SESSION['flash_message'] = "Erreur : action non autorisée.";
                header('Location: /');
                exit;
            }

            // Mise à jour en BDD
            $stmt = $db->prepare("UPDATE Trajet SET Ville_départ = ?, Ville_arrivée = ?, Date_départ = ?, Date_arrivée = ?, places_restantes = ? WHERE id = ?");
            $success = $stmt->execute([$villeDepart, $villeArrivee, $dateDepart, $dateArrivee, $places, $id]);

            if ($success) {
                $_SESSION['flash_message'] = "Le trajet a été modifié avec succès !";
            } else {
                $_SESSION['flash_message'] = "Erreur lors de la modification du trajet.";
            }

            header('Location: /');
            exit;
        }
    }

    /**
     * Supprime un trajet existant.
     * 
     * @return void
     */
    public static function destroy() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['flash_message'] = "Erreur : vous devez être connecté.";
            header('Location: /');
            exit;
        }

        $id = $_GET['id'] ?? null;

        if (empty($id)) {
            $_SESSION['flash_message'] = "Erreur : ID de trajet introuvable.";
            header('Location: /');
            exit;
        }

        $db = Database::getConnection();

        // Vérification des droits (auteur du trajet ou administrateur)
        $stmtCheck = $db->prepare("SELECT auteur FROM Trajet WHERE id = ?");
        $stmtCheck->execute([$id]);
        $trajet = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if (!$trajet || ($trajet['auteur'] != $_SESSION['user_id'] && (!isset($_SESSION['user_admin']) || $_SESSION['user_admin'] != 1))) {
            $_SESSION['flash_message'] = "Erreur : action non autorisée.";
            header('Location: /');
            exit;
        }

        // Suppression en BDD
        $stmt = $db->prepare("DELETE FROM Trajet WHERE id = ?");
        $success = $stmt->execute([$id]);

        if ($success) {
            $_SESSION['flash_message'] = "Le trajet a été supprimé avec succès.";
        } else {
            $_SESSION['flash_message'] = "Erreur lors de la suppression du trajet.";
        }

        header('Location: /');
        exit;
    }
}