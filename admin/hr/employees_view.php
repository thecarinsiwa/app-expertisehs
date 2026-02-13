<?php
/**
 * Liste des employés - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Employés';
$active_menu = 'hr';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'employees';
$table_view_title = 'Employés';
$table_view_module = 'hr';
$table_view_prefix = 'employees';
$table_view_entity = 'Employé';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-person';
$table_view_index_href = 'hr/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
