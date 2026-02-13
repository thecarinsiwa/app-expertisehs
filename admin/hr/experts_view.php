<?php
/**
 * Liste des experts - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Experts';
$active_menu = 'hr';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'experts';
$table_view_title = 'Experts';
$table_view_module = 'hr';
$table_view_prefix = 'experts';
$table_view_entity = 'Expert';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-person-badge';
$table_view_index_href = 'hr/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
