# API REST ExpertiseHS

CRUD PHP sans framework pour toutes les tables de la base **MySQL** (`database/schema.mysql.sql`).

## Prérequis

- PHP 7.4+ avec extensions `pdo`, `pdo_mysql`, `json`
- MySQL 5.7+ ou 8+ avec la base créée depuis `database/schema.mysql.sql`

## Configuration

Variables d'environnement (optionnel) :

- `DB_HOST` (défaut : localhost)
- `DB_PORT` (défaut : 3306)
- `DB_NAME` (défaut : expertisehs)
- `DB_USER` (défaut : root)
- `DB_PASSWORD` (défaut : vide)
- `DB_CHARSET` (défaut : utf8mb4)

Modifier sinon `api/config/database.php`.

## Vérification

Une page **Bootstrap responsive** permet de contrôler la configuration, la connexion à la base et la disponibilité de l’API :

- **URL :** `http://localhost:8000/check.php` ou `.../api/check` (selon votre installation)
- Vérifications : fichier de config, connexion MySQL, nombre de tables, réponse de l’API.

## Lancement

**Serveur PHP intégré :**

```bash
cd api
php -S localhost:8000
# Base URL : http://localhost:8000/
```

**Apache :** placer le projet sous une URL (ex. `/api`) et activer `mod_rewrite`. Les requêtes sont redirigées vers `index.php` via `.htaccess`.

## Endpoints

| Méthode | URL | Description |
|--------|-----|-------------|
| GET | `/` ou `/api` | Liste des tables disponibles |
| GET | `/{table}` | Liste des enregistrements (query : `?limit=100&offset=0`) |
| GET | `/{table}/{id}` | Détail d'un enregistrement (UUID) |
| POST | `/{table}` | Création (body JSON) |
| PUT | `/{table}/{id}` | Mise à jour (body JSON) |
| DELETE | `/{table}/{id}` | Suppression |

Exemples :

```bash
# Liste des organisations
GET http://localhost:8000/organizations

# Détail
GET http://localhost:8000/organizations/550e8400-e29b-41d4-a716-446655440000

# Création
POST http://localhost:8000/organizations
Content-Type: application/json
{"name": "Mon ONG", "country_code": "FRA"}

# Mise à jour
PUT http://localhost:8000/organizations/550e8400-e29b-41d4-a716-446655440000
Content-Type: application/json
{"name": "Nouveau nom"}

# Suppression
DELETE http://localhost:8000/organizations/550e8400-e29b-41d4-a716-446655440000
```

## Tables exposées

Toutes les tables du schéma sont exposées : `organizations`, `structures`, `departments`, `institutional_partners`, `countries`, `regions`, `cities`, `priority_zones`, `expertise_domains`, `projects`, `project_zones`, `project_phases`, `deliverables`, `skills`, `employees`, `experts`, `expert_skills`, `project_roles`, `donors`, `funding_contracts`, `project_budgets`, `budget_lines`, `target_communities`, `beneficiaries`, `local_contacts`, `local_partner_institutions`, `expertise_missions`, `mission_participants`, `mission_activities`, `mission_deliverables`, `flight_tickets`, `accommodations`, `equipment`, `steering_committees`, `steering_committee_members`, `meetings`, `decisions`, `progress_points`, `result_indicators`, `indicator_measurements`, `project_evaluations`, `testimonials`, `impact_reports`, `documentary_resources`, `best_practices`, `lessons_learned`, `model_library`, `news`, `publications`, `media`, `newsletters`, `access_profiles`, `users`, `activity_log`, `configurations`.

Réponses en JSON. CORS autorisé (`Access-Control-Allow-Origin: *`) pour usage depuis un front.
