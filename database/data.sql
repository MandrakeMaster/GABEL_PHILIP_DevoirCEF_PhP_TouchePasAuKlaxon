SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `Trajet`;
DROP TABLE IF EXISTS `User`;
DROP TABLE IF EXISTS `Agences`;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `Agences` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `Ville` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `User` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `Nom` VARCHAR(100) NOT NULL,
    `Prénom` VARCHAR(100) NOT NULL,
    `téléphone` VARCHAR(20) NOT NULL,
    `email` VARCHAR(150) NOT NULL,
    `is_admin` BOOLEAN NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `Trajet` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `Ville_départ` INT NOT NULL,
    `Ville_arrivée` INT NOT NULL,
    `Date_départ` DATETIME NOT NULL,
    `Date_arrivée` DATETIME NOT NULL,
    `places_restantes` INT NOT NULL,
    `auteur` INT NOT NULL,
    CONSTRAINT `fk_trajet_agence_depart` FOREIGN KEY (`Ville_départ`) REFERENCES `Agences`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_trajet_agence_arrivee` FOREIGN KEY (`Ville_arrivée`) REFERENCES `Agences`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_trajet_user` FOREIGN KEY (`auteur`) REFERENCES `User`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

INSERT INTO `User` (`id`, `Nom`, `Prénom`, `téléphone`, `email`, `is_admin`) VALUES
(1, 'Martin', 'Alexandre', '0612345678', 'alexandre.martin@email.fr', 1),
(2, 'Dubois', 'Sophie', '0698765432', 'sophie.dubois@email.fr', 0),
(3, 'Bernard', 'Julien', '0622446688', 'julien.bernard@email.fr', 0),
(4, 'Moreau', 'Camille', '0611223344', 'camille.moreau@email.fr', 0),
(5, 'Lefèvre', 'Lucie', '0777889900', 'lucie.lefevre@email.fr', 0),
(6, 'Leroy', 'Thomas', '0655443322', 'thomas.leroy@email.fr', 0),
(7, 'Roux', 'Chloé', '0633221199', 'chloe.roux@email.fr', 0),
(8, 'Petit', 'Maxime', '0766778899', 'maxime.petit@email.fr', 0),
(9, 'Garnier', 'Laura', '0688776655', 'laura.garnier@email.fr', 0),
(10, 'Dupuis', 'Antoine', '0744556677', 'antoine.dupuis@email.fr', 0),
(11, 'Lefebvre', 'Emma', '0699887766', 'emma.lefebvre@email.fr', 0),
(12, 'Fontaine', 'Louis', '0655667788', 'louis.fontaine@email.fr', 0),
(13, 'Chevalier', 'Clara', '0788990011', 'clara.chevalier@email.fr', 0),
(14, 'Robin', 'Nicolas', '0644332211', 'nicolas.robin@email.fr', 0),
(15, 'Gauthier', 'Marine', '0677889922', 'marine.gauthier@email.fr', 0),
(16, 'Fournier', 'Pierre', '0722334455', 'pierre.fournier@email.fr', 0),
(17, 'Girard', 'Sarah', '0688665544', 'sarah.girard@email.fr', 0),
(18, 'Lambert', 'Hugo', '0611223366', 'hugo.lambert@email.fr', 0),
(19, 'Masson', 'Julie', '0733445566', 'julie.masson@email.fr', 0),
(20, 'Henry', 'Arthur', '0666554433', 'arthur.henry@email.fr', 0);