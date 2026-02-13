<?php
/**
 * Liste des rapports d'impact - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Rapports d\'impact';
$active_menu = 'impact';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'impact_reports';
$table_view_title = 'Rapports d\'impact';
$table_view_module = 'impact';
$table_view_prefix = 'impact_reports';
$table_view_entity = 'Rapport d\'impact';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-file-earmark-bar-graph';
$table_view_index_href = 'impact/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
