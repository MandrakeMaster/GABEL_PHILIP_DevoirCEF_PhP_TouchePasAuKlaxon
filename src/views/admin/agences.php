<?php
// Inclusion du header
require_once __DIR__ . '/../partials/header.php';
?>

<div class="container my-4">
    <h1 class="mb-4">Administration - Gestion des Agences</h1>

    <!-- Affichage des messages flash -->
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($_SESSION['flash_message']) ?>
            <?php unset($_SESSION['flash_message']); ?>
        </div>
    <?php endif; ?>

    <!-- Formulaire d'ajout d'une agence optimisé -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Ajouter une nouvelle agence</h5>
        </div>
        <div class="card-body">
            <form action="/admin/agences/store" method="POST">
                <div class="row align-items-center">
                    <div class="col-md-9 mb-2 mb-md-0">
                        <input type="text" name="ville" class="form-control" placeholder="Nom de la ville (ex: Strasbourg)" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success w-100">Ajouter l'agence</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tableau de liste des agences optimisé -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Liste des agences existantes</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 10%;" class="py-3 ps-3">ID</th>
                        <th style="width: 65%;" class="py-3">Ville</th>
                        <th style="width: 25%;" class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($agences)): ?>
                        <?php foreach ($agences as $agence): ?>
                            <tr>
                                <td class="ps-3 fw-bold"><?= htmlspecialchars($agence['id']) ?></td>
                                <td><?= htmlspecialchars($agence['Ville']) ?></td>
                                <td class="text-end pe-3">
                                    <!-- Bouton déclenchant la modale -->
                                    <button type="button" class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $agence['id'] ?>">
                                        Modifier
                                    </button>
                                    
                                    <!-- Bouton de suppression -->
                                    <a href="/admin/agences/supprimer?id=<?= $agence['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette agence ?');">
                                        Supprimer
                                    </a>
                                </td>
                            </tr>

                            <!-- Modale de modification dédiée à cette agence -->
                            <div class="modal fade" id="editModal<?= $agence['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $agence['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?= $agence['id'] ?>">Modifier l'agence</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                        </div>
                                        <form action="/admin/agences/update" method="POST">
                                            <div class="modal-body text-start">
                                                <input type="hidden" name="id" value="<?= $agence['id'] ?>">
                                                <div class="form-group mb-3">
                                                    <label for="ville<?= $agence['id'] ?>" class="form-label">Nom de la ville</label>
                                                    <input type="text" class="form-control" id="ville<?= $agence['id'] ?>" name="ville" value="<?= htmlspecialchars($agence['Ville']) ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary">Valider</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center py-4">Aucune agence trouvée.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Inclusion du footer
require_once __DIR__ . '/../partials/footer.php';
?>