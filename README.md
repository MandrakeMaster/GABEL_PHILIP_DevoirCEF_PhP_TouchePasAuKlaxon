# Touche pas au klaxon ! 🚗

Application web de covoiturage interne développée en **PHP pur (Architecture MVC)** sans framework lourd, dans le cadre de la formation de développeur web et web mobile.

## 🛠️ Stack Technique
* **PHP** (avec l'extension PDO pour la base de données)
* **MySQL** / MariaDB
* **Bootstrap 5 & Sass** (pour l'interface utilisateur)
* **PHPStan** (pour l'analyse statique du code et la qualité)
* **Composer** (gestion des dépendances PHP et autoloading PSR-4)
* **NPM** (gestion des dépendances front-end / compilation Sass)

---

## 📂 Structure de la Base de Données

Le dossier `/database` contient les scripts SQL nécessaires à la mise en place de l'application :
- `schema.sql` : Crée la structure des tables (`Agences`, `User`, `Trajet`) avec les contraintes d'intégrité et clés étrangères en cascade.
- `data.sql` : Initialise la base de données avec un jeu de données de référence et pré-configure un administrateur.
- `test.sql` : Contient des requêtes de vérification et des exemples de manipulation SQL pour les tests.

### ⚙️ Initialisation de la base de données sous MySQL / phpMyAdmin :

**1.** Créez une base de données nommée `touche_pas_au_klaxon` (ou modifiez le nom dans `config/database.php`).

**2.** Exécutez le script **`schema.sql`** pour créer les tables.

**3.** Exécutez le script **`data.sql`** pour insérer les agences et les utilisateurs de test.

> ℹ️ **Comptes et Rôles :** 
> Le script `data.sql` configure automatiquement l'utilisateur **Alexandre Martin** (`alexandre.martin@email.fr`) en tant qu'administrateur (`is_admin = 1`). 
> 
> Si vous souhaitez basculer un autre utilisateur en administrateur, vous pouvez exécuter la requête suivante dans l'onglet **SQL** de phpMyAdmin :
> ```sql
> UPDATE User SET is_admin = 1 WHERE email = 'votre.email@email.fr';
> ```

---

## 🚀 Installation et Lancement du Projet

**1.** Cloner ou placer le projet dans votre environnement de développement local (ex: `htdocs` sous WampServer / Xampp ou via le serveur interne PHP).  
 > git clone https://github.com/MandrakeMaster/GABEL_PHILIP_DevoirCEF_PhP_TouchePasAuKlaxon

**2.** Installer les dépendances PHP via Composer :
 > composer install

**3.** Installer les dépendances front-end (si modification des styles Sass) :
> npm install

**4.** Configurer la connexion BDD dans le fichier `config/database.php` (en adaptant le nom de la base de données, l'utilisateur et le mot de passe selon votre environnement local) :
```php
return [
    'host' => 'localhost',
    'dbname' => 'touche_pas_au_klaxon',
    'username' => 'root',
    'password' => '', 
    'charset' => 'utf8mb4'
];
```
**5.** Lancer l'analyse statique (PHPStan) pour vérifier la conformité et la robustesse du code :
vendor/bin/phpstan analyse

---

## 👤 Auteur
* **Philip Gabel** - Étudiant Développeur Web et Web Mobile (Centre Européen de Formation)
