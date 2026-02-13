<?php
/** Tableau de bord - Module Gouvernance */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Gouvernance';
$active_menu = 'governance';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Gouvernance';
$module_dashboard_subtitle = 'Comités de pilotage, réunions, décisions et points d\'avancement.';
$module_dashboard_entities = [
    ['table' => 'steering_committees',       'label' => 'Comités de pilotage',  'href' => 'governance/steering_committees_view.php',       'icon' => 'bi-diagram-3'],
    ['table' => 'steering_committee_members', 'label' => 'Membres comités',      'href' => 'governance/steering_committee_members_view.php', 'icon' => 'bi-people'],
    ['table' => 'meetings',                  'label' => 'Réunions',              'href' => 'governance/meetings_view.php',                  'icon' => 'bi-calendar-event'],
    ['table' => 'decisions',                 'label' => 'Décisions',             'href' => 'governance/decisions_view.php',                 'icon' => 'bi-check2-all'],
    ['table' => 'progress_points',           'label' => 'Points d\'avancement',  'href' => 'governance/progress_points_view.php',           'icon' => 'bi-flag'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
