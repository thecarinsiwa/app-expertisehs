<?php
/**
 * Liste des donateurs - ExpertiseHS (vue dashboard)
 */
require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../includes/bootstrap_db.php';

$page_title = 'Donateurs';
$active_menu = 'funding';
$page_styles = '<link href="' . $admin_base . 'assets/css/page-dashboard.css" rel="stylesheet">';

$table_view_table = 'donors';
$table_view_title = 'Donateurs';
$table_view_module = 'funding';
$table_view_prefix = 'donors';
$table_view_entity = 'Donateur';
$table_view_entity_feminine = false;
$table_view_icon = 'bi-currency-dollar';
$table_view_index_href = 'funding/index.php';

require __DIR__ . '/../includes/layout_start.php';
require __DIR__ . '/../includes/table_view_dashboard.php';
require __DIR__ . '/../includes/layout_end.php';
