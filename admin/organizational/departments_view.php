<?php
/**
 * Liste des départements - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Départements';
$active_menu = 'organizational';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'departments';
$table_view_title = 'Départements';
$table_view_module = 'organizational';
$table_view_prefix = 'departments';
$table_view_entity = 'Département';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-folder';
$table_view_index_href = 'organizational/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
