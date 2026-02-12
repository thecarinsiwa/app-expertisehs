# ExpertiseHS

**Expertise Humanitaire et Sociale** — L'expertise humanitaire et sociale regroupe les savoirs professionnels nécessaires pour répondre aux crises et à l'exclusion. Elle s'articule autour de deux volets principaux : l'humanitaire, qui intervient dans l'urgence (catastrophes, conflits) pour sauver des vies et protéger les populations, et le social, qui agit sur le long terme contre les vulnérabilités et pour l'inclusion. Cette expertise requiert à la fois des compétences techniques (gestion de projet, droit humanitaire, logistique) et des qualités humaines (résilience, adaptabilité interculturelle, éthique). Le secteur est marqué par des enjeux contemporains comme la professionnalisation, la coordination entre acteurs, et la recherche d'un équilibre entre réponse d'urgence et développement durable. Aujourd'hui, il tend vers une plus grande redevabilité et un renforcement des capacités locales.

---

## Le projet

ExpertiseHS est un outil conçu pour **Expertise Humanitaire et Sociale**, une organisation qui mène des projets d'expertise technique et des missions d'expertise dans les domaines humanitaires et sociaux. La plateforme permet de piloter le cycle de vie des projets (identification des besoins, montage financier, phases, livrables, gouvernance, évaluation d'impact) et de gérer les missions menées pour des organisations externes (UNICEF, OIM, PAM, etc.) — évaluations, études, formations, missions VBG, revues mi-parcours, etc.

### Objectifs

- **Centraliser** les informations sur les projets, les missions d'expertise, les experts, les bailleurs, les organisations partenaires et les zones d'intervention.
- **Structurer** la gouvernance des projets (comités de pilotage, réunions, points d'avancement) et la traçabilité des décisions.
- **Piloter** les budgets, les contrats de financement et les lignes budgétaires par projet.
- **Gérer les missions d'expertise** autonomes pour organisations externes (UNICEF, OIM, PAM, etc.) : participants, activités, livrables.
- **Organiser** la logistique des missions (déplacements, hébergements, équipements) et la gestion des parties prenantes (bénéficiaires, contacts locaux, institutions partenaires).
- **Capitaliser** les connaissances (bonnes pratiques, leçons apprises, modèles) et valoriser les résultats (indicateurs, évaluations, témoignages, rapports d'impact).
- **Communiquer** sur les actions (actualités, publications, médias, newsletters) et renforcer la visibilité de l'organisation.

### À qui s'adresse la plateforme ?

- **Directions et départements** : vue d'ensemble des projets, des missions d'expertise, du financement et de l'avancement.
- **Chefs de projet** : suivi des phases, livrables et parties prenantes des projets.
- **Experts (internes et externes)** : missions d'expertise, projets, compétences, rôles et documents de référence.
- **Services administratifs** : budgets, contrats, logistique des missions et conformité.
- **Partenaires, bailleurs et organisations clientes** (UNICEF, OIM, PAM, etc.) : reporting, indicateurs et rapports d'impact.

En résumé, ExpertiseHS (Expertise Humanitaire et Sociale) accompagne l'organisation dans la conduite de leurs projets dans leurs domaines d'expertise et de ses missions pour organisations externes, tout en respectant les exigences d'une structure à but non lucratif (bailleurs, impact social, bénéficiaires, redevabilité).

---

## Modules fonctionnels

| Module                         | Contenu principal                                                                                        |
| ------------------------------ | -------------------------------------------------------------------------------------------------------- |
| **Entités organisationnelles** | Organisation, Structure (filiales, branches, antennes), Département/Direction, Partenaire institutionnel |
| **Projets d'expertise**        | Projet, Domaine d'expertise, Phase de projet, Livrable                                                   |
| **Missions d'expertise**       | Mission (évaluation, étude, VBG, mi-parcours…), participants, activités, livrables                       |
| **Ressources humaines**        | Employé/Collaborateur, Expert (interne/externe), Compétence/Spécialité, Rôle dans les projets            |
| **Gestion des connaissances**  | Ressource documentaire, Bonne pratique, Leçon apprise, Bibliothèque de modèles                           |
| **Financement et budget**      | Donateur/Bailleur, Contrat de financement, Budget projet, Ligne budgétaire                               |
| **Zones d'intervention**       | Pays, Région, Ville, Zone prioritaire                                                                    |
| **Impact et évaluation**       | Indicateur de résultat, Évaluation de projet, Témoignage/Étude de cas, Rapport d'impact                  |
| **Communication**              | Actualité/Événement, Publication, Média, Newsletter                                                      |
| **Logistique**                 | Billet d'avion, Hébergement, Équipement (au service des missions d'expertise)                            |
| **Parties prenantes**          | Bénéficiaire, Contact local, Institution partenaire locale, Communauté cible                             |
| **Gouvernance**                | Comité de pilotage, Réunion, Décision, Point d'avancement                                                |
| **Administration**             | Utilisateur, Profil d'accès, Journal d'activité, Configuration                                           |

### Distinction Projets / Missions d'expertise

- **Projets d'expertise** : projets propres à ExpertiseHS (financement, bailleurs, phases, livrables, gouvernance).
- **Missions d'expertise** : missions autonomes pour des organisations externes (UNICEF, OIM, PAM, etc.) — évaluations, études, missions VBG, revues mi-parcours… Non liées aux projets de la plateforme.

---

## Base de données

Deux schémas sont disponibles dans `database/` :

- **`schema.sql`** : PostgreSQL (référence)
- **`schema.mysql.sql`** : MySQL 5.7+ / 8+ — utilisé par l’API PHP

- **Clés primaires** : UUID (généré par l’API en PHP pour MySQL)
- **Langue** : anglais (tables et colonnes)

---

## Stack technique

_À définir (ex. Laravel, Symfony, etc.)_

---

## Prérequis

_À compléter selon la stack choisie._

---

## Installation

```bash
# Cloner le dépôt (si applicable)
git clone <url-du-repo>
cd expertisehs

# Installer les dépendances
# (commande à adapter : composer install, npm install, etc.)
```

_Instructions détaillées à ajouter après initialisation du projet._

---

## Utilisation

_À compléter : commandes de lancement (serveur, queue, etc.) et accès à l'application._

---

## Licence

_À définir._
