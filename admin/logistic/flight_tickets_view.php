<?php
/**
 * Liste des billets d'avion - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Billets d\'avion';
$active_menu = 'logistic';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'flight_tickets';
$table_view_title = 'Billets d\'avion';
$table_view_module = 'logistic';
$table_view_prefix = 'flight_tickets';
$table_view_entity = 'Billet d\'avion';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-airplane';
$table_view_index_href = 'logistic/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
