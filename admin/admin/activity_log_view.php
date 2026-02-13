<?php
/**
 * Liste du journal d'activité - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Journal d\'activité';
$active_menu = 'admin';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'activity_log';
$table_view_title = 'Journal d\'activité';
$table_view_module = 'admin';
$table_view_prefix = 'activity_log';
$table_view_entity = 'Entrée du journal';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-journal-text';
$table_view_index_href = 'admin/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
