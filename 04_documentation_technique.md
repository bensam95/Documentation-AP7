# Documentation Technique
## Système de Réservation de Places de Parking

---

## 1. Architecture de l'application

### Stack technique

| Composant | Technologie | Version |
|-----------|-------------|---------|
| Langage backend | PHP | 8.4 |
| Framework backend | Laravel | 13 |
| Base de données | MySQL | 8.4 |
| Frontend CSS | Tailwind CSS | CDN |
| Serveur de développement | PHP Artisan Serve | — |
| Système d'exploitation | Ubuntu | 25.10 |
| Virtualisation | VMware Workstation | — |

---

## 2. Architecture MVC (Modèle - Vue - Contrôleur)

Laravel suit le patron d'architecture MVC :

```
Requête HTTP
     │
     ▼
┌─────────────┐
│   ROUTES    │  routes/web.php — Aiguillage des URLs
└──────┬──────┘
       │
       ▼
┌─────────────┐
│ MIDDLEWARE  │  auth, admin — Vérification des droits
└──────┬──────┘
       │
       ▼
┌─────────────┐
│ CONTRÔLEUR  │  app/Http/Controllers/ — Logique métier
└──────┬──────┘
       │
       ▼
┌─────────────┐
│   MODÈLE    │  app/Models/ — Interaction avec la BDD
└──────┬──────┘
       │
       ▼
┌─────────────┐
│    VUE      │  resources/views/ — Affichage HTML
└─────────────┘
       │
       ▼
  Réponse HTTP
```

---

## 3. Structure des dossiers

```
parking-app/
│
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       └── ExpireReservations.php     ← Tâche planifiée
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php  ← Connexion
│   │   │   │   └── RegisteredUserController.php        ← Inscription
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php    ← Tableau de bord admin
│   │   │   │   ├── ParkingSpotController.php  ← CRUD places
│   │   │   │   ├── UserController.php         ← CRUD utilisateurs
│   │   │   │   ├── WaitingListController.php  ← File d'attente
│   │   │   │   ├── ReservationController.php  ← Réservations admin
│   │   │   │   └── SettingController.php      ← Paramètres
│   │   │   ├── ReservationController.php      ← Réservations user
│   │   │   └── ProfileController.php          ← Profil utilisateur
│   │   │
│   │   └── Middleware/
│   │       └── AdminMiddleware.php            ← Protection routes admin
│   │
│   └── Models/
│       ├── User.php           ← Modèle utilisateur
│       ├── ParkingSpot.php    ← Modèle place de parking
│       ├── Reservation.php    ← Modèle réservation
│       ├── WaitingList.php    ← Modèle file d'attente
│       └── Setting.php        ← Modèle paramètres
│
├── database/
│   ├── migrations/            ← Structure des tables
│   └── seeders/
│       └── DatabaseSeeder.php ← Données initiales
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php     ← Layout utilisateur
│       │   └── admin.blade.php   ← Layout admin
│       ├── auth/
│       │   ├── login.blade.php   ← Page connexion
│       │   └── register.blade.php← Page inscription
│       ├── profile/
│       │   └── edit.blade.php    ← Page profil
│       ├── dashboard.blade.php   ← Tableau de bord user
│       └── admin/
│           ├── dashboard.blade.php
│           ├── spots/
│           ├── users/
│           ├── reservations/
│           ├── history.blade.php
│           ├── waiting-list.blade.php
│           └── settings.blade.php
│
└── routes/
    ├── web.php       ← Routes principales
    ├── auth.php      ← Routes authentification
    └── console.php   ← Tâches planifiées
```

---

## 4. Modèle Conceptuel de Données (MCD)

```
┌──────────────────────┐         ┌──────────────────────┐
│        USERS         │         │    PARKING_SPOTS      │
├──────────────────────┤         ├──────────────────────┤
│ id (PK)              │         │ id (PK)              │
│ name                 │         │ number_parking_spot  │
│ email (UNIQUE)       │         │ is_available         │
│ password             │         │ created_at           │
│ is_admin             │         │ updated_at           │
│ is_active            │         └──────────┬───────────┘
│ status               │                    │
│ login_attempts       │         1,n         │ 1,n
│ last_failed_login    │         ┌───────────┴───────────┐
│ created_at           ├─────────┤     RESERVATIONS      │
│ updated_at           │ 1,n     ├───────────────────────┤
└──────────┬───────────┘         │ id (PK)               │
           │                     │ user_id (FK)          │
           │                     │ parking_spot_id (FK)  │
           │                     │ status                │
           │                     │ start_date            │
           │                     │ actual_end_date       │
           │                     │ created_at            │
           │                     │ updated_at            │
           │                     └───────────────────────┘
           │
           │ 0,1
           │
┌──────────┴───────────┐         ┌──────────────────────┐
│    WAITING_LIST      │         │      SETTINGS        │
├──────────────────────┤         ├──────────────────────┤
│ id (PK)              │         │ id (PK)              │
│ user_id (FK)         │         │ key (UNIQUE)         │
│ position_wait        │         │ value                │
│ request_date         │         │ created_at           │
│ created_at           │         │ updated_at           │
│ updated_at           │         └──────────────────────┘
└──────────────────────┘
```

