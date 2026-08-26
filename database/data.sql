SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE `Trajet`;
TRUNCATE TABLE `User`;
TRUNCATE TABLE `Agences`;

SET FOREIGN_KEY_CHECKS = 1;


INSERT INTO `Agences` (`id`, `Ville`) VALUES
(1, 'Paris'),
(2, 'Lyon'),
(3, 'Marseille'),
(4, 'Toulouse'),
(5, 'Nice'),
(6, 'Nantes'),
(7, 'Strasbourg'),
(8, 'Montpellier'),
(9, 'Bordeaux'),
(10, 'Lille'),
(11, 'Rennes'),
(12, 'Reims');

-- 2. Insertion des Utilisateurs / Employés (Jeu d'essai)
-- Le premier est défini comme administrateur (`is_admin = 1`) pour les tests
INSERT INTO `User` (`id`, `Nom`, `Prénom`, `téléphone`, `email`, `is_admin`) VALUES
(1, 'Martin', 'Alexandre', '0612345678', 'alexandre.martin@email.fr', 1),
(2, 'Bernard', 'Sophie', '0623456789', 'sophie.bernard@email.fr', 0),
(3, 'Thomas', 'Lucas', '0634567890', 'lucas.thomas@email.fr', 0),
(4, 'Petit', 'Emma', '0645678901', 'emma.petit@email.fr', 0),
(5, 'Robert', 'Thomas', '0656789012', 'thomas.robert@email.fr', 0),
(6, 'Richard', 'Chloé', '0667890123', 'chloe.richard@email.fr', 0),
(7, 'Durand', 'Nicolas', '0678901234', 'nicolas.durand@email.fr', 0),
(8, 'Dubois', 'Manon', '0689012345', 'manon.dubois@email.fr', 0),
(9, 'Moreau', 'Julien', '0690123456', 'julien.moreau@email.fr', 0),
(10, 'Laurent', 'Camille', '0601234567', 'camille.laurent@email.fr', 0),
(11, 'Simon', 'Antoine', '0611223344', 'antoine.simon@email.fr', 0),
(12, 'Michel', 'Sarah', '0622334455', 'sarah.michel@email.fr', 0),
(13, 'Lefebvre', 'Maxime', '0633445566', 'maxime.lefebvre@email.fr', 0),
(14, 'Leroy', 'Laura', '0644556677', 'laura.leroy@email.fr', 0),
(15, 'Roux', 'David', '0655667788', 'david.roux@email.fr', 0),
(16, 'David', 'Audrey', '0666778899', 'audrey.david@email.fr', 0),
(17, 'Bertrand', 'Romain', '0677889900', 'romain.bertrand@email.fr', 0),
(18, 'Morel', 'Julie', '0688990011', 'julie.morel@email.fr', 0),
(19, 'Smith', 'Kevin', '0699001122', 'kevin.smith@email.fr', 0),
(20, 'Gauthier', 'Océane', '0600112233', 'oceane.gauthier@email.fr', 0);