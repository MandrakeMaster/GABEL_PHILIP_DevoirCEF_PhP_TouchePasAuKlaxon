<!-- Modale de modification de trajet -->
<div class="modal fade" id="modalEditTrajet<?= $trajet['id'] ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/trajet-update" method="POST">
                <!-- On passe l'ID du trajet en champ caché -->
                <input type="hidden" name="id" value="<?= $trajet['id'] ?>">
                
                <div class="modal-header">
                    <h5 class="modal-title">Modifier le trajet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="ville_depart<?= $trajet['id'] ?>" class="form-label small fw-bold">Agence de départ</label>
                            <select class="form-select form-select-sm" id="ville_depart<?= $trajet['id'] ?>" name="ville_depart" required>
                                <?php if (!empty($agences)): ?>
                                    <?php foreach ($agences as $agence): ?>
                                        <option value="<?= $agence['id'] ?>" <?= ($trajet['Ville_départ'] == $agence['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($agence['Ville']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="ville_arrivee<?= $trajet['id'] ?>" class="form-label small fw-bold">Agence d'arrivée</label>
                            <select class="form-select form-select-sm" id="ville_arrivee<?= $trajet['id'] ?>" name="ville_arrivee" required>
                                <?php if (!empty($agences)): ?>
                                    <?php foreach ($agences as $agence): ?>
                                        <option value="<?= $agence['id'] ?>" <?= ($trajet['Ville_arrivée'] == $agence['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($agence['Ville']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="date_depart<?= $trajet['id'] ?>" class="form-label small fw-bold">Date et heure de départ</label>
                            <input type="datetime-local" class="form-control form-control-sm" id="date_depart<?= $trajet['id'] ?>" name="date_depart" value="<?= date('Y-m-d\TH:i', strtotime($trajet['Date_départ'])) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="date_arrivee<?= $trajet['id'] ?>" class="form-label small fw-bold">Date et heure d'arrivée</label>
                            <input type="datetime-local" class="form-control form-control-sm" id="date_arrivee<?= $trajet['id'] ?>" name="date_arrivee" value="<?= date('Y-m-d\TH:i', strtotime($trajet['Date_arrivée'])) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="places<?= $trajet['id'] ?>" class="form-label small fw-bold">Places restantes</label>
                            <input type="number" class="form-control form-control-sm" id="places<?= $trajet['id'] ?>" name="places" min="0" value="<?= $trajet['places_restantes'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-dark btn-sm">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>