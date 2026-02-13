<?php
/** Tableau de bord - Module Ressources humaines */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Ressources humaines';
$active_menu = 'hr';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Ressources humaines';
$module_dashboard_subtitle = 'Experts, employés, compétences et rôles projet.';
$module_dashboard_entities = [
    ['table' => 'experts',        'label' => 'Experts',         'href' => 'hr/experts_view.php',         'icon' => 'bi-person-badge'],
    ['table' => 'employees',      'label' => 'Employés',        'href' => 'hr/employees_view.php',       'icon' => 'bi-person'],
    ['table' => 'skills',        'label' => 'Compétences',     'href' => 'hr/skills_view.php',           'icon' => 'bi-star'],
    ['table' => 'expert_skills',  'label' => 'Compétences experts', 'href' => 'hr/expert_skills_view.php', 'icon' => 'bi-award'],
    ['table' => 'project_roles', 'label' => 'Rôles projet',    'href' => 'hr/project_roles_view.php',    'icon' => 'bi-person-rolodex'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
