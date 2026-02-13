<?php
/**
 * Liste des points d'avancement - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Points d\'avancement';
$active_menu = 'governance';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'progress_points';
$table_view_title = 'Points d\'avancement';
$table_view_module = 'governance';
$table_view_prefix = 'progress_points';
$table_view_entity = 'Point d\'avancement';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-flag';
$table_view_index_href = 'governance/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
