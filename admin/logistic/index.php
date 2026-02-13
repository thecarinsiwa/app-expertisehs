<?php
/** Tableau de bord - Module Logistique */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Logistique';
$active_menu = 'logistic';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$module_dashboard_title = 'Logistique';
$module_dashboard_subtitle = 'Billets d\'avion, hébergements et équipements.';
$module_dashboard_entities = [
    ['table' => 'flight_tickets',  'label' => 'Billets d\'avion', 'href' => 'logistic/flight_tickets_view.php',  'icon' => 'bi-airplane'],
    ['table' => 'accommodations',  'label' => 'Hébergements',    'href' => 'logistic/accommodations_view.php',  'icon' => 'bi-house'],
    ['table' => 'equipment',       'label' => 'Équipements',      'href' => 'logistic/equipment_view.php',       'icon' => 'bi-box-seam'],
];

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/module_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
