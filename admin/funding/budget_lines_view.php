<?php
/**
 * Liste des lignes budgétaires - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Lignes budgétaires';
$active_menu = 'funding';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'budget_lines';
$table_view_title = 'Lignes budgétaires';
$table_view_module = 'funding';
$table_view_prefix = 'budget_lines';
$table_view_entity = 'Ligne budgétaire';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-list-ul';
$table_view_index_href = 'funding/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
