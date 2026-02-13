<?php
/**
 * Liste des pays - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Pays';
$active_menu = 'zones';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'countries';
$table_view_title = 'Pays';
$table_view_module = 'zones';
$table_view_prefix = 'countries';
$table_view_entity = 'Pays';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-globe';
$table_view_index_href = 'zones/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
