<?php
/**
 * Liste des newsletters - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Newsletters';
$active_menu = 'communication';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'newsletters';
$table_view_title = 'Newsletters';
$table_view_module = 'communication';
$table_view_prefix = 'newsletters';
$table_view_entity = 'Newsletter';
$table_view_entity_feminine = true;
$table_view_icon = 'bi-envelope';
$table_view_index_href = 'communication/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
