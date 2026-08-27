<?php
use Gabel\GabelPhilipDevoirCefPhPTouchePasAuKlaxon\Models\Agence;
$agences = Agence::all();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Touche pas au klaxon</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Header principal -->
    <header class="container my-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border rounded shadow-sm px-4 py-3">
            <a class="navbar-brand fw-bold text-dark" href="/">Touche pas au klaxon</a>
            
            <div class="ms-auto d-flex align-items-center gap-3">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Navigation spécifique Administrateur -->
                    <?php if (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
                        <a href="/admin/utilisateurs" class="btn btn-secondary btn-sm">Utilisateurs</a>
                        <a href="/admin/agences" class="btn btn-secondary btn-sm">Agences</a>
                        <a href="/" class="btn btn-secondary btn-sm">Trajets</a>
                    <?php endif; ?>

                    <!-- Actions utilisateur connecté -->
                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreateTrajet">Créer un trajet</button>
                    <span class="text-secondary small">Bonjour <?= htmlspecialchars($_SESSION['user_prenom'] . ' ' . $_SESSION['user_nom']) ?></span>
                    <a href="/logout" class="btn btn-dark btn-sm">Déconnexion</a>
                <?php else: ?>
                    <!-- Bouton d'ouverture de la modale de connexion pour les visiteurs -->
                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalLogin">Connexion</button>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <!-- Contenu principal -->
    <main class="container my-4 flex-fill">
        <!-- Affichage des messages flash -->
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-secondary border shadow-sm mb-4" role="alert">
                <?= htmlspecialchars($_SESSION['flash_message']) ?>
            </div>
            <?php unset($_SESSION['flash_message']); ?>
        <?php endif; ?>

<!-- Inclusion de la modale de connexion -->
<?php include __DIR__ . '/modal-login.php'; ?>

<!-- Inclusion de la modale de création de trajet -->
<?php include __DIR__ . '/modal-create-trajet.php'; ?>