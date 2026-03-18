# Checklist de tests manuels

Objectif: valider rapidement les flux critiques apres une refacto MVC/Repository/Secu.

Duree cible: 5 a 10 minutes.

## Prerequis

- Lancer l'application et verifier que la page d'accueil `/` repond.
- Avoir une base avec les tables seedees.
- Avoir au moins un compte `admin`.
- Avoir au moins un programme et une salle en base.

## Comptes utiles

- `admin`: acces au panneau `/admin`
- `user`: acces `/account`, `/mes-programmes`, depot de temoignage

Si besoin, creer un compte user via `/register`, puis promouvoir en base temporairement.

## 1. Smoke test routes publiques

- Ouvrir `/`
  Attendu: la home s'affiche sans warning PHP.
- Ouvrir `/programmes`
  Attendu: la liste s'affiche.
- Ouvrir `/salles`
  Attendu: la liste s'affiche.
- Ouvrir `/temoignages`
  Attendu: la page s'affiche, sans formulaire si non connecte.
- Ouvrir `/carriere`
  Attendu: le formulaire s'affiche.
- Ouvrir une route inconnue, ex. `/does-not-exist`
  Attendu: page 404.

## 2. Authentification

- Aller sur `/register` et creer un compte user valide.
  Attendu: redirection vers `/account`.
- Se deconnecter via `/logout`.
  Attendu: retour sur `/`.
- Se reconnecter via `/login`.
  Attendu: redirection vers `/account`.
- Tenter un login avec mauvais mot de passe.
  Attendu: message d'erreur, pas de connexion.

## 3. Protections d'acces

- Ouvrir `/account` en etant deconnecte.
  Attendu: redirection vers `/login`.
- Ouvrir `/mes-programmes` en etant deconnecte.
  Attendu: redirection vers `/login`.
- Ouvrir `/admin` avec un compte `user`.
  Attendu: redirection vers `/`.
- Ouvrir `/admin` avec un compte `admin`.
  Attendu: panneau admin visible.

## 4. CSRF

- Connecte en user, ouvrir le detail d'un programme `/programmes/show?id=X`.
  Attendu: le formulaire "S inscrire" contient un champ cache `csrf_token`.
- Supprimer manuellement la valeur du token dans DevTools puis soumettre.
  Attendu: l'inscription echoue et redirige sans ajout.
- Ouvrir `/temoignages`, vider le `csrf_token` puis soumettre.
  Attendu: message "Token invalide." ou refus equivalent.
- Ouvrir `/carriere`, vider le `csrf_token` puis soumettre.
  Attendu: message "Token invalide." ou refus equivalent.
- En admin, vider le `csrf_token` sur un formulaire CRUD.
  Attendu: aucune modification en base.

## 5. Programmes cote utilisateur

- Depuis `/programmes`, filtrer par `objectif` et/ou `niveau`.
  Attendu: la liste filtre correctement.
- Ouvrir un detail programme.
  Attendu: les champs detail s'affichent proprement si presents.
- Cliquer sur "S inscrire" en etant connecte.
  Attendu: redirection sur le detail avec etat "Deja inscrit" apres ajout.
- Recliquer ou recharger.
  Attendu: pas de doublon visible, pas d'erreur.
- Ouvrir `/mes-programmes`.
  Attendu: le programme inscrit apparait.

## 6. Suivi utilisateur

- Depuis `/account`, ajouter une entree de progression valide.
  Attendu: retour sur `/account` avec la nouvelle ligne dans l'historique.
- Tester une valeur invalide, ex. `poids=0`.
  Attendu: refus silencieux ou absence d'ajout.

## 7. Temoignages

- Connecte en user, soumettre un temoignage valide.
  Attendu: message de succes.
- Verifier en admin sur `/admin`.
  Attendu: le temoignage apparait dans la liste en attente.
- Moderer en `approuve`.
  Attendu: retour sur `/admin` sans erreur.
- Retourner sur `/temoignages`.
  Attendu: le temoignage approuve est visible publiquement.

## 8. Carriere

- Soumettre le formulaire avec des champs valides.
  Attendu: message de succes.
- Soumettre avec un email invalide.
  Attendu: refus, pas d'insertion.
- Soumettre avec champ obligatoire vide.
  Attendu: refus, pas d'insertion.

## 9. CRUD admin utilisateurs

- Depuis `/admin`, creer un utilisateur valide.
  Attendu: nouvel utilisateur visible dans la table.
- Tenter de creer un utilisateur avec email deja utilise.
  Attendu: pas de doublon cree.
- Supprimer un autre utilisateur.
  Attendu: suppression effective.
- Tenter de supprimer son propre compte admin.
  Attendu: refus.

## 10. CRUD admin programmes

- Creer un programme avec `title` et `description`.
  Attendu: programme visible dans la liste et sur `/programmes`.
- Modifier ce programme.
  Attendu: les nouvelles valeurs apparaissent.
- Supprimer ce programme.
  Attendu: disparition dans `/admin` et `/programmes`.

## 11. CRUD admin salles

- Creer une salle valide.
  Attendu: salle visible dans `/admin` et `/salles`.
- Modifier la salle.
  Attendu: nouvelles valeurs visibles.
- Filtrer `/salles?ville=...`
  Attendu: la recherche renvoie la bonne salle.
- Supprimer la salle.
  Attendu: elle disparait des listes.

## 12. Controle donnees

- Verifier qu'aucun champ HTML n'affiche de balise injectee en clair.
  Attendu: les contenus sont echappes a l'affichage.
- Verifier les dates de creation visibles dans compte/temoignages/admin.
  Attendu: format coherent et pas de valeur vide anormale.
- Verifier que les pages critiques ne cassent pas si une entite est introuvable.
  Exemple: `/programmes/show?id=999999`
  Attendu: message "Programme introuvable."

## Requete SQL utiles

```sql
SELECT id, username, email, role, created_at FROM users ORDER BY id DESC;
SELECT id, title, niveau, objectif FROM programme ORDER BY id DESC;
SELECT id, nom, ville FROM salle ORDER BY id DESC;
SELECT id, user_id, note, statut, created_at FROM temoignages ORDER BY id DESC;
SELECT id, user_id, programme_id FROM programme_utilisateur ORDER BY id DESC;
SELECT id, user_id, poids, tour_taille, nombre_seances, date_suivi FROM progression ORDER BY id DESC;
SELECT id, nom, email, poste, created_at FROM candidatures ORDER BY id DESC;
```

## Validation minimale avant merge

- Toutes les routes critiques repondent.
- Aucun formulaire critique ne contourne le CSRF.
- Aucun warning/erreur PHP visible.
- Les CRUD admin fonctionnent.
- Le user peut se connecter, consulter son compte, s'inscrire a un programme et laisser un temoignage.