---

## 5. Description des tables

### Table `users`
| Colonne | Type | Description |
|---------|------|-------------|
| id | BIGINT (PK) | Identifiant unique |
| name | VARCHAR(255) | Nom complet |
| email | VARCHAR(255) UNIQUE | Adresse email |
| password | VARCHAR(255) | Mot de passe haché (bcrypt) |
| is_admin | BOOLEAN | 1 = admin, 0 = utilisateur |
| is_active | BOOLEAN | Compte actif ou non |
| status | ENUM(pending, active, locked) | État du compte |
| login_attempts | INTEGER | Nombre de tentatives échouées |
| last_failed_login | TIMESTAMP | Date dernière tentative échouée |

### Table `parking_spots`
| Colonne | Type | Description |
|---------|------|-------------|
| id | BIGINT (PK) | Identifiant unique |
| number_parking_spot | VARCHAR(10) UNIQUE | Numéro de place (ex: P-01) |
| is_available | BOOLEAN | 1 = libre, 0 = occupée |

### Table `reservations`
| Colonne | Type | Description |
|---------|------|-------------|
| id | BIGINT (PK) | Identifiant unique |
| user_id | BIGINT (FK) | Référence vers users.id |
| parking_spot_id | BIGINT (FK) | Référence vers parking_spots.id |
| status | ENUM(active, expired, closed) | État de la réservation |
| start_date | TIMESTAMP | Date de début |
| actual_end_date | TIMESTAMP | Date d'expiration |

### Table `waiting_list`
| Colonne | Type | Description |
|---------|------|-------------|
| id | BIGINT (PK) | Identifiant unique |
| user_id | BIGINT (FK) | Référence vers users.id |
| position_wait | INTEGER | Position dans la file (1 = premier) |
| request_date | TIMESTAMP | Date de la demande |

### Table `settings`
| Colonne | Type | Description |
|---------|------|-------------|
| id | BIGINT (PK) | Identifiant unique |
| key | VARCHAR(255) UNIQUE | Clé du paramètre |
| value | VARCHAR(255) | Valeur du paramètre |

---

## 6. Relations entre les modèles

```
User
 ├── hasMany(Reservation)       → Un utilisateur peut avoir plusieurs réservations
 ├── hasOne(Reservation) active → Un utilisateur a au plus une réservation active
 └── hasOne(WaitingList)        → Un utilisateur est au plus une fois en file d'attente

ParkingSpot
 ├── hasMany(Reservation)       → Une place peut avoir eu plusieurs réservations
 └── hasOne(Reservation) active → Une place a au plus une réservation active

Reservation
 ├── belongsTo(User)            → Appartient à un utilisateur
 └── belongsTo(ParkingSpot)     → Appartient à une place

WaitingList
 └── belongsTo(User)            → Appartient à un utilisateur
```

---

## 7. Sécurité de l'application

### Authentification
- Hachage des mots de passe avec **bcrypt** via Laravel
- Protection CSRF sur tous les formulaires (token @csrf)
- Sessions sécurisées avec régénération après connexion

### Politique de mot de passe
- Minimum 14 caractères
- Au moins 1 majuscule
- Au moins 1 minuscule
- Au moins 1 caractère spécial

### Protection contre les attaques

| Attaque | Protection |
|---------|-----------|
| Injection SQL | Requêtes préparées via Eloquent ORM |
| CSRF | Token CSRF sur tous les formulaires |
| Brute force | Verrouillage après 3 tentatives + délais 30s/45s |
| Accès non autorisé | Middleware auth + admin sur les routes |
| XSS | Échappement automatique des variables dans Blade ({{ }}) |

