-- ==========================================
-- FICHIER DE TEST ET DE VERIFICATION SQL
-- ==========================================

-- 1. Afficher tous les utilisateurs avec leur rôle (Employé ou Admin)
SELECT `Nom`, `Prénom`, `email`, 
       CASE WHEN `is_admin` = 1 THEN 'Administrateur' ELSE 'Employé' END AS `Rôle`
FROM `User`;

-- 2. Afficher la liste de toutes les agences classées par ordre alphabétique de ville
SELECT * FROM `Agences` ORDER BY `Ville` ASC;

-- 3. Exemple d'insertion d'un trajet de test (Ex: Trajet de Paris ID 1 vers Lyon ID 2, créé par l'User ID 1)
INSERT INTO `Trajet` (`Ville_départ`, `Ville_arrivée`, `Date_départ`, `Date_arrivée`, `places_restantes`, `auteur`) 
VALUES (1, 2, '2026-09-10 08:00:00', '2026-09-10 12:30:00', 3, 1);


-- 4. Afficher la liste complète des trajets avec les noms des villes de départ et d'arrivée, et l'auteur du trajet
SELECT 
    t.`id`,
    a_dep.`Ville` AS `Ville_depart`,
    a_arr.`Ville` AS `Ville_arrivee`,
    t.`Date_départ`,
    t.`Date_arrivée`,
    t.`places_restantes`,
    CONCAT(u.`Prénom`, ' ', u.`Nom`) AS `Auteur`
FROM `Trajet` t
JOIN `Agences` a_dep ON t.`Ville_départ` = a_dep.`id`
JOIN `Agences` a_arr ON t.`Ville_arrivée` = a_arr.`id`
JOIN `User` u ON t.`auteur` = u.`id`;

-- 5. Tester une recherche de trajets (Ex: tous les trajets partant de Paris - id 1)
SELECT * FROM `Trajet` WHERE `Ville_départ` = 1 AND `Date_départ` > NOW();