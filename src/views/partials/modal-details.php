<div class="modal fade" id="modalDetails<?= $trajet['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails du trajet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <p><strong>Auteur :</strong> <?= htmlspecialchars($trajet['auteur_prenom'] . ' ' . $trajet['auteur_nom']) ?></p>
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($trajet['auteur_telephone'] ?? 'Non renseigné') ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($trajet['auteur_email'] ?? 'Non renseigné') ?></p>
                <p><strong>Nombre total de places :</strong> <?= $trajet['nombre_total_places'] ?? 'X' ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>