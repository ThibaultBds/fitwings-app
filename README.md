# Fitwings

## Regle de contenu (Programmes)

La page `/programmes` affiche uniquement des programmes issus de la base de donnees (`programme`).

- Source: table `programme`
- Gestion: admin (create/update/delete depuis le panneau admin)
- Cote utilisateur: consultation detail + inscription a un programme

## Pages editoriales

Les pages `/pages/cardio`, `/pages/musculation`, `/pages/cours`, etc. sont des pages de presentation/conseils.
Elles ne remplacent pas les programmes officiels en base.

## Navigation

- `/programmes` : liste officielle des programmes DB
- `/programmes/show?id=...` : detail d'un programme

## Migration details programme (DB existante)

Si votre base existe deja, executer dans phpMyAdmin:

- `docker/mysql-init/programme_details_upgrade.sql`

Ce script ajoute les colonnes de detail et remplit les programmes seedes.

## Recette manuelle

- `doc/manual-test-checklist.md`
