<?php 
$hasError = isset($_SESSION['flash_error']);
$hasSuccess = isset($_SESSION['flash_success']);
$isOpen = $hasError || $hasSuccess;
?>

<!-- Modale de connexion (ouverte automatiquement s'il y a un retour de session) -->
<div class="modal fade <?= $isOpen ? 'show' : '' ?>" id="modalLogin" tabindex="-1" aria-hidden="true" <?= $isOpen ? 'style="display: block;"' : '' ?>>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Connexion à Touche pas au klaxon</h5>
                <!-- La croix recharge la page pour fermer proprement la modale -->
                <a href="/" class="btn-close" aria-label="Fermer"></a>
            </div>
            <div class="modal-body">
                <!-- Message d'erreur en rouge -->
                <?php if ($hasError): ?>
                    <div class="alert alert-danger small py-2" role="alert">
                        <?= htmlspecialchars($_SESSION['flash_error']) ?>
                    </div>
                    <?php unset($_SESSION['flash_error']); ?>
                <?php endif; ?>

                <!-- Message de validation en vert -->
                <?php if ($hasSuccess): ?>
                    <div class="alert alert-success small py-2 mb-0" role="alert">
                        <?= htmlspecialchars($_SESSION['flash_success']) ?>
                    </div>
                    <?php unset($_SESSION['flash_success']); ?>
                <?php else: ?>
                    <!-- Le formulaire de saisie s'affiche uniquement si la connexion n'est pas encore réussie -->
                    <form action="/login-submit" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold">Adresse Email</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Ex: mon.email@fai.fr" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-dark btn-sm">Se connecter</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <!-- Le bouton Fermer recharge la page d'accueil -->
                <a href="/" class="btn btn-secondary btn-sm">Fermer</a>
            </div>
        </div>
    </div>
</div>

<!-- Voile sombre (backdrop) cliquable pour fermer la modale -->
<?php if ($isOpen): ?>
    <div class="modal-backdrop fade show" onclick="window.location.href='/'" style="cursor: pointer;"></div>
<?php endif; ?>