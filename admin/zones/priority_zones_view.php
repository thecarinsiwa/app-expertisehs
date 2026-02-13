<?php
/**
 * Liste des zones prioritaires - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Zones prioritaires';
$active_menu = 'zones';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'priority_zones';
$table_view_title = 'Zones prioritaires';
$table_view_module = 'zones';
$table_view_prefix = 'priority_zones';
$table_view_entity = 'Zone prioritaire';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-pin-map';
$table_view_index_href = 'zones/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
