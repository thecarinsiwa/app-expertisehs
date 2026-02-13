<?php
/**
 * Liste des structures - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Structures';
$active_menu = 'organizational';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'structures';
$table_view_title = 'Structures';
$table_view_module = 'organizational';
$table_view_prefix = 'structures';
$table_view_entity = 'Structure';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-diagram-3';
$table_view_index_href = 'organizational/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
