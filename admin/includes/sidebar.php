<?php
/**
 * Barre latérale - Modules ExpertiseHS
 * $active_menu : clé du module actif (ex: 'dashboard', 'projects', 'funding').
 * $active_sub  : (optionnel) nom du fichier vue actif (ex: 'projects_view') pour surligner le lien.
 */
$active = isset($active_menu) ? $active_menu : '';
$active_sub = isset($active_sub) ? $active_sub : '';

// Ordre et libellés alignés sur les modules fonctionnels ExpertiseHS (README)
$sections = [
    [
        'id' => 'dashboard',
        'icon' => 'bi-house-door',
        'label' => 'Tableau de bord',
        'href' => $admin_base . 'index.php',
        'items' => null,
    ],
    [
        'id' => 'projects',
        'icon' => 'bi-briefcase',
        'label' => 'Projets d\'expertise',
        'items' => [
            ['view' => 'projects_view', 'label' => 'Projets'],
            ['view' => 'expertise_domains_view', 'label' => 'Domaines d\'expertise'],
            ['view' => 'project_phases_view', 'label' => 'Phases'],
            ['view' => 'deliverables_view', 'label' => 'Livrables'],
            ['view' => 'project_zones_view', 'label' => 'Zones projet'],
        ],
        'folder' => 'projects',
    ],
    [
        'id' => 'missions',
        'icon' => 'bi-airplane',
        'label' => 'Missions d\'expertise',
        'items' => [
            ['view' => 'expertise_missions_view', 'label' => 'Missions'],
            ['view' => 'mission_participants_view', 'label' => 'Participants'],
            ['view' => 'mission_activities_view', 'label' => 'Activités'],
            ['view' => 'mission_deliverables_view', 'label' => 'Livrables'],
        ],
        'folder' => 'missions',
    ],
    [
        'id' => 'organizational',
        'icon' => 'bi-building',
        'label' => 'Entités organisationnelles',
        'items' => [
            ['view' => 'organizations_view', 'label' => 'Organisations'],
            ['view' => 'structures_view', 'label' => 'Structures'],
            ['view' => 'departments_view', 'label' => 'Départements'],
            ['view' => 'institutional_partners_view', 'label' => 'Partenaires institutionnels'],
        ],
        'folder' => 'organizational',
    ],
    [
        'id' => 'stakeholders',
        'icon' => 'bi-people',
        'label' => 'Parties prenantes',
        'items' => [
            ['view' => 'beneficiaries_view', 'label' => 'Bénéficiaires'],
            ['view' => 'local_contacts_view', 'label' => 'Contacts locaux'],
            ['view' => 'local_partner_institutions_view', 'label' => 'Institutions partenaires locales'],
            ['view' => 'target_communities_view', 'label' => 'Communautés cibles'],
        ],
        'folder' => 'stakeholders',
    ],
    [
        'id' => 'hr',
        'icon' => 'bi-person-badge',
        'label' => 'Ressources humaines',
        'items' => [
            ['view' => 'employees_view', 'label' => 'Employés'],
            ['view' => 'experts_view', 'label' => 'Experts'],
            ['view' => 'skills_view', 'label' => 'Compétences'],
            ['view' => 'expert_skills_view', 'label' => 'Compétences experts'],
            ['view' => 'project_roles_view', 'label' => 'Rôles projet'],
        ],
        'folder' => 'hr',
    ],
    [
        'id' => 'funding',
        'icon' => 'bi-currency-dollar',
        'label' => 'Financement et budget',
        'items' => [
            ['view' => 'donors_view', 'label' => 'Bailleurs'],
            ['view' => 'funding_contracts_view', 'label' => 'Contrats de financement'],
            ['view' => 'project_budgets_view', 'label' => 'Budgets projet'],
            ['view' => 'budget_lines_view', 'label' => 'Lignes budgétaires'],
        ],
        'folder' => 'funding',
    ],
    [
        'id' => 'zones',
        'icon' => 'bi-geo-alt',
        'label' => 'Zones d\'intervention',
        'items' => [
            ['view' => 'countries_view', 'label' => 'Pays'],
            ['view' => 'regions_view', 'label' => 'Régions'],
            ['view' => 'cities_view', 'label' => 'Villes'],
            ['view' => 'priority_zones_view', 'label' => 'Zones prioritaires'],
        ],
        'folder' => 'zones',
    ],
    [
        'id' => 'governance',
        'icon' => 'bi-diagram-3',
        'label' => 'Gouvernance',
        'items' => [
            ['view' => 'steering_committees_view', 'label' => 'Comités de pilotage'],
            ['view' => 'steering_committee_members_view', 'label' => 'Membres'],
            ['view' => 'meetings_view', 'label' => 'Réunions'],
            ['view' => 'decisions_view', 'label' => 'Décisions'],
            ['view' => 'progress_points_view', 'label' => 'Points d\'avancement'],
        ],
        'folder' => 'governance',
    ],
    [
        'id' => 'impact',
        'icon' => 'bi-graph-up',
        'label' => 'Impact et évaluation',
        'items' => [
            ['view' => 'result_indicators_view', 'label' => 'Indicateurs de résultat'],
            ['view' => 'indicator_measurements_view', 'label' => 'Mesures indicateurs'],
            ['view' => 'impact_reports_view', 'label' => 'Rapports d\'impact'],
            ['view' => 'project_evaluations_view', 'label' => 'Évaluations projet'],
            ['view' => 'testimonials_view', 'label' => 'Témoignages'],
        ],
        'folder' => 'impact',
    ],
    [
        'id' => 'knowledge',
        'icon' => 'bi-journal-bookmark',
        'label' => 'Gestion des connaissances',
        'items' => [
            ['view' => 'documentary_resources_view', 'label' => 'Ressources documentaires'],
            ['view' => 'best_practices_view', 'label' => 'Bonnes pratiques'],
            ['view' => 'lessons_learned_view', 'label' => 'Leçons apprises'],
            ['view' => 'model_library_view', 'label' => 'Bibliothèque de modèles'],
        ],
        'folder' => 'knowledge',
    ],
    [
        'id' => 'communication',
        'icon' => 'bi-megaphone',
        'label' => 'Communication',
        'items' => [
            ['view' => 'news_view', 'label' => 'Actualités'],
            ['view' => 'publications_view', 'label' => 'Publications'],
            ['view' => 'media_view', 'label' => 'Médias'],
            ['view' => 'newsletters_view', 'label' => 'Newsletters'],
        ],
        'folder' => 'communication',
    ],
    [
        'id' => 'logistic',
        'icon' => 'bi-box-seam',
        'label' => 'Logistique',
        'items' => [
            ['view' => 'flight_tickets_view', 'label' => 'Billets d\'avion'],
            ['view' => 'accommodations_view', 'label' => 'Hébergements'],
            ['view' => 'equipment_view', 'label' => 'Équipements'],
        ],
        'folder' => 'logistic',
    ],
    [
        'id' => 'admin',
        'icon' => 'bi-gear',
        'label' => 'Administration',
        'items' => [
            ['view' => 'users_view', 'label' => 'Utilisateurs'],
            ['view' => 'access_profiles_view', 'label' => 'Profils d\'accès'],
            ['view' => 'activity_log_view', 'label' => 'Journal d\'activité'],
            ['view' => 'configurations_view', 'label' => 'Configurations'],
        ],
        'folder' => 'admin',
    ],
];
?>
<div class="sidebar-overlay" id="sidebarOverlay" aria-hidden="true"></div>
<button class="btn btn-light navbar-toggler-sidebar border shadow-sm" type="button" id="sidebarToggler" aria-label="Menu">
    <i class="bi bi-list"></i>
