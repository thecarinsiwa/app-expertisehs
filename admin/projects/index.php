<?php
/** Tableau de bord - Module Projets d'expertise */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Projets d\'expertise';
$active_menu = 'projects';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Projets d\'expertise';
$module_dashboard_subtitle = 'Vue d\'ensemble des projets, phases, livrables et domaines d\'expertise.';
$module_dashboard_entities = [
    ['table' => 'projects',              'label' => 'Projets',              'href' => 'projects/projects_view.php',           'icon' => 'bi-briefcase'],
    ['table' => 'project_zones',        'label' => 'Zones projet',        'href' => 'projects/project_zones_view.php',     'icon' => 'bi-geo-alt'],
    ['table' => 'project_phases',       'label' => 'Phases projet',       'href' => 'projects/project_phases_view.php',     'icon' => 'bi-list-check'],
    ['table' => 'deliverables',         'label' => 'Livrables',           'href' => 'projects/deliverables_view.php',       'icon' => 'bi-check2-square'],
    ['table' => 'expertise_domains',     'label' => 'Domaines d\'expertise', 'href' => 'projects/expertise_domains_view.php',  'icon' => 'bi-journal'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
