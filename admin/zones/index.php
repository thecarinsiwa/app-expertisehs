<?php
/** Tableau de bord - Module Zones d'intervention */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Zones d\'intervention';
$active_menu = 'zones';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Zones d\'intervention';
$module_dashboard_subtitle = 'Pays, régions, villes et zones prioritaires.';
$module_dashboard_entities = [
    ['table' => 'countries',       'label' => 'Pays',              'href' => 'zones/countries_view.php',       'icon' => 'bi-globe'],
    ['table' => 'regions',         'label' => 'Régions',           'href' => 'zones/regions_view.php',         'icon' => 'bi-geo'],
    ['table' => 'cities',          'label' => 'Villes',             'href' => 'zones/cities_view.php',          'icon' => 'bi-geo-alt'],
    ['table' => 'priority_zones',  'label' => 'Zones prioritaires', 'href' => 'zones/priority_zones_view.php',  'icon' => 'bi-pin-map'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
