<?php
/**
 * Liste des zones projet - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Zones projet';
$active_menu = 'projects';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'project_zones';
$table_view_title = 'Zones projet';
$table_view_module = 'projects';
$table_view_prefix = 'project_zones';
$table_view_entity = 'Zone projet';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-geo-alt';
$table_view_index_href = 'projects/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
