# Site de Lutherie 🎻

## Sujet 🎯

Ce projet consiste en la création d'un site web complet pour un petit magasin de lutherie. Le site a été développé en HTML/CSS/JS et PHP, et s'articule autour d'une base de données MySQL. Nous avons choisi d'utiliser PHP version 7 et Bootstrap pour le design du site.

### Objectifs du Projet

Le site web a pour vocation de répondre aux besoins suivants :

- Présenter les produits du magasin
- Permettre aux clients de s'inscrire et de s'authentifier
- Offrir un espace client personnalisé où les clients peuvent gérer leurs informations personnelles
- Fournir un espace administrateur pour la gestion des locations, des clients, des villes, des instruments et leurs entretiens.

### Fonctionnalités Principales

- **Système d'inscription/authentification** : Permet aux utilisateurs de créer un compte et de se connecter.
- **Gestion des sessions et cookies** : Assure une expérience utilisateur continue et sécurisée.
- **Envoi de mail** : Utilisé pour la confirmation des inscriptions et autres notifications.
- **Vérification des données** : Assure que les données saisies par les utilisateurs sont valides.
- **Gestion des profils utilisateurs** : Différenciation entre les droits des administrateurs et des clients.
- **Requêtes variées** : Lecture, insertion, modification, suppression des données via des formulaires.

## Technologies Utilisées 🛠️

- **PHP** : Version 7
- **MySQL** : Base de données relationnelle
- **Bootstrap** : Framework CSS pour un design réactif
- **HTML/CSS/JS** : Pour la structure et le comportement du site
- **PDO** : Pour l'accès sécurisé et portable à la base de données

## Informations Complémentaires 📋

Voici quelques informations complémentaires sur ce site :

- Le [MCD](https://github.com/N-BLET/Site_ADC/blob/main/infos/MCD.pdf) (Modèle Conceptuel des Données)
- Le script [SQL de création](https://github.com/N-BLET/SITE_ADC/blob/main/infos/script_creation.sql) de la base de données
- Le script [SQL de peuplement](https://github.com/N-BLET/SITE_ADC/blob/main/infos/script_peuplement.sql) de la base de données

## Contributeur 👥
- **Nicolas BLET** - [N-BLET](https://github.com/N-BLET)

## Dockerisation 🐳

Ce projet est dockerisé pour faciliter le déploiement et le développement. Vous pouvez utiliser Docker pour lancer rapidement l'environnement de développement complet. Pour commencer :

1. Assurez-vous d'avoir Docker installé sur votre machine.
2. Clonez ce dépôt.
3. Naviguez vers le répertoire du projet.
4. Exécutez la commande suivante pour construire et démarrer les conteneurs :

   ```sh
   docker-compose up --build
   ```

5. Après que les conteneurs sont démarrés, il faut initialiser et peupler la base de données. Exécutez les commandes suivantes pour accéder au conteneur MySQL et exécuter les scripts SQL :

   ```sh
   docker exec -i mysql-container mysql -u root -p<your_password> < infos/script_creation.sql
   docker exec -i mysql-container mysql -u root -p<your_password> < infos/script_peuplement.sql
   ```

   Remplacez `<your_password>` par le mot de passe root configuré dans votre fichier `docker-compose.yml`.

Cela créera et remplira la base de données avec les tables et les données initiales. Vous pouvez ensuite accéder au site web via `http://localhost:8000`.