</button>

<aside class="sidebar" id="sidebar">
    <div class="logo-wrap">
        <div class="logo-title">ExpertiseHS</div>
        <div class="logo-sub">Administration</div>
    </div>
    <div class="search-wrap">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
            <input type="search" class="form-control border-start-0" placeholder="Rechercher" aria-label="Rechercher">
        </div>
    </div>
    <nav class="nav-section">
        <div class="nav-section-title">Menu</div>
        <?php foreach ($sections as $section): ?>
            <?php if (empty($section['items'])): ?>
                <a class="nav-link <?php echo ($section['id'] === $active) ? 'active' : ''; ?>" href="<?php echo htmlspecialchars($section['href']); ?>">
                    <i class="bi <?php echo htmlspecialchars($section['icon']); ?>"></i>
                    <?php echo htmlspecialchars($section['label']); ?>
                </a>
            <?php else: ?>
                <?php
                $collapse_id = 'collapse-' . $section['id'];
                $is_active_section = ($section['id'] === $active);
                ?>
                <div class="sidebar-group">
                    <button type="button" class="nav-link nav-link-toggle w-100 text-start border-0 bg-transparent <?php echo $is_active_section ? 'active' : ''; ?>" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapse_id; ?>" aria-expanded="<?php echo $is_active_section ? 'true' : 'false'; ?>" aria-controls="<?php echo $collapse_id; ?>">
                        <i class="bi <?php echo htmlspecialchars($section['icon']); ?>"></i>
                        <span><?php echo htmlspecialchars($section['label']); ?></span>
                        <i class="bi bi-chevron-right sidebar-chevron ms-auto" aria-hidden="true"></i>
                    </button>
                    <div class="collapse <?php echo $is_active_section ? 'show' : ''; ?>" id="<?php echo $collapse_id; ?>">
                        <div class="sidebar-sub">
                            <?php foreach ($section['items'] as $item): ?>
                                <?php
                                $item_href = $admin_base . $section['folder'] . '/' . $item['view'] . '.php';
                                $is_active_item = ($section['id'] === $active && $active_sub === $item['view']);
                                ?>
                                <a class="sidebar-sub-link <?php echo $is_active_item ? 'active' : ''; ?>" href="<?php echo htmlspecialchars($item_href); ?>">
                                    <?php echo htmlspecialchars($item['label']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </nav>
    <div class="theme-select d-flex align-items-center justify-content-between px-3 py-2 border-top border-secondary border-opacity-25">
        <span class="small text-muted">Thème</span>
        <div class="btn-group btn-group-sm" role="group" aria-label="Mode clair / sombre">
            <input type="radio" class="btn-check" name="themeToggle" id="themeLight" value="light" autocomplete="off">
            <label class="btn btn-outline-secondary theme-btn" for="themeLight" title="Mode clair"><i class="bi bi-sun"></i></label>
            <input type="radio" class="btn-check" name="themeToggle" id="themeDark" value="dark" autocomplete="off">
            <label class="btn btn-outline-secondary theme-btn" for="themeDark" title="Mode sombre"><i class="bi bi-moon"></i></label>
        </div>
    </div>
    <div class="lang-select">
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0 input-group-text-theme"><i class="bi bi-globe text-muted"></i></span>
            <select class="form-select border-start-0 form-select-theme" aria-label="Langue">
                <option value="fr">Fr</option>
                <option value="en">Eng</option>
            </select>
        </div>
    </div>
</aside>
