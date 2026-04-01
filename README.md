# FitWings

Application web de fitness développée dans le cadre du TP DWWM. L'idée : permettre à des utilisateurs de s'inscrire à des programmes sportifs, suivre leur progression, et accéder aux informations des salles partenaires.

Pas de framework — MVC maison avec un pattern Repository et des middlewares de gestion des rôles.

## Stack

**Back-end**
- PHP 8.2
- MySQL 8.4
- MongoDB 7.0
- Composer / PHPUnit 11

**Front-end**
- HTML / CSS (variables, responsive)
- JavaScript vanilla

**Infra**
- Docker en local
- Heroku en production

## Structure

```
fitwings/
├── docker/
│   └── mysql-init/
├── public/
│   └── assets/
│       ├── css/
│       ├── img/
│       └── js/
├── routes/
├── src/
│   ├── Controllers/
│   ├── Core/
│   │   └── Auth/
│   ├── Middleware/
│   ├── Models/
│   ├── Repositories/
│   ├── Security/
│   └── Views/
└── storage/
```

## Fonctionnalités

**Sans compte**
- Parcourir et filtrer les programmes (objectif, niveau)
- Consulter les salles de sport
- Lire les témoignages
- Formulaires contact, réservation de cours, candidature

**Utilisateur connecté**
- S'inscrire à un programme, se désinscrire
- Suivre sa progression (poids, tour de taille, sessions)
- Déposer un témoignage (passe par la modération)

**Modérateur**
- Valider ou refuser les témoignages

**Admin**
- CRUD programmes et salles
- Gestion des comptes (création, rôle, suppression)

## Rôles

| Rôle | Accès |
|---|---|
| user | Espace perso, programmes, témoignages |
| moderateur | Modération des avis |
| admin | Administration complète |

## Sécurité

- Mots de passe hashés (`password_hash`)
- Sessions : `httponly`, `samesite=Lax`, regénération à la connexion
- Requêtes préparées PDO (pas d'injection SQL)
- Tokens CSRF sur tous les formulaires POST
- Échappement des sorties (XSS)
- Protection injection d'en-têtes sur le formulaire contact
- Validation des entrées via `Security\Input`

## Comptes de démonstration

Mot de passe : `password`

| Rôle | Email |
|---|---|
| Admin | `admin@mail.com` |
| Modérateur | `moderateur@mail.com` |
| Utilisateur | `marc@mail.com` |

## Installation

```bash
git clone <url>
cd fitwings
composer install
docker-compose up -d --build
```

| Service | URL |
|---|---|
| Application | http://localhost:8082 |
| phpMyAdmin | http://localhost:8083 |
| MailHog | http://localhost:8026 |

Les emails sont interceptés par MailHog en local — rien n'est envoyé pour de vrai.

## Variables d'environnement

Déjà définies dans `docker-compose.yml`, pas besoin de `.env` en local.

```env
APP_ENV=dev
DB_HOST=db
DB_PORT=3306
DB_DATABASE=fitwings
DB_USERNAME=fitwings_user
DB_PASSWORD=fitwings_pass
DB_CHARSET=utf8mb4
MONGO_URI=mongodb://mongo:27017
MAIL_HOST=mailhog
MAIL_PORT=1025
```

## Base de données

Schéma et données de test dans `docker/mysql-init/` :
- `init.sql` — création des tables
- `seed.sql` — données de démo

Tables : `users`, `programmes`, `programme_utilisateur`, `salle`, `temoignages`, `progression`, `candidatures`, `reservations`, `coachs`

## Déploiement (Heroku)

```bash
git push heroku main
```

Penser à configurer les variables d'environnement et à provisionner JawsDB (MySQL). Un délai de réveil peut apparaître au premier accès (mise en veille automatique sur plan gratuit).

## Tests

Checklist de recette manuelle disponible dans `doc/manual-test-checklist.md`.
