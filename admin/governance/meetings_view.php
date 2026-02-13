<?php
/**
 * Liste des réunions - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Réunions';
$active_menu = 'governance';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'meetings';
$table_view_title = 'Réunions';
$table_view_module = 'governance';
$table_view_prefix = 'meetings';
$table_view_entity = 'Réunion';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-calendar-event';
$table_view_index_href = 'governance/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
