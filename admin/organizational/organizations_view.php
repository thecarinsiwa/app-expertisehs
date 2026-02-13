<?php
/**
 * Liste des organisations - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Organisations';
$active_menu = 'organizational';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'organizations';
$table_view_title = 'Organisations';
$table_view_module = 'organizational';
$table_view_prefix = 'organizations';
$table_view_entity = 'Organisation';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-building';
$table_view_index_href = 'organizational/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
