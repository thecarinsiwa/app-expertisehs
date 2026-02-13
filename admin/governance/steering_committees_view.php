<?php
/**
 * Liste des comités de pilotage - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Comités de pilotage';
$active_menu = 'governance';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'steering_committees';
$table_view_title = 'Comités de pilotage';
$table_view_module = 'governance';
$table_view_prefix = 'steering_committees';
$table_view_entity = 'Comité de pilotage';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-diagram-3';
$table_view_index_href = 'governance/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
