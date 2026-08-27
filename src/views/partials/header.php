<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Touche pas au klaxon</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    <header class="container my-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border rounded shadow-sm px-4 py-3">
            <a class="navbar-brand fw-bold text-dark" href="/">Touche pas au klaxon</a>
            
            <div class="ms-auto d-flex align-items-center gap-3">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Menu Administrateur (si is_admin == 1) -->
                    <?php if (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
                        <a href="/admin/utilisateurs" class="btn btn-secondary btn-sm">Utilisateurs</a>
                        <a href="/admin/agences" class="btn btn-secondary btn-sm">Agences</a>
                        <a href="/admin/trajets" class="btn btn-secondary btn-sm">Trajets</a>
                    <?php endif; ?>

                    <!-- Bouton Créer un trajet (pour utilisateur connecté) -->
                    <a href="/trajets/creer" class="btn btn-dark btn-sm">Créer un trajet</a>

                    <!-- Message de bienvenue -->
                    <span class="text-secondary small">Bonjour <?= htmlspecialchars($_SESSION['user_prenom'] . ' ' . $_SESSION['user_nom']) ?></span>

                    <!-- Bouton Déconnexion -->
                    <a href="/logout" class="btn btn-dark btn-sm">Déconnexion</a>
                <?php else: ?>
                    <!-- Visiteur non connecté -->
                    <a href="/connexion" class="btn btn-dark btn-sm">Connexion</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main class="container my-4 flex-fill">
        <!-- Gestion des messages flash éventuels (ex: Le trajet a été modifié) -->
        <?php if (isset($_SESSION['flash_message'])): ?>
            <div class="alert alert-secondary border shadow-sm mb-4" role="alert">
                <?= htmlspecialchars($_SESSION['flash_message']) ?>
            </div>
            <?php unset($_SESSION['flash_message']); ?>
        <?php endif; ?>