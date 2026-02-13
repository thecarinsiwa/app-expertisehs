<?php
/**
 * Barre latérale - Modules ExpertiseHS
 * $active_menu : clé du module actif (ex: 'dashboard', 'projects', 'funding').
 */
$active = isset($active_menu) ? $active_menu : '';

// Ordre et libellés alignés sur les modules fonctionnels ExpertiseHS — liens vers index.php de chaque module
$sections = [
    [
        'id' => 'dashboard',
        'icon' => 'bi-house-door',
        'label' => 'Tableau de bord',
        'href' => $admin_base . 'index.php',
    ],
    [
        'id' => 'projects',
        'icon' => 'bi-briefcase',
        'label' => 'Projets d\'expertise',
        'href' => $admin_base . 'projects/index.php',
    ],
    [
        'id' => 'missions',
        'icon' => 'bi-airplane',
        'label' => 'Missions d\'expertise',
        'href' => $admin_base . 'missions/index.php',
    ],
    [
        'id' => 'organizational',
        'icon' => 'bi-building',
        'label' => 'Entités organisationnelles',
        'href' => $admin_base . 'organizational/index.php',
    ],
    [
        'id' => 'stakeholders',
        'icon' => 'bi-people',
        'label' => 'Parties prenantes',
        'href' => $admin_base . 'stakeholders/index.php',
    ],
    [
        'id' => 'hr',
        'icon' => 'bi-person-badge',
        'label' => 'Ressources humaines',
        'href' => $admin_base . 'hr/index.php',
    ],
    [
        'id' => 'funding',
        'icon' => 'bi-currency-dollar',
        'label' => 'Financement et budget',
        'href' => $admin_base . 'funding/index.php',
    ],
    [
        'id' => 'zones',
        'icon' => 'bi-geo-alt',
        'label' => 'Zones d\'intervention',
        'href' => $admin_base . 'zones/index.php',
    ],
    [
        'id' => 'governance',
        'icon' => 'bi-diagram-3',
        'label' => 'Gouvernance',
        'href' => $admin_base . 'governance/index.php',
    ],
    [
        'id' => 'impact',
        'icon' => 'bi-graph-up',
        'label' => 'Impact et évaluation',
        'href' => $admin_base . 'impact/index.php',
    ],
    [
        'id' => 'knowledge',
        'icon' => 'bi-journal-bookmark',
        'label' => 'Gestion des connaissances',
        'href' => $admin_base . 'knowledge/index.php',
    ],
    [
        'id' => 'communication',
        'icon' => 'bi-megaphone',
        'label' => 'Communication',
        'href' => $admin_base . 'communication/index.php',
    ],
    [
        'id' => 'logistic',
        'icon' => 'bi-box-seam',
        'label' => 'Logistique',
        'href' => $admin_base . 'logistic/index.php',
    ],
    [
        'id' => 'admin',
        'icon' => 'bi-gear',
        'label' => 'Administration',
        'href' => $admin_base . 'admin/index.php',
    ],
];
?>
<div class="sidebar-overlay" id="sidebarOverlay" aria-hidden="true"></div>
<button class="btn btn-light navbar-toggler-sidebar border shadow-sm" type="button" id="sidebarToggler" aria-label="Menu">
    <i class="bi bi-list"></i>
</button>

<aside class="sidebar" id="sidebar">
    <div class="logo-wrap">
        <div class="logo-title">Expertise Humanitaire et Sociale</div>
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
            <a class="nav-link <?php echo ($section['id'] === $active) ? 'active' : ''; ?>" href="<?php echo htmlspecialchars($section['href']); ?>">
                <i class="bi <?php echo htmlspecialchars($section['icon']); ?>"></i>
                <?php echo htmlspecialchars($section['label']); ?>
            </a>
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
    <div class="sidebar-logout px-3 pb-3">
        <a href="<?php echo htmlspecialchars($admin_base . 'logout.php'); ?>" class="btn btn-outline-danger btn-sm w-100">
            <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
        </a>
    </div>
</aside>
