<?php
// Inclusion du header
require_once __DIR__ . '/../partials/header.php';
?>

<div class="container my-4">
    <h1 class="mb-4">Administration - Liste des Utilisateurs</h1>

    <!-- Affichage des messages flash -->
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($_SESSION['flash_message']) ?>
            <?php unset($_SESSION['flash_message']); ?>
        </div>
    <?php endif; ?>

    <!-- Tableau de liste des utilisateurs (en lecture seule selon le brief) -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Liste des employés inscrits</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 5%;" class="py-3 ps-3">ID</th>
                        <th style="width: 25%;" class="py-3">Nom & Prénom</th>
                        <th style="width: 35%;" class="py-3">Email</th>
                        <th style="width: 20%;" class="py-3">Téléphone</th>
                        <th style="width: 15%;" class="py-3 text-center pe-3">Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($utilisateurs)): ?>
                        <?php foreach ($utilisateurs as $user): ?>
                            <tr>
                                <td class="ps-3 fw-bold"><?= htmlspecialchars($user['id']) ?></td>
                                <td><?= htmlspecialchars($user['Nom'] . ' ' . $user['Prénom']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['téléphone']) ?></td>
                                <td class="text-center pe-3">
                                    <?php if ($user['is_admin'] == 1): ?>
                                        <span class="badge bg-danger">Administrateur</span>
                                    <?php else: ?>
                                        <span class="badge bg-primary">Utilisateur</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">Aucun utilisateur trouvé.</td>
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