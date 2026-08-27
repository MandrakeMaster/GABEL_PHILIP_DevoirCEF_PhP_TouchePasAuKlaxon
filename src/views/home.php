<?php require_once __DIR__ . '/partials/header.php'; ?>

<?php if (!isset($_SESSION['user_id'])): ?>
    <p class="text-secondary mb-4">Pour obtenir plus d'informations sur un trajet, veuillez vous connecter</p>
<?php endif; ?>

<h2 class="mb-4">Trajets proposés</h2>

<?php if (empty($trajets)): ?>
    <div class="alert alert-info">Aucun trajet disponible pour le moment.</div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle border shadow-sm bg-white">
            <thead class="table-dark">
                <tr>
                    <th>Départ</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Destination</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Places</th>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <th class="text-center">Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trajets as $trajet): ?>
                    <?php 
                        $dateDepartObj = new DateTime($trajet['Date_départ']);
                        $dateArriveeObj = new DateTime($trajet['Date_arrivée']);
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($trajet['ville_depart_nom']) ?></td>
                        <td><?= $dateDepartObj->format('d/m/Y') ?></td>
                        <td><?= $dateDepartObj->format('H:i') ?></td>
                        <td><?= htmlspecialchars($trajet['ville_arrivee_nom']) ?></td>
                        <td><?= $dateArriveeObj->format('d/m/Y') ?></td>
                        <td><?= $dateArriveeObj->format('H:i') ?></td>
                        <td><?= $trajet['places_restantes'] ?></td>

                        <?php if (isset($_SESSION['user_id'])): ?>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-light text-dark border-0" data-bs-toggle="modal" data-bs-target="#modalDetails<?= $trajet['id'] ?>" title="Détails">
                                    👁️
                                </button>

                                <?php if ($trajet['auteur'] == $_SESSION['user_id'] || (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1)): ?>
                                    <a href="/trajets/modifier?id=<?= $trajet['id'] ?>" class="btn btn-sm btn-light text-dark border-0" title="Modifier">✏️</a>
                                    <a href="/trajets/supprimer?id=<?= $trajet['id'] ?>" class="btn btn-sm btn-light text-danger border-0" title="Supprimer" onclick="return confirm('Confirmer la suppression ?')">🗑️</a>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>

                    <!-- Inclusion propre de la modale pour ce trajet -->
                    <?php if (isset($_SESSION['user_id'])) {
                        include __DIR__ . '/partials/modal-details.php';
                    } ?>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/partials/footer.php'; ?>