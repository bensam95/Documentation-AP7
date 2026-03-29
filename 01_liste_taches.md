# Liste des tâches — Système de Réservation de Parking
## Triées par ordre de priorité

---

## PRIORITÉ 1 — Fonctionnalités critiques (indispensables)

| # | Tâche | Statut | Description |
|---|-------|--------|-------------|
| 1 | Installation de l'environnement | ✅ Terminé | PHP 8.4, MySQL, Node.js, Composer sur Ubuntu |
| 2 | Création du projet Laravel | ✅ Terminé | Structure de base, configuration .env |
| 3 | Base de données — Migrations | ✅ Terminé | Tables users, parking_spots, reservations, waiting_list, settings |
| 4 | Authentification sécurisée | ✅ Terminé | Login avec compteur de tentatives, verrouillage compte |
| 5 | Gestion des rôles | ✅ Terminé | Rôle admin / utilisateur, middleware de protection |
| 6 | Réservation de place aléatoire | ✅ Terminé | Attribution immédiate et aléatoire d'une place libre |
| 7 | File d'attente automatique | ✅ Terminé | Placement en file si aucune place disponible |
| 8 | Fermeture de réservation | ✅ Terminé | Par l'utilisateur ou l'administrateur |
| 9 | Attribution automatique depuis la file | ✅ Terminé | Quand une place se libère, le premier en attente la reçoit |
| 10 | Espace administrateur — Back-office | ✅ Terminé | Tableau de bord, sidebar de navigation |

---

## PRIORITÉ 2 — Fonctionnalités importantes

| # | Tâche | Statut | Description |
|---|-------|--------|-------------|
| 11 | Gestion des places (CRUD) | ✅ Terminé | Admin : créer, modifier, supprimer des places |
| 12 | Gestion des utilisateurs (CRUD) | ✅ Terminé | Admin : créer, modifier, supprimer, débloquer |
| 13 | Validation des inscriptions | ✅ Terminé | Admin approuve ou rejette les demandes |
| 14 | Page d'inscription | ✅ Terminé | Demande d'accès avec validation admin requise |
| 15 | Sécurité mot de passe | ✅ Terminé | 14 caractères min, majuscule, minuscule, caractère spécial |
| 16 | Blocage après 3 tentatives | ✅ Terminé | Délai 30s, 45s, puis verrouillage du compte |
| 17 | Déblocage de compte (admin) | ✅ Terminé | Bouton débloquer dans la liste des utilisateurs |
| 18 | Historique des réservations | ✅ Terminé | Côté utilisateur et côté admin |
| 19 | Durée configurable (admin) | ✅ Terminé | Paramètre durée par défaut dans les settings |
| 20 | Expiration automatique | ✅ Terminé | Commande artisan planifiable |

---

## PRIORITÉ 3 — Fonctionnalités secondaires

| # | Tâche | Statut | Description |
|---|-------|--------|-------------|
| 21 | Rang dans la file d'attente | ✅ Terminé | Utilisateur voit sa position avec barre de progression |
| 22 | Changement de mot de passe | ✅ Terminé | Utilisateur peut modifier son propre mot de passe |
| 23 | Réinitialisation MDP (admin) | ✅ Terminé | Admin génère un nouveau mot de passe temporaire |
| 24 | Attribution manuelle (admin) | ✅ Terminé | Admin choisit manuellement utilisateur + place |
| 25 | Gestion file d'attente (admin) | ✅ Terminé | Modifier la position, retirer de la file |
| 26 | Design responsive | ✅ Terminé | Interface adaptée mobile/desktop via Tailwind CSS |
| 27 | Pages HTML5 valides | ✅ Terminé | Structure sémantique correcte |

---

## PRIORITÉ 4 — Améliorations et bonus

| # | Tâche | Statut | Description |
|---|-------|--------|-------------|
| 28 | Documentation utilisateur | ✅ Terminé | Guide d'utilisation accessible depuis l'app |
| 29 | Documentation technique | ✅ Terminé | Architecture, MCD, schémas |
| 30 | Plan du site avec URLs | ✅ Terminé | Toutes les routes documentées |
| 31 | Mot de passe oublié | ⏳ À faire | Envoi d'email de réinitialisation |
| 32 | Notifications email | ⏳ À faire | Email lors de l'attribution d'une place |
| 33 | Tests unitaires | ⏳ À faire | Tests automatisés des contrôleurs |
| 34 | Déploiement réseau local | ✅ Terminé | Accessible via IP de la VM |
| 35 | Versioning GitHub | ⏳ À faire | Code source hébergé sur GitHub |

---

## Récapitulatif

| Priorité | Total | Terminé | En cours |
|----------|-------|---------|----------|
| Priorité 1 | 10 | 10 | 0 |
| Priorité 2 | 10 | 10 | 0 |
| Priorité 3 | 7 | 7 | 0 |
| Priorité 4 | 8 | 5 | 3 |
| **Total** | **35** | **32** | **3** |
