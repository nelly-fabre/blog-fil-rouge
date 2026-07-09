# Figurines Expo

Site de gestion et d'exposition d'une collection de figurines, développé dans le cadre de la formation **DWWM (Développeur Web et Web Mobile)**.

Le site permet de consulter un catalogue de figurines en accès public limité, puis d'accéder au catalogue complet et aux fonctionnalités de gestion (ajout, modification, suppression) après connexion.

---

## Sommaire

- [Fonctionnalités](#fonctionnalités)
- [Technologies utilisées](#technologies-utilisées)
- [Structure du projet](#structure-du-projet)
- [Architecture : Front Controller](#architecture--front-controller)
- [Routes disponibles](#routes-disponibles)
- [Base de données](#base-de-données)
- [Installation](#installation)
- [Journal des actions (logs)](#journal-des-actions-logs)

---

## Fonctionnalités

- Page d'accueil publique présentant un aperçu de 3 figurines
- Authentification des administrateurs (connexion / déconnexion)
- Consultation du catalogue complet après connexion
- Ajout, modification et suppression d'une figurine (CRUD)
- Upload d'image pour chaque figurine
- Fiche détaillée par figurine, avec URL propre et lisible (SEO friendly)
- Partage de la fiche figurine via l'API Web Share du navigateur
- Journal des actions (logs) consultable par les administrateurs connectés

## Technologies utilisées

- **PHP** (procédural, PDO pour l'accès à la base de données)
- **MySQL / MariaDB** (via phpMyAdmin, environnement WampServer)
- **Bootstrap 5.3** pour l'interface
- **JavaScript** (API Web Share pour le partage de fiches)
- **Apache** avec `mod_rewrite` pour la réécriture d'URL

## Structure du projet

```
blog/
├── common/                 Fichiers partagés, non accessibles depuis le navigateur
│   ├── connect.php         Connexion PDO à la base de données + démarrage de session
│   ├── functions.php       Fonctions utilitaires (slugify, redirection, requêtes communes)
│   ├── logger.php          Système de journalisation des actions
│   ├── head.php            Balises <head> communes
│   ├── header.php          En-tête / barre de navigation commune
│   └── logs/
│       └── actions.json    Journal des actions au format JSON
│
├── pages/                  Pages de l'application, appelées uniquement via le routeur
│   ├── accueil.php
│   ├── Read.php            Catalogue complet
│   ├── article.php         Fiche détaillée d'une figurine
│   ├── login.php / submit-login.php
│   ├── logout.php
│   ├── Create.php / Create_post.php
│   ├── Update.php / Update_post.php
│   ├── Delete.php / Delete_post.php
│   └── logs.php            Consultation du journal des actions
│
└── public/                 Racine du site (dossier pointé par le virtual host)
    ├── index.php            Front controller (point d'entrée unique)
    ├── .htaccess            Règles de réécriture d'URL
    └── assets/
        ├── img/             Images des figurines
        └── js/
            └── share.js     Script de partage
```

## Architecture : Front Controller

Le projet repose sur un **front controller** : toutes les requêtes passent par un point d'entrée unique, `public/index.php`, qui joue le rôle de routeur.

**Fonctionnement :**

1. Le `.htaccess` redirige toute URL qui ne correspond pas à un fichier ou dossier réel vers `index.php`, avec l'URL demandée en paramètre (`?url=...`).
2. `index.php` lit ce paramètre et consulte une table de routage (`$routes`) qui associe chaque route à un fichier PHP précis dans `pages/`.
3. Si la route existe, le fichier correspondant est inclus. Sinon, une erreur 404 est renvoyée.
4. Les fiches figurines (`figurine/23-nom-du-slug`) sont traitées par une expression régulière dédiée, qui extrait l'identifiant et inclut `article.php`.

**Pourquoi cette architecture ?**

- Sécurité : les fichiers de `pages/` sont physiquement en dehors de `public/`, donc inaccessibles directement par une URL — seul `index.php` peut les inclure.
- Centralisation : un seul point de contrôle pour l'ensemble du routage.
- URLs propres : les routes n'ont pas d'extension `.php` visible (`/lire`, `/connexion`, `/ajouter`...).

## Routes disponibles

| Route                  | Page                        | Description                              |
|-------------------------|------------------------------|-------------------------------------------|
| `/` ou `/accueil`       | `accueil.php`                | Page d'accueil publique (3 figurines)     |
| `/lire`                 | `Read.php`                   | Catalogue complet (connexion requise)     |
| `/figurine/{id}-{slug}` | `article.php`                | Fiche détaillée d'une figurine            |
| `/connexion`            | `login.php`                  | Formulaire de connexion                   |
| `/connexion-post`       | `submit-login.php`           | Traitement de la connexion                |
| `/deconnexion`          | `logout.php`                 | Déconnexion                               |
| `/ajouter`              | `Create.php`                 | Formulaire d'ajout d'une figurine          |
| `/ajouter-post`         | `Create_post.php`            | Traitement de l'ajout                     |
| `/modifier`             | `Update.php`                 | Formulaire de modification                |
| `/modifier-post`        | `Update_post.php`            | Traitement de la modification             |
| `/supprimer`            | `Delete.php`                 | Confirmation de suppression               |
| `/supprimer-post`       | `Delete_post.php`            | Traitement de la suppression              |
| `/logs`                 | `logs.php`                   | Journal des actions (connexion requise)   |

## Base de données

Base : `expo_figurines`

| Table       | Description                                                    |
|-------------|------------------------------------------------------------------|
| `vendeurs`  | Vendeurs/boutiques proposant des figurines                       |
| `figurines` | Figurines exposées (nom, licence, description, date d'ajout...)  |
| `valeur`    | Estimation de prix et état de chaque figurine                    |
| `admins`    | Comptes administrateurs (login, mot de passe hashé, droits)       |

Le script SQL de création et de peuplement se trouve dans `common/figurines_expo.sql`.

## Installation

1. Cloner ou copier le projet dans le dossier `www` de WampServer.
2. Configurer un virtual host Apache pointant vers le dossier `public/`.
3. Vérifier que le module `rewrite_module` est activé dans Apache, et que `AllowOverride All` est défini pour le dossier du projet.
4. Importer `common/figurines_expo.sql` dans phpMyAdmin.
5. Vérifier les identifiants de connexion à la base dans `common/connect.php`.
6. Accéder au site via l'URL configurée pour le virtual host.

## Journal des actions (logs)

Chaque action importante (connexion, création/modification/suppression d'une figurine, déconnexion) est enregistrée dans `common/logs/actions.json`, avec la date, l'utilisateur concerné, le type d'action, des détails contextuels et l'adresse IP.

Ce journal est consultable via la route `/logs`, réservée aux utilisateurs connectés.
