<?php
/**
 * Liste des missions d'expertise - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Missions d\'expertise';
$active_menu = 'missions';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'expertise_missions';
$table_view_title = 'Missions d\'expertise';
$table_view_module = 'missions';
$table_view_prefix = 'expertise_missions';
$table_view_entity = 'Mission';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-airplane';
$table_view_index_href = 'missions/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
