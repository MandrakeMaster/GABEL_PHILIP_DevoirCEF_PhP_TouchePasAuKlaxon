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