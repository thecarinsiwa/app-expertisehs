<?php
/**
 * Liste des décisions - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Décisions';
$active_menu = 'governance';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'decisions';
$table_view_title = 'Décisions';
$table_view_module = 'governance';
$table_view_prefix = 'decisions';
$table_view_entity = 'Décision';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-check2-all';
$table_view_index_href = 'governance/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