### Gestion des tentatives de connexion
```
Tentative 1 échouée → Délai 30 secondes
Tentative 2 échouée → Délai 45 secondes
Tentative 3 échouée → Compte verrouillé (status = locked)
                    → Seul l'admin peut débloquer
```

---

## 8. Logique métier principale

### Algorithme de réservation
```
1. Vérifier que l'utilisateur est actif
2. Vérifier qu'il n'a pas déjà une réservation active
3. Vérifier qu'il n'est pas déjà en file d'attente
4. Chercher une place libre aléatoirement
   ├── Si place trouvée :
   │   ├── Créer la réservation (status = active)
   │   ├── Marquer la place (is_available = false)
   │   └── Date expiration = now() + durée_par_défaut
   └── Si aucune place :
       ├── Calculer la prochaine position (max + 1)
       └── Ajouter en waiting_list
```

### Algorithme de libération de place
```
1. Vérifier les droits (propriétaire ou admin)
2. Marquer la place comme disponible (is_available = true)
3. Fermer la réservation (status = closed)
4. Vérifier si quelqu'un attend en file
   ├── Si file non vide :
   │   ├── Récupérer le premier (position_wait = 1)
   │   ├── Créer une nouvelle réservation pour lui
   │   ├── Marquer la place à nouveau occupée
   │   ├── Supprimer son entrée de la file
   │   └── Réordonner les positions (1, 2, 3...)
   └── Si file vide :
       └── La place reste disponible
```

### Algorithme d'expiration automatique
```
Commande : php artisan reservations:expire
1. Récupérer toutes les réservations actives expirées (actual_end_date < now())
2. Pour chaque réservation expirée :
   ├── Mettre status = expired
   ├── Libérer la place
   └── Attribuer au prochain en file (même algo que ci-dessus)
```

---

## 9. Commandes artisan disponibles

| Commande | Description |
|----------|-------------|
| `php artisan serve` | Lance le serveur de développement |
| `php artisan migrate` | Applique les migrations |
| `php artisan migrate:fresh --seed` | Recrée toutes les tables et insère les données |
| `php artisan db:seed` | Insère les données initiales |
| `php artisan route:list` | Liste toutes les routes |
| `php artisan reservations:expire` | Expire les réservations dont la date est dépassée |
| `php artisan cache:clear` | Vide le cache de l'application |
| `php artisan config:clear` | Vide le cache de configuration |
| `php artisan view:clear` | Vide le cache des vues |

---

## 10. Installation et déploiement

### Prérequis
- Ubuntu 20.04 ou supérieur
- PHP 8.2 ou supérieur avec extensions : mbstring, xml, curl, mysql, zip, bcmath
- MySQL 8.0 ou supérieur
- Composer 2.x
- Node.js 18 ou supérieur

### Installation pas à pas

```bash
# 1. Cloner le projet
git clone https://github.com/[username]/parking-app.git
cd parking-app

# 2. Installer les dépendances PHP
composer install

# 3. Copier le fichier de configuration
cp .env.example .env

# 4. Générer la clé de l'application
php artisan key:generate

# 5. Configurer la base de données dans .env
DB_DATABASE=parking_app
DB_USERNAME=parking_user
DB_PASSWORD=votre_mot_de_passe

# 6. Créer la base de données MySQL
sudo mysql -e "CREATE DATABASE parking_app;"
sudo mysql -e "CREATE USER 'parking_user'@'localhost' IDENTIFIED BY 'password';"
sudo mysql -e "GRANT ALL PRIVILEGES ON parking_app.* TO 'parking_user'@'localhost';"

# 7. Lancer les migrations et le seeder
php artisan migrate --seed

# 8. Lancer le serveur
php artisan serve --host=0.0.0.0 --port=8000
```

### Comptes créés par défaut

| Rôle | Email | Mot de passe |
|------|-------|-------------|
| Administrateur | admin@parking.fr | Admin1234!Admin |
| Utilisateur test | user@parking.fr | User1234!UserOk |

---

## 11. Données initiales (Seeder)

Le seeder crée automatiquement :
- 1 compte administrateur
- 1 compte utilisateur de test
- 20 places de parking (P-01 à P-20)
- 1 paramètre : durée par défaut = 30 jours

---

## 12. Accès réseau local

Pour accéder à l'application depuis d'autres machines du réseau local :

```bash
# Trouver l'IP de la VM
hostname -I

# Lancer le serveur accessible depuis tout le réseau
php artisan serve --host=0.0.0.0 --port=8000
```

Les autres machines peuvent accéder via : `http://[IP-VM]:8000`
