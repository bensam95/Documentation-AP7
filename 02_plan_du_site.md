# Plan du Site — Système de Réservation de Parking
## Toutes les URLs de l'application

---

## 1. Pages publiques (non connecté)

| URL | Méthode | Contrôleur | Description |
|-----|---------|-----------|-------------|
| `/` | GET | — | Redirige vers `/login` |
| `/login` | GET | AuthenticatedSessionController@create | Page de connexion |
| `/login` | POST | AuthenticatedSessionController@store | Traitement de la connexion |
| `/register` | GET | RegisteredUserController@create | Page de demande d'accès |
| `/register` | POST | RegisteredUserController@store | Envoi de la demande d'inscription |
| `/forgot-password` | GET | PasswordResetLinkController@create | Page mot de passe oublié |
| `/forgot-password` | POST | PasswordResetLinkController@store | Envoi du lien de réinitialisation |
| `/reset-password/{token}` | GET | NewPasswordController@create | Page de réinitialisation |
| `/reset-password` | POST | NewPasswordController@store | Traitement de la réinitialisation |
| `/logout` | POST | AuthenticatedSessionController@destroy | Déconnexion |

---

## 2. Espace utilisateur (connecté — rôle user)

| URL | Méthode | Contrôleur | Description |
|-----|---------|-----------|-------------|
| `/dashboard` | GET | ReservationController@index | Tableau de bord utilisateur |
| `/reservation` | POST | ReservationController@store | Demander une place de parking |
| `/reservation/{id}` | DELETE | ReservationController@destroy | Fermer/libérer sa réservation |
| `/profile` | GET | ProfileController@edit | Page profil et changement de MDP |
| `/profile/password` | PATCH | ProfileController@updatePassword | Modifier son mot de passe |

---

## 3. Espace administrateur (connecté — rôle admin)

### Tableau de bord
| URL | Méthode | Contrôleur | Description |
|-----|---------|-----------|-------------|
| `/admin` | GET | Admin\DashboardController@index | Tableau de bord admin |

### Gestion des places
| URL | Méthode | Contrôleur | Description |
|-----|---------|-----------|-------------|
| `/admin/spots` | GET | Admin\ParkingSpotController@index | Liste de toutes les places |
| `/admin/spots/create` | GET | Admin\ParkingSpotController@create | Formulaire ajout place |
| `/admin/spots` | POST | Admin\ParkingSpotController@store | Créer une place |
| `/admin/spots/{id}/edit` | GET | Admin\ParkingSpotController@edit | Formulaire modification place |
| `/admin/spots/{id}` | PUT | Admin\ParkingSpotController@update | Modifier une place |
| `/admin/spots/{id}` | DELETE | Admin\ParkingSpotController@destroy | Supprimer une place |

### Gestion des utilisateurs
| URL | Méthode | Contrôleur | Description |
|-----|---------|-----------|-------------|
| `/admin/users` | GET | Admin\UserController@index | Liste des utilisateurs + inscriptions en attente |
| `/admin/users/create` | GET | Admin\UserController@create | Formulaire création compte |
| `/admin/users` | POST | Admin\UserController@store | Créer un compte utilisateur |
| `/admin/users/{id}/edit` | GET | Admin\UserController@edit | Formulaire modification utilisateur |
| `/admin/users/{id}` | PUT | Admin\UserController@update | Modifier un utilisateur |
| `/admin/users/{id}` | DELETE | Admin\UserController@destroy | Supprimer un utilisateur |
| `/admin/users/{id}/approve` | POST | Admin\UserController@approve | Approuver une demande d'inscription |
| `/admin/users/{id}/reject` | POST | Admin\UserController@reject | Rejeter une demande d'inscription |
| `/admin/users/{id}/unlock` | POST | Admin\UserController@unlock | Débloquer un compte verrouillé |
| `/admin/users/{id}/reset-password` | POST | Admin\UserController@resetPassword | Réinitialiser le MDP d'un utilisateur |

### Gestion de la file d'attente
| URL | Méthode | Contrôleur | Description |
|-----|---------|-----------|-------------|
| `/admin/waiting-list` | GET | Admin\WaitingListController@index | Voir la file d'attente |
| `/admin/waiting-list/{id}/move` | PATCH | Admin\WaitingListController@move | Modifier la position dans la file |
| `/admin/waiting-list/{id}` | DELETE | Admin\WaitingListController@destroy | Retirer quelqu'un de la file |

### Gestion des réservations
| URL | Méthode | Contrôleur | Description |
|-----|---------|-----------|-------------|
| `/admin/history` | GET | Admin\ReservationController@history | Historique complet des réservations |
| `/admin/reservations/create` | GET | Admin\ReservationController@create | Formulaire attribution manuelle |
| `/admin/reservations` | POST | Admin\ReservationController@store | Créer une réservation manuellement |
| `/admin/reservations/{id}` | DELETE | Admin\ReservationController@destroy | Fermer une réservation |

### Paramètres
| URL | Méthode | Contrôleur | Description |
|-----|---------|-----------|-------------|
| `/admin/settings` | GET | Admin\SettingController@edit | Page des paramètres |
| `/admin/settings` | PATCH | Admin\SettingController@update | Modifier la durée par défaut |
| `/admin/settings/expire` | POST | Admin\SettingController@forceExpire | Forcer l'expiration des réservations |

---

## 4. Schéma de navigation

```
/ (accueil)
│
├── /login ──────────────────────────────── Page publique
├── /register ───────────────────────────── Page publique
├── /forgot-password ────────────────────── Page publique
│
├── /dashboard ──────────────────────────── Utilisateur connecté
│   ├── Demander une place → POST /reservation
│   ├── Libérer ma place  → DELETE /reservation/{id}
│   └── Mon profil        → /profile
│
├── /profile ────────────────────────────── Utilisateur connecté
│   └── Changer MDP       → PATCH /profile/password
│
└── /admin ──────────────────────────────── Admin seulement
    ├── /admin/spots ────────────────────── Gestion des places
    ├── /admin/users ────────────────────── Gestion des utilisateurs
    ├── /admin/waiting-list ─────────────── File d'attente
    ├── /admin/history ──────────────────── Historique
    ├── /admin/reservations/create ──────── Attribution manuelle
    └── /admin/settings ─────────────────── Paramètres
```

---

## 5. Middleware de protection

| Middleware | Routes protégées | Rôle requis |
|-----------|-----------------|-------------|
| `guest` | /login, /register | Non connecté |
| `auth` | /dashboard, /profile | Connecté |
| `auth + admin` | /admin/* | Admin uniquement |
