<!-- Modale de création de trajet -->
<div class="modal fade" id="modalCreateTrajet" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/trajet-store" method="POST" id="formCreateTrajet">
                <div class="modal-header">
                    <h5 class="modal-title">Proposer un nouveau trajet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Informations de l'auteur -->
                        <div class="col-12">
                            <h6 class="text-muted border-bottom pb-2">Informations de contact (Auteur)</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Nom & Prénom</label>
                            <input type="text" class="form-control form-control-sm" value="<?= htmlspecialchars(($_SESSION['user_prenom'] ?? '') . ' ' . ($_SESSION['user_nom'] ?? '')) ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Email</label>
                            <input type="email" class="form-control form-control-sm" value="<?= htmlspecialchars($_SESSION['user_email'] ?? '') ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Téléphone</label>
                            <input type="text" class="form-control form-control-sm" value="<?= htmlspecialchars($_SESSION['user_telephone'] ?? '') ?>" disabled>
                        </div>

                        <!-- Trajet -->
                        <div class="col-12 mt-4">
                            <h6 class="text-muted border-bottom pb-2">Détails du trajet</h6>
                        </div>
                        <div class="col-md-6">
                            <label for="ville_depart" class="form-label small fw-bold">Agence de départ</label>
                            <select class="form-select form-select-sm" id="ville_depart" name="ville_depart" required>
                                <option value="">Sélectionner une agence</option>
                                <?php if (!empty($agences)): ?>
                                    <?php foreach ($agences as $agence): ?>
                                        <option value="<?= $agence['id'] ?>"><?= htmlspecialchars($agence['Ville']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="ville_arrivee" class="form-label small fw-bold">Agence d'arrivée</label>
                            <select class="form-select form-select-sm" id="ville_arrivee" name="ville_arrivee" required>
                                <option value="">Sélectionner une agence</option>
                                <?php if (!empty($agences)): ?>
                                    <?php foreach ($agences as $agence): ?>
                                        <option value="<?= $agence['id'] ?>"><?= htmlspecialchars($agence['Ville']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="date_depart" class="form-label small fw-bold">Date et heure de départ</label>
                            <input type="datetime-local" class="form-control form-control-sm" id="date_depart" name="date_depart" min="<?= date('Y-m-d\TH:i') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="date_arrivee" class="form-label small fw-bold">Date et heure d'arrivée</label>
                            <input type="datetime-local" class="form-control form-control-sm" id="date_arrivee" name="date_arrivee" min="<?= date('Y-m-d\TH:i') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="places" class="form-label small fw-bold">Nombre total de places</label>
                            <input type="number" class="form-control form-control-sm" id="places" name="places" min="1" value="3" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-dark btn-sm">Valider la proposition</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Petit script JS pour s'assurer que la date d'arrivée est toujours supérieure ou égale au départ -->
<script>
document.getElementById('date_depart').addEventListener('change', function() {
    const departValue = this.value;
    const arriveeInput = document.getElementById('date_arrivee');
    arriveeInput.min = departValue;
    if (arriveeInput.value && arriveeInput.value < departValue) {
        arriveeInput.value = departValue;
    }
});
</script>