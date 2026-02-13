<?php
/** Tableau de bord - Module Entités organisationnelles */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Entités organisationnelles';
$active_menu = 'organizational';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Entités organisationnelles';
$module_dashboard_subtitle = 'Organisations, structures, départements et partenaires institutionnels.';
$module_dashboard_entities = [
    ['table' => 'organizations',            'label' => 'Organisations',              'href' => 'organizational/organizations_view.php',            'icon' => 'bi-building'],
    ['table' => 'structures',               'label' => 'Structures',                 'href' => 'organizational/structures_view.php',               'icon' => 'bi-diagram-3'],
    ['table' => 'departments',              'label' => 'Départements',                'href' => 'organizational/departments_view.php',              'icon' => 'bi-folder'],
    ['table' => 'institutional_partners',   'label' => 'Partenaires institutionnels', 'href' => 'organizational/institutional_partners_view.php',  'icon' => 'bi-link-45deg'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
